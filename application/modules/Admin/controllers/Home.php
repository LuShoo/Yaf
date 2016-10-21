<?php
/*
 * 后台首页
 * @author nick <zhaozhiwei@747.cn>
 */
class HomeController extends Yaf_Controller_Abstract
{
	//后台首页
	public function indexAction()
	{
		$userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin();
		$params = TZ_Request::getParams('get');
		$search['telephone']    = isset($params['telephone']) ? $params['telephone']: '';
		$search['uname']        = isset($params['uname']) ? $params['uname']: '';
		$search['sn']           = isset($params['sn']) ? $params['sn']: '';
		$search['imei']         = isset($params['imei']) ? $params['imei']: '';
		$search['simtelephone'] = isset($params['simtelephone']) ? $params['simtelephone']: '';
		$search['ccid']         = isset($params['ccid']) ? $params['ccid']: '';
		$this->_view->assign("search", $search);
		$this->_view->display('home.tpl');
	}
	//菜单设置
	public function menuAction()
	{
		$list = TZ_Loader::service('Menu')->getAdminMenuList();
        $Rows = array();
		foreach($list['head'] AS $menu)
		{
			$Rows[] = $menu;
			if(isset($list['child'][$menu['id']])){
				foreach($list['child'][$menu['id']] AS $child)
				{
					$Rows[] = $child;
				}
			}
		}
		$this->_view->assign('list',$Rows);
		$this->_view->display('menu_list.tpl');
	}
	//添加菜单
	public function addmenuAction()
	{
		$list = TZ_Loader::service('Menu')->getAdminMenuList();
		$this->_view->assign('list',$list['head']);
		$this->_view->assign('title','新增菜单');
		$this->_view->display('menu_add.tpl');
	}
	//修改菜单
	public function editmenuAction()
	{
		$id = intval($_GET['id']);
		if($id < 1)
		{
			die('无效请求');
		}
		$list = TZ_Loader::service('Menu')->getAdminMenuList();
		$this->_view->assign('list',$list['head']);
		$info = TZ_Loader::model('Menu','Admin')->select(array('id:eq'=>$id),'*','ROW');
		$this->_view->assign('info',$info);
		$this->_view->assign('title','修改菜单');
		$this->_view->display('menu_add.tpl');
	}
	public function createmenuAction()
	{
		$pid = intval($_POST['pid']);
		$name = trim($_POST['name']);
		$action = trim($_POST['action']);
		$icon = trim($_POST['icon']);
		$status = intval($_POST['status']);
		if($name == '' || $action == '')
		{
			TZ_Request::error('参数错误。');
			exit;
		}
		$cols = array( 'pid' => $pid, 'name' => $name, 'action' => $action, 'icon' => $icon ,'status'=>$status);
		//修改
		if($_POST['id'])
		{
			$id = intval($_POST['id']);
			$condition['id:eq'] = $id;
			$cols['updated_at'] = date('Y-m-d H:i:s');
			$update = TZ_Loader::model('Menu','Admin')->update($cols,$condition);
			if(!$update)
			{
				TZ_Request::error('修改失败。');
				exit;
			}
		}
		//添加
		else
		{
			//是否重复
			$condition['name:eq'] = $name;
			$repeat = TZ_Loader::model('Menu','Admin')->select($condition,'id','ROW');
			if($repeat['id'])
			{
				TZ_Request::error('菜单名称重复。');
				exit;
			}
			$cols['created_at'] = $cols['updated_at'] = date('Y-m-d H:i:s');
			$insert = TZ_Loader::model('Menu','Admin')->insert($cols);
			//var_dump($insert);
			if(!$insert)
			{
				TZ_Request::error('添加失败。');
				exit;
			}
		}
		TZ_Request::success();
	}
	//删除
	public function delmenuAction()
	{
		$id = intval($_GET['id']);
		if($id < 1)
		{
			die('无效请求');
		}
		$condition['id:eq'] = $id;
		$del = TZ_Loader::model('Menu','Admin')->delete($condition);
		if($del)
		{
			echo '<script>alert("删除成功。");location.href="/admin/home/menu.html";</script>';
		}
		else
		{
			echo '<script>alert("删除失败。");location.href="/admin/home/menu.html";</script>';
		}
	}
}