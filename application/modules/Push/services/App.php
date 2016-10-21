<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class AppService
{
  //获取消息列表
  public function getList($conditions,$start, $size)
  {
    $conditions['limit'] = array($start, $size);
    $conditions['status:eq'] = 1;

    return TZ_Loader::model('App', 'Push')->select($conditions);

  }
  /**
   * 获取消息总数
   *
   * @return int
   */
  public function getTotal($conditions)
  {
    $conditions['status:eq'] = 1;
    $fields = 'COUNT(id) total';

    $countInfo = TZ_Loader::model('App', 'Push')->select($conditions, $fields, 'ROW');
    if(!$countInfo['total']){
      return '0';
    }
    return intval($countInfo['total']);
  }

   public function appManage($cols,$mod='insert')
  {
    return TZ_Loader::model('App','Push')->insert($cols);
  }


  public function updateAppManage($cols,$id)
  {
    return TZ_Loader::model('App','Push')->update($cols,array("id:eq"=>$id));
  }
}
