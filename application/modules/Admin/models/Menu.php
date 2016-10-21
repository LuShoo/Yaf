<?php
/*
 * 菜单数据库model
 * @author nick <zhaozhiwei@747.cn>
 */

class MenuModel extends TZ_Db_Table
{

    //init
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.admin_menu');
    }

}
