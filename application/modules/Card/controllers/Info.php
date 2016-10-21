<?php
/**
 * 卡信息管理
 * @author ziyang<hexiangcheng@showboom.cn>
 *  @final 2016-04-25
 */
class InfoController extends Yaf_Controller_Abstract
{
    static private $_extName = array('xls','xlsx');
    static private $_standardTemplate = '';
    static private $_stardendTempl = '78351fe54fa718ba1cb739de6e58a979';
    static private $_btn = 1;


	//卡信息列表
	public function indexAction()
	{
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		$this->_view->display('card_list.tpl');
	}

	//回调获取卡信息列表
	public function getListAction()
	{
		$params = $_GET;

		if (!empty($params['unique_id'])) {
			$condition['unique_id:eq'] = $params['unique_id'];
		}
		if (!empty($params['iccid'])) {
			$condition['iccid:eq'] = $params['iccid'];
		}

        if (!empty($params['telephone'])) {
            $condition['telephone:eq'] = $params['telephone'];
        }

        if (!empty($params['batch'])) {
            $condition['batch:eq'] = $params['batch'];
        }

        if (!empty($params['status'])) {
            $condition['status:eq'] = $params['status'];
        }

		if (!empty($params['start_time']) && !empty($params['end_time'])) {
			$condition['created_at:between'] = array($params['start_time'], $params['end_time']);
		}
		if (empty($params['page']) || empty($params['size']))
		TZ_Request::error('params error.');

		if (($params['page'] < 1) || ($params['size'] < 1))
		TZ_Request::error('params error.');

		$page = intval($params['page']);
		$size = intval($params['size']);

		//load service
		$orderService = TZ_Loader::service('Card', 'Card');

		//get data
		$orderTotal = $orderService->getOrderTotal($condition);
		$orderList = $orderService->getOrderList($condition,$page, $size);

        //处理卡类型关联
        $type=TZ_Loader::model('Type','Card')->select(['id:gt'=>0,'id,name']);
        $ids=array();
        $names=array();

        foreach($type as $key=>$val)
        {
            $ids[]=$val['id'];
            $names[]=$val['name'];
        }
        /*$ids=array_column($type,'id');
        $names=array_column($type,'name');*/

        foreach($orderList as $k=>$v){
            $key=array_search($v['type_id'],$ids);
            $orderList[$k]['type_name']=$names[$key];
        }


		//render
		$this->_view->assign('list', $orderList);
		$orderHtml = $this->_view->render('card_list_row.tpl');

		//send
		$data = array(
            'total' => $orderTotal,
            'html' => $orderHtml
		);
		echo json_encode($data);
	}
	//编辑卡信息页面
	public function setViewAction(){
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		if (empty($_GET['id']) || !is_numeric($_GET['id']))
		throw new Exception('id为空!');
		$result=TZ_Loader::model('Card', 'Card')->select(array('id:eq'=>$_GET['id']),'*','ROW');
        $result['type_name']=TZ_Loader::model('Type','Card')->select(['id:eq'=>$result['type_id']],'name','ROW')['name'];

		$this->_view->assign('list', $result);
		$this->_view->display('card_set.tpl');
	}
	//编辑卡信息
	public function setAction(){
		$info = array();
		$params = $_POST;
		if (empty($params['id']) || !is_numeric($params['id']))
		throw new Exception('id为空!');

		$info['remark'] = $params['remark'];
		$info['status'] = $params['status'];

		$info['updated_at']=date('Y-m-d H:i:s') ;
		TZ_Loader::model('Card','Card')->update($info,array('id:eq'=>$params['id']));

		header('Location:/card/info/index.html');
	}


    /**
     * 从excel中导入数据
     *
     */
    public function importDataFromExcelAction()
    {
        set_time_limit(0);

        ini_set('memory_limit','200M');

       // ignore_user_abort(false);


       /* if (empty($_FILES["file-name"]))
            self::_die(array('msg'=>'表单name未定义.','code'=>0));*/

        $file = $_FILES["file-name"];


        $fileName = $file["name"];	//获取文件名

        if ($file['error'] > 0) {
            $result = json_encode(array('msg'=>'上传出错.','code'=>0),JSON_UNESCAPED_UNICODE);
            $this->_callback($result);
        }
        $extName = substr($fileName,strrpos($fileName,'.') + 1);	//扩展名
        if (!in_array($extName, self::$_extName)) {
            $result = json_encode(array('msg'=>'不支持此扩展的Excel文件.','code'=>1),JSON_UNESCAPED_UNICODE);
            $this->_callback($result);
        }
        $filePath = $file['tmp_name'];

        $excel = new TZ_Excel();
        $excel->loadExcel($filePath);


        $data = $excel->findAll();

        $count=count($data);

        if ($count<=1) {
            $result = json_encode(array('code'=>0,'msg'=>'无有效数据.'));
            $this->_callback($result);
        }

        unset($excel); //删除大数据变量

        TZ_loader::model('Card','Card')->beginTransaction();

        try{
            foreach ($data as $key => $val)
            {
                if ($key == 1)
                    continue;
               // d($val);die;

                $len=strlen($val['G']);//数据库字段状态有可能为0
                if (empty($val['A'])||empty($val['B'])||empty($val['C'])||empty($val['D'])||empty($val['E'])||empty($val['F'])||$len<1||empty($val['H'])) {
                    throw new \Exception('第'.$key.'行部分数据不能为空，请填写完整！',1001);
                }

                //插入到数据库
                $rowdata=array();
                $rowdata["type_id"]=$val['A'];
                $rowdata["unique_id"]=$val['C'];
                $rowdata["iccid"]=$val['D'];
                $rowdata["batch"]=$val['E'];
                $rowdata["telephone"]=$val['F'];
                $rowdata["status"]=$val['G'];
                $rowdata["set_meal"]=$val['H'];
                $rowdata["remark"]=$val['I'];
                //$rowdata["tag"]=$this->_makeKey($val['D']);

                if($val['J']){
                    $rowdata["expire_time"]=$this->_excelTime($val['J']);
                }
                $rowdata["created_at"]=date('Y-m-d H:i:s');


                if(TZ_loader::model('Card','Card')->select(['iccid:eq'=>$rowdata['iccid']],'id','ROW')){
                    throw new \Exception('第'.$key.'行iccid已经存在，请更正！',1002);
                }
                if(TZ_loader::model('Card','Card')->select(['iccid:eq'=>$rowdata['iccid'],'telephone:eq'=>$rowdata['telephone']],'id','ROW')){
                    throw new \Exception('第'.$key.'行iccid和sim卡手机号已经存在',1003);
                }

                do{
                    $rowdata["tag"]=$this->_makeKey($val['D']);

                }while(TZ_loader::model('Card','Card')->select(['tag:eq'=>$rowdata['tag']],'tag','ROW'));

                try{
                    TZ_loader::model('Card','Card')->insert($rowdata);
                }catch(\Exception $e){
                     throw new \Exception('第'.$key.'行数据有误，请检查',1004);
                }
            }

            //完全没有错误,提交
            TZ_loader::model('Card','Card')->commit();

            $this->_callbackLocation(json_encode(array('code'=>200, 'msg'=>'导入成功')));

        }catch (\Exception $e)
        {
            TZ_loader::model('Card','Card')->rollback();
            $result = json_encode(array('msg'=>$e->getMessage(),'code'=>$e->getCode()),JSON_UNESCAPED_UNICODE);
            $this->_callback($result);
        }
    }

    /**
     * 导出秘钥
     *
     */
    public function exportDataAction()
    {
        set_time_limit(0);

        ini_set('memory_limit','200M');

        /* if (empty($_FILES["file-name"]))
             self::_die(array('msg'=>'表单name未定义.','code'=>0));*/

        $file = $_FILES["file-name-export"];


        $fileName = $file["name"];	//获取文件名

        if ($file['error'] > 0) {
            $result = json_encode(array('msg'=>'上传出错.','code'=>0),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }
        $extName = substr($fileName,strrpos($fileName,'.') + 1);	//扩展名
        if (!in_array($extName, self::$_extName)) {
            $result = json_encode(array('msg'=>'不支持此扩展的Excel文件.','code'=>1),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }
        $filePath = $file['tmp_name'];

        $excel = new TZ_Excel();
        $excel->loadExcel($filePath);


        $data = $excel->findAll();

        unset($excel);

        $count=count($data);

        if ($count<=1) {
            $result = json_encode(array('code'=>0,'msg'=>'无有效数据.'),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }

        $rowdata=array();

        foreach ($data as $key => $val)
        {
            $temp=[];
            if ($key == 1){
                $temp['iccid']='iccid';
                $temp['key']='iccid秘钥';
                $rowdata[]=$temp;
                continue;
            }
            if (empty($val['A'])) {
                throw new \Exception('第'.$key.'行iccid不能为空，请填写完整！',1001);
            }
            $temp['iccid']=$val['A'];

            $query=TZ_loader::model('Card','Card')->select(['iccid:eq'=>$val['A']],'tag','ROW');
            if(!$query['tag']){
                $temp['key']='';
            }else{
                $temp['key']=$query['tag'];
            }
            $rowdata[]=$temp;
        }

        $excel = new TZ_Excel();

      /* $data=TZ_loader::model('Card','Card')->select(['id:gt'=>0],'type_id,tag as type_name,unique_id,iccid,batch,telephone,status,set_meal,remark,expire_time','ALL');

        foreach($data as $k=>&$v ){

            $v['type_name']='类型类型';
            $v['unique_id']=(string)$v['unique_id'];
            $v['iccid']=(string)$v['iccid'];
            $v['batch']=(string)$v['batch'];
            $v['telephone']=(string)$v['telephone'];

        }*/
        //d($rowdata);die;
        $excel->dump($rowdata,'2007');
    }



    private function _callback($result,$type=1)
    {
        if($type==1){
            $jsCode ='<script type="text/javascript">parent.alertResult(\''.$result.'\');</script>';
        }else{
            $jsCode ='<script type="text/javascript">parent.alertResult2(\''.$result.'\');</script>';
        }
        die($jsCode);
    }
    private function _callbackLocation($str="")
    {
        $jsCode ='<script type="text/javascript">parent.alertResult(\''.$str.'\')</script>';
        die($jsCode);
    }





    private  function _makeKey($str){//根据iccid，生成秘钥

        $arr=array(
            'A','B','C','D','E','F','G',
            'H','I','J','K','L','M','N',
            'O','P','Q','R','S','T',
            'U','V','W','X','Y','Z',

            'a','b','c','d','e','f','g',
            'h','i','j','k','l','m','n',
            'o','p','q','r','s','t',
            'u','v','w','x','y','z'
        );

        $pre=$arr[array_rand($arr)].$arr[array_rand($arr)];
        $sub=$arr[array_rand($arr)].$arr[array_rand($arr)];

        //$str=strrev($pre.rand(10000,99999).$sub.mktime()).strrev($str);
        $str=strrev($pre.rand(10000,99999).$sub.sha1(uniqid())).strrev($str);

        return substr(md5(md5($str)),8,16);
    }

    private function _excelTime($date,$time=false)
    {

        if(is_numeric($date)){
            $jd = GregorianToJD(1, 1, 1970);
            $gregorian = JDToGregorian($jd+intval($date)-25569);
            $date = explode('/',$gregorian);
            $date_str = str_pad($date[2],4,'0', STR_PAD_LEFT)
                ."-".str_pad($date[0],2,'0', STR_PAD_LEFT)
                ."-".str_pad($date[1],2,'0', STR_PAD_LEFT)
                .($time?" 00:00:00":'');
            return $date_str;
        }
        return $date;
    }

    /**
     * 修改数据，不是本控制器的
     *
     */
    public function changeDataAction()
    {
        set_time_limit(0);

        ini_set('memory_limit','200M');

        /* if (empty($_FILES["file-name"]))
             self::_die(array('msg'=>'表单name未定义.','code'=>0));*/

        $file = $_FILES["file-name-export"];


        $fileName = $file["name"];	//获取文件名

        if ($file['error'] > 0) {
            $result = json_encode(array('msg'=>'上传出错.','code'=>0),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }
        $extName = substr($fileName,strrpos($fileName,'.') + 1);	//扩展名
        if (!in_array($extName, self::$_extName)) {
            $result = json_encode(array('msg'=>'不支持此扩展的Excel文件.','code'=>1),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }
        $filePath = $file['tmp_name'];

        $excel = new TZ_Excel();
        $excel->loadExcel($filePath);


        $data = $excel->findAll();

        unset($excel);

        $count=count($data);

        if ($count<=1) {
            $result = json_encode(array('code'=>0,'msg'=>'无有效数据.'),JSON_UNESCAPED_UNICODE);
            $this->_callback($result,2);
        }

        $rowdata=[];

        foreach ($data as $key => $val)
        {
            $temp=[];
            if ($key == 1){
                continue;
            }
            if (empty($val['A'])||empty($val['B'])) {
                throw new \Exception('第'.$key.'行不能为空，请填写完整！',1001);
            }
            $temp['telephone']=$val['A'];
            $temp['iccid']=$val['B'];
            $rowdata[]=$temp;
        }



        foreach($rowdata as $k=>$v)
        {

            $update="update card_info set iccid="."'".$v['iccid']."' where telephone=".$v['telephone'].";";
            echo $update;

            echo '<br/>';

        }

       die;

    }

    public function exportDatatwoAction()
    {
        set_time_limit(0);
        ini_set('memory_limit','200M');

        $params=$_GET;

        $where=' where 1 ';

        if (!empty($params['unique_id'])) {
            $where.=" and unique_id='".$params['unique_id']."'";
        }
        if (!empty($params['iccid'])) {
            $where.=" and iccid='".$params['iccid']."'";
        }

        if (!empty($params['telephone'])) {
            $where.=" and telephone='".$params['telephone']."'";
        }

        if (!empty($params['batch'])) {
            $where.=" and batch='".$params['batch']."'";
        }

        if (!empty($params['status'])) {
            $where.=" and status='".$params['status']."'";
        }

        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $where.=" and created_at between '".$params['start_time']."' and '".$params['end_time']."'";
        }


        $sql='select type_id,unique_id,iccid,telephone,batch,set_meal,status,expire_time,created_at,remark,tag from card_info  ';
        $sql.=$where;
        $sql.=' order by created_at desc';
        $result=TZ_loader::model('Card','Card')->query($sql);
        $query=$result->fetchAll();


        $title=[
            [
                '卡类型',
                '流量卡唯一码',
                'iccid',
                'sim卡号',
                '入库批次号',
                '套餐',
                '是否出库',
                '有效期',
                '创建时间',
                '备注',
                '卡秘钥',
            ]
        ];

        if($query){

            $card_type=TZ_loader::model('Type','Card')->select([],'id,name','ALL');
            $arr_type=[];
            foreach($card_type as $v){
                $arr_type[$v['id']]=$v['name'];
            }

            foreach($query as &$v){
                $v['type_id']=$arr_type[$v['type_id']];

                $arr=array(
                    '1'=>'×',
                    '2'=>'√',
                );
                $v['status']=$arr[$v['status']];

            }

            $query=array_merge($title,$query);
        }else{
            $query=$title;
        }

        $excel = new TZ_Excel();
        $excel->dump($query,'2007');
    }

}