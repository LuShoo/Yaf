<?php
/**
 * 管理系统认证服务
 * 
 * @author vincent <vincent@747.cn>
 * @final 2013-05-15
 */
class AuthService
{
	/**
	 * @var string
	 */
	static private $_userDomain = '747_BOSS_USER';
	
	/**
	 * @var int
	 */
	const SESS_LIFE_TIME = 36000;
	
	/**
	 * 执行登陆操作
	 * 
	 * @param string $username
	 * @param string $password
	 * @return string $sessionId
	 */
	public function login($username, $password)
	{
		$data = array('success' => false);
		$userInfo = TZ_Loader::model('AdminUser', 'Admin')->getInfoByUsername($username);
        if (empty($userInfo))
			return $data + array('message' => '用户不存在，请联系管理员开通帐号');

		if ($this->passwordEncode($password) != $userInfo['password'])
			return $data + array('message' => '用户名或密码错误,请尝试重新登陆');

		$data['success'] = true;
		$data['data'] = $userInfo;
		return $data;
	}
	
	/**
	 * 注册用户信息到会话中，会话的有效时间。
	 *
	 * @param array $data			    //用户信息
	 * @param int $recordTime			//登陆状态的保存时间，即免登陆时间，默认0。
	 * @param int $lifeTime				//会话的生命周期，默认5分钟不操作就会关闭会话，不得超过24分钟。
	 * @return bool
	 */
	public function registerUser($data, $recordTime = 0)
	{
		$now = time();
        $userInfo = array(
			'user_id' 	=>  $data['id'],
			'user_type' =>  $data['user_type'],
            'user_nickname'	=>	$data['nickname'],
            'level'     =>  $data['level'],
            'agent_list'=>  $data['agent_list'],
		);
		$_SESSION['user_info'] = $userInfo;
		$_SESSION['create_time'] = $now;
		$_SESSION['life_time'] = self::SESS_LIFE_TIME;
		if ($recordTime != 0) {
			$cipher = new TZ_Mcrypt(Yaf_Registry::get('config')->cookie->key);
			$cookieData = base64_encode($cipher->encode(json_encode($userInfo)));
			setCookie(self::$_userDomain, $cookieData, ($now + $recordTime));
		}
	}
	
	/**
	 * 退出登陆
	 * 
	 * @return boolean
	 */
	public function logout()
	{
		session_unset();
		setCookie(self::$_userDomain, '', 0);
		return true;
	}
	
	/**
	 * 检测是否登陆
	 * 
	 * @param boolean $locationUrl false - 返回false
	 * @return mixed 成功返回用户信息，失败则默认自动跳转。
	 */
	public function checkLogin($locationUrl = '/admin/auth/index')
	{
		$now = time();
		$locationMode = '';
		
		//会话存在
		if (!empty($_SESSION)) {
			//会话是否有效
			if (($now - $_SESSION['create_time']) < $_SESSION['life_time']) {
				$_SESSION['create_time'] = $now;
				return $_SESSION['user_info'];
			} else {
				session_unset();
				$locationMode .= '?mode=timeout';
			}
		}

		//会话不存在，检查客户端cookie
		if (!empty($_COOKIE[self::$_userDomain])) {
			$cipher = new TZ_Mcrypt(Yaf_Registry::get('config')->cookie->key);
			$userInfo = json_decode($cipher->decode(base64_decode($_COOKIE[self::$_userDomain])), true);
			//创建新的会话
			$_SESSION['user_info'] = $userInfo;
			$_SESSION['create_time'] = $now;
			$_SESSION['life_time'] = self::SESS_LIFE_TIME;	
			return $userInfo;
		}
		
		//登陆失败
		if (false === $locationUrl)
			return false;
		
		die(header("Location:{$locationUrl}{$locationMode}"));	
	}
	
	/**
	 * 对明文密码进行加密
	 * 
	 * @param string $password
	 * @return string
	 */
	public function passwordEncode($password)
	{
		return md5($password);
	}

}