<?php
date_default_timezone_set('Asia/Shanghai');
header("Content-Type:text/html;charset=utf-8");
session_start();
if (!empty($_GET['debug'])) {
	if (extension_loaded('xhprof'))
		xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}

//run
define('APP_PATH', dirname(__FILE__));
$app = new Yaf_Application(APP_PATH.'/config/application.ini');
$app->bootstrap()->run();
