<?php

/**
 * Class DeviceModel
 */
class DeviceModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.msg_device');
    }
}
?>