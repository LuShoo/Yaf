<?php
/* 
 * 卡实名表
 * @ author ziyang <hexiangcheng@showboom.cn>
 * @date 2016-06-07
 */
class CardModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('user_ext_db'), 'user_ext_db.user_cards');
    }
}