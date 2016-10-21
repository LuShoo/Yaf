<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class AgentController extends Yaf_Controller_Abstract
{
    public $cols = array('id','name','password','agentname','linkname','telephone','address','status');
    //大客户列表
    public function indexAction()
    {
    	$userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin(false);
        $this->_view->display('agent_list.tpl');
    }
    //Ajax 获取列表
    public function getlistAction()
    {
        $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $size = isset($_REQUEST['size']) ? intval($_REQUEST['size']) : 10;
        $start = $size*($page -1);
        $conditions = array('limit'=>array($start,$size));
        $total = TZ_Loader::model('Agent','Admin')->select(array('id:neq'=>0),'COUNT(`id`) AS num','ROW');
        $total = $total['num'];
        $list = TZ_Loader::model('Agent','Admin')->select($conditions,'*','ALL');
        //Render
        $this->_view->assign('user_list',$list);
        $Html = $this->_view->render('agent_list_row.tpl');
        
        $data = array(
            'total' => $total,
            'html'  => $Html
        );
        echo json_encode($data);
    }
    //添加大客户
    public function addAction()
    {
        $userinfo = array();
        foreach($this->cols AS $val) $userinfo[$val] = '';
        $this->_view->assign('userinfo',$userinfo);
        $this->_view->assign('title','添加大客户');
        $this->_view->display('agent_add.tpl');
    }
    //编辑大客户
    public function editAction()
    {
        $id = intval($_GET['id']);
        if($id < 1)
        {
            die("参数无效。");
        }
        $this->_view->assign('title','编辑大客户');
        $userinfo = TZ_Loader::model('Agent','Admin')->select(array('id:eq'=>$id),'*','ROW');
        $this->_view->assign('userinfo',$userinfo);
        $this->_view->display('agent_add.tpl');
    }
    //保存
    public function createAction()
    {
        $cols = array();
        foreach($this->cols AS $val){
            if(isset($_POST[$val])){
                $cols[$val] =  trim($_POST[$val]);
            }
        }
        $cols['updated_at'] = date('Y-m-d H:i:s');
        if(isset($cols['password'])){
            $cols['password'] = TZ_Loader::service('Auth', 'Admin')->passwordEncode($cols['password']);
        }
        //print_r($cols);die;
        //修改
        if(isset($cols['id'])){
            $res = TZ_Loader::service('Agent', 'Admin')->setAgentManage($cols,$cols['id']);
            die(json_encode(array('detail'=>"ok")));
        } else{
            if(!isset($cols['name']) || !isset($cols['agentname'])){
                die("无效数据。");
            }
            //是否重复
            $Exists = TZ_Loader::model('Agent','Admin')->exists($cols['name']);
            if($Exists){
                die($cols['name'].'已经存在。');
            }
            $cols['created_at'] = date('Y-m-d H:i:s');
             TZ_Loader::service('Agent', 'Admin')->agentManage($cols);
            die(json_encode(array('detail'=>"ok")));
        }
    }
}