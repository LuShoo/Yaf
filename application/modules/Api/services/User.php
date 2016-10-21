<?php
/**
 * 用户
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-11
 */
class UserService
{
	//用户登录
	public function login($name,$pwd){
		$condition["name:eq"]=$name;
		$condition["password:eq"]=md5($pwd);
		return TZ_Loader::model("Agent","Admin")->select($condition,"*","ROW");
	
	}
	//用户信息
	public function getUserInfo($id){
		$condition["id:eq"]=$id;
		return TZ_Loader::model("Agent","Admin")->select($condition,"*","ROW");
	}
	
	//更新信息
	public function setUserInfo($condition,$set){
		$set["updated_at"]=date("Y-m-d H:i:s");
		return TZ_Loader::model('Agent', 'Admin')->update($set,$condition);
	}
}