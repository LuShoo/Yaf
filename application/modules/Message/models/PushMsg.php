<?php
/*
 * 标签表
 * @author nick <zhaozhiwei@747.cn>
 */
class PushMsgModel extends TZ_Db_Table
{
     public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.msg_push');
    }
}