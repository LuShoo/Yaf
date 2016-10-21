<?php

/**
 * 按钮
 * Class ButtonModel
 */

class ButtonModel extends TZ_Db_Table
{

    //init
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.power_btn');
    }

}