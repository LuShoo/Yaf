<?php
/*
 * 消息详情表
 * @author nick <zhaozhiwei@747.cn>
 */
class AppModel extends TZ_Db_Table
{
     public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.msg_app');
    }
}
