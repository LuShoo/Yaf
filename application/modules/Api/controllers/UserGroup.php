<?php
/**
 * 设备管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class UserGroupController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		$condition["agent_id:eq"]=$params["agent_id"];
		$result=TZ_Loader::service('Group','Api')->getUserGroupList($condition);
		if(count($result)==0){
			throw new Exception('当前用户还没有分组。');
		}
		TZ_Request::success($result);
    }
  
}