<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class MessagemasterService
{
  //获取消息列表
  public function getList($conditions,$start, $size)
  {

    $conditions['limit'] = array($start, $size);

    return TZ_Loader::model('Messagemaster', 'Push')->select($conditions);
  }
  /**
   * 获取消息总数
   * @return int
   */
  public function getTotal($conditions)
  {
    $fields = 'COUNT(id) total';

    $countInfo = TZ_Loader::model('Messagemaster', 'Push')->select($conditions, $fields, 'ROW');

    if(!$countInfo['total']){
      return '0';
    }
    return intval($countInfo['total']);
  }
}
