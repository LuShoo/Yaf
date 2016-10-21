<?php
/**
 * userlogin controller
 * @author octopus <zhangguipo@747.cn>
 * @final 2015-11-02
 */
class UserInfoController extends Yaf_Controller_Abstract {

	public function indexAction() {
		$params = TZ_Request::getParams('post');

		if(!isset($params["id"])||empty($params["id"])){
			throw new Exception('请输入用户ID。');
		}
		$userInfo = TZ_Loader::service('User','Api')->getUserInfo($params["id"]);
		if(count($userInfo)==0){
			throw new Exception('用户不存在。');
		}
		TZ_Request::success(array($userInfo));
    }

}
