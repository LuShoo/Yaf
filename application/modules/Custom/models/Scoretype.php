<?php

/**积分类型
 * Created by PhpStorm.
 * @author ziyang<hexiangcheng@showboom.cn>
 * @final 2016-05-31
 */
class ScoretypeModel extends TZ_Db_Table
{
    /**
     * UserScore constructor.
     */
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('user_center_db'), 'user_center_db.score_type');
    }

}