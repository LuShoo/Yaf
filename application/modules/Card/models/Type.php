<?php
/**
 *
 * 卡类型服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-25
 */

class TypeModel extends TZ_Db_Table
{

    //init
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('card_center_s2_db'), 'card_center_s2_db.card_type');
    }

}
