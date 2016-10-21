<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/23 15:04
 * 用户卡激活
 */
class CustomerService
{
    // 获取列表
    public function getCusList($condition, $page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['group'] = 'uid';
        $condition['order'] = 'created_at desc,uid asc';
        return TZ_Loader::model('Customer', 'Custom')->select($condition, "*", "ALL");
    }

    // 获取总数
    public function getCusTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Customer', 'Custom')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }
    
}