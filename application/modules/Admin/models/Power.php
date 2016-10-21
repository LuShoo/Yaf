<?php
/*
 * 权限分配数据库model
 * @author nick <zhaozhiwei@747.cn>
 */

class PowerModel extends TZ_Db_Table
{

    //init
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.admin_power');
    }

}
