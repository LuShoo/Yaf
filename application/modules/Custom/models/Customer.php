<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/23 14:51
 *
 */
class CustomerModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('user_ext_db'), 'user_ext_db.user_cards');
    }
    
}