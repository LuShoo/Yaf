<?php
/**
 * 卡信息管理
 * @author ziyang<hexiangcheng@showboom.cn>
 *  @final 2016-04-25
 */
class CardpackageController extends Yaf_Controller_Abstract
{
    static private $_extName = array('xls','xlsx');
    static private $_btn = 1;


	//卡信息列表
	public function indexAction()
	{
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		$this->_view->display('cardpackage_list.tpl');
	}

	//回调获取卡信息列表
	public function getListAction()
	{
		$params = $_GET;

	 	if (!empty($params['pack_code'])) {
            $condition['pack_code:eq'] = $params['pack_code'];
        }
		
		if (!empty($params['iccid'])) {
			$condition['iccid:eq'] = $params['iccid'];
		}

        if (!empty($params['telephone'])) {
            $condition['telephone:eq'] = $params['telephone'];
        }

        if (isset($params['effective_type'])&&$params['effective_type']!='a') {
            $condition['effective_type:eq'] = $params['effective_type'];
        }

        if (isset($params['status'])&&$params['status']!='a') {
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
		$orderService = TZ_Loader::service('Cardpackage', 'Card');

		//get data
		$orderTotal = $orderService->getOrderTotal($condition);
		$orderList = $orderService->getOrderList($condition,$page, $size);

        //处理卡类型关联
        $type=TZ_Loader::model('Cardtype','Common')->select(['id:gt'=>0,'id,name']);
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
		$orderHtml = $this->_view->render('cardpackage_list_row.tpl');

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
		$result=TZ_Loader::model('Cardpackage', 'Common')->select(array('id:eq'=>$_GET['id']),'*','ROW');
        $result['type_name']=TZ_Loader::model('Cardtype','Common')->select(['id:eq'=>$result['type_id']],'name','ROW')['name'];
        //已生效XX个月，剩余XX个月
        if($result['pack_type']==1){
        	if(strtotime($result['effective_time'])>time()){
        		$typeHtml="还未生效";
        	}elseif(strtotime($result['expire_time'])<time()){
        		$typeHtml="已经结束";
        	}else{
        		$use=TZ_Loader::service('Cardpackage','Card')->getMonthNum(date('Y-m-d'),$result['effective_time']);
				$use+=1;
        		$left=TZ_Loader::service('Cardpackage','Card')->getMonthNum(date('Y-m-d'),$result['expire_time']);
        		$typeHtml="已生效".$use."个月，剩余".$left."个月";
        	}
        }else{
       	 $typeHtml="";
        }
		$result['typeHtml']=$typeHtml;
		$this->_view->assign('list', $result);
		$this->_view->display('cardpackage_set.tpl');
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
		TZ_Loader::model('Cardpackage','Common')->update($info,array('id:eq'=>$params['id']));

		header('Location:/card/cardpackage/index.html');
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

    public function exportDatatwoAction()
    {
        set_time_limit(0);
        ini_set('memory_limit','200M');

        $params=$_GET;

        $where=' where 1 ';

        if (!empty($params['pack_code'])) {
            $where.=" and pack_code='".$params['pack_code']."'";
        }
        if (!empty($params['iccid'])) {
            $where.=" and iccid='".$params['iccid']."'";
        }

        if (!empty($params['telephone'])) {
            $where.=" and telephone='".$params['telephone']."'";
        }

        if (isset($params['effective_type'])&&$params['effective_type']!='a') {
            $where.=" and effective_type='".$params['effective_type']."'";
        }

        if (isset($params['status'])&&$params['status']!='a') {
            $where.=" and status='".$params['status']."'";
        }

        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $where.=" and created_at between '".$params['start_time']."' and '".$params['end_time']."'";
        }


        $sql='select type_id,iccid,telephone,order_id,pack_name,pack_type,status,pack_price,effective_time,expire_time from card_package  ';
        $sql.=$where;
        $sql.=' order by created_at desc';
        $result=TZ_loader::model('Cardpackage','Common')->query($sql);
        $query=$result->fetchAll();
        $title=[
            [
                '卡类型',
                'iccid',
                '手机号',
                '订单号',
                '套餐名称',
                '套餐类型',
                '套餐状态',
                '售价',
                '生效时间',
                '到期时间',
            ]
        ];

        if($query){

            $card_type=TZ_loader::model('Cardtype','Common')->select([],'id,name','ALL');
            $arr_type=[];
            foreach($card_type as $v){
                $arr_type[$v['id']]=$v['name'];
            }

            foreach($query as &$v){
                $v['type_id']=$arr_type[$v['type_id']];

                $arr=array(
                    '0'=>'未激活',
                    '1'=>'未生效',
               	    '2'=>'已生效',
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