<?php
/**
 * portal log
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-20
 */
class PortalLogService
{

	// 获取记录列表
	public function getUserEquipmenetList($condition,$limit, $size)
	{
		$condition['limit'] = "{$limit},{$size}";
		$condition['order'] = 'created_at DESC';
		return TZ_Loader::model('PortalLog', 'Equipment')->select($condition, '*', 'ALL');
	}
	// 获取记录列表
	public function getUserEquipmenetTotal($condition)
	{
		$data=TZ_Loader::model('PortalLog', 'Equipment')->select($condition, 'count(*) as total', 'ROW');
		return $data["total"];
	}
	
}