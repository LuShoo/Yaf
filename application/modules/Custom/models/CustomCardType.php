<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/24 12:42
 *
 */
class CustomCardTypeModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('card_center_s2_db'), 'card_center_s2_db.card_type');
    }
    
}