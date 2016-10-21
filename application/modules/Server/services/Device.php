<?php
/* 数据库事务
 * @author nick <zhaozhiwei@747.cn>
 * @final 2015-03-10
 */
class DeviceService
{
	//添加设备
    public function addevice($cols){
		$imeis = $cols['imeis']; 			
		if(is_array($a)){
			foreach($imeis as $key=>$value){
				$imeis[$key]=$value;
				$info['imeis'] = $imeis[$key];
				$info['partnerid'] = $cols['partnerid']; 
				$info['created_at'] = date('Y-m-d H:i:s');
				$p=TZ_Loader::model('Api', 'Server')->insert($info);
			}
			if($p){
				TZ_Response::success();
			}else{
				TZ_Response::error("添加设备失败");
			}
		}else{
			TZ_Response::error("IMEI非数组形式");
		}
		
		
    }
	//删除设备
	public function dedevice($cols){
		$imeis = $cols['imeis']; 
		if(is_array($imeis)){
			foreach($imeis as $key=>$value){
				$imeis[$key]=$value;
				$conds['imeis:eq'] = $imeis[$key];
				$conds['partnerid:eq'] = $cols['partnerid']; 
				$col = array(
					'status'           =>  0
				);
				$p=TZ_Loader::model('Api', 'Server')->update($col,$conds);
			}
			if($p){
				TZ_Response::success();
			}else{
				TZ_Response::error("删除设备失败");
			}
		}else{
			TZ_Response::error("IMEI非数组形式");
		}
		
    }
	//标签管理
	public function tag($cols){
        $info['partnerid'] = $cols['partnerid'];   	
		$info['imeis'] = $cols['imeis']; 				
		$info['tag'] = $cols['tag']; 					
		$info['tag_type'] = $cols['tag_type']; 					
		$type = $cols['type']; 							
		$info['created_at'] = date('Y-m-d H:i:s');
		
		
		
		
		if($type==1){
			$p=TZ_Loader::model('Tag', 'Server')->insert($info); 
			if($p){
				//添加到数据库的同时要  修改极光标签
				//在设备表中查询registration_id
				$imeis=$cols['imeis']; 
				$tag=$cols['tag']; 
				$explode=explode(",",$imeis);
				$deviceinfo = array();
				foreach($explode as $key => $value){
					$explode[$key]=$value;
					$deviceinfo[$key]=TZ_Loader::model('Api','Server')->select(array('imei:eq'=>$explode[$key],'status:eq'=>1),'registration_id','ROW');
				}
				#++ 应用表根据partnerid查询出appkey ++#
				$partnerid=$cols['partnerid'];
				$dsql="select * from msg_app where partnerid=$partnerid and status=1";
				$dresult=TZ_loader::model('App','Server')->query($dsql);
				$dquery=$dresult->fetchAll();
				$appkeys=$dquery[0]['app_key'];
				$masterSecret=$dquery[0]['master_secret'];
				$client = new TZ_Jpush($appkeys,$masterSecret);
				$device = $client->device();
				$device->addDevicesToTag($tag,$deviceinfo);
				TZ_Response::success();
			}else{
				TZ_Response::error("添加标签失败");
			}
			
		}else if($type==2){
			$conds["tag:eq"] = $cols['tag']; 				//设备号标签
			$p=TZ_Loader::model('Tag', 'Server')->delete($conds);
				if($p){
					#++ 应用表根据partnerid查询出appkey ++#
					$partnerid=$cols['partnerid'];
					$dsql="select * from msg_app where partnerid=$partnerid and status=1";
					$dresult=TZ_loader::model('App','Server')->query($dsql);
					$dquery=$dresult->fetchAll();
					$appkeys=$dquery[0]['app_key'];
					$masterSecret=$dquery[0]['master_secret'];
			
					$client = new TZ_Jpush($appkeys,$masterSecret);
					$device = $client->device();
					$tag=$cols['tag'];
					$device->deleteTag($tag);
					TZ_Response::success();
				}else{
					TZ_Response::error("删除标签失败");
				}
			
		}else if($type==3){
			
			TZ_Response::error("暂不支持修改！");
		}else if($type=4){
			TZ_Response::error("暂不支持合并！");
		}else{
			TZ_Response::error("错误的操作类型！");
		}
    }
	/* //发送消息
	public function msg($fo){
		//判断坏词
		$callerid=$fo['callerid'];
		$msg_title = $fo['msg_title'];
		$msg_data = $fo['msg_data'];
		$badwords= TZ_Loader::model('Badword','Badword')->select(array('status:eq'=>1),'badword','ALL');	
		foreach($badwords as $k=>$val){
			$badwords[$k]=$val['badword'];	
		} 
		$arr=$badwords;
		foreach($arr as $v){
			if(strpos($msg_title, $v) !== false){
				TZ_Response::error("标题存在坏词请修改后重发");
			}
			if(strpos($msg_data, $v) !== false){
				TZ_Response::error("内容存在坏词请修改后重发");
			}
		}
		
		//判断有效期
		if(strtotime($fo['expire_time']) < strtotime(date('Y-m-d H:i:s'))){
			TZ_Response::error("该消息超过有效期");
		} 
		//初始化接口
			$partnerid=$fo['partnerid'];
			$dsql="select * from msg_app where partnerid=$partnerid and status=1";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			$partnerid_ID=$dquery[0]['id'];
			$client = new TZ_Jpush($appkeys,$masterSecret);
		
		//存入消息
			$info['partnerid'] = $fo['partnerid'];
			$info['imei'] = $fo['imeis'];  				//设备号
			$info['callerid'] = $fo['callerid']; 		//调用方id
			$info['send_type'] = $fo['send_type'];		//正式  预览
			$info['msg_title'] = $fo['msg_title'];		//
			$info['msg_type'] = $fo['msg_type'];		//消息类别
			$info['msg_data'] = $fo['msg_data']; 
			$info['send_scope'] = $fo['send_scope']; 	//发送范围
			$info['tags'] = $fo['tags'];				//标签
			$info['expire_time'] = $fo['expire_time'];	//有效期 
			$info['is_immediate'] = $fo['is_immediate'];//是否立即发送
			$info['release'] = $fo['release'];			//定时发送
			$info['created_at'] =date('Y-m-d H:i:s');
			//生成唯一消息ID
			$info['msg_code'] = $partnerid_ID.$callerid;	
			//把消息存入本地数据库
			TZ_Loader::model('Mess', 'Server')->insert($info);
			//存入消息到发送明细表
			$imei = $fo['imeis']; 
			if(is_array($imei)){
				$imeis=$imei;
			}else{
				$imeis=explode(",",$imei);
			}
		//	var_dump($imeis);exit;
			
			foreach($imeis as $key=>$value){
				$imeis[$key]=$value;
				$if['imei'] = $imeis[$key];
				$if['msg_code'] = $partnerid_ID.$callerid;
				$if['msg_type'] = $fo['msg_type']; 
				$if['created_at'] = date('Y-m-d H:i:s');
				$p=TZ_Loader::model('Push', 'Server')->insert($if);
			}
			//存入消息到详情表
			$ifo['msg_code'] = $partnerid_ID.$callerid;
			$ifo['partnerid'] = $fo['partnerid'];
			$ifo['msg_title'] = $fo['msg_title'];
			$ifo['msg_data'] = $fo['msg_data'];
			$ifo['created_at'] = date('Y-m-d H:i:s');
			TZ_Loader::model('Tips', 'Server')->insert($ifo);   
		//判断是否为及时发送
		$is_immediate = $fo['is_immediate'];
		if($is_immediate==1){
			//判断发送范围
			$send_scope=$fo['send_scope'];
			if($send_scope==0){
				$result = $client->push()
				->setPlatform('all')          
				->addAlias("1111")			
				->addTag("22222")
				 ->setNotificationAlert('Hi, JPush')
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
				$response = $result->send();
			}else if($send_scope==1){
				$result = $client->push()
				->setPlatform('all')            
				->addTag($fo['tags'])				
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
				$response = $result->send();
			}else{
				$result = $client->push()
				->setPlatform('all')            
				->setAudience($fo['imeis']) 					
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
				$response = $result->send();
			}
			$msg_id = $response->data->msg_id;
			if($msg_id !==""){
				TZ_Response::success();
			}
			
		}else{
			if(strtotime($fo['release']) < strtotime(date('Y-m-d H:i:s'))){
				TZ_Response::error("该消息已过时");
			} 
			$ttime=$fo['release'];
			//判断发送范围
			$send_scope=$fo['send_scope'];
			if($send_scope==0){
				$result = $client->push()
				->setPlatform('all')     
				->addAlias("1111")			
				->addTag("22222")	
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
				->build();
				$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
			}else if($send_scope==1){
				$result = $client->push()
				->setPlatform('all')            
				->addTag($fo['tags'])				
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
				->build();
				$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
			}else{
				$result = $client->push()
				->setPlatform('all')            
				->setAudience($fo['imeis']) 					
				->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
				->build();
				$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
			}	
			$schedule_id =  $respons->data->schedule_id;
			if($schedule_id !==""){
				TZ_Response::success();
			}
		}
    } */
	
	
	
	//发送消息
	public function msg($fo){
		//判断坏词
		 $callerid=$fo['callerid'];
		$msg_title = $fo['msg_title'];
		$msg_data = $fo['msg_data'];
		$badwords= TZ_Loader::model('Badword','Badword')->select(array('status:eq'=>1),'badword','ALL');	
		foreach($badwords as $k=>$val){
			$badwords[$k]=$val['badword'];	
		} 
		$arr=$badwords;
		foreach($arr as $v){
			if(strpos($msg_title, $v) !== false){
				TZ_Response::error(9002,"标题存在坏词请修改后重发");
			}
			if(strpos($msg_data, $v) !== false){
				TZ_Response::error(9002,"内容存在坏词请修改后重发");
			}
		} 
		
		//判断有效期
		if(strtotime($fo['expire_time']) < strtotime(date('Y-m-d H:i:s'))){
			TZ_Response::error("1001","该消息超过有效期");
		} 
		//初始化接口
			$partnerid=$fo['partnerid'];
			$dsql="select * from msg_app where partnerid='$partnerid' and status=1";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			$partnerid_ID=$dquery[0]['id'];
			$client = new TZ_Jpush($appkeys,$masterSecret);
		
		
			//存入消息
			$info['partnerid'] = $fo['partnerid'];
			$info['imei'] = $fo['imeis'];  				//设备号
			$info['callerid'] = $fo['callerid']; 		//调用方id
			$info['send_type'] = $fo['send_type'];		//正式  预览
			$info['msg_title'] = $fo['msg_title'];		//
			$info['msg_type'] = $fo['msg_type'];		//消息类别
			$info['msg_data'] = $fo['msg_data']; 
			$info['send_scope'] = $fo['send_scope']; 	//发送范围
			$info['tags'] = $fo['tags'];				//标签
			$info['expire_time'] = $fo['expire_time'];	//有效期 
			$info['is_immediate'] = $fo['is_immediate'];//是否立即发送
			$info['release'] = $fo['release'];			//定时发送
			$info['created_at'] =date('Y-m-d H:i:s');
			//生成唯一消息ID
			$info['msg_code'] = $partnerid_ID.$callerid;	
		
		//判断是否为预览消息、正式消息
		$send_type=$fo['send_type'];
		if($send_type==0){
			//把消息存入本地数据库
			TZ_Loader::model('Mess', 'Server')->insert($info);
			//存入消息到发送明细表
			$imei = $fo['imeis']; 
			if(is_array($imei)){
				$imeis=$imei;
			}else{
				$imeis=explode(",",$imei);
			}
		//	var_dump($imeis);exit;
			
			foreach($imeis as $key=>$value){
				$imeis[$key]=$value;
				$if['imei'] = $imeis[$key];
				$if['msg_code'] = $partnerid_ID.$callerid;
				$if['msg_type'] = $fo['msg_type']; 
				$if['created_at'] = date('Y-m-d H:i:s');
				$p=TZ_Loader::model('Push', 'Server')->insert($if);
			}
			//存入消息到详情表
			$ifo['msg_code'] = $partnerid_ID.$callerid;
			$ifo['partnerid'] = $fo['partnerid'];
			$ifo['msg_title'] = $fo['msg_title'];
			$ifo['msg_data'] = $fo['msg_data'];
			$ifo['created_at'] = date('Y-m-d H:i:s');
			TZ_Loader::model('Tips', 'Server')->insert($ifo);  
			
			//判断是否为及时发送
				$is_immediate = $fo['is_immediate'];
				if($is_immediate==1){
					//判断发送范围
					$send_scope=$fo['send_scope'];
					if($send_scope==0){
						$result = $client->push()
						->setPlatform('all')          
						->addAlias("1111")			
						->addTag("22222")
						 ->setNotificationAlert('Hi, JPush')
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
						$response = $result->send();
					}else if($send_scope==1){
						$result = $client->push()
						->setPlatform('all')            
						->addTag($fo['tags'])				
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
						$response = $result->send();
					}else{
						$result = $client->push()
						->setPlatform('all')            
						->setAudience($fo['imeis']) 					
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
						$response = $result->send();
					}
					$msg_id = $response->data->msg_id;
					if($msg_id !==""){
						TZ_Response::success();
					}
				}else{
					if(strtotime($fo['release']) < strtotime(date('Y-m-d H:i:s'))){
						TZ_Response::error(1001,"该消息已过时");
					} 
					$ttime=$fo['release'];
					//判断发送范围
					$send_scope=$fo['send_scope'];
					if($send_scope==0){
						$result = $client->push()
						->setPlatform('all')     
						->addAlias("1111")			
						->addTag("22222")	
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
						->build();
						$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
					}else if($send_scope==1){
						$result = $client->push()
						->setPlatform('all')            
						->addTag($fo['tags'])				
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
						->build();
						$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
					}else{
						$result = $client->push()
						->setPlatform('all')            
						->setAudience($fo['imeis']) 					
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type'])
						->build();
						$respons = $client->schedule()->createSingleSchedule("定时任务", $result, array("time"=>$ttime));
					}	
					$schedule_id =  $respons->data->schedule_id;
					if($schedule_id !==""){
						TZ_Response::success();
					}else{
						TZ_Response::error(500080,"消息发送失败");
					}
				}
			
		}else if($send_type==1){
			//把消息存入本地数据库
			TZ_Loader::model('Mess', 'Server')->insert($info);
			//存入消息到发送明细表
			$imei = $fo['imeis']; 
			if(is_array($imei)){
				$imeis=$imei;
			}else{
				$imeis=explode(",",$imei);
			}
		//	var_dump($imeis);exit;
			
			foreach($imeis as $key=>$value){
				$imeis[$key]=$value;
				$if['imei'] = $imeis[$key];
				$if['msg_code'] = $partnerid_ID.$callerid;
				$if['msg_type'] = $fo['msg_type']; 
				$if['created_at'] = date('Y-m-d H:i:s');
				$p=TZ_Loader::model('Push', 'Server')->insert($if);
			}
			//存入消息到详情表
			$ifo['msg_code'] = $partnerid_ID.$callerid;
			$ifo['partnerid'] = $fo['partnerid'];
			$ifo['msg_title'] = $fo['msg_title'];
			$ifo['msg_data'] = $fo['msg_data'];
			$ifo['created_at'] = date('Y-m-d H:i:s');
			TZ_Loader::model('Tips', 'Server')->insert($ifo);  
			
			$result = $client->push()
						->setPlatform('all')          
						->addAlias("1111")			
						->addTag("22222")
						 ->setNotificationAlert('Hi, JPush')
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
						$response = $result->send();
						
			$msg_id = $response->data->msg_id;			
			if($msg_id !==""){
				TZ_Response::success();
			}else{
				TZ_Response::error(500081,'预览失败');
			}			
		}else if($send_type==2){
			$result = $client->push()
						->setPlatform('all')          
						->addAlias("1111")			
						->addTag("22222")
						 ->setNotificationAlert('Hi, JPush')
						->setMessage($fo['msg_data'],$fo['msg_title'],$fo['msg_type']);
						$response = $result->send();
						
			$msg_id = $response->data->msg_id;			
			if($msg_id !==""){
				TZ_Response::success();
			}else{
				TZ_Response::error(500082,'重发失败');
			}			
		}else{
			TZ_Response::error(500083,'没有该消息类型');
		}
				
			
    }
	
	
	//消息情况  发送数量   接收数量
	public function stmsg($fo){
        $callerid=$fo['callerid'];
		$partnerid=$fo['partnerid'];
		//消息表查出msg_code
		$msg_code=TZ_Loader::model('Mess','Server')->select(array('partnerid:eq'=>$partnerid,'callerid:eq'=>$callerid,'status:eq'=>1),'msg_code,created_at','ROW');
		//应发数量
		$code=$msg_code['msg_code'];
		$result=TZ_Loader::model('Push','Server')->select(array('msg_code'=>$code,'received:neq'=>0,'status:eq'=>1),'COUNT(`id`) AS num','ROW');
		$y_num=$result['num'];
		//接收数量
		$j_result=TZ_Loader::model('Push','Server')->select(array('msg_code'=>$code,'received:neq'=>1,'status:eq'=>1),'COUNT(`id`) AS num','ROW');
		$j_num=$j_result['num'];
		//发送时间
		$time=$msg_code['created_code'];
		
		TZ_Response::success(array('sends'=>$y_num,'receiveds'=>$j_num,'send_time'=>$time));
    }
	//重发消息
	public function reptmsg($cols){
		//1、根据调用方id callerid  查询出  发送消息的  内容标题类型  和  消息编号msg_code
		//2、根据  msg_code 取详情表查询出没有收到消息的设备号 给这些设备重新发送消息
        $call=$cols['callerid'];
		$sql="select * from msg_message where callerid='$call' and status=1";
		$result=TZ_loader::model('Mess','Server')->query($sql);
		$fo=$result->fetchAll();
		$imei=$fo[0]['imei'];
		$msg_data=$fo[0]['msg_data'];
		$msg_title=$fo[0]['msg_title'];
		$msg_type=$fo[0]['msg_type'];
		$msg_code=$fo[0]['msg_code'];
		$created_at=$fo[0]['created_at'];
		$sql1="select imei from msg_push where msg_code='$msg_code' and status=1 and received=0";
		$result1=TZ_loader::model('Push','Server')->query($sql1);
		$fo1=$result1->fetchAll();
		//设备号数组
		foreach($fo1 as $key => $rows){
			$fo1[$key]['imei']=$rows['imei'];
		}
		//推送到极光
		$partnerid=$cols['partnerid'];
		$dsql="select * from msg_app where partnerid='$partnerid' and status=1";
		$dresult=TZ_loader::model('App','Server')->query($dsql);
		$dquery=$dresult->fetchAll();
		$appkeys=$dquery[0]['app_key'];
		$masterSecret=$dquery[0]['master_secret'];
			
		$client = new TZ_Jpush($appkeys,$masterSecret);
		$result = $client->push()
		->setPlatform('all')            //推送平台设置
		->setAudience($fo1) 			//推送设备指定				
		->setMessage($msg_data,$msg_title,$msg_type);
		$response = $result->send();
		$xmsg_code=$response->data->msg_id;	
		if($xmsg_code !==""){
			//有多少设备号就是应发数量
			$count=count($result1);
			TZ_Response::success(array('sends'=>$count,'send_time'=>$created_at));
		}else{
			TZ_Response::error("消息重发失败");
		}
		
    }
	//消息回告
	public function back($cols){
        $imei = $cols['imeis']; 				
		$msg_code = $cols['msg_code']; 
		$cols['received']=1;
		foreach($msg_code as $key=>$row){
			$msg_code[$key]=$row;
			$result=TZ_Loader::model('Push','Server')->update($cols,array("imei:eq"=>$imei,"msg_code:eq"=>$msg_code[$key]));
		}
		if($result){
			TZ_Response::success();
		}
    }
	//设备开机获取消息   消息列表
	public function msglist($cols){
        $imei = $cols['imeis']; 				
		$sql="select msg_code,msg_type,created_at from msg_push where imei='$imei' and status=1";
		$result=TZ_loader::model('Push','Server')->query($sql);
		$query=$result->fetchAll();	
		foreach($query as $key => $rows){
			$query[$key]['created_at']=strtotime($rows['created_at']);
		} 
		$res['msg_codes'] = $query; 
		if($result){
			TZ_Response::success($res);
		}
    }
	//设备开机获取消息    消息内容  
	public function msgdetail($cols){
        $imei = $cols['imeis']; 				//盒子id
		$msg_code = $cols['msg_code']; 		//消息编号  数组  
		
		//在消息明细表查询是否有这条消息
		$sql="select * from msg_push where imei='$imei' and msg_code='$msg_code' and status=1";
		$result=TZ_loader::model('Push','Server')->query($sql);
		if($result){
			$sqls="select * from msg_tips where msg_code='$msg_code' and status=1";
			$results=TZ_loader::model('Tips','Server')->query($sqls);
			$query=$results->fetchAll();
			TZ_Response::success($query);
		}else{
			TZ_Response::error("获取消息失败");
		} 
		
    }
	//初始化接口
	public function initialize($cols){
        $info['imei'] = $cols['imeis']; 						//盒子id
		$info['registration_id'] = $cols['registration_id']; 	//极光注册id
		$info['partnerid'] = $cols['partnerid'];
		$info['created_at'] =date('Y-m-d H:i:s');	
		$result=TZ_Loader::model('Api', 'Server')->insert($info);
		if($result){
			//根据imei  partnerid在标签表中查出 tag 标签添加到极光
			TZ_Loader::model('Tag','Server')->select(array('imeis:eq'=>$cols['imeis'],'partnerid:eq'=>$cols['partnerid'],'status:eq'=>1),'tag','ALL');
			$partnerid=$cols['partnerid'];
			$dsql="select * from msg_app where partnerid='$partnerid' and status=1";
			$dresult=TZ_loader::model('App','Server')->query($dsql);
			$dquery=$dresult->fetchAll();
			$appkeys=$dquery[0]['app_key'];
			$masterSecret=$dquery[0]['master_secret'];
			$partnerid_ID=$dquery[0]['id'];
			$client = new TZ_Jpush($appkeys,$masterSecret);
			$device = $client->device();
			$device->addTags($cols['registration_id'], ['tag1', 'tag2']);
			TZ_Response::success();
		}else{
			TZ_Response::error("初始化失败");
		}
    }
	
}