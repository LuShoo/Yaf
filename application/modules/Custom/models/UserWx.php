<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/21 13:45
 *
 */
class UserWxModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('user_center_db'), 'user_center_db.user_wx_openids');
    }
    
}