<?php
/* 
 * 用户基本信息表
 * @ author ziyang <hexiangcheng@showboom.cn>
 * @date 2016-05-27
 */
class BaseModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('user_center_db'), 'user_center_db.user_base');
    }
}