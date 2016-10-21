<?php
/**
 * 卡类型管理
 * @author ziyang<hexiangcheng@showboom.cn>
 *  @final 2016-04-26
 */
class TypeController extends Yaf_Controller_Abstract
{

	//卡类型列表
	public function indexAction()
	{
		TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
		$this->_view->display('type_list.tpl');
	}

	//回调获取卡类型列表
	public function getListAction()
	{
		$params = $_GET;

		if (!empty($params['name'])) {
			$condition['name:eq'] = $params['name'];
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
		$orderService = TZ_Loader::service('Type', 'Card');

		//get data
		$orderTotal = $orderService->getOrderTotal($condition);
		$orderList = $orderService->getOrderList($condition,$page, $size);

		//render
		$this->_view->assign('list', $orderList);
		$orderHtml = $this->_view->render('type_list_row.tpl');

		//send
		$data = array(
            'total' => $orderTotal,
            'html' => $orderHtml
		);
		echo json_encode($data);
	}


}