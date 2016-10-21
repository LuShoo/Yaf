<?php
/**
 * userlogin controller
 * @author octopus <zhangguipo@747.cn>
 * @final 2015-11-02
 */
class UserSetController extends Yaf_Controller_Abstract {

	public function indexAction() {
		$params = TZ_Request::getParams('post');

		if(!isset($params["id"])||empty($params["id"])){
			throw new Exception('请输入用户ID。');
		}
		$data['agentname']=$params['agentname'];
		$data['linkname']=$params['linkname'];
		$data['telephone']=$params['telephone'];
		$data['address']=$params['address'];
		if(isset($params['password'])&&!empty($params['password'])){
			$data['password']=$params['password'];
		}
		$userInfo = TZ_Loader::service('User','Api')->setUserInfo(array('id:eq'=>$params["id"]),$data);
		if(count($userInfo)==0){
			throw new Exception('修改失败。');
		}
		TZ_Request::success();
    }

}
