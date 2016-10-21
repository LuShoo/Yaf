<?php
/**
 * 应用管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-04
 */
class ObjectController extends Yaf_Controller_Abstract
{

	//大客户列表
	public function indexAction()
	{
		$this->_view->display('object_list.tpl');
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
		$service = TZ_Loader::service('Object', 'Ad');
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
		foreach ($logList as &$row){
			$tag=TZ_Loader::model("Object","Ad")->getTagListByObject($row['id']);
			$row['taglist']=$tag;
		}
		//render
		$this->_view->assign('list', $logList);
		$listHtml = $this->_view->render('object_list_row.tpl');

		//send
		$data = array(
            'total' => $logTotal,
            'html'  => $listHtml
		);
		echo json_encode($data);
	}
	//更新object广告
	public function addViewAction()
	{
		$tagList=TZ_Loader::model('Tag','Ad')->select(array('status:eq'=>1),'*','ALL');
		$this->_view->assign('taglist', $tagList);
		$this->_view->display('object_add.tpl');
	}

	//更新object到数据库
	public function addAction(){
		$params=$_POST;
		$data=array();
		//		    [tag_id] => 477

		$data['name']=TZ_Request::clean($params['name']);
		$data['content']=TZ_Request::clean($params['content']);
		$data['pic']=TZ_Request::clean($params['imageurl']);
		$data['star']=TZ_Request::clean($params['star']);
		$data['is_free']=TZ_Request::clean($params['is_free']);
		$data['start_at']=TZ_Request::clean($params['start_at']);
		$data['end_at']=TZ_Request::clean($params['end_at']);
		$data['sort']=TZ_Request::clean($params['sort']);
		$data['url']=TZ_Request::clean($params['url']);
		$data['mark']=TZ_Request::clean($params['mark']);
		$data['req_url']=TZ_Request::clean($params['req_url']);
		$data['mac']=TZ_Request::clean($params['mac']);
		$data['idfa']=TZ_Request::clean($params['idfa']);
		$data['idfv']=TZ_Request::clean($params['idfv']);
		$data['imei']=TZ_Request::clean($params['imei']);
		$data['phone']=TZ_Request::clean($params['phone']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['create_at']=$data['update_at']=date('Y-m-d H:i:s');
		$aid=TZ_Loader::model('Object','Ad')->insert($data);

		foreach ($params as $key=>$row){
			$len=strpos($key, "tag_");
			if($len!==false){
				$map=array();
				$map['ad_id']=$aid;
				$map['tag_id']=$row;
				$map['status']=1;
				$map['create_at']=$map['update_at']=date('Y-m-d H:i:s');
				TZ_Loader::model('ObjectTag','Ad')->insert($map);
			}
		}

		header('Location:/ad/object/index.html');
	}



	//更新object广告
	public function setViewAction()
	{
		if(empty($_GET['id'])){
			throw new Exception('ID异常.');
		}
		$data=TZ_Loader::model('Object','Ad')->select(array('id:eq'=>$_GET['id']),'*','ROW');
		$this->_view->assign('list', $data);

		$tagList=TZ_Loader::model('Tag','Ad')->select(array('status:eq'=>1),'*','ALL');
		$mapList=TZ_Loader::model('ObjectTag','Ad')->select(array('ad_id:eq'=>$_GET['id'],'status:eq'=>1),'*','ALL');
		foreach ($tagList as &$tag){
			$tid=$tag['id'];
			$tag['checked']=0;
			foreach ($mapList as $map){
				if($map['tag_id']==$tid){
					$tag['checked']=1;
					break;
				}
			}
		}
		$this->_view->assign('taglist', $tagList);
		$this->_view->display('object_set.tpl');
	}

	//更新object到数据库
	public function setAction(){
		$params=$_POST;
		$data=array();
		if(empty($_POST['id'])){
			throw new Exception('ID异常.');
		}
		$id=$_POST['id'];
		$data['name']=TZ_Request::clean($params['name']);
		$data['content']=TZ_Request::clean($params['content']);
		$data['pic']=TZ_Request::clean($params['imageurl']);
		$data['star']=TZ_Request::clean($params['star']);
		$data['is_free']=TZ_Request::clean($params['is_free']);
		$data['start_at']=TZ_Request::clean($params['start_at']);
		$data['end_at']=TZ_Request::clean($params['end_at']);
		$data['sort']=TZ_Request::clean($params['sort']);
		$data['url']=TZ_Request::clean($params['url']);
		$data['mark']=TZ_Request::clean($params['mark']);
		$data['req_url']=TZ_Request::clean($params['req_url']);
		$data['mac']=TZ_Request::clean($params['mac']);
		$data['idfa']=TZ_Request::clean($params['idfa']);
		$data['idfv']=TZ_Request::clean($params['idfv']);
		$data['imei']=TZ_Request::clean($params['imei']);
		$data['phone']=TZ_Request::clean($params['phone']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['update_at']=date('Y-m-d H:i:s');
		TZ_Loader::model('Object','Ad')->update($data,array("id:eq" => $id));

		//更新所有的状态为未使用
		TZ_Loader::model('ObjectTag','Ad')->update(array('status'=>2,'update_at'=>date('Y-m-d H:i:s')),array("ad_id:eq" => $id));
		foreach ($params as $key=>$row){
			$len=strpos($key, "tag_");
			if($len!==false){
				$map=array();
				//判断是否存在，如果不存在就插入，如果存在就更新
				$tagobj=TZ_Loader::model('ObjectTag','Ad')->select(array('tag_id:eq'=>$row,'ad_id:eq'=>$id),"*","ROW");
				//print_r($tagobj);die;
				if(count($tagobj)==0){
					$map['ad_id']=$id;
					$map['tag_id']=$row;
					$map['status']=1;
					$map['create_at']=$map['update_at']=date('Y-m-d H:i:s');
					TZ_Loader::model('ObjectTag','Ad')->insert($map);
				}else{
					$map['status']=1;
					$map['update_at']=date('Y-m-d H:i:s');
					TZ_Loader::model('ObjectTag','Ad')->update($map,array('tag_id:eq'=>$row,'ad_id:eq'=>$id));
				}
			}
		}
		header('Location:/ad/object/index.html');
	}
	
}