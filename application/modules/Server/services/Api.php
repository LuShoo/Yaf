<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class ApiService
{
    public function agentManage($cols,$mod='insert')
    {
          return TZ_Loader::model('Api','Server')->insert($cols);
    }
     public function setAgentManage($cols,$id)
    {
          return TZ_Loader::model('Agent','Admin')->update($cols,array("id:eq"=>$id));
    } 
}