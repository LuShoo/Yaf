<?php
/**
 * 订单管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-10-12
 */
class RebateController extends Yaf_Controller_Abstract
{
	//订单列表
	public function indexAction()
	{
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		$this->_view->display('rebate_list.tpl');
	}

	//回调获取订单列表
	public function getListAction()
	{
		$params = $_GET;

		if (!empty($params['account'])) {
			$condition['account:eq'] = $params['account'];
		}
		if (!empty($params['order_id'])) {
			$condition['order_id:eq'] = $params['order_id'];
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
		$rebateService = TZ_Loader::service('Rebate', 'Admin');
		//get data
		$rebateTotal = $rebateService->getRebateTotal($condition);
		$rebateList = $rebateService->getRebateList($condition,$page, $size);
		//render
		$this->_view->assign('list', $rebateList);
		$rebateHtml = $this->_view->render('rebate_list_row.tpl');

		//send
		$data = array(
            'total' => $rebateTotal,
            'html' => $rebateHtml
		);
		echo json_encode($data);
	}
   //添加产品页面
    public function addViewAction(){
    	TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
    	  $this->_view->display('rebate_add.tpl');
    }
    //添加产品
    public function addAction(){
		$info = array();
		$params = $_POST;
		$info['title'] = $params['title'];
		$info['card_type'] = $params['card_type'];
		$info['rate'] = $params['rate'];
		$info['created_at'] = date('Y-m-d H:i:s') ;
		TZ_Loader::model('RBconfig', 'Admin')->insert($info);
		header('Location:/admin/rebate/index.html');
    }
	//删除配置
    public function delConfigAction(){
    	$params = $_POST;
    	if (empty($params['id']) || !is_numeric($params['id']))
				throw new Exception('参数错误.');
    	$delStatus = TZ_Loader::model('RBconfig', 'Admin')->delete(array('id:eq'=>$params['id']));
		$delStatus ? TZ_Response::success() : TZ_Response::error(101);
    }
}