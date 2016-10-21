<?php
/**
 * 充值自动查询服务
 * 
 * @author octopus <zhangguipo@747.cn>
 * @final 2016-01-27
 */
class RebateService
{
   // 获取充值自动查询列表
    public function getRebateList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('RBconfig', 'Admin')->select($condition);
    }

    // 获取充值自动查询总数
    public function getRebateTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('RBconfig', 'Admin')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }   
}