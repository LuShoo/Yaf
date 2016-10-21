<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class MessageController extends Yaf_Controller_Abstract
{
   //public $cols = array('id','name','password','agentname','linkname','telephone','address','status');
    //大客户列表
	 public $cols = array('name');
	
    public function indexAction()
    {
		$userinfo = array();
		$this->_view->display('message_list.tpl');
    	/* $userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin(false);
        $this->_view->display('agent_list.tpl'); */
    }
	
	public function addAction()
    {		
        //$userinfo = array();
        $this->_view->display('message_add.tpl');
    }
	
	//增加设备
	public function createAction()
    {
		/* 测试AJAX是否收到  post 传过来的值 
		
		if($_POST['name']==''){
			die(json_encode(array('detail'=>"no")));
			
		}else{
			
			die(json_encode(array('detail'=>$_POST['name'])));
		}   */
		
		//接口接收 设备值 与设备标签值 一起接收
		
		/* $info['parnterid'] = $_POST['parnterid'];   	代理商号
		$info['sign'] = $_POST['sign']; 				签名字串
		$info['service'] = $_POST['service']; 			服务名
		$info['imei'] = $_POST['imeis']; 				设备号数组
		$info['tag'] = $_POST['tag']; 					设备号标签
		$info['tag_type'] = $_POST['tag_type']; 		设备号标签类型
		$info['created_at'] =date('Y-m-d H:i:s'); */
		
		//假设设备的值存入设备表
		$info['parnterid'] = "1111111";
		$info['imei'] = "4444444444"; 
		$info['created_at'] =date('Y-m-d H:i:s');
		TZ_Loader::service('Message', 'Message')->agentManage($info); 
		
		//假设标签的值存入标签表 
		
			
	
			
		
		
		
    }
 
}