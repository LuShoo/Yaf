<?php
/**
 * 设备apn设置
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-04-06
 */
class EquipmentapnSetController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["apn_ids"])||empty($params["apn_ids"])){
			$apn_ids='';
		}else{
			$apn_ids=$params["apn_ids"];
		}
		$imeis='';
		if(!isset($params["imeis"])||empty($params["imeis"])){
			if(!isset($params["group_id"])||empty($params["group_id"])){
				throw new Exception('参数错误。');
			}else{
				$list=TZ_Loader::model("UserEquipment","Equipment")->select(array("agent_id:eq"=>$params["agent_id"],"group_id:eq"=>$params["group_id"]),"group_concat(imei) as imei","ROW");
				$imeis=$list["imei"];
			}
		}else{
			$imeis=$params["imeis"];
		}
		TZ_Loader::service('Apn','Api')->setEquipmentApn($imeis,$params["agent_id"], $params["apn_ids"]);
		TZ_Request::success();
    }
  
}