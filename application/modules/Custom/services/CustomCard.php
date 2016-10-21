<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/24 10:30
 *
 */
class CustomCardService
{
    // 获取列表
    public function getList($condition, $page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'actived_at desc,uid asc';
        return TZ_Loader::model('Card', 'Custom')->select($condition, "*", "ALL");
    }

    // 获取总数
    public function getTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Card', 'Custom')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }
    
}