<?php

/**
 * Class DeviceModel
 */
class DeviceGroupModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_device_center_db'), 'xiubao_system_db.msg_device');
    }
}
?>