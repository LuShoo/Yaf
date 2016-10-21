<?php
/**
 * @Author: LiuS
 * @Date:   2016-10-11 13:48:41
 * @Last Modified by:   anchen
 * @Last Modified time: 2016-10-11 14:14:48
 */
class MessageMasterModel extends TZ_Db_Table
{
     public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.msg_message');
    }
}