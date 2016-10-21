<?php
/**
 * 应用管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-04
 */
class AppController extends Yaf_Controller_Abstract
{

    //大客户列表
    public function indexAction()
    {
        $this->_view->display('app_list.tpl');
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
		$service = TZ_Loader::service('App', 'Ad');
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
		$listHtml = $this->_view->render('app_list_row.tpl');

		//send
		$data = array(
            'total' => $logTotal,
            'html'  => $listHtml
		);
		echo json_encode($data);
    }
//更新app广告
	public function addViewAction()
	{
		$this->_view->display('app_add.tpl');
	}

	//更新app到数据库
	public function addAction(){
		$params=$_POST;
		$data=array();
		$data['app_code']=TZ_Request::clean($params['app_code']);
		$data['app_name']=TZ_Request::clean($params['app_name']);
		$data['platform']=TZ_Request::clean($params['platform']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['create_at']=$data['update_at']=date('Y-m-d H:i:s');
		TZ_Loader::model('App','Ad')->insert($data);
			header('Location:/ad/app/index.html');
	}
	
    
    
//更新app广告
	public function setViewAction()
	{
		if(empty($_GET['id'])){
			throw new Exception('ID异常.');
		}
		$data=TZ_Loader::model('App','Ad')->select(array('id:eq'=>$_GET['id']),'*','ROW');
		$this->_view->assign('list', $data);
		$this->_view->display('app_set.tpl');
	}

	//更新app到数据库
	public function setAction(){
		$params=$_POST;
		$data=array();
		if(empty($_POST['id'])){
			throw new Exception('ID异常.');
		}
		$id=$_POST['id'];
		$data['app_code']=TZ_Request::clean($params['app_code']);
		$data['app_name']=TZ_Request::clean($params['app_name']);
		$data['platform']=TZ_Request::clean($params['platform']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['update_at']=date('Y-m-d H:i:s');
		TZ_Loader::model('App','Ad')->update($data,array("id:eq" => $id));
		header('Location:/ad/app/index.html');
	}
	
}