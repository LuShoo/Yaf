<?php
/**
 * 应用管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-04
 */
class TagController extends Yaf_Controller_Abstract
{

    //大客户列表
    public function indexAction()
    {
        $this->_view->display('tag_list.tpl');
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
		$service = TZ_Loader::service('Tag', 'Ad');
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
			$app=TZ_Loader::model("App","Ad")->select(array('id:eq'=>$row['app_id']),"app_code,app_name","ROW");
			$row=array_merge($row,$app);
		}
		//print_r($logList);
		//render
		$this->_view->assign('list', $logList);
		$listHtml = $this->_view->render('tag_list_row.tpl');

		//send
		$data = array(
            'total' => $logTotal,
            'html'  => $listHtml
		);
		echo json_encode($data);
    }
//更新tag广告
	public function addViewAction()
	{
		$data=TZ_Loader::model('App','Ad')->select(array('status:eq'=>1),'*','ALL');
		$this->_view->assign('list', $data);
		$this->_view->display('tag_add.tpl');
	}

	//更新tag到数据库
	public function addAction(){
		$params=$_POST;
		//print_r($params);die;
		//Array ( [app_id] => 478 [tag_code] => kikitag [tag_name] => 手由宝tag [status] => 1 [imageurl] => /static/upload/image/20160104/20160104143854_84529.png )
		$data=array();
		$data['tag_code']=TZ_Request::clean($params['tag_code']);
		$data['tag_name']=TZ_Request::clean($params['tag_name']);
		$data['app_id']=TZ_Request::clean($params['app_id']);
		$data['tag_pic']=TZ_Request::clean($params['imageurl']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['create_at']=$data['update_at']=date('Y-m-d H:i:s');
		TZ_Loader::model('Tag','Ad')->insert($data);
			header('Location:/ad/tag/index.html');
	}
	
    
    
//更新tag广告
	public function setViewAction()
	{
		if(empty($_GET['id'])){
			throw new Exception('ID异常.');
		}
		$appList=TZ_Loader::model('App','Ad')->select(array('status:eq'=>1),'*','ALL');
		$this->_view->assign('applist', $appList);
		$data=TZ_Loader::model('Tag','Ad')->select(array('id:eq'=>$_GET['id']),'*','ROW');
		$this->_view->assign('list', $data);
		$this->_view->display('tag_set.tpl');
	}

	//更新tag到数据库
	public function setAction(){
		$params=$_POST;
		$data=array();
		if(empty($_POST['id'])){
			throw new Exception('ID异常.');
		}
		$id=$_POST['id'];
		$data['tag_code']=TZ_Request::clean($params['tag_code']);
		$data['tag_name']=TZ_Request::clean($params['tag_name']);
		$data['app_id']=TZ_Request::clean($params['app_id']);
		$data['tag_pic']=TZ_Request::clean($params['imageurl']);
		$data['status']=TZ_Request::clean($params['status']);
		$data['update_at']=date('Y-m-d H:i:s');
		TZ_Loader::model('Tag','Ad')->update($data,array("id:eq" => $id));
		header('Location:/ad/tag/index.html');
	}
//上传文件
	public function uploadImageAction()
	{
		
		//文件保存目录路径
		$save_path = $_SERVER['DOCUMENT_ROOT'].'/static/upload/';
		//文件保存目录URL
		$save_url =  'http://'.$_SERVER['HTTP_HOST'].'/static/upload/';
		$save_url =  '/static/upload/';
		//定义允许上传的文件扩展名
		$ext_arr = array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
		);
		//最大文件大小
		$max_size = 1000000;

		$save_path = realpath($save_path) . '/';

		//PHP上传失败
		if (!empty($_FILES['img']['error'])) {
			switch($_FILES['img']['error']){
				case '1':
					$error = '超过php.ini允许的大小。';
					break;
				case '2':
					$error = '超过表单允许的大小。';
					break;
				case '3':
					$error = '图片只有部分被上传。';
					break;
				case '4':
					$error = '请选择图片。';
					break;
				case '6':
					$error = '找不到临时目录。';
					break;
				case '7':
					$error = '写文件到硬盘出错。';
					break;
				case '8':
					$error = 'File upload stopped by extension。';
					break;
				case '999':
				default:
					$error = '未知错误。';
			}
			alert($error);
		}
		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES['img']['name'];
			//服务器上临时文件名
			$tmp_name = $_FILES['img']['tmp_name'];
			//文件大小
			$file_size = $_FILES['img']['size'];
			//检查文件名
			if (!$file_name) {
				TZ_Response::error("401","请选择文件");
				//alert("请选择文件。");
			}
			//检查目录
			if (@is_dir($save_path) === false) {
				TZ_Response::error("401","上传目录不存在");
			}
			//检查目录写权限
			if (@is_writable($save_path) === false) {
				TZ_Response::error("401",$save_path."上传目录没有写权限");
			}
			//检查是否已上传
			if (@is_uploaded_file($tmp_name) === false) {
				TZ_Response::error("401","上传失败");
			}
			//检查文件大小
			if ($file_size > $max_size) {
				TZ_Response::error("401","上传文件大小超过限制");

			}
			//检查目录名
			$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
			if (empty($ext_arr[$dir_name])) {
				TZ_Response::error("401","目录名不正确");

			}
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			//检查扩展名
			if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
				TZ_Response::error("401","请选择文件");
				alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
			}
			//创建文件夹
			if ($dir_name !== '') {
				$save_path .= $dir_name . "/";
				$save_url .= $dir_name . "/";
				if (!file_exists($save_path)) {
					mkdir($save_path);
				}
			}
			$ymd = date("Ymd");
			$save_path .= $ymd . "/";
			$save_url .= $ymd . "/";
			if (!file_exists($save_path)) {
				mkdir($save_path);
			}
			//新文件名
			$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
			//移动文件
			$file_path = $save_path . $new_file_name;
			if (move_uploaded_file($tmp_name, $file_path) === false) {
				TZ_Response::error("401","上传文件失败");
				
			}
			@chmod($file_path, 0644);
			$file_url = $save_url . $new_file_name;
			//print_r($file_url);die;
			header('Content-type: text/html; charset=UTF-8');

			$this->_callParent(1,'id_img','imageurl', $file_url);
		}
	}
	//call parent
	private function _callParent($status,$id,$name, $url = '')
	{
		echo '<script type="text/javascript">parent.refreshImage('.$status.',"'.$id.'","'.$name.'", "'.$url.'")</script>';
		die;
	}
}