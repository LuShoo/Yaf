<?php
/**
 * @Author: LiuS
 * @Date:   2016-10-11 13:49:45
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-10-12 14:27:11
 */
class MessagemasterController extends Yaf_Controller_Abstract
{
  public $cols = array('id','partnerid','send_scope','tags','imeis','msg_data','msg_type','msg_title','msg_image','msg_content','msg_url','msg_app','msg_page','is_top','expire_time','is_immediate','release','status','audit_time');

  public function indexAction()
  {
    $this->_view->display('messageMaster_list.tpl');
  }
  //
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
    if (empty($params['page']) || empty($params['size']))
        TZ_Request::error('params error.');

    if (($params['page'] < 1) || ($params['size'] < 1))
          TZ_Request::error('params error.');

    $page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('Messagemaster','Push');

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
    $Html = $this->_view->render('messageMaster_list_row.tpl');

    //send
    $data = array(
      'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
  }

}
