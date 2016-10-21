<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/8/1 15:04
 *
 */
class ProductService
{
    /**
     * 获取运营商产品列表
     * @param $condition
     * @param $page
     * @param $size
     * @return mixed
     */
    public function getProductList($condition, $page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('Providerpackage', 'Common')->select($condition);
    }
    
    /**
     * 获取运营商产品总数
     * @param $condition
     * @return int
     */
    public function getProductTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Providerpackage', 'Common')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }
    
}