<?php

/**
 * log controller
 * @author sangba <wangjianbo@747.cn>
 * @final 2013-5-23
 */
class ConfigController extends Yaf_Controller_Abstract
{


    /**
     * 渲染导入上网卡日志view
     *
     */
    public function indexAction()
    {
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('configs');
        $this->_view->display('config_list.tpl');
    }

    //获取列表
    public function getListAction()
    {
        $params    = $_GET;
        //print_r($params);die();
        $condition = array();
        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);

        //load service

        if (!empty($params['start_time']) && !empty($params['end_time']))
        {
            $condition['created_at:between'] = array(
                $params['start_time'],
                $params['end_time'] . ' 23:59:59');
        }
        //get data
        $limit         = ($page - 1) * $size;
        $configService = TZ_Loader::service('Configs', 'User');
        $configTotal   = $configService->getTotal($condition);
        $configList    = $configService->getList($condition, $limit, $size);
        $i             = ($page - 1) * $size + 1;
        foreach ($configList as &$val)
        {
            $val['sort_id'] = $i++;
        }
        $this->_view->assign('set_info', $configList);
        $listHtml = $this->_view->render('config_list_row.tpl');

        //send
        $data = array(
            'total' => $configTotal,
            'html'  => $listHtml
        );
        echo json_encode($data);
    }

    //删除用户
    public function deleteAction()
    {
        if (empty($_POST['id']))
            TZ_Request::error('params error.');

        $id           = $_POST['id'];
        TZ_Loader::service('Configs', 'User')->delete($id);
        $data['code'] = 0;
        echo json_encode($data);
    }

    //开通新用户,需要超级管理员权限
    public function openAction()
    {
        //TZ_Loader::service('Auth', 'Admin')->isAdmin(true);
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('configs');
        $this->_view->display('add_config.tpl');
    }

    //注册用户,需要超级管理员权限
    public function createAction()
    {
        //TZ_Loader::service('Auth', 'Admin')->isAdmin(true);
        $userInfo        = array();
        $params          = $_POST;
        //print_r($params);die;
        if (empty($params['username']))
            TZ_Request::error('健值不能为空。');
        $userInfo['key'] = $params['username'];

        if (empty($params['nickname']))
            TZ_Request::error('描述不能为空。');
        $userInfo['desc'] = $params['nickname'];

        if (empty($params['password']))
            TZ_Request::error('值不能为空。');
        $userInfo['value'] = $params['password'];

        //print_r($userInfo);
        TZ_Loader::service('Configs', 'User')->create($userInfo);
        $data['code'] = 0;
        echo json_encode($data);
    }

    //开通新用户,需要超级管理员权限
    public function editAction()
    {

        if (empty($_GET['id']))
            throw new Exception();
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('configs');
        $configInfo = TZ_Loader::service('Configs', 'User')->getConfigInfo($_GET['id']);
        //print_r($configInfo);die;
        $this->_view->assign('configinfo', $configInfo);
        $this->_view->display('edit_config.tpl');
    }

    //注册用户,需要超级管理员权限
    public function setAction()
    {
        //TZ_Loader::service('Auth', 'Admin')->isAdmin(true);
        $userInfo      = array();
        $params        = $_POST;
        //print_r($params);die;
        if (empty($params['username']))
            TZ_Request::error('健值不能为空。');
        $set['key:eq'] = $params['username'];

        if (empty($params['nickname']))
            TZ_Request::error('描述不能为空。');
        $userInfo['desc'] = $params['nickname'];

        if (empty($params['password']))
            TZ_Request::error('值不能为空。');
        $userInfo['value'] = $params['password'];

        //print_r($userInfo);die;
        TZ_Loader::service('Configs', 'User')->set($set, $userInfo);
        $data['code'] = 0;
        echo json_encode($data);
    }

    //签到配置
    public function signconfigAction()
    {
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('signconfig');
        $this->_view->display('sign_config_index.tpl');
    }

    //获取签到配置数据
    public function getSignConfiglistAction()
    {
        $params    = $_GET;
        //print_r($params);die();
        $condition = array();
        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page          = intval($params['page']);
        $size          = intval($params['size']);
        //get data
        $limit         = ($page - 1) * $size;
        $configService = TZ_Loader::service('Configs', 'User');
        $configTotal   = $configService->getSignConfigTotal($condition);
        $configList    = $configService->getSignConfigList($condition, $limit, $size);
        $i             = ($page - 1) * $size + 1;
        foreach ($configList as &$val)
        {
            $val['sort_id'] = $i++;
        }
        $this->_view->assign('set_info', $configList);
        $listHtml = $this->_view->render('sign_config_index_row.tpl');

        //send
        $data = array(
            'total' => $configTotal,
            'html'  => $listHtml
        );
        echo json_encode($data);
    }

    //添加签到配置
    public function addSignConfigAction()
    {
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('signconfig');
        $this->_view->display('add_sign_config.tpl');
    }

    //添加签到配置数据
    public function signCreateAction()
    {
        $arConfigInfo        = array();
        $params              = $_POST;
        //print_r($params);die;
        if (empty($params['day']))
            TZ_Request::error('签到天数不能为空。');
        $arConfigInfo['day'] = $params['day'];

        if (empty($params['score']))
            TZ_Request::error('获得银豆数量。');
        $arConfigInfo['score']      = $params['score'];
        $arConfigInfo['created_at'] = $arConfigInfo['updated_at'] = date("Y-m-d H:i:s");
        TZ_Loader::service('Configs', 'User')->createSingConfig($arConfigInfo);
        
        $data['code']               = 0;
        echo json_encode($data);
    }

    //编辑签到配置
    public function signConfigEditAction()
    {
        if (empty($_GET['id']))
            throw new Exception("参数错误");
        TZ_Loader::service('Page', 'Admin')->setView($this->_view)->render('signconfig');
        $arSignConfigInfo = TZ_Loader::service('Configs', 'User')->getSignConfigInfo($_GET['id']);
        //print_r($configInfo);die;
        $this->_view->assign('signConfigInfo', $arSignConfigInfo);
        $this->_view->display('edit_sign_config.tpl');
    }

    //编辑签到数据
    public function setSignAction()
    {
        $arConfigInfo        = array();
        $params              = $_POST;
        if (empty($params['day']))
            TZ_Request::error('签到天数不能为空。');
        $arConfigInfo['day'] = $params['day'];

        if (empty($params['score']))
            TZ_Request::error('获得银豆数量。');
        $arConfigInfo['score']      = $params['score'];
        $arConfigInfo['updated_at'] = date("Y-m-d H:i:s");
        $set['id:eq']               = $params['id'];
        TZ_Loader::service('Configs', 'User')->setSign($set, $arConfigInfo);
        $data['code']               = 0;
        echo json_encode($data);
    }

    //删除签到
    public function delSignConfigAction(){
        if (empty($_POST['id']))
            throw new Exception("参数错误");
        TZ_Loader::service('Configs', 'User')->delSign($_POST['id']);
         $data['code']               = 0;
        echo json_encode($data);
    }
}