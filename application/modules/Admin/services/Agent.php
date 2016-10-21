<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class AgentService
{
    public function agentManage($cols,$mod='insert')
    {
          return TZ_Loader::model('Agent','Admin')->insert($cols);
    }
    public function setAgentManage($cols,$id)
    {
          return TZ_Loader::model('Agent','Admin')->update($cols,array("id:eq"=>$id));
    }
}