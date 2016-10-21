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
	  $addmessage='[{"id":"1001","group_name":"秀 豹","parent_id":"1","enable_del":"0","level":"1","description":"。。。。。","created_at":"2016-10-17 11:48:22","updated_at":"2016-10-17 11:48:22"},{"id":"1001001","group_name":"标准 版","parent_id":"1001","enable_del":"0","level":"2","description":"。。。。。","created_at":"2016-10-17 11:51:52","updated_at":"2016-10-17 11:51:52"},{"id":"1001001001","group_name":"标准版自营渠 道","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。。。","created_at":"2016-10-19 11:15:54","updated_at":"2016-10-19 11:32:12"},{"id":"1001001002","group_name":"京东渠道 三 级","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。。。","created_at":"2016-10-19 11:16:26","updated_at":"2016-10-19 11:32:14"},{"id":"1001001002001","group_name":"京东群组1 四 级","parent_id":"1001001002","enable_del":"0","level":"4","description":"。。。。","created_at":"2016-10-19 11:38:31","updated_at":"2016-10-19 11:38:31"},{"id":"1001001003","group_name":"国美渠道 三 级","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。","created_at":"2016-10-19 11:16:43","updated_at":"2016-10-19 11:32:10"},{"id":"1001002","group_name":"电竞 版","parent_id":"1001","enable_del":"0","level":"2","description":"。。。。。。","created_at":"2016-10-17 11:52:14","updated_at":"2016-10-17 11:52:14"},{"id":"1001002001","group_name":"电竞销售渠道 一","parent_id":"1001002","enable_del":"0","level":"3","description":"。。。。","created_at":"2016-10-17 14:21:00","updated_at":"2016-10-17 14:21:00"}]';
	  
	  $tagsList=json_decode($addmessage,true);
	  
	  
    $msginfo= array();
	  foreach($this->cols AS $val) $msginfo[$val] = '';
    //$tagsList = TZ_Loader::service('Group','Admin')->groupList();
    $tagsInfo = array();
    foreach ($tagsList as $v) {
      $tagsInfo[] = '{ id:'.$v['id'].', pId:'.$v['parent_id'].', name:"'.htmlspecialchars($v['group_name']).'", open:true},';
    }
    unset($tagLisg);

	  $this->_view->assign('msginfo',$msginfo);
    $this->_view->assign('tagsinfo',$tagsInfo);
	  $this->_view->assign('title','添加消息');
    $this->_view->display('message_add.tpl');
  }
  //编辑消息
  public function editMsgAction()
  {
	  $addmessage='[{"id":"1001","group_name":"秀 豹","parent_id":"1","enable_del":"0","level":"1","description":"。。。。。","created_at":"2016-10-17 11:48:22","updated_at":"2016-10-17 11:48:22"},{"id":"1001001","group_name":"标准 版","parent_id":"1001","enable_del":"0","level":"2","description":"。。。。。","created_at":"2016-10-17 11:51:52","updated_at":"2016-10-17 11:51:52"},{"id":"1001001001","group_name":"标准版自营渠 道","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。。。","created_at":"2016-10-19 11:15:54","updated_at":"2016-10-19 11:32:12"},{"id":"1001001002","group_name":"京东渠道 三 级","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。。。","created_at":"2016-10-19 11:16:26","updated_at":"2016-10-19 11:32:14"},{"id":"1001001002001","group_name":"京东群组1 四 级","parent_id":"1001001002","enable_del":"0","level":"4","description":"。。。。","created_at":"2016-10-19 11:38:31","updated_at":"2016-10-19 11:38:31"},{"id":"1001001003","group_name":"国美渠道 三 级","parent_id":"1001001","enable_del":"0","level":"3","description":"。。。。","created_at":"2016-10-19 11:16:43","updated_at":"2016-10-19 11:32:10"},{"id":"1001002","group_name":"电竞 版","parent_id":"1001","enable_del":"0","level":"2","description":"。。。。。。","created_at":"2016-10-17 11:52:14","updated_at":"2016-10-17 11:52:14"},{"id":"1001002001","group_name":"电竞销售渠道 一","parent_id":"1001002","enable_del":"0","level":"3","description":"。。。。","created_at":"2016-10-17 14:21:00","updated_at":"2016-10-17 14:21:00"}]';
	  
	  $tagsList=json_decode($addmessage,true);
	  
    $id = intval($_GET['id']);
    if($id<1){
      die('参数无效!');
    }
    $tagsInfo = array();
  //  $tagsList = TZ_Loader::service('Group','Admin')->groupList();
    $msgInfo = TZ_Loader::model('Message','Message')->select(array('id:eq'=>$id),'*','ROW');

    $tags = $msgInfo['tags'];
    foreach ($tagsList as $v) {
      $res = strpos(','.$tags.',', ','.$v['group_name'].',') === false ? '':'checked="checked"';
      $isCheck = $res == '' ? 'false' : 'true';
      $tagsInfo[] = '{ id:'.$v['id'].', pId:'.$v['parent_id'].', name:"'.htmlspecialchars($v['group_name']).'", open:true, checked:'.$isCheck.'},';
    }
    unset($tagLisg);

    $this->_view->assign('title','编辑消息');
    $this->_view->assign('msginfo',$msgInfo);
    $this->_view->assign('tagsinfo',$tagsInfo);
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
	$cols['status'] = 0;
    $cols['updated_at'] = date('Y-m-d H:i:s');
    $res = TZ_Loader::model('Message','Message')->update($cols,array("id:eq"=>$cols['id']));
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

    die(json_encode(array('detail'=>"ok",'message'=>array('partnerid'=>$partnerid,'imeis'=>$imei,'send_type'=>$send_type,'msg_title'=>$msg_title,'msg_type'=>$msg_type,'msg_data'=>$msg_data,'send_scope'=>$send_scope,'tags'=>$tags,'release'=>$release,'expire_time'=>$expire_time,'is_immediate'=>$is_immediate,'server'=>'msg','sign'=>'111111111','callerid'=>$id))));
  }
  
  //预览消息
   public function sendMsgyAction()
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
    $imei = $cols['imeis'];  //设备号

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

    die(json_encode(array('detail'=>"ok",'message'=>array('partnerid'=>$partnerid,'imeis'=>$imei,'send_type'=>$send_type,'msg_title'=>$msg_title,'msg_type'=>$msg_type,'msg_data'=>$msg_data,'send_scope'=>$send_scope,'tags'=>$tags,'release'=>$release,'expire_time'=>$expire_time,'is_immediate'=>$is_immediate,'server'=>'msg','sign'=>'111111111','callerid'=>$id))));
  }
  
 //重发发消息
  public function sendMsgrAction()
  {
	$params = TZ_Request::getParams("post");
		
		//var_dump($params['id']);
	
	if(($params['id']) !==""){
		$res = TZ_Loader::model('Message', 'Message')->select(array('id:eq'=>$params['id']),'*','ROW');
		if(strtotime($res['expire_time']) < strtotime(date('Y-m-d H:i:s'))){
			TZ_Repsonse::error('消息已过期,不能发送');
		}
		$arr=array();
		$arr['partnerid'] = $res['partnerid'];
		$arr['callerid'] = $res['id'];
		$arr['imeis'] = $res['imeis'];  
		$arr['send_type'] = 1;//正式  预览
		$arr['msg_title'] = $res['msg_title'];//
		$arr['msg_type'] = $res['msg_type'];//消息类别
		$arr['msg_data'] = $res['msg_data'];
		$arr['send_scope'] = $res['send_scope']; //发送范围
		$arr['tags'] = $res['tags']; //标签
		$arr['release'] = $res['release']; 
		$arr['expire_time'] = $res['expire_time'];//有效期
		$arr['is_immediate'] = $res['is_immediate'];
		$arr['service'] = "reptmsg";
		
		$url=Yaf_Registry::get('config')->heimi->push->url;
        $type = 'post';
        $charset = 'utf-8';
        
		$remote = new TZ_RemoteTool();
		$data=$remote->send($url,$type,$arr,$charset);
		 //var_dump($data);
        $d=json_decode($data, true);
        if($d['code']==0){
            die(json_encode(array('code'=>0,'message'=>'发送成功')));
        }else{
            die(json_encode(array('code'=>1,'message'=>'发送失败')));
        }
	}else{
		TZ_Response::error(11111,'消息发送失败');
	}
  
  }
  
//curl
    public function sendtoAction(){

        //获取黑米消息中心远程url配置
        $url=Yaf_Registry::get('config')->heimi->push->url;

        $type = 'post';
        $charset = 'utf-8';
        $params = TZ_Request::getParams("post");
        $args=array();
        $args['partnerid'] = $params['partnerid'];
        $args['imeis'] = $params['imeis'];  //设备号
        $args['send_type'] = $params['send_type'];//正式  预览
        $args['msg_title'] = $params['msg_title'];//
        $args['msg_type'] = $params['msg_type'];//消息类别
        $args['msg_data'] = $params['msg_data'];
        $args['send_scope'] = $params['send_scope']; //发送范围
        $args['tags'] = $params['tags']; //标签
        $args['expire_time'] = $params['expire_time'];//有效期
        $args['is_immediate'] = $params['is_immediate'];//是否立即发送
        $args['release'] = $params['release'];//定时发送
        $args['service'] = $params['service'];//定时发送
        $args['sign'] = $params['sign'];//定时发送
        $args['callerid'] = $params['callerid'];//消息id
        $remote = new TZ_RemoteTool();

        $data=$remote->send($url,$type,$args,$charset);
   //   var_dump($data);
        $d=json_decode($data, true);


        if($d['code']===0){
            die(json_encode(array('code'=>"1",'message'=>'发送成功')));
        }else{
            die(json_encode(array('code'=>"0",'message'=>'发送失败')));
        }
    }

}