<?php
/**
 *
 * 卡管理服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-25
 */
class CardpackageService
{
	// 获取卡列表
	public function getOrderList($condition,$page, $size)
	{
		$start = ($page - 1) * $size;
		$condition['limit'] = array($start, $size);
		$condition['order'] = 'created_at desc';
		return TZ_Loader::model('Cardpackage', 'Common')->select($condition);
	}

	// 获取卡总数
	public function getOrderTotal($condition)
	{
		$fields = 'COUNT(id) total';
		$countInfo = TZ_Loader::model('Cardpackage', 'Common')->select($condition, $fields, 'ROW');
		return intval($countInfo['total']);
	}
	//判断两个日期之间相差多少个月份的方法
	public  function getMonthNum( $date1, $date2, $tags='-' ){
	 $date1 = explode($tags,$date1);
	 $date2 = explode($tags,$date2);
	 return abs($date1[0] - $date2[0]) * 12 + abs($date1[1] - $date2[1]);
	}
}