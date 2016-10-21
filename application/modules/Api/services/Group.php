<?php
/**
 * 设备管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class GroupService
{

	// 获取记录列表
	public function getUserGroupList($condition)
	{
		$condition["status:eq"]=1;
		$condition['order'] = 'updated_at DESC';
		return TZ_Loader::model('UserGroup', 'Equipment')->select($condition, '*', 'ALL');
	}

	
	//添加用户分组　
	public function addUserGroup($id,$name){
		$data["agent_id"]=$id;
		$data["name"]=$name;
		$data["status"]=1;
		$data["created_at"]=$data["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('UserGroup', 'Equipment')->insert($data);
	}
	//修改用户分组　
	public function setUserGroup($agentId,$id,$name){
		$condition["agent_id:eq"]=$agentId;
		$condition["id:eq"]=$id;
		$set["name"]=$name;
		$set["updated_at"]=date("Y-m-d H:i:s");
		TZ_Loader::model('UserGroup', 'Equipment')->update($set,$condition);
		return TZ_Loader::service("Equipment","Api")->setUserEquipment(array("group_name"=>$name),array("agent_id:eq"=>$agentId,"group_id:eq"=>$id));
	}
	//删除分组　
	public function delUserGroup($agentId,$id){
		$condition["agent_id:eq"]=$agentId;
		$condition["id:eq"]=$id;
		TZ_Loader::model('UserGroup', 'Equipment')->delete($condition);
		return TZ_Loader::service("Equipment","Api")->setUserEquipment(array("group_id"=>0,"group_name"=>''),array("agent_id:eq"=>$agentId,"group_id:eq"=>$id));
	}
	//查询分组信息
	public function getUserGroupInfo($condition){
		return TZ_Loader::model('UserGroup', 'Equipment')->select($condition, '*', 'ROW');
	}
	
	
}