<?php
/**
 * ad services
 * @author octopus <zhangguipo@747.cn>
 * @final 2016-01-04
 */
class ClickLogService
{	
	// 点击日志总数
	public function getTotal($condition)
	{
		$fields = "count(id) total";
		$countInfo = TZ_Loader::model('ClickLog', 'Ad')->select($condition, $fields, 'ROW');
		return intval($countInfo['total']);
	}

	//点击日志列表
	public function getList($condition, $limit, $size)
	{
		$condition['order'] = 'create_at desc';
		$condition['limit'] = "{$limit},{$size}";
		return TZ_Loader::model('ClickLog', 'Ad')->select($condition, "*", 'ALL');
	}

}
		










