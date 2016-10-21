<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/21 17:41
 *
 */
class WxConfigModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('wechat_message_db'), 'wechat_message_db.wechat_config');
    }
    
}