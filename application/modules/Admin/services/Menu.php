<?php
/* 菜单页面
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class MenuService
{
    //获取可展示的菜单列表
    public function getMenuList()
    {
        $condition = array('status:eq'=>1);
        $list = TZ_Loader::model('Menu','Admin')->select($condition);
        $sortlist = array();
        if($list)
        {
            foreach($list AS $val)
            {
                if($val['pid']==0)
                    $sortlist['head'][] = $val;
                else
                    $sortlist['child'][$val['pid']][] = $val;
            }
        }
        return $sortlist;
    }

    //获取菜单列表
    public function getAdminMenuList()
    {
        $condition = array();
        $list = TZ_Loader::model('Menu','Admin')->select($condition);
        $sortlist = array();
        if($list)
        {
            foreach($list AS $val)
            {
                if($val['pid']==0)
                    $sortlist['head'][] = $val;
                else
                    $sortlist['child'][$val['pid']][] = $val;
            }
        }
        return $sortlist;
    }


    //用户权限设置列表
    public function parseMenu($id){
        //用户自己的权限
        $powerList = TZ_Loader::service('AdminUser', 'Admin')->getPowerList($id)['power'];
        $userPower = explode(',',$powerList);
        //获取所登录用户的全部的权限
        $admin_id = $_SESSION['user_info']['user_id'];
        $powerid = TZ_Loader::service('AdminUser', 'Admin')->powerList($admin_id)['power'];
        $powerid = explode(',',$powerid);
        $powerInfo = TZ_Loader::model('Power', 'Admin')->select(['id:in'=>$powerid],'*','ALL');
        $poweArr = TZ_Loader::service('Recursion','Common')->_formatData($powerInfo,0);
        ob_start();
        echo '<div class="tab-content">';
        echo '<div class="tab-pane active" id="customer">';
        foreach ($poweArr as $perm){
            $checked = '';
            if (in_array($perm['id'], $userPower)) {
                $checked = 'checked="checked"';
            }
            echo '<label class="checkbox" style="margin-left:30px;margin-bottom:10px;">';
            echo '<input type="checkbox" id="Mu' . $perm['id'] . '" value="' . $perm['id'] . '" onclick="relation(this,' . $perm['parent_id'] . ')"' . $checked . ' ><strong>' . $perm['perm_name'] . '</strong>';
            echo '</label>';
            echo '<div style="margin-left:30px;margin-bottom:10px;">';
            foreach ($perm['child'] as $child){
                $checked = '';
                if (in_array($child['id'], $userPower)) {
                    $checked = 'checked="checked"';
                }
                echo '<label class="checkbox inline" style="margin-left:30px">';
                echo '<input class="belog' . $perm['id'] . '" type="checkbox" id="Mu' . $child['id'] . '" value="' . $child['id'] . '" onclick="relation(this,' . $child['parent_id'] . ')" ' . $checked . '>' . $child['perm_name'];
                echo '</label>';
                echo '<div style="margin-left:30px;margin-bottom:10px;">';
                foreach($child['child'] as $next_child){
                    $checked = '';
                    if (in_array($next_child['id'], $userPower)) {
                        $checked = 'checked="checked"';
                    }
                    echo '<label class="checkbox inline" style="margin-left:30px">';
                    echo '<input class="belog' . $perm['id'] . '" type="checkbox" id="Mu' . $next_child['id'] . '" value="' . $next_child['id'] . '" onclick="relation(this,' . $next_child['parent_id'] . ')" ' . $checked . '>' . $next_child['perm_name'];
                    echo '</label>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="tab-pane" id="role">';
        echo '</div>';

        $code = ob_get_contents();
        ob_end_clean();
        return $code;
    }


    //获取菜单(左侧)
    public function disMenu()
    {
//        $uid = $_SESSION['user_info']['user_id'];
//        $agentInfo = TZ_Loader::service('Power', 'Admin')->getUserAgents($uid);
//        $agentArr = explode(',', $agentInfo['agent_list']);
//        // var_dump($agentArr);die;
//        $menuUserList = TZ_Loader::service('Power', 'Admin')->getMenuList($agentArr);
//        $menuAllList = $this->getMenuList();
//        echo json_encode($menuAllList, JSON_UNESCAPED_UNICODE); exit;
        $menuStr = ' {"head":[{"id":"1","pid":"0","name":"系统管理","action":"admin","icon":"icon-dashboard","status":"1","created_at":"2015-03-09 14:31:25","updated_at":"2016-09-10 14:43:52"},{"id":"100","pid":"0","name":"设备管理","action":"device","icon":"icon-cogs","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"102","pid":"0","name":"广告管理","action":"ad","icon":"icon-tasks","status":"1","created_at":"2016-09-12 15:00:14","updated_at":"2016-09-12 15:01:57"},{"id":"103","pid":"0","name":"会员管理","action":"member","icon":"icon-dashboard","status":"1","created_at":"2016-09-12 15:59:45","updated_at":"2016-09-12 16:31:53"},{"id":"113","pid":"0","name":"流量管理","action":"flow","icon":"icon-dashboard","status":"1","created_at":"2016-09-12 18:33:29","updated_at":"2016-09-12 18:34:03"},{"id":"117","pid":"0","name":"经销商消息中心","action":"message","icon":"icon-dashboard","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"125","pid":"0","name":"平台消息中心","action":"app","icon":"icon-dashboard","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"}],"child":{"1":[{"id":"2","pid":"1","name":"用户管理","action":"\/admin\/user\/index.html","icon":"","status":"1","created_at":"2015-03-09 14:32:30","updated_at":"2016-06-14 14:49:07"},{"id":"3","pid":"1","name":"菜单管理","action":"\/admin\/home\/menu.html","icon":"","status":"1","created_at":"2015-03-09 15:54:23","updated_at":"2015-03-09 15:54:31"},{"id":"97","pid":"1","name":"权限管理","action":"\/admin\/power\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"98","pid":"1","name":"分组管理","action":"\/admin\/group\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"}],"100":[{"id":"101","pid":"100","name":"设备管理","action":"\/device\/device\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"}],"103":[{"id":"104","pid":"103","name":"会员列表","action":"\/member\/member\/index.html","icon":"","status":"1","created_at":"2016-09-12 16:36:34","updated_at":"2016-09-12 16:36:34"}],"102":[{"id":"105","pid":"102","name":"应用列表","action":"\/ad\/app\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"2016-09-12 17:23:20"},{"id":"106","pid":"102","name":"广告tag","action":"\/ad\/tag\/index.html","icon":"","status":"1","created_at":"2016-09-12 17:35:47","updated_at":"2016-09-12 17:35:47"},{"id":"107","pid":"102","name":"广告列表","action":"\/ad\/object\/index.html","icon":"","status":"1","created_at":"2016-09-12 17:39:14","updated_at":"2016-09-12 17:39:14"},{"id":"108","pid":"102","name":"请求日志","action":"\/ad\/req\/index.html","icon":"","status":"1","created_at":"2016-09-12 17:39:50","updated_at":"2016-09-12 17:39:50"},{"id":"109","pid":"102","name":"点击日志","action":"\/ad\/click\/index.html","icon":"","status":"1","created_at":"2016-09-12 17:40:12","updated_at":"2016-09-12 17:40:12"}],"113":[{"id":"114","pid":"113","name":"流量卡入库","action":"\/flow\/cards\/index.html","icon":"","status":"1","created_at":"2016-09-12 18:34:59","updated_at":"2016-09-12 18:34:59"},{"id":"115","pid":"113","name":"充值包管理","action":"\/flow\/packages\/index.html","icon":"","status":"1","created_at":"2016-09-12 18:36:17","updated_at":"2016-09-12 18:36:17"},{"id":"116","pid":"113","name":"订单管理","action":"\/flow\/orders\/index.html","icon":"","status":"1","created_at":"2016-09-12 18:36:55","updated_at":"2016-09-12 18:37:03"}],"117":[{"id":"118","pid":"117","name":"添加消息","action":"\/message\/message\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"119","pid":"117","name":"审核消息","action":"\/message\/message\/check.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"120","pid":"117","name":"发送消息","action":"\/message\/message\/send.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"}],"125":[{"id":"126","pid":"125","name":"消息管理","action":"\/push\/messageMaster\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"131","pid":"125","name":"坏词列表","action":"\/push\/badword\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"132","pid":"125","name":"设备管理","action":"\/push\/device\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"},{"id":"133","pid":"125","name":"经销商列表","action":"\/push\/app\/index.html","icon":"","status":"1","created_at":"0000-00-00 00:00:00","updated_at":"0000-00-00 00:00:00"}]}}';

        $menuAllList = json_decode($menuStr, true);
        // var_dump($menuAllList);exit;

        echo '<div id="sidebar" class="nav-collapse collapse">
                <div class="sidebar-toggler hidden-phone"></div>
                <ul class="sidebar-menu">';
        // 处理显示列表
        echo $this->_getMenuHtml($menuAllList);

        echo '  </ul>
             </div>';

    }

    /**
     * 整理菜单数据
     *
     * @param $menuList
     *
     * @return string
     */
    private function _getMenuHtml($menuList)
    {
        $html = '';
        // 查看用户权限列表
        // 获取当前请求地址¬
        $path = $_SERVER['REQUEST_URI'];
        $path = !empty($_SERVER['QUERY_STRING']) ? substr($path, 0, strpos($path, '?')) : preg_replace('/^\?.*/', '', $path);
        $qurlarr = explode('/', $path);
        $qurl = '/' . $qurlarr[1] . '/' . $qurlarr[2] . '/' . $qurlarr[3];
        foreach ($menuList['head'] as $menu) {

                $class = 'has-sub';
                $style = 'style="display:none;"';
                if($menuList['child'][$menu['id']]){
                    foreach ($menuList['child'][$menu['id']] as $child) {
                        if ($qurl == $child['action']) {
                            $class = 'has-sub open';
                            $style = 'style="display:block;"';
                            //$liclass='style="background-color:red;"';
                            break;
                        }
                    }
                }

                // 整理菜单
                $html .= '<li class="' . $class . '">
                            <a href="javascript:;">
                                <span class="icon-box"> <i class="' . $menu['icon'] . '"></i></span> ' . $menu['name'] . '
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub" ' . $style . '>';
                if($menuList['child'][$menu['id']]){
                    foreach ($menuList['child'][$menu['id']] as $child) {
                        // echo $child['action'], "\n";

                            $liclass = '';
                            if (trim($child['action']) == $qurl) {
                                $liclass = 'style="background-color:#008888;';
                            }
                            $html .= '<li><a ' . $liclass . ' href="' . $child['action'] . '">' . $child['name'] . '</a></li>';

                    }
                }


                $html .=  ' </ul>
                         </li>';
            }


        return $html;
    }
}