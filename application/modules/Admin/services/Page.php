<?php
/**
 * 公共页面服务
 * 
 * @author vincent <vincent@747.cn>
 * @final 2013-05-16
 */
class PageService
{
	/**
	 * @var object
	 */
	private $_view;
	
	/**
	 * 设置视图对象
	 * 
	 * @param object $view
	 * @return PageService
	 */
	public function setView($view)
	{
		$this->_view = $view;
		return $this;
	}
	
	/**
	 * 渲染所有模板
	 * 
	 * @param string $menu
	 */
	public function render($menu = 'home')
	{
		$this->header()->menu($menu)->footer();
	}
	
	/**
	 * 渲染头部
	 * 
	 * @return PageService
	 */
	public function header()
	{
		$userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin();
                ////////////////////////检查用户登录权限//////////////////////////////////////
                if($userInfo['user_id'] != "1")
                {//超级管理员直接全部权限
                    $bloon = $this->userCanLoadFunction($userInfo['user_id']);
                    if(!$bloon)
                    {
                        throw new Exception("没有权限访问此模块");
                    }
                }
                ////////////////////////检查用户登录权限end//////////////////////////////////////
                $this->_view->assign('nickname', $userInfo['user_nickname']);
		return $this;
	}	
	
	/**
	 * 渲染菜单项
	 * 
	 * @param string $menu
	 * @return void
	 */
	public function menu($menu = 'home')
	{
		$isAdmin = TZ_Loader::service('Auth', 'Admin')->isAdmin();
             
                $userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin();
		$this->_view->assign('menu', $menu);
                $this->_view->assign('uprivilege', $this->getUserPrivilegeList($userInfo['user_id']));
                $this->_view->assign('privilegeList', $this->getPrivilegeList());
              
		$this->_view->assign('is_admin', $isAdmin);
		return $this;
	}
	
	/**
	 * 渲染底部
	 * 
	 * @return PageService
	 */
	public function footer()
	{
		return $this;
	}
        
        /**
	 * 判断用户权限
	 * 
	 * @return PageService
	 */
	private function userCanLoadFunction($uid)
	{
            
                //判断当前访问的页面是否在权限控制的范围内，如果不在则直接true，如果在判断用户是否有此权限
                $modulesName = Yaf_Dispatcher::getInstance()->getRequest()->getModuleName();
                $controllerName = Yaf_Dispatcher::getInstance()->getRequest()->getControllerName();
                $actionName = Yaf_Dispatcher::getInstance()->getRequest()->getActionName();
                
                $curlurl =  strtolower("/".$modulesName."/".$controllerName."/".$actionName);
                
                $privilegelist = $this->getPrivilegeList();
                if(in_array($curlurl, $privilegelist))
                {
                    $conditions['uid:eq'] = $uid;
                    $userPrivileges = TZ_Loader::model('UserPrivilege', 'Admin')->select($conditions, "rule_list", 'ROW');
                    if($userPrivileges)
                    {
                        $userPrivilegesArr = explode("|", $userPrivileges['rule_list']);
                        $uuserPrivilege = array();
                        foreach($userPrivilegesArr as $val)
                        {
                            array_push($uuserPrivilege, strtolower($val));
                        }
                        if(in_array($curlurl,$uuserPrivilege))
                        {
                            return true;
                        }
                        else
                            return false;
                        }   
                    else
                        return false;
                }
                else
                    return true;
                
        }
        
        
        /**
	 * 获取权限列表
	 * 
	 * @return PageService
	 */
        private function getPrivilegeList()
        {     
              $conditions = array(); //查询条件
              $privilete = array();       //访问权限
              $conditions['status:eq'] = 1;
              $fields = "action";
              $privileteList = TZ_Loader::model('Privilege', 'Admin')->select($conditions, $fields, 'ALL');
              if($privileteList)
              {
                  foreach($privileteList as $pval)
                  {
                       array_push($privilete, strtolower($pval['action']));
                  }
              }
              
              return $privilete;
        }
        
        /**
	 * 获取权限列表
	 * 
	 * @return PageService
	 */
        private function getUserPrivilegeList($uid)
        {     
              $conditions = array();
              $returnuprivileteList = array();
              $conditions['uid:eq'] = $uid;
              $fields = "rule_list";
              $privileteList = TZ_Loader::model('UserPrivilege', 'Admin')->select($conditions, $fields, 'ROW');
              if($privileteList)
              {
                  $uprivileteList = explode("|",$privileteList['rule_list']);
                  foreach($uprivileteList as $val)
                  {
                      array_push($returnuprivileteList,  strtolower($val));
                  }
              }
              else
              {
                  $returnuprivileteList = array();
              }
              
              return $returnuprivileteList;
        }
        
        
}