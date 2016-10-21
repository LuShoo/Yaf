<?php

/**
 * 分组管理
 * Class GroupController
 */
class GroupController extends Yaf_Controller_Abstract{
    public function indexAction(){
        //获取分组信息
       
        $this->_view->display('group_list.tpl');
    }

    //添加新分组
    public function addGroupAction(){
        //获取组
        $this->_view->assign('title','添加新组');
       
        $this->_view->display('group_add.tpl');
    }
    //组信息编辑
    public function editGroupAction(){
        $gid = intval($_GET['gid']);
        if($gid < 1)
        {
            die("无效请求");
        }
        $groupList = TZ_Loader::service('Group', 'Admin')->getGroupInfo();
        $groupInfo = TZ_Loader::model('GroupInfo', 'Admin')->select(['id:eq'=>$gid], '*', 'ROW');
        $this->_view->assign('list', $groupList);
        $this->_view->assign('editinfo', $groupInfo);
        $this->_view->assign('title','编辑分组');
        $this->_view->display('group_add.tpl');
    }

    public function createGroupAction(){
        $pid = intval($_POST['pid']);
        $level = intval($_POST['level'])+1;
        if($level > 5){
            $level = 5;
        }
        $group_name = trim($_POST['group_name']);
        $enable_del = intval($_POST['enable_del']);
        $description = trim($_POST['description']);
        $time = date('Y-m-d H:i:s');
        $cols = array(
            'parent_id'           =>  $pid,
            'group_name'    =>  $group_name,
            'enable_del'    =>  $enable_del,
            'description'   =>  $description,
            'updated_at'    =>  $time
        );
        if($_POST['id']){
            //修改
            $id = intval($_POST['id']);
            $condition['id:eq'] = $id;
            $update = TZ_Loader::model('GroupInfo', 'Admin')->update($cols,$condition);
            if(!$update)
            {
                TZ_Request::error('修改失败。');
                exit;
            }
        }else{
            //添加
            $cols['created_at'] = $time;
            $cols['level'] = $level;
            $insert = TZ_Loader::model('GroupInfo', 'Admin')->insert($cols);
            if(!$insert)
            {
                TZ_Request::error('添加失败。');
                exit;
            }
        }
        TZ_Request::success();
    }
}
?>