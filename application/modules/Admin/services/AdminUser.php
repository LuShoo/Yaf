<?php

/**
 * 用户服务
 * 
 * @author vincent <vincent@747.cn>
 * @final 2013-05-22
 */
class AdminUserService
{
    /* 用户管理
     * @param array $userInfo
     * @return array 
     */
    public function create($userInfo, $gid)
    {
        $data = array('success' => false);
        $adminModel = TZ_Loader::model('AdminUser', 'Admin');
        $groupModel = TZ_Loader::model('Group', 'Admin');
        $authService = TZ_Loader::service('Auth', 'Admin');
        //修改用户
        if($userInfo['id'])
        {
            //判断是否存在
            $existsUser = $adminModel->getInfoByUserId($userInfo['id']);
            if(empty($existsUser))
            {
                return $data + array('message' => '用户不存在。');
            }
            if($userInfo['password'])
            {
                $userInfo['password'] = $authService->passwordEncode($userInfo['password']);
            }
            $condition = array('id:eq'=>$userInfo['id']);
            $admin_id = $userInfo['id'];
            unset($userInfo['id']);
            $updateStatus = $adminModel->update($userInfo,$condition);
            $res = $groupModel->update(['gid'=>$gid],['admin_id:eq'=>$admin_id]);
            if(!$updateStatus && !$res)
            {
                return $data + array('message' => '修改用户失败。');
            }
        }
        //添加用户
        else
        {
            //判断用户名是否重复
            $existsUser = $adminModel->getInfoByUsername($userInfo['username']);
            if(!empty($existsUser))
            {
                return $data + array('message' => '用户已存在，请更换其他用户名再尝试注册。');
            }
            $userInfo['password'] = $authService->passwordEncode($userInfo['password']);
            $userInfo['created_at'] = $userInfo['updated_at'] = date('Y-m-d H:i:s');
            $insertStatus = $adminModel->insert($userInfo);
            $res = $groupModel->insert(['admin_id'=>$insertStatus, 'gid'=>$gid, 'create_at'=>date('Y-m-d H:i:s')]);
            if(!$res)
            {
                return $data + array('message' => '创建新用户失败。');
            }
        }
        $data['insert_id'] = $insertStatus;
        $data['success'] = true;
        return $data;
    }

    /**
     * 获取用户列表
     * 
     * @param int $page
     * @param int $size
     */
    public function getList($page, $size)
    {
        $start = ($page - 1) * $size;
        $conditions['limit'] = array($start, $size);
        $id = $_SESSION['user_info']['user_id'];
        $user_type = $_SESSION['user_info']['user_type'];
        if($id == '1'){
            return TZ_Loader::model('AdminUser', 'Admin')->select($conditions);
        }else{
            //获取自己组的  用户信息
            $gid = TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$id],'gid','ROW')['gid'];
            $result = TZ_Loader::model('GroupInfo', 'Admin')->select();

            $groupArr = TZ_Loader::service('Recursion', 'Common')->getChild($result, $gid, 0);
            $gids = [];
            $ids = [];
            foreach($groupArr as $val){
                $gids[] = $val['id'];
            }
            $adminIdArr = TZ_Loader::model('Group', 'Admin')->select(['gid:in'=>$gids],['admin_id','gid']);
            foreach ($adminIdArr as $val){
                $ids[] = $val['admin_id'];
            }
            return TZ_Loader::model('AdminUser', 'Admin')->select(['id:in'=>$ids]);

        }
    }

    /**
     * 获取用户总数
     * 
     * @return int
     */
    public function getTotal()
    {
        $fields = 'COUNT(id) total';
        $conditions = array();
        $countInfo = TZ_Loader::model('AdminUser', 'Admin')->select($conditions, $fields, 'ROW');
        return intval($countInfo['total']);
    }

    //删除某个用户
    public function delete($userId)
    {
        return TZ_Loader::model('AdminUser', 'Admin')->delete(array('id:eq' => $userId));
    }

    //获取权限列表
    public function getPowerList($id)
    {
        if($id == '1')
        {
            $conditions['status:neq'] = 0;
            $ids = TZ_Loader::model('Menu','Admin')->select($conditions,'id','ALL');
            $ret = array('power'=>'');
            foreach($ids AS $val)
            {
                $ret['power'] .= $val['id'].',';
            }
            trim($ret['power'],',');
            return $ret;
        }
        else
        {
            $conditions['user_id:eq'] = $id;
            return TZ_Loader::model('PowerAssignment', 'Admin')->select($conditions,'agent_list as power','ROW');
        }
    }

    //所有的权限列表
    public function powerList($id){
        $conditions['user_id:eq'] = $id;
        return TZ_Loader::model('PowerAssignment', 'Admin')->select($conditions,'agent_list as power','ROW');
    }
}