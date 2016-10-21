<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
 
class ApiController extends Yaf_Controller_Abstract
{
	//消息平台路由
	public function messageAction(){		
		$params = TZ_Request::getParams("post");  // 获取参数
			
	/* 	$checkRest = $this->checkParams($params); // 验证请求签名
		if (!$checkRest) {
			// 失败
			TZ_Response::error("验证签名失败！");
		} */

		$service = $_POST['service']; 			//服务名==路由	
		// var_dump($_POST);exit;
		switch ($service) {
			case 'addevice':
				//添加设备
				TZ_loader::service("Device", "Server")->addevice($params);
				break;
			case 'dedevice':
				//删除设备
				TZ_loader::service("Device", "Server")->dedevice($params);
				break;
			case 'tag':
				//添加标签
				TZ_loader::service("Device", "Server")->tag($params);
				break;
			case 'msg':
				//发送消息
				TZ_loader::service("Device", "Server")->msg($params);
				break;
			case 'stmsg':
				//查询消息发送情况    发送数量   接收数量
				TZ_loader::service("Device", "Server")->stmsg($params);
				break;
			case 'reptmsg':
				//重发消息
				TZ_loader::service("Device", "Server")->reptmsg($params);
				break;
			default :
				TZ_Response::error("请求服务错误！");
		}
			
	}

	//统一验证签名
	private function checkParams($arg) {
		$demo = new TZ_Demo();
		return $demo->test($arg);
	}

	//设备路由
	public function moAction(){
		$params = TZ_Request::getParams("post");  // 获取参数
		
		$service = $_POST['service']; 			//服务名==路由	
		switch ($service) {
			case 'back':
				//消息回告
				TZ_loader::service("Device", "Server")->back($params);
				break;
			case 'msglist':
				//设备开机获取消息
				TZ_loader::service("Device", "Server")->msglist($params);
				break;
			case 'msgdetail':
				//具体消息   标题内容
				TZ_loader::service("Device", "Server")->msgdetail($params);
				break;
			case 'initialize':
				//初始化接口
				TZ_loader::service("Device", "Server")->initialize($params);
				break;
			default :
				TZ_Response::error("请求服务错误！");
		}
			
	}
	
	public function indexAction(){
		
		/* $callerid=1;
		$partnerid="333333";
		
		$msg_code=TZ_Loader::model('Mess','Server')->select(array('partnerid:eq'=>$partnerid,'callerid:eq'=>$callerid,'status:eq'=>1),'msg_code','ROW');
		$code=$msg_code['msg_code'];
		$result=Loader::model('Push','Server')->select(array('received:neq'=>0,'status:eq'=>1),'COUNT(`id`) AS num','ROW');
	var_dump($result); */
		
		//$sql="select * from msg_push where msg_code=$code and status=1 and received=1";  
		//$result=TZ_loader::model('Push','Server')->query($sql);
		 
	/* 	 echo "<pre>";
		 var_dump($result); */
		
		
		
		
		/* $imei=array('1111','2222','3333','4444','5555','6666');
		$msg_code=12345;
		$msg_type=1;
		
		
		
		foreach($imei as $key=>$value){
			$imei[$key]=$value;
			$f['imei']=$imei[$key];
			$f['msg_code']=$msg_code;
			$f['msg_code']=$msg_type;
			TZ_Loader::model('Push','Server')->insert($f);
		} */
		
		
		
		/* $partnerid="22222";
		$dsql="select * from msg_app where partnerid=$partnerid and status=1";
		$dresult=TZ_loader::model('App','Server')->query($dsql);
		$dquery=$dresult->fetchAll();
		$appkeys=$dquery[0]['app_key'];
		$masterSecret=$dquery[0]['master_secret'];
		$partnerid_ID=$dquery[0]['id'];
		$callerid=1110;
		$msg_code=$partnerid_ID.$callerid;
		echo $msg_code; */
		
		
		/* $col = array(
            'status'=>0
        );
		$conds["partnerid:eq"] = "222";   	//代理商号
		$conds["imei:eq"] = "3333";			//设备号数组
		$p=TZ_Loader::model('Api', 'Server')->update($col,$conds);
		if($p){
			TZ_Response::success();
		}else{
			TZ_Response::error("删除设备失败");
		}
		 */
		
		/* //$info['partnerid'] = "";  		//代理商号
		$info['imei'] = "3333"; 			//设备号数组
		//$info['created_at'] = date('Y-m-d H:i:s');
		$p=TZ_Loader::model('Api', 'Server')->insert($info);
		if($p){
			TZ_Response::success();
		}else{
			TZ_Response::error("添加设备失败");
		} */
		
		
		
		
		/*  $info['partnerid'] = "11111";   	//代理商号
		$info['imeis'] = "DCEC06000003"; 			//设备号数组
		$info['tag'] = "1001"; 				//设备号标签
		$info['tag_type'] = "33333"; 			//设备号标签类型
		$type = 1; 					//标签操作模式
		$info['created_at'] = date('Y-m-d H:i:s');
		if($type==1){
			TZ_Loader::service('Tag', 'Server')->agentManage($info); 
			//添加到数据库的同时要  修改极光标签
			//在设备表中查询registration_id
			$imeis="111,222,333"; 
			$explode=explode(",",$imeis);
			$deviceinfo = array();
			foreach($explode as $key => $value){
				$explode[$key]=$value;
				$deviceinfo[$key]=TZ_Loader::model('Api','Server')->select(array('imei:eq'=>$explode[$key],'status:eq'=>1),'registration_id','ROW');
			}
			var_dump($deviceinfo);exit;
			
			$tag="1001"; 
			
			//var_dump($regid);exit;
			#++ 应用表根据partnerid查询出appkey ++#
			$partnerid="11111";
			$dsql="select * from msg_app where partnerid=$partnerid and status=1";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			
			//$appkeys='5c589e7d96536c376076f985';
			//$masterSecret='8ba7db36f4b10c046d99c98d';
			$client = new TZ_Jpush($appkeys,$masterSecret);
			$device = $client->device();
			$c=$device->addDevicesToTag($tag,"11111");
			var_dump($c);exit;
			die(json_encode(array('code'=>"1",'message'=>'标签添加成功')));
		}else if($type==2){
		
			$conds["tag:eq"] = "111"; 				//设备号标签
			
			TZ_Loader::model('Tag', 'Server')->delete($conds);
			
			
			#++ 应用表根据partnerid查询出appkey ++#
			$partnerid="11111";
			$dsql="select * from msg_app where partnerid=$partnerid and status=1";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			
			
			//$appkeys='5c589e7d96536c376076f985';
			//$masterSecret='8ba7db36f4b10c046d99c98d';
			$client = new TZ_Jpush($appkeys,$masterSecret);
			$device = $client->device();
			$c=$device->deleteTag('111');
			var_dump($c);
			
			
			
		}else if($type==3){
			$imeis = $cols['imeis']; 
			$tag = $cols['tag']; 
			TZ_Loader::model('Tag', 'Server')->update($tag,['imeis:eq'=>$imeis]);
			
			$sql="select * from msg_device where imei=$imeis and status=1";
			$result=TZ_loader::model('Api','Server')->query($sql);
			$query=$result->fetchAll();
			$regid=$query[0]['registration_id'];
			
			$tags=$query[0]['tag'];
			
			#++ 应用表根据partnerid查询出appkey ++#
			$partnerid=$cols['partnerid'];
			$dsql="select * from msg_app where partnerid=$partnerid";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			
			
			//$appkeys='5c589e7d96536c376076f985';
			//$masterSecret='8ba7db36f4b10c046d99c98d';
			$client = new TZ_Jpush($appkeys,$masterSecret);
			$device = $client->device();
			$device->removeTags($registration_id, $tags);
			$device->addTags($registration_id, $tag);
			die(json_encode(array('code'=>"1",'message'=>'标签修改成功')));
		}else if($type=4){
			TZ_Response::error("暂不支持合并！");
		}else{
			TZ_Response::error("错误的操作类型！");
		}  */
		
	} 
	
}