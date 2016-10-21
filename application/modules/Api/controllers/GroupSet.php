<?php
/**
 * 分组修改
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class GroupSetController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		if(!isset($params["id"])||empty($params["id"])){
			throw new Exception('请输入分组ID。');
		}
		if(!isset($params["name"])||empty($params["name"])){
			throw new Exception('请输入客户分组名称。');
		}
		$condition["agent_id:eq"]=$params["agent_id"];
		$condition["id:eq"]=$params["id"];
		TZ_Loader::service('Group','Api')->setUserGroup($params["agent_id"],$params["id"],$params["name"]);
		TZ_Request::success(array());
    }
  
}