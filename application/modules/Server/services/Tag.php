<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class TagService
{
     public function agentManage($cols,$mod='insert')
    {
          return TZ_Loader::model('Tag','Server')->insert($cols);
    }
	public function setAgentManage($cols,$id)
    {
          return TZ_Loader::model('Agent','Admin')->update($cols,array("id:eq"=>$id));
    }
}