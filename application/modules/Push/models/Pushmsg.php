<?php
/*
 * 标签表
 * @author nick <zhaozhiwei@747.cn>
 */
class PushmsgModel extends TZ_Db_Table
{
     public function __construct()
    {
        parent::__construct(Yaf_Registry::get('heimi_msg_db'), 'heimi_msg_db.msg_push');
    }
}