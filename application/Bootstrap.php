<?php

/**
 * bootstrap file
 *
 * @author vincent <vincent@747.cn>
 * @final 2013-5-10
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{
	/**
	 * data
	 */
	private $_config = null;

	/**
	 * config init
	 */
	public function _initConfig()
	{
		$this->_config = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $this->_config);
	}

	/**
	 * loader config
	 */
	public function _initLoader()
	{
		$loader = new TZ_Loader;
		Yaf_Registry::set('loader', $loader);
	}

	/**
	 * plug config
	 */
	public function _initPlugin(Yaf_Dispatcher $dispatcher)
	{
		$routerPlugin = new RouterPlugin();
		$dispatcher->registerPlugin($routerPlugin);
	}

	/**
	 * view config
	 */
	public function _initView(Yaf_Dispatcher $dispatcher)
	{
		defined('STATIC_SERVER') or define('STATIC_SERVER', $this->_config->static->server);
		defined('STATIC_VERSION') or define('STATIC_VERSION', md5(date('Ymd')));
		$dispatcher->disableView();
	}

	/**
	 * db config
	 */
	public function _initDb()
	{
		$heimi_msgDb = $this->_config->database->heimi_msg_db;
        $heimi_msgMaster = $heimi_msgDb->master->toArray();
        $heimi_msgSlave = !empty($heimi_msgDb->slave) ? $heimi_msgDb->slave->toArray() : null;
        $heimi_msgDb = new TZ_Db($heimi_msgMaster, $heimi_msgSlave, $heimi_msgDb->driver);
        Yaf_Registry::set('heimi_msg_db', $heimi_msgDb);

        $xiubao_msgDb = $this->_config->database->xiubao_msg_db;
        $xiubao_msgMaster = $xiubao_msgDb->master->toArray();
        $xiubao_msgSlave = !empty($xiubao_msgDb->slave) ? $xiubao_msgDb->slave->toArray() : null;
        $xiubao_msgDb = new TZ_Db($xiubao_msgMaster, $xiubao_msgSlave, $xiubao_msgDb->driver);
        Yaf_Registry::set('xiubao_msg_db', $xiubao_msgDb);

		

    }

	/**
	 * Init library
	 *
	 * @return void
	 */
	public function _initLibrary()
	{
		 
	}

}

/**
 * RouterPlugin.php
 */
class RouterPlugin extends Yaf_Plugin_Abstract
{

	public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{

	}

	public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{
	    return true;

        $req = '/' . $request->module . '/' . $request->controller . '/' . $request->action;
        $req = strtolower($req);
        //权限管理
        if (isset($_SESSION['user_info']['user_id']) && $_SESSION['user_info']['user_id'] > 0)
        {
            // 获取用户权限列表
            // 登录用户的权限列表
            $userAgent = TZ_Loader::service('Power', 'Admin')->agentList($_SESSION['user_info']['user_id']);
            //所有权限
            $allAgentList = TZ_Loader::service('Power', 'Admin')->agentList('');
            if(!in_array($req, $allAgentList)){
                return true;
            }else{
                if(!in_array($req, $userAgent) || empty($userAgent)){
                    if($req == '/admin/home/index.html'){
                        return true;
                    }
                    echo '<script>alert("权限不够！");location.href="/admin/home/index.html";</script>';
                    exit;
                }
            }
        }
		return true;
	}

	public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{
		$view = new TZ_View();
		$view->setCacheEnable(true);
		$view->setScriptPath(APP_PATH . '/application/modules/' . $request->getModuleName() . '/views');
		Yaf_Dispatcher::getInstance()->setView($view);
	}

	public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{
		//将下划线请求的控制器名称重写为大小写
		$controller = $request->getControllerName();
		if (false !== ($pos = strpos($controller, '_')))
		$request->setControllerName(substr($controller, 0, $pos) . substr($controller, ($pos + 1)));

		//在模块名称合法的情况下，对方法名称做处理
		$moduleName = $request->getModuleName();
		if (in_array($moduleName, Yaf_Application::app()->getModules()))
		{

			//记录将访问的接口名称
			Yaf_Registry::set('REQUEST_API_NAME', strtolower($moduleName . '/' . $controller));

			//action中存在".",不存在则默认返回Json数据并且指向index动作

			$action = $request->getActionName();
			if (false !== strpos($action, '.'))
			{

				//source && format
				$param = explode('.', $action);
				if ((count($param) < 2) || empty($param[1]))
				die('request error.');

				//记录需要格式化的类型
				Yaf_Registry::set('REQUEST_FORMAT_TYPE', $param[1]);

				switch ($param[1])
				{

					case 'json':
						// header("Content-type:application/json;charset=utf-8");
						$request->setActionName('index');
						break;

					case 'html':
						//header("Content-type:text/html;charset=utf-8");
						$request->setActionName($param[0]);
						break;

					case 'zip':
						//header('Content-Type:application/zip;charset=utf-8');
						$request->setActionName('index');
						break;
				}

				$source = $param[0];
			}
			else
			{
				//header("Content-type:application/json;charset=utf-8");   //默认返回json数据
				$request->setActionName('index');        //默认全部指向index方法
				Yaf_Registry::set('REQUEST_FORMAT_TYPE', 'json');
				$source = $action;
			}

			self::_analySource($source);
		}
	}

	public function postDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{

	}

	public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
	{

	}

	/**
	 * 定义os,app_name,app_version
	 *
	 * @param string $source
	 * @return void
	 */
	static private function _analySource($source)
	{
		$osName = 'unknow';
		$appName = $source;
		$appVersion = 'unknow';
		if (preg_match_all('#^([ai])([\w]+)([\d]{6})$#', $source, $matches))
		{
			$osName = self::$_os[$matches[1][0]];
			$appName = $matches[2][0];
			$appVersion = $matches[3][0];
		}
		else
		{
			if (isset($_SERVER['HTTP_USER_AGENT']))
			{

				$sUserAgent = $_SERVER['HTTP_USER_AGENT'];
				preg_match('#android|ios|ubuntu|windows#i', $sUserAgent, $matches);
				//               $osName     = strtolower($matches[0]);
				if (isset($matches[0]) && is_array($matches[0]))
				{
					$osName = strtolower($matches[0]);
				}
			}
		}
		Yaf_Registry::set('REQUEST_API_VERSION', '3');
		Yaf_Registry::set('REQUEST_OS_NAME', $osName);
		Yaf_Registry::set('REQUEST_APP_NAME', $appName);
		Yaf_Registry::set('REQUEST_APP_VERSION', $appVersion);
	}

	/**
	 * @var array
	 */
	static private $_os = array(
        'a' => 'android',
        'i' => 'ios'
        );

}
//获得session中的用户ID
function getUserInfo()
{
	if(!empty($_SESSION['user_info']))
	{
		return $_SESSION['user_info'];
	}else
	{
		header('Location:/admin/auth/index.html');
		exit;
	}
}
//tools
function d($params)
{
	echo '<pre>';
	var_dump($params);
	echo '</pre>';
}

function error_404()
{
	die(header('Location:/error/notfound'));
}

function E($p)
{
	echo '<pre>';
	var_export($p);
	exit;
}

function L($param)
{
	if(is_array($param))
	{
		$msg = json_encode($param);
	}
	else
	$msg = $param;
	$h = fopen('log.txt','a+');
    fwrite($h,$msg."\r\n");
    fclose($h);
}

//更好支持中文json_encode
function usr_json_encode($obj){
	return json_encode($obj,JSON_UNESCAPED_UNICODE);
}