<?php
/**
 * 分组添加
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-11
 */
class GroupAddController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["name"])||empty($params["name"])){
			throw new Exception('请输入客户分组名称。');
		}
		
		TZ_Loader::service('Group','Api')->addUserGroup($params["agent_id"],$params["name"]);
		TZ_Request::success(array());
    }
  
}