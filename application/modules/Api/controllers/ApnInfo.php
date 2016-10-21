<?php
/**
 * apn管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class ApnInfoController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["id"])||empty($params["id"])){
			throw new Exception('请输入Apn ID。');
		}
		$condition["agent_id:eq"]=$params["agent_id"];
		$condition["id:eq"]=$params["id"];

		$result=TZ_Loader::service('Apn','Api')->getApnInfo($condition);
		TZ_Request::success($result);
    }
  
}