<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class BadwordService
{
  //获取消息列表
  public function getList($conditions,$start, $size)
  {
    $conditions['limit'] = array($start, $size);
    $conditions['status:eq'] = 1;
    //if(!isset($conditions['audit_status:eq']){
        //$coditions['audit_status:in'] = ['1','2'];
      
    //}

    return TZ_Loader::model('Badword', 'Push')->select($conditions);

  }
  /**
   * 获取消息总数
   *
   * @return int
   */
  public function getTotal($conditions)
  {
    $conditions['status:eq'] = 1;
   /*  if(!isset($conditions['audit_status:eq']) || $conditions['audit_status:eq'] == 2){
      unset($conditions['audit_status:eq']);
      $conditions['audit_status:in'] = ['1','0'];
    } */

    $fields = 'COUNT(id) total';
    $countInfo = TZ_Loader::model('Badword', 'Push')->select($conditions, $fields, 'ROW');
    if(!$countInfo['total']){
      return '0';
    }
    return intval($countInfo['total']);
  }

   public function msgManage($cols,$mod='insert')
  {
    return TZ_Loader::model('Badword','Push')->insert($cols);
  }


  public function setMsgManage($cols,$id)
  {
    return TZ_Loader::model('Badword','Push')->update($cols,array("id:eq"=>$id));
  }
}
