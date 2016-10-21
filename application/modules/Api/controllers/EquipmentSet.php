<?php
/**
 * 设备管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class EquipmentSetController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["ids"])||empty($params["ids"])){
			throw new Exception('请输入设备ID。');
		}
		$set=array();
		if(isset($params["name"])&&!empty($params["name"])){
			$set["name"]=$params["name"];
		}
		if(isset($params["group_id"])&&!empty($params["group_id"])){
			$set["group_id"]=$params["group_id"];
			$info=TZ_Loader::service('Group','Api')->getUserGroupInfo(array("id:eq"=>$params["group_id"]));
			if(count($info)==0){
				throw new Exception('当前用户分组ID错误。');
			}
			$set["group_name"]=$info["name"];
		}
		//如果备注和分组id都为空，返回错误
		if(count($set)==0){
				throw new Exception('当前用户设备参数错误。');
		}
		$idList=explode(",",$params["ids"]);
		$condition["agent_id:eq"]=$params["agent_id"];
		$condition["id:in"]=$idList;
		TZ_Loader::service('Equipment','Api')->setUserEquipment($set,$condition);
		TZ_Request::success(array());
    }
  
}