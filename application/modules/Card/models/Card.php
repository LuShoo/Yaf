<?php
/**
 *卡信息模型
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-25
 */
class CardModel extends TZ_Db_Table
{

    //init
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('card_center_s2_db'), 'card_center_db.card_info');
    }

}
