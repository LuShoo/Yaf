<?php
/**
 * 企业实名管理
 *  @ author ziyang <hexiangcheng@showboom.cn>
 * @date 2016-08-11
 */
class IdentifyController extends Yaf_Controller_Abstract
{
    public $cols=array('business_type','bid','iden_name','iden_nric','corp_name','corp_no','corp_licencer','mobile');


	//实名列表主页
	public function indexAction()
	{
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		$this->_view->display('identify_list.tpl');
	}

	//回调获取实名列表
	public function getListAction()
	{
		$params = $_GET;

		if (!empty($params['corp_name'])) {
			$condition['corp_name:eq'] = $params['corp_name'];
		}
		if (!empty($params['bid'])) {
			$condition['bid:eq'] = $params['bid'];
		}

		if (!empty($params['type'])) {
			$condition['business_type:eq'] = $params['type'];
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
		$channel_cardService = TZ_Loader::service('Identify', 'Corp');
		//get data
		$channel_cardTotal = $channel_cardService->getTotal($condition);
		$channel_cardList = $channel_cardService->getList($condition,$page, $size);


		//render
		$this->_view->assign('list', $channel_cardList);
		$channel_cardHtml = $this->_view->render('identify_list_row.tpl');

		//send
		$data = array(
            'total' => $channel_cardTotal,
            'html' => $channel_cardHtml
		);
		echo json_encode($data);
	}




    public function addAction()
    {

        $this->_view->display('identify_add.tpl');
    }


    //保存
    public function createAction()
    {
        set_time_limit(0);
        ini_set('memory_limit','200M');

        $cols = array();
        foreach($this->cols AS $val){
            if(isset($_POST[$val])){
                $cols[$val] =  trim($_POST[$val]);
            }
        }

        //判断该企业是否已经实名过
        $data=TZ_Loader::model('Corpidentify','Common')->select(['business_type:eq'=>$cols['business_type'],'bid:eq'=>$cols['bid']],'id','ROW');

        if($data){
            die(usr_json_encode(array('detail'=>'该企业已经实名过了')));
        }

         $cols['created_at']=date('Y-m-d H:i:s');

         if($cols['business_type']==1){
            $iccid_arr=TZ_Loader::model('ChannelCard','Admin')->select(['cid:eq'=>$cols['bid']],'iccid');
         }

         if($cols['business_type']==3){
            $iccid_arr=TZ_Loader::model('Carddetail','Xs')->select(['xsid:eq'=>$cols['bid']],'iccid');
         }
         if($cols['business_type']==2){
            $iccid_arr=array();
        }

        $insert_id=TZ_Loader::model('Corpidentify','Common')->insert($cols);

        if($iccid_arr){
            $arr=[];
            foreach($iccid_arr as $v){
                $arr[]=$v['iccid'];
            }

            $update=[];
            $update['iden_type']=2;
            $update['iden_id']=$insert_id;
            $update['updated_at']=date('Y-m-d H:i:s');

            $where=[];
            $where['iccid:in']=$arr;
            $where['iden_type']=0;

            TZ_Loader::model('Cardinfo','Common')->update($update,$where);

        }

        die(usr_json_encode(array('detail'=>'ok')));

    }

    //获取不同业务类型的企业
    public function getBidAction(){
        $type=intval($_POST['type']);

        $res=[];

        switch($type){

            case 1:   //渠道商
                 $result=TZ_Loader::model('User','Channel')->select([],'cid as bid,user_name as name');

                 $res['code']=200;
                 $res['result']=$result?$result:[];

                 break;

            case 2:  //大客户
                $result=[];
                $res['code']=200;
                $res['result']=$result;

                break;

            case 3:   //虚商
                 $result=TZ_Loader::model('User','Xs')->select([],'xsid as bid,xs_name as name');

                 $res['code']=200;
                 $res['result']=$result?$result:[];

                break;

            case 0:
                $result=[];
                $res['code']=200;

                $res['result']=$result;
                break;

        }

        die(json_encode($res));

    }


    public function editAction()
    {
        $id=intval($_GET['id']);
        if(!$id){
            die('数据错误');
        }

        $data=TZ_Loader::model('Corpidentify','Common')->select(['id:eq'=>$id],'*','ROW');
        if($data){

            $type=$data['business_type'];
            switch($type){

                case 1:   //渠道商
                    $name=TZ_Loader::model('User','Channel')->select(['cid:eq'=>$data['bid']],'user_name as name','ROW')['name'];
                    break;

                case 2:  //大客户
                    $name='';

                    break;

                case 3:   //虚商
                    $name=TZ_Loader::model('User','Xs')->select(['xsid:eq'=>$data['bid']],'xs_name as name','ROW')['name'];

                    break;

                case 0:
                    $name='';
                    break;
            }

            $data['name']=$name;
        }

        $this->_view->assign('list',$data);

        $this->_view->display('identify_edit.tpl');
    }


    public function editsaveAction(){

        $cols = array();
        foreach($this->cols AS $val){
            if(isset($_POST[$val])){
                $cols[$val] =  trim($_POST[$val]);
            }

            unset($cols['bid']);
            unset($cols['business_type']);
        }

        $id=$_POST['id'];

        TZ_Loader::model('Corpidentify','Common')->update($cols,['id:eq'=>$id]);

        die(usr_json_encode(array('detail'=>'ok')));
    }



    //导出记录
	public function exportDataAction()
	{
		set_time_limit(0);
		ini_set('memory_limit','200M');

		$params=$_GET;

		$where=' where 1 ';

        if (!empty($params['corp_name'])) {
            $where.=" and corp_name='".$params['corp_name']."'";
        }
        if (!empty($params['bid'])) {
            $where.=" and bid='".$params['bid']."'";
        }

        if (!empty($params['type'])) {
            $where.=" and business_type='".$params['type']."'";
        }

		if (!empty($params['start_time']) && !empty($params['end_time'])) {
			$where.=" and created_at between '".$params['start_time']."' and '".$params['end_time']."'";
		}

		$sql='select business_type,bid,iden_name,iden_nric,corp_name,corp_no,corp_licencer,mobile from corp_identify ';
		$sql.=$where;
		$sql.=' order by created_at desc';
		$result=TZ_loader::model('Corpidentify','Common')->query($sql);
		$query=$result->fetchAll();

		$title=[
				[
						'业务类型',
						'企业实名编号',
						'实名人姓名',
						'企业法人身份证',
						'企业名称',
						'营业执照号',
						'企业授权人',
						'企业授权人联系方式',
				]
		];

		if($query){

            $type_arr=array(
                '1'=>'渠道',
                '2'=>'大客户',
                '3'=>'虚商'
            );

            foreach($query as &$v){
                $v['business_type']=$type_arr[$v['business_type']];
            }

			$query=array_merge($title,$query);
		}else{
			$query=$title;
		}

		$excel = new TZ_Excel();
		$excel->dump($query,'2007');
	}

}