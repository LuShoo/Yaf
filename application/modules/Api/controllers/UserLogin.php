<?php
/**
 * userlogin controller
 * @author octopus <zhangguipo@747.cn>
 * @final 2015-11-02
 */
class UserLoginController extends Yaf_Controller_Abstract {

	public function indexAction() {
		$params = TZ_Request::getParams('post');
		if(!isset($params["name"])||empty($params["name"])){
			throw new Exception('请输入用户名。');
		}
		if(!isset($params["password"])||empty($params["password"])){
			throw new Exception('请输入密码。');
		}
		$userInfo = TZ_Loader::service('User','Api')->login($params["name"],$params["password"]);
		if(count($userInfo)==0){
			throw new Exception('用户不存在。');
		}
		TZ_Request::success(array($userInfo));
    }

}
