<?php
/* 用户实名认证服务
 *@ author ziyang <hexiangcheng@showboom.cn>
 * @date 2016-05-27
 */
class IdentifyService
{

   // 获取列表
    public function getUserList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('Identify', 'Custom')->select($condition,"*","ALL");
    }

    // 获取总数
    public function getUserTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Identify', 'Custom')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }
}