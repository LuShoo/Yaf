<?php
/**
 * 后台登陆控制器
 * 
 * @author vincent <vincent@747.cn>
 * @final 2013-05-10
 */
class AuthController extends Yaf_Controller_Abstract
{
	//登陆验证页
	public function indexAction()
	{

		$userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin(false);

		if (false !== $userInfo)
			die(header('Location:/admin/home/index.html'));

		$mode = !empty($_GET['mode']) ? $_GET['mode'] : 'default';
		switch ($mode) {
			case 'timeout':
				$mode = 1;
				break;
		}
		$this->_view->assign('mode', $mode);
		$this->_view->display('login.tpl');
	}
	
	//执行登陆
	public function loginAction()
	{
       
/*		if (empty($_POST['username']))
			TZ_Response::error(108, '用户名不能为空');
		$username = TZ_Request::clean($_POST['username']);
		
		if (empty($_POST['password']))
			TZ_Response::error(109, '密码不能为空');
		$password = TZ_Request::clean($_POST['password']);
		$record=0;
		if (isset($_POST['record'])){
			$record = (boolean)$_POST['record'];
		}
		//用户认证服务
		$authService = TZ_Loader::service('Auth', 'Admin');
        //登陆系统
		$loginStatus = $authService->login($username, $password);
        //查询所属组级别
        $loginStatus['data']['level'] = TZ_Loader::service('Group', 'Admin')->userLevel($loginStatus['data']['id']);
        //查询所拥有操作的权限
        $loginStatus['data']['agent_list'] = TZ_Loader::model('PowerAssignment', 'Admin')->select(['user_id:eq'=>$loginStatus['data']['id']],'agent_list', 'ROW')['agent_list'];
        if (!$loginStatus['success'])
			TZ_Response::error(111, $loginStatus['message']);*/
		//注册会话状态,默认保存会话状态10分钟，记住状态则保存一周
        $loginStatus['data'] = [
            'user_id' 	=>  1,
            'user_type' =>  1,
            'user_nickname'	=>	'admin',
            'level'     =>  0,

        ];
        $authService = TZ_Loader::service('Auth', 'Admin');
		$userInfo = $loginStatus['data'];
		$loginLife = 604800;
		$authService->registerUser($userInfo, $loginLife);
		
		//返回成功
		TZ_Response::success();
	}
	//登出
	public function logoutAction()
	{
		TZ_Loader::service('Auth', 'Admin')->logout();
        header("Location:/admin/auth/index.html");
	}
}