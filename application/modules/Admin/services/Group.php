<?php

class GroupService{

    //获取分组的信息
    public function getGroupInfo(){
        $id = $_SESSION['user_info']['user_id'];
        $user_type = $_SESSION['user_info']['user_type'];
        if($id == '1') {
            return TZ_Loader::model('GroupInfo', 'Admin')->select([]);
        }else{
            //获取自己组的  用户信息
            $gid = TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$id],'gid','ROW')['gid'];
            $ids = [];
            if($user_type == '0'){
                $ids[0] = $gid;
            }
            $result = TZ_Loader::model('GroupInfo', 'Admin')->select();
            $groupArr = TZ_Loader::service('Recursion', 'Common')->getChild($result, $gid, 0);
            foreach($groupArr as $val){
                $ids[] =$val['id'];
            }
            return TZ_Loader::model('GroupInfo', 'Admin')->select(['id:in'=>$ids]);
        }
    }

/*    //获取分组列表
    public function getGroupList(){
        $id = $_SESSION['user_info']['user_id'];
        if($id == '1'){
            return TZ_Loader::model('GroupInfo', 'Admin')->select();
        }else{
            $gid = TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$id],'gid','ROW')['gid'];
            return TZ_Loader::model('GroupInfo', 'Admin')->select(['id:eq'=>$gid],'*','ROW');
        }
    }*/


    public function getAdminGroup(){
        $id = $_SESSION['user_info']['user_id'];
        if($id == '1'){
            return 0;
        }
        $gid = TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$id],'gid','ROW')['gid'];
        return TZ_Loader::model('GroupInfo', 'Admin')->select($gid,'*', 'ROW');
    }

    public function getUserGroup($uid){
        return TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$uid],'gid','ROW')['gid'];
    }

    //获取登录用户组级别
    public function userLevel($id){
        if(!$id){
            $id = $_SESSION['user_info']['user_id'];
        }
        if($id == '1'){
            return 0;
        }
        $gid = TZ_Loader::model('Group', 'Admin')->select(['admin_id:eq'=>$id],'gid','ROW')['gid'];
        return TZ_Loader::model('GroupInfo', 'Admin')->select(['id:eq'=>$gid],'`level`','ROW')['level'];
    }

}
?>