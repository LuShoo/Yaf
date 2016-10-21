<?php
/**
 * 设备配置管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class ConfigService
{

	// 获取记录列表
	public function getEquipmenetConfigList($condition,$limit, $size)
	{
		$dd=TZ_Loader::model('EquipmentConfig', 'Equipment')->getColumnName();
		$condition['limit'] = "{$limit},{$size}";
		$condition['order'] = 'updated_at DESC';
		$list=TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, '*', 'ALL');
		foreach($list as &$row){
			$imei=$row["imei"];
			$info=$this->getUserEquipmentConfig(array("imei:eq"=>$imei));
			if(count($info)==0){
				$rowName=TZ_Loader::model('EquipmentConfig', 'Equipment')->getColumnName();
				$row=$rowName;
				$row["imei"]=$imei;
			}else{
				$row=array_merge($row, $info);
			}
		}
		return $list;
	}
// 获取记录列表
	public function getEquipmenetConfigTotal($condition)
	{
		$list=TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, 'count(*) as total', 'ROW');
		return $list["total"];
	}
	//修改用户设备信息
	public function setUserEquipment($set,$condition){
		$set["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('UserEquipment', 'Equipment')->update($set,$condition);

	}
	//查询设备配置信息
	public function getUserEquipmentConfig($condition){
		return TZ_Loader::model('EquipmentConfig', 'Equipment')->select($condition, '*', 'ROW');
	}
	//更新配置信息
	public function setUserEquipmentConfig($ids,$agentId,$set){
		$idList=explode(",", $ids);
		foreach ($idList as &$row){
			try {
				$data=$set;
				$imei=$row;
				$condition["imei:eq"]=$imei;
				$condition["agent_id:eq"]=$agentId;
				//查询当前imei是否存在
				$Info=TZ_Loader::model('EquipmentConfig', 'Equipment')->select($condition, '*', 'ROW');
				if(count($Info)==0){
					$data["imei"]=$imei;
					$data["agent_id"]=$agentId;
					$data["created_at"]=$data["updated_at"]=date("Y-m-d H:i:s");
					TZ_Loader::model('EquipmentConfig', 'Equipment')->insert($data);
				}else{
					$set["updated_at"]=date("Y-m-d H:i:s");
					TZ_Loader::model('EquipmentConfig', 'Equipment')->update($set,$condition);
				}
			} catch (Exception $e) {
			}
		}
		return true;
	}

}