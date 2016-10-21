<?php

class DeviceService{
    //获取消息列表
  public function getList($conditions,$start, $size)
  {
    $conditions['limit'] = array($start, $size);
    $conditions['status:eq'] = 1;
    

    return TZ_Loader::model('Device', 'Push')->select($conditions);

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
    $countInfo = TZ_Loader::model('Device', 'Push')->select($conditions, $fields, 'ROW');
    if(!$countInfo['total']){
      return '0';
    }
    return intval($countInfo['total']);
  }

   public function msgManage($cols,$mod='insert')
  {
    return TZ_Loader::model('Device','Push')->insert($cols);
  }


  public function setMsgManage($cols,$id)
  {
    return TZ_Loader::model('Device','Push')->update($cols,array("id:eq"=>$id));
  }
}
?>