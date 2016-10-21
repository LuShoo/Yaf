<?php
/**
 * @Author: anchen
 * @Date:   2016-10-11 16:57:03
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-10-13 11:09:16
 */
class TipsController extends Yaf_Controller_Abstract
{
  public $cols = array('id','partnerid','msg_code','msg_data','status','created_at');
  //Ajax 获取信息
  public function getMsgInfoAction()
  {
    $id = $_POST['id'];
    if($id<1){
      die('wrong!!!!!!!!');
    }
    $conditions = array('msg_code:eq'=>$id);
    $res = TZ_Loader::model('Tips','Push')->select($conditions,'*','ROW');
    if(isset($res['status'])){
      if($res['status'] == 1){
        $res['status'] = '正常';
      }else{
        $res['status'] = '删除';
      }
    }
    //Render
    echo json_encode($res);
  }

}
