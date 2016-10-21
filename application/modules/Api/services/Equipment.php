<?php
/**
 * 设备管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class EquipmentService
{

	// 获取记录列表
	public function getUserEquipmenetList($condition,$limit, $size)
	{
		$condition['limit'] = "{$limit},{$size}";
		$condition['order'] = 'updated_at DESC';
		return TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, '*', 'ALL');
	}
	// 获取记录列表
	public function getUserEquipmenetTotal($condition)
	{
		$data=TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, 'count(*) as total', 'ROW');
		return $data["total"];
	}
	//修改用户设备信息
	public function setUserEquipment($set,$condition){
		$set["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('UserEquipment', 'Equipment')->update($set,$condition);
	}
	
	// 获取设备分组记录列表
	public function getUserEquipmentGroupList($condition)
	{
		$condition['group'] = 'group_id';
		$condition['order'] = 'group_id asc';
		return TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, 'group_id,group_name,count(*) as total', 'ALL');
	}
}