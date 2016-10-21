<?php
/**
 * apn删除
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-04-06
 */
class ApnDelController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["id"])||empty($params["id"])){
			throw new Exception('请输入apn ID。');
		}
		TZ_Loader::service('Apn','Api')->delApn($params["agent_id"],$params["id"]);
		TZ_Request::success(array());
	}

}