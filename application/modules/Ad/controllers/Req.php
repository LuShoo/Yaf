<?php
/**
 * 请求日志管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-04
 */
class ReqController extends Yaf_Controller_Abstract
{

    //大客户列表
    public function indexAction()
    {
        $this->_view->display('req_list.tpl');
    }
    //Ajax 获取列表
    public function getlistAction()
    {
    	$params    = $_GET;
		//print_r($params);die();
		$condition = array();
		if (!empty($params['imei'])) {
			$condition['imei:eq'] = $params['imei'];
		}
    	if (!empty($params['mac'])) {
			$condition['mac:eq'] = $params['mac'];
		}
		if (!empty($params['status'])) {
			$condition['status:eq'] = $params['status'];
		}
		if (empty($params['page']) || empty($params['size']))
		TZ_Request::error('params error.');

		if (($params['page'] < 1) || ($params['size'] < 1))
		TZ_Request::error('params error.');

		$page = intval($params['page']);
		$size = intval($params['size']);

		//load service
		$service = TZ_Loader::service('ReqLog', 'Ad');
		if (!empty($params['start_time']) && !empty($params['end_time']))
		{
			$condition['created_at:between'] = array(
			$params['start_time'],
			$params['end_time']);
		}
		//get data
		$limit    = ($page - 1) * $size;
		$logTotal = $service->getTotal($condition);
		$logList  = $service->getList($condition, $limit, $size);
		//print_r($logList);
		//render
		$this->_view->assign('list', $logList);
		$listHtml = $this->_view->render('req_list_row.tpl');

		//send
		$data = array(
            'total' => $logTotal,
            'html'  => $listHtml
		);
		echo json_encode($data);
    }
}