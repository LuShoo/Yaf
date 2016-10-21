<?php
/*
 * 消息详情表
 * @author nick <zhaozhiwei@747.cn>
 */
class MessageModel extends TZ_Db_Table
{
     public function __construct()
    {
        parent::__construct(Yaf_Registry::get('heimi_msg_db'), 'heimi_msg_db.xb_message');
    }
}
