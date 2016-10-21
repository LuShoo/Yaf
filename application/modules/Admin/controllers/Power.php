<?php

/**
 * 权限管理
 *
 * Class PowerController
 */

class PowerController extends Yaf_Controller_Abstract{

    //权限控制列表
    public function indexAction()
    {
        $powerList = TZ_Loader::model('Power', 'Admin')->select( array('status:eq'=>1) );
        foreach ($powerList as $key=>&$val){
            $act    = ( !empty($val['class']) ? ('/' . $val['module']) : $val['module'])
                . ( !empty($val['class']) ? ('/' . $val['class']) : '')
                . ( !empty($val['action']) ? ('/' . $val['action']) : '');
            $val['action'] = $act;
        }
        $this->_view->assign('list', $powerList);
        $this->_view->display('power_list.tpl');
    }

    //添加权限
    public function addPowerAction()
    {
        $list = TZ_Loader::service('Power', 'Admin')->getPowerList();
        $this->_view->assign('list', $list);
        $this->_view->display('power_add.tpl');
    }

    //  修改权限
    public function editPowerAction()
    {
        $id = intval($_GET['id']);
        if($id<1)
        {
            die('无效请求');
        }
        $list = TZ_Loader::service('Power', 'Admin')->getPowerList();
        $info = TZ_Loader::model('Power','Admin')->select(array('id:eq'=>$id),'*','ROW');
        $this->_view->assign('list', $list);
        $this->_view->assign('info', $info);
        $this->_view->assign('title', '权限编辑');
        $this->_view->display('power_add.tpl');
    }

    public function createPowerAction()
    {
        $parent_id = intval($_POST['pid']);
        $perm_name = trim($_POST['perm_name']);
        $module = trim($_POST['module']);
        $class = !empty($_POST['class']) ? trim($_POST['class']) : '';
        $action = !empty($_POST['action']) ? trim($_POST['action']) : '';
        $perm_type = $_POST['perm_type'];
        $status = intval($_POST['status']);
        $btn = intval($_POST['btn']);
        $btn_position = isset($_POST['btn_position']) ? intval($_POST['btn_position']) : 0;
        if($perm_name == '' || $module == '')
        {
            TZ_Request::error('参数错误。');
            exit;
        }
        $cols = array(
            'parent_id'     =>      $parent_id,
            'perm_name'     =>      $perm_name,
            'module'        =>      $module,
            'class'         =>      $class,
            'action'        =>      $action,
            'perm_type'     =>      $perm_type,
            'status'        =>      $status,
        );
        if($_POST['id'])
        {
            //修改
            $id = intval($_POST['id']);
            $condition['id:eq'] = $id;
            $cols['created_at'] = date('Y-m-d H:i:s');
            $update = TZ_Loader::model('Power','Admin')->update($cols,$condition);
            $arr = array(
                'id'        =>  $id,
                'btn_name'  =>  $perm_name,
                'btn_url'   =>  '/' . $module . '/' . $class . '/' . $action,
                'module_id' =>  $parent_id,
                'btn_position'  =>  $btn_position,
            );
            $result = TZ_Loader::model('Button', 'Admin')->select(['id:eq'=>$id],'*','ROW');
            if($btn == 1){
                if(!empty($result)){
                    TZ_Loader::model('Button', 'Admin')->insert($arr);
                }else{
                    unset($arr['id']);
                    TZ_Loader::model('Button', 'Admin')->update($arr,['id:eq'=>$id]);
                }
            }else{
                //判断是否存在按钮
                if(!empty($result)){
                    TZ_Loader::model('Button', 'Admin')->delete(['id:eq'=>$id]);
                }
            }
            if(!$update)
            {
                TZ_Request::error('修改失败。');
                exit;
            }
        }
        else
        {
            //添加
            $cols['created_at'] = date('Y-m-d H:i:s');
            $insert = TZ_Loader::model('Power','Admin')->insert($cols);
            if($btn == 1){
                $arr = array(
                    'id'        =>  $insert,
                    'btn_name'  =>  $perm_name,
                    'btn_url'   =>  '/' . $module . '/' . $class . '/' . $action,
                    'module_id' =>  $parent_id,
                    'btn_position'  =>  $btn_position,
                );
                TZ_Loader::model('Button', 'Admin')->insert($arr);

            }
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