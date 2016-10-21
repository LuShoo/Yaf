<?php
/**
 *
 * 企业实名服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-06-30
 */
class IdentifyService
{
   // 获取卡列表
    public function getList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('Corpidentify', 'Common')->select($condition);
    }

    // 获取卡总数
    public function getTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Corpidentify', 'Common')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }

}