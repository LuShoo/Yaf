<?php
/**
 *
 * 卡类型服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-26
 */
class TypeService
{
   // 获取卡列表
    public function getOrderList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('Type', 'Card')->select($condition);
    }

    // 获取卡总数
    public function getOrderTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Type', 'Card')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }

}