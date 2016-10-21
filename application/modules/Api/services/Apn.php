<?php
/**
 * 设备Apn管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-04-06
 */
class ApnService
{
	// 获取记录列表
	public function getEquipmenetApnList($condition,$limit, $size)
	{
		$condition['limit'] = "{$limit},{$size}";
		$condition['order'] = 'updated_at DESC';
		$list=TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, '*', 'ALL');
		//print_r($list);
		foreach($list as &$row){
			$imei=$row["imei"];
			$info=TZ_Loader::model('EquipmentApn', 'Equipment')->select(array("imei:eq"=>$imei),"*","ROW");
			//print_r($info);
			if(count($info)>0){
				
				$apnInfo=TZ_Loader::model('ApnSet', 'Equipment')->select(array("id:in"=>split(',', $info['apn_id'])),"group_concat(name ) as name,group_concat(apn) as apn","ROW");
				$row['apn_name']=$apnInfo['name'];
				$row['apn_key']=$apnInfo['apn'];
				$row['apn_id']=$info['apn_id'];
			}else{
				$row['apn_name']='';
				$row['apn_key']='';
				$row['apn_id']='';
			}
		}
		return $list;
	}
	// 获取记录列表
	public function getEquipmenetApnTotal($condition)
	{
		$list=TZ_Loader::model('UserEquipment', 'Equipment')->select($condition, 'count(*) as total', 'ROW');
		return $list["total"];
	}
	
	// 获取记录列表
	public function getApnList($condition,$limit, $size)
	{
		$condition['limit'] = "{$limit},{$size}";
		$condition['order'] = 'updated_at DESC';
		$list=TZ_Loader::model('ApnSet', 'Equipment')->select($condition, '*', 'ALL');
		return $list;
	}
	// 获取记录列表
	public function getApnTotal($condition)
	{
		$list=TZ_Loader::model('ApnSet', 'Equipment')->select($condition, 'count(*) as total', 'ROW');
		return $list["total"];
	}
	//添加apn
	public function addApn($data){
		$data["created_at"]=$data["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('ApnSet', 'Equipment')->insert($data);
	}	
	//修改apn
	public function setApn($set,$condition){
		$set["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('ApnSet', 'Equipment')->update($set,$condition);
	}
	//删除apn
	public function delApn($agentId,$id){
		//删除数据
		TZ_Loader::model('ApnSet', 'Equipment')->delete(array('id:eq'=>$id,'agent_id:eq'=>$agentId));
		//更新配置表的数据
		TZ_Loader::model('EquipmentApn', 'Equipment')->setEquipmentApn($agentId,$id);
		return true;
	}
	
	//查询apn
	public function getApnInfo($condition){
		return TZ_Loader::model('ApnSet', 'Equipment')->select($condition,"*","ROW");
	}
	
	//更新配置信息
	public function setEquipmentApn($ids,$agentId,$apnIds){
		$idList=explode(",", $ids);
		foreach ($idList as &$row){
			try {
				
				$imei=$row;
				$condition["imei:eq"]=$imei;
				$condition["agent_id:eq"]=$agentId;
				//查询当前imei是否存在
				$Info=TZ_Loader::model('EquipmentApn', 'Equipment')->select($condition, '*', 'ROW');
				if(count($Info)==0){
					$data=array();
					$data["apn_id"]=$apnIds;
					$data["imei"]=$imei;
					$data["agent_id"]=$agentId;
					$data["created_at"]=$data["updated_at"]=date("Y-m-d H:i:s");
					TZ_Loader::model('EquipmentApn', 'Equipment')->insert($data);
				}else{
					$set=array();
					$set["apn_id"]=$apnIds;
					$set["updated_at"]=date("Y-m-d H:i:s");
					TZ_Loader::model('EquipmentApn', 'Equipment')->update($set,$condition);
				}
			} catch (Exception $e) {
			}
		}
		return true;
	}

}