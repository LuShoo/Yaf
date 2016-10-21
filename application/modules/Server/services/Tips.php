<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class TipsService
{
     public function agentManage($cols,$mod='insert')
    {
          return TZ_Loader::model('Tips','Server')->insert($cols);
    }
	
}