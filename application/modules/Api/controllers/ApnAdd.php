<?php
/**
 * apn添加
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-04-06
 */
class ApnAddController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		
		
		if(!isset($params["name"])||empty($params["name"])){
			throw new Exception('请输入name。');
		}
		if(!isset($params["apn"])||empty($params["apn"])){
			throw new Exception('请输入apn。');
		}
		if(!isset($params["apn_type"])){
			throw new Exception('请输入apn_type。');
		}
		if(!isset($params["mcc"])||empty($params["mcc"])){
			throw new Exception('请输入mcc。');
		}
		if(!isset($params["mnc"])||empty($params["mnc"])){
			throw new Exception('请输入mnc。');
		}
		if(!isset($params["apn_protocol"])){
			throw new Exception('请输入apn_protocol。');
		}
		if(!isset($params["apn_roaming_protocol"])){
			throw new Exception('请输入apn_roaming_protocol。');
		}
		$data=array();
		$data["agent_id"]=$params["agent_id"];
		$data['name']=$params["name"];
		$data['apn']=$params["apn"];
		$data['apn_type']=$params["apn_type"];
		$data['mcc']=$params["mcc"];
		$data['mnc']=$params["mnc"];
		$data['apn_protocol']=$params["apn_protocol"];
		$data['apn_roaming_protocol']=$params["apn_roaming_protocol"];

		if(isset($params["proxy_hd"])&&!empty($params["proxy_hd"])){
			$data['proxy_hd']=$params["proxy_hd"];
		}
		if(isset($params["port"])&&!empty($params["port"])){
			$data['port']=$params["port"];
		}
		if(isset($params["username"])&&!empty($params["username"])){
			$data['username']=$params["username"];
		}
		if(isset($params["password"])&&!empty($params["password"])){
			$data['password']=$params["password"];
		}
		if(isset($params["server"])&&!empty($params["server"])){
			$data['server']=$params["server"];
		}
		if(isset($params["mmsc"])&&!empty($params["mmsc"])){
			$data['mmsc']=$params["mmsc"];
		}
		if(isset($params["mms_proxy"])&&!empty($params["mms_proxy"])){
			$data['mms_proxy']=$params["mms_proxy"];
		}
		if(isset($params["mms_port"])&&!empty($params["mms_port"])){
			$data['mms_port']=$params["mms_port"];
		}
		if(isset($params["authentication_type"])&&!empty($params["authentication_type"])){
			$data['authentication_type']=$params["authentication_type"];
		}
		if(isset($params["apn_enable"])&&!empty($params["apn_enable"])){
			$data['apn_enable']=$params["apn_enable"];
		}
		if(isset($params["bearer"])&&!empty($params["bearer"])){
			$data['bearer']=$params["bearer"];
		}
		if(isset($params["mvno_type"])&&!empty($params["mvno_type"])){
			$data['mvno_type']=$params["mvno_type"];
		}
		if(isset($params["mvno_value"])&&!empty($params["mvno_value"])){
			$data['mvno_value']=$params["mvno_value"];
		}
		if(isset($params["operator"])&&!empty($params["operator"])){
			$data['operator']=$params["operator"];
		}

		TZ_Loader::service('Apn','Api')->addApn($data);
		TZ_Request::success(array());
	}

}