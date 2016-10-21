<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class AppController extends Yaf_Controller_Abstract
{
  //经销商列表
	public $cols = array('id','name','partnerid','app_key','master_secret','status','created_at','updated_at');

  public function indexAction()
  {
		$this->_view->display('app_list.tpl');
  }
  //Ajax 获取列表
  public function getAppListAction()
  {
    $params    = $_GET;
    $condition = array();
	if (!empty($params['partnerid'])) {
        $condition['name:eq'] = $params['name'];
    }
    if (!empty($params['partnerid'])) {
        $condition['partnerid:eq'] = $params['partnerid'];
    }
    if (!empty($params['app_key'])) {
        $condition['app_key:eq'] = $params['app_key'];
    }
    if (isset($params['status'])) {
        $condition['status:eq'] = $params['status'];
    }
    if (empty($params['page']) || empty($params['size']))
        TZ_Request::error('params error.');

    if (($params['page'] < 1) || ($params['size'] < 1))
          TZ_Request::error('params error.');

  	$page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('App','App');

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

    //render
    $this->_view->assign('list',$logList);
    $Html = $this->_view->render('app_list_row.tpl');

    //send
    $data = array(
			'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
  }
  //添加经销商
  public function addAppAction()
  {
      $appInfo= array();
  	  foreach($this->cols AS $val) $appInfo[$val] = '';
  	  $this->_view->assign('appInfo',$appInfo);
  	  $this->_view->assign('title','添加经销商');
      $this->_view->display('app_add.tpl');
  }
  //编辑消息
  public function editAppAction()
  {
    $id = intval($_GET['id']);
    if($id<1){
      die('参数无效!');
    }
    $this->_view->assign('title','编辑消息');
    $appInfo = TZ_Loader::model('App','App')->select(array('id:eq'=>$id),'*','ROW');
    $this->_view->assign('appInfo',$appInfo);
    $this->_view->display('app_add.tpl');
  }

  //添加消息
  public function createAction()
  {
    $cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }

    $cols['updated_at'] = date('Y-m-d H:i:s');

    //修改
    if(!empty($cols['id'])){
      $res = TZ_Loader::service('Message', 'Message')->setMsgManage($cols,$cols['id']);
      die(json_encode(array('detail'=>"ok")));
    } else{  //添加
      $cols['created_at'] = date('Y-m-d H:i:s');
      TZ_Loader::service('app', 'app')->appManage($cols);
      die(json_encode(array('detail'=>"ok")));
    }
  }
  //删除经销商
  public function delAppAction(){
    $cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }

    $cols['status'] = 0;
    $cols['updated_at'] = date('Y-m-d H:i:s');
    $res = TZ_Loader::service('app', 'app')->delAppManage($cols,$cols['id']);
    die(json_encode(array('detail'=>"ok")));
  }
}
