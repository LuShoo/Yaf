<?php
/**
 * @Author: anchen
 * @Date:   2016-10-11 16:57:03
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-10-12 11:12:19
 */
class PushMsgController extends Yaf_Controller_Abstract
{
  //Ajax 获取信息
  public function getMsgInfoAction()
  {
    $id = $_POST['id'];
    if($id<1){
      die('wrong!!!!!!!!');
    }
    $data = array();
    $conditions = array('msg_code:eq'=>$id,);
    $total = TZ_Loader::model('PushMsg','Message')->select($conditions,'count(*) as num','ROW');

    $conditions = array('msg_code:eq'=>$id,'received:eq'=>1);
    $suc = TZ_Loader::model('PushMsg','Message')->select($conditions,'count(*) as num','ROW');

    $fail = $total['num'] - $suc['num'];
    if(empty($total)){
      die('aaaaaaaaaaaaaa');
    }

    $data['total'] = $total['num'];
    $data['success'] = $suc['num'];
    $data['fail'] = $fail;

    echo json_encode($data);
  }

}
