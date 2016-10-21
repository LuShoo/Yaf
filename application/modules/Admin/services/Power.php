<?php

/**
 * 权限服务
 * Class PowerService
 */
class PowerService{
    /**
     * 获取权限添加列表
     *
     * @return array
     */
    public function getPowerList()
    {
        $list = TZ_Loader::model('Power', 'Admin')->select( array('status:eq'=>1) );
        return TZ_Loader::service('Recursion','Common')->_formatData2($list, 0, 0);
    }

    public function getUserAgents($id){
        return TZ_Loader::model('PowerAssignment', 'Admin')->select(['user_id:eq'=>$id],'','ROW');
    }
    /*
     * 按类别获取权限列表
     * @param $param 条件数据
     * @param $type （SHOW 菜单权限, EDIT 操作权限, ALL 所有权限控制项）
     */
    public function getMenuList($param, $type='SHOW') {
        $conds = array();
        $datas = array();
        if (!empty($param)) {
            $conds = is_array($param) ? array("id:in" => $param) : array('id:eq' => $param);
        }
        // 获取菜单类权限
        if ($type === 'SHOW') {

            $conds["perm_type:eq"] = 'SHOW';
            $conds["status:eq"] = '1';
            $list = TZ_Loader::model('Power', 'Admin')->select($conds);
            $datas = $this->_formatDatas($list);
            // 获取操作类权限
        } else if ($type === 'EDIT') {
            if (!empty($param)) {
                $conds["perm_type:eq"] = 'EDIT';
                $conds["status:eq"] = '1';
                $list = TZ_Loader::model('Power', 'Admin')->select($conds);
                //print_r($list);die;
                $datas = $this->_formatDatas($list);
            }
        } else if ($type === 'ALL') {
            $conds["status:eq"] = '1';
            $list = TZ_Loader::model('Power', 'Admin')->select($conds);
            $datas = $this->_formatDatas($list);
        }
        return $datas;
    }


    // 整理列表数据
    private function _formatDatas($list, $pid = 0) {
        $temArr = array();
        if (!empty($list)) {
            foreach ($list as $key => &$val) {
                if (intval($val['parent_id']) == $pid) {
                    $tempDatas = $this->_formatDatas($list, intval($val['id']));
                    $act    = ( !empty($val['class']) ? ('/' . $val['module']) : $val['module'])
                        . ( !empty($val['class']) ? ('/' . $val['class']) : '')
                        . ( !empty($val['action']) ? ('/' . $val['action']) : '');
                    $temArr[] = strtolower($act);
                    $temArr = array_merge($temArr, $tempDatas);
                }
            }
        }
        return array_unique($temArr);
    }

    //获取 该模块的按钮
    public function getBtn($request, $position = 'LIST'){
        $controller = strtolower($request->controller);
        $module = strtolower($request->module);
        $agent_list = $_SESSION['user_info']['agent_list'];
        //获取名称及路由
        $arr = TZ_Loader::model('Power', 'Admin')->select(['perm_type:eq'=>'EDIT','module:eq'=>$module,'class:eq'=>$controller],['parent_id'],'ROW');
        $agent_list = explode(',',$agent_list);
        $condition = array(
            'module_id:eq'=>$arr['parent_id'],
            'id:in'=>$agent_list,
        );
        if($position == 'LIST'){
            $condition['btn_position:eq'] = 1;
        } else if($position == 'MENU'){
            $condition['btn_position:eq'] = 0;
        }else if($position == 'ALL'){
            $condition['btn_position:in'] = [0,1];
        }
        $result = TZ_Loader::model('Button', 'Admin')->select($condition,['btn_name','btn_url']);
        return $result;
    }
    //登录用户的权限
    public function agentList($id){
        if(!$id){
            $list = TZ_Loader::model('Power', 'Admin')->select([]);
            $datas = $this->_formatDatas($list);
        }else{
            $agentList = TZ_Loader::model('PowerAssignment', 'Admin')->select(['user_id:eq'=>$id],'agent_list','ROW')['agent_list'];
            $agentList = explode(',', $agentList);
            $list = TZ_Loader::model('Power', 'Admin')->select(['id:in'=>$agentList]);
            $datas = $this->_formatDatas($list);
        }
        return $datas;

    }

}
?>