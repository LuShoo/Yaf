<?php
/**
 * 分组删除
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-11
 */
class GroupDelController extends Yaf_Controller_Abstract
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
		TZ_Loader::service('Group','Api')->delUserGroup($params["agent_id"],$params["id"]);
		TZ_Request::success(array());
    }
  
}