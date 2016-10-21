<?php
/**
 * 用户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class UserController extends Yaf_Controller_Abstract
{
    //用户列表
    public function indexAction()
    {
         
        $this->_view->display('user_list.tpl'); 
    }
    //开通新用户
    public function addAction()
    {
        $this->_view->assign('title','新增用户');
        //分组
        $groupList = TZ_Loader::service('Group', 'Admin')->getGroupInfo();
        $this->_view->assign('grouplist',$groupList);
        $this->_view->display('user_add.tpl');
    }
    //编辑用户
    public function editAction()
    {
        $uid = intval($_GET['id']);
        if($uid < 1)
        {
            die("无效请求");
        }
        $userinfo = TZ_Loader::model('AdminUser','Admin')->getInfoByUserId($uid);
        //编辑用户所属的组
        $userinfo['id'] = TZ_Loader::service('Group', 'Admin')->getUserGroup($uid);
        $groupList = TZ_Loader::service('Group', 'Admin')->getGroupInfo();
        $this->_view->assign('grouplist',$groupList);
        $this->_view->assign('uid', $uid);
        $this->_view->assign('userinfo', $userinfo);
        $this->_view->assign('title','编辑用户');
        $this->_view->display('user_add.tpl');
    }
    
    //编辑自己的信息
    public function setselfAction()
    {
        $uid = $_SESSION['user_info']['user_id'];
        if($uid < 1)
        {
            die("无效请求。");
        }
        $userinfo = TZ_Loader::model('AdminUser','Admin')->getInfoByUserId($uid);
        $this->_view->assign('userinfo', $userinfo);
        $this->_view->assign('title','我的信息');
        $this->_view->display('user_self.tpl');
    }

    //执行用户管理命令
    public function createAction()
    {
        $userInfo = array();
        $params = $_POST;
        if(empty($params['username'])) TZ_Request::error('用户名不能为空。');
        if(empty($params['nickname'])) TZ_Request::error('昵称不能为空。');
        if(empty($params['branch'])) TZ_Request::error('部门不能为空。');
        $userInfo['username'] = $params['username'];
        $userInfo['nickname'] = $params['nickname'];
        $userInfo['user_type'] = $params['user_type'];
        $userInfo['branch'] = $params['branch'];
        $userInfo['user_level'] = $params['level'];
        $gid = $params['gid'];
        if($params['id'])
        {
            if(!empty($params['password'])) $userInfo['password'] = $params['password'];
            $userInfo['id'] = $params['id'];
        }
        else
        {
            if(empty($params['password'])) TZ_Request::error('密码不能为空。');
            $userInfo['password'] = $params['password'];
        }
        $registerStatus = TZ_Loader::service('AdminUser', 'Admin')->create($userInfo, $gid);
        if ($registerStatus['success'])
            TZ_Request::success();
        else
            TZ_Request::error($registerStatus['message']);
    }

    //回调获取用户列表 
    public function getListAction()
    {
        $params = $_GET;
        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);

        //load service
        $userService = TZ_Loader::service('AdminUser', 'Admin');

        //get data
        $userTotal = $userService->getTotal();
        $userList = $userService->getList(1, 10000);
        //render
        //获取操作按钮
        $btnInfo = TZ_Loader::service('Power', 'Admin')->getBtn($this->getRequest());
        $this->_view->assign('user_list', $userList);
        $this->_view->assign('btnInfo', $btnInfo);
        $userHtml = $this->_view->render('user_list_row.tpl');

        //send
        $data = array(
            'total' => $userTotal,
            'html' => $userHtml
        );
        echo json_encode($data);
    }

    //删除用户
    public function deleteAction()
    {
        if (empty($_POST['id']) || !is_numeric($_POST['id']))
            TZ_Request::error('params error.');

        $id = intval($_POST['id']);
        $deleteStatus = TZ_Loader::service('AdminUser', 'Admin')->delete($id);
        if ($deleteStatus)
            TZ_Request::success();
        else
            TZ_Request::error('用户删除失败');
    }

    //////////////////////////////////权限管理///////////////////////////////////////////

    //权限管理模板
    public function powerAction()
    {
        $id = intval($_GET['id']);
        if($id < 1)
        {
            $this->_callback("无效请求","/admin/user/index.html");
        }

        //权限分配列表
        $menuList = TZ_Loader::service('Menu', 'Admin')->parseMenu($id);

        $this->_view->assign('menuList', $menuList);
        $userInfo = TZ_Loader::model('AdminUser', 'Admin')->getInfoByUserId($id);
        $this->_view->assign('userinfo', $userInfo);
        $this->_view->display('user_power.tpl');
    }
    //保存权限
    public function savepowerAction()
    {
        $user_id    = intval($_POST['user_id']);
        $power      = trim(trim($_POST['power']),',');
        if($user_id && $power)
        {
            $condition['user_id:eq'] = $user_id;
            $isExists = TZ_Loader::model('PowerAssignment','Admin')->select($condition,'*','ROW');
            if($isExists['id'])
            {
                //修改
                $set = array('agent_list'=>$power,'updated_at'=>date('Y-m-d H:i:s'));
                $res = TZ_Loader::model('PowerAssignment','Admin')->update($set,$condition);
            }
            else
            {
                //添加
                $set = array(
                    'agent_list'=>$power,
                    'user_id'=>$user_id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                );
                $res = TZ_Loader::model('PowerAssignment','Admin')->insert($set);
            }
            if($res) die('ok');
            else die('保存失败。');
        }
        die('参数无效。');
    }

    //回调函数
    private function _callback($result = '操作成功', $url = '/admin/auth/index.html')
    {
        echo "<script>alert('" . $result . "');window.location.href = '" . $url . "';</script>";
        exit();
    }
}