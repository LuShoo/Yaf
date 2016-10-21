<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class MessageController extends Yaf_Controller_Abstract
{
  //消息列表
	public $cols = array('id','partnerid','send_scope','tags','imeis','msg_data','msg_type','msg_title','msg_image','msg_content','msg_url','msg_app','msg_page','is_top','expire_time','is_immediate','release','audit_status','audit_time');
  //添加
  public function indexAction()
  {
		$this->_view->display('message_list.tpl');
  }
  //审核
   public function checkAction()
  {
    $this->_view->display('check_list.tpl');
  }
  //发送
  public function sendAction()
  {
    $this->_view->display('send_list.tpl');
  }
  //Ajax 获取列表
  public function getMsgListAction()
  {
    $params    = $_GET;
    $condition = array();
    if (!empty($params['partnerid'])) {
        $condition['partnerid:eq'] = $params['partnerid'];
    }
    if (!empty($params['msg_title'])) {
        $condition['msg_title:eq'] = $params['msg_title'];
    }
    if (isset($params['status'])) {
        $condition['audit_status:eq'] = $params['status'];
    }
    if (empty($params['page']) || empty($params['size']))
        TZ_Request::error('params error.');

    if (($params['page'] < 1) || ($params['size'] < 1))
          TZ_Request::error('params error.');

  	$page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('Message','Message');

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
    $Html = $this->_view->render('message_list_row.tpl');

    //send
    $data = array(
			'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
  }
  //Ajax 获取审核列表
  public function getCheckListAction()
  {
    $params    = $_GET;
    $condition = array();
    if (!empty($params['partnerid'])) {
        $condition['partnerid:eq'] = $params['partnerid'];
    }
    if (!empty($params['msg_title'])) {
        $condition['msg_title:eq'] = $params['msg_title'];
    }
    if (isset($params['status'])) {
        $condition['audit_status:eq'] = $params['status'];
    }
    if (empty($params['page']) || empty($params['size']))
        TZ_Request::error('params error.');

    if (($params['page'] < 1) || ($params['size'] < 1))
          TZ_Request::error('params error.');

    $page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('Message','Message');

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
    $Html = $this->_view->render('check_list_row.tpl');

    //send
    $data = array(
      'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
  }
  //Ajax 获取发送列表
  public function getSendListAction()
  {
    $params    = $_GET;
    $condition = array();
    if (!empty($params['partnerid'])) {
        $condition['partnerid:eq'] = $params['partnerid'];
    }
    if (!empty($params['msg_title'])) {
        $condition['msg_title:eq'] = $params['msg_title'];
    }
    if (empty($params['page']) || empty($params['size']))
        TZ_Request::error('params error.');

    if (($params['page'] < 1) || ($params['size'] < 1))
          TZ_Request::error('params error.');

    $page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('Message','Message');

    if (!empty($params['start_time']) && !empty($params['end_time']))
    {
      $condition['created_at:between'] = array(
          $params['start_time'],
          $params['end_time']);
    }

    $condition['audit_status:eq'] = 1;
    //get data
    $limit    = ($page - 1) * $size;
    $logTotal = $service->getTotal($condition);
    $logList  = $service->getList($condition, $limit, $size);

    //render
    $this->_view->assign('list',$logList);
    $Html = $this->_view->render('send_list_row.tpl');

    //send
    $data = array(
      'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
  }

  //添加消息
  public function addMsgAction()
  {
    $msginfo= array();
	  foreach($this->cols AS $val) $msginfo[$val] = '';
	  $this->_view->assign('msginfo',$msginfo);
	  $this->_view->assign('title','添加消息');
    $this->_view->display('message_add.tpl');
  }
  //编辑消息
  public function editMsgAction()
  {
    $id = intval($_GET['id']);
    if($id<1){
      die('参数无效!');
    }
    $this->_view->assign('title','编辑消息');
    $msginfo = TZ_Loader::model('Message','Message')->select(array('id:eq'=>$id),'*','ROW');
    $this->_view->assign('msginfo',$msginfo);
    $this->_view->display('message_add.tpl');
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
    $cols['msg_data'] = '标题:'.$_POST['msg_title'].'内容:'.$_POST['msg_content'];
    $cols['updated_at'] = date('Y-m-d H:i:s');

    //修改
    if(!empty($cols['id'])){
      $res = TZ_Loader::service('Message', 'Message')->setMsgManage($cols,$cols['id']);
      die(json_encode(array('detail'=>"ok")));
    } else{  //添加
      if(empty($cols['release'])){
        $cols['release'] = date('Y-m-d H:i:s');
      }
      $cols['created_at'] = date('Y-m-d H:i:s');
      TZ_Loader::service('Message', 'Message')->MsgManage($cols);
      die(json_encode(array('detail'=>"ok")));
    }
  }
  //删除消息
  public function deleteMsgAction()
  {
    $cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }
    $res = TZ_Loader::service('Message','Message')->delMsgManage($cols,$cols['id']);
    die(json_encode(array('detail'=>'ok')));
  }
  //审核消息
  public function checkMsgAction()
  {
    $cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }

    $cols['audit_status'] = 1;
    $cols['audit_time'] = date('Y-m-d H:i:s');
    $res = TZ_Loader::service('Message', 'Message')->setMsgManage($cols,$cols['id']);
    die(json_encode(array('detail'=>"ok")));
  }

  //发送消息
  public function sendMsgAction()
  {
    $cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }
    $condition['id:eq'] = $cols['id'];
    $res = TZ_Loader::model('Message', 'Message')->select($condition,'*','ROW');
    if(strtotime($res['expire_time']) < strtotime(date('Y-m-d H:i:s'))){
      die(json_encode(array('detail'=>'消息已过期,不能发送')));
    }

    $id=$cols['id'];
    //审核之后将消息推送到极光接口
    $sql="select * from xb_message where id=$id";

    $result=TZ_loader::model('Message','Message')->query($sql);
    $query=$result->fetchAll();
    $partnerid = $query[0]['partnerid'];
    $imei = $query[0]['imeis'];  //设备号

    //##########xb_message中没有  send_type
    $send_type = $query[0]['send_scope'];//正式  预览
    $msg_title = $query[0]['msg_title'];//
    $msg_type = $query[0]['msg_type'];//消息类别
    $msg_data = $query[0]['msg_data'];
    $send_scope = $query[0]['send_scope']; //发送范围
    $tags = $query[0]['tags']; //标签
    $release = $query[0]['release']; //标签
    $expire_time = $query[0]['expire_time'];//有效期
    $is_immediate = $query[0]['is_immediate'];

    die(json_encode(array('detail'=>"ok",'message'=>array('partnerid'=>$partnerid,'imeis'=>$imei,'send_type'=>$send_type,'msg_title'=>$msg_title,'msg_type'=>$msg_type,'msg_data'=>$msg_data,'send_scope'=>$send_scope,'tags'=>$tags,'release'=>$release,'expire_time'=>$expire_time,'is_immediate'=>$is_immediate,'server'=>'msg','sign'=>'111111111'))));


  }
}