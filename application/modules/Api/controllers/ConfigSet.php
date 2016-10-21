<?php
/**
 * 设备管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class ConfigSetController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		$imeis='';
		if(!isset($params["imeis"])||empty($params["imeis"])){
			if(!isset($params["group_id"])||empty($params["group_id"])){
				throw new Exception('参数错误。');
			}else{
				$list=TZ_Loader::model("UserEquipment","Equipment")->select(array("agent_id:eq"=>$params["agent_id"],"group_id:eq"=>$params["group_id"]),"group_concat(imei) as imei","ROW");
				$imeis=$list["imei"];
			}
		}else{
			$imeis=$params["imeis"];
		}
		$set=array();
		//Wifi名称和密码是否由用户app修改1由用户管理。下面的ssid和password不传0不由用户管理，ssid和password必须传
		if(isset($params["wifi_modified"])){
			$condition["wifi_modified"]=$params["wifi_modified"];
		}
		//Wifi名称
		if(isset($params["ssid"])&&!empty($params["ssid"])){
			$condition["ssid"]=$params["ssid"];
		}
		//Wifi密码,明文
		if(isset($params["password"])&&!empty($params["password"])){
			$condition["password"]=$params["password"];
		}
		//管理员账号和密码是否由用户app修改1由用户管理。2不由用户管理
		if(isset($params["admin_modified"])&&!empty($params["admin_modified"])){
			$condition["admin_modified"]=$params["admin_modified"];
		}
		//管理员名称，默认为admin
		if(isset($params["admin_name"])&&!empty($params["admin_name"])){
			$condition["admin_name"]=$params["admin_name"];
		}
		//管理员密码，默认为123456 或者其它随机生成的值,明文
		if(isset($params["admin_pwd"])&&!empty($params["admin_pwd"])){
			$condition["admin_pwd"]=$params["admin_pwd"];
		}
		//Portal是否由用户app管理1:由用户管理，则下面跟protal有关的参数几项不下发0：不由用户管理
		if(isset($params["portal_modified"])&&!empty($params["portal_modified"])){
			$condition["portal_modified"]=$params["portal_modified"];
		}
		//是否启动portal服务，1-启动0-不启动当为0时后面三项不下发
		if(isset($params["portal_on"])&&!empty($params["portal_on"])){
			$condition["portal_on"]=$params["portal_on"];
		}
		//需要终端跳转的302地址
		if(isset($params["portal_url"])&&!empty($params["portal_url"])){
			$condition["portal_url"]=$params["portal_url"];
		}else{
			$condition["portal_url"]="https://mobapi.showboom.cn/boxapi/portal/index";
		}
		
		//最终跳转url
		if(isset($params["real_url"])&&!empty($params["real_url"])){
			$condition["real_url"]=$params["real_url"];
		}
		//是否需要验证才能上网  1开启，0关闭当开启时需要提供服务器地址，在没有通过验证时，只有提供的服务里地址可以使用
		if(isset($params["validate_on"])&&!empty($params["validate_on"])){
			$condition["validate_on"]=$params["validate_on"];
		}
		//用于验证的服务器地址, 多个地址用逗号隔开
		if(isset($params["validate_server"])&&!empty($params["validate_server"])){
			$condition["validate_server"]=$params["validate_server"];
		}
		//Banner是否又用户的app管理1.由用户app管理，则下面两项不洗发0．不由用户app管理
		if(isset($params["banner_modified"])&&!empty($params["banner_modified"])){
			$condition["banner_modified"]=$params["banner_modified"];
		}
		//是否开启banner功能0-不开启，1-开启
		if(isset($params["banner_on"])&&!empty($params["banner_on"])){
			$condition["banner_on"]=$params["banner_on"];
		}
		//banner的链接地址，如果是广域网的地址，在开启白名单过滤功能的时候，必须加入到白名单列表中
		if(isset($params["banner_url"])&&!empty($params["banner_url"])){
			$condition["banner_url"]=$params["banner_url"];
		}
		//限速设置是否由用户app管理1.由用户app管理，则下面三项不下发0．不由用户app管理
		if(isset($params["limit_modified"])&&!empty($params["limit_modified"])){
			$condition["limit_modified"]=$params["limit_modified"];
		}
		//-1表示不限速，最高限速，最高限速与流量限速有交叉，取最小值'
		if(isset($params["max_speed"])&&!empty($params["max_speed"])){
			$condition["max_speed"]=$params["max_speed"];
		}
		//是否针对流量限速0：不针对流量限速（flow_section不下发）1：以天为周期2：周(周一到周日)3：月。计算周期为自然天，自然周，自然月
		if(isset($params["flow_limit"])&&!empty($params["flow_limit"])){
			$condition["flow_limit"]=$params["flow_limit"];
		}
		//针对流量分段[{flow:100,speed_limit:500},{flow:1000,speed_limit:200},{flow:2000,speed_limit:100}]
		if(isset($params["flow_section"])&&!empty($params["flow_section"])){
			$condition["flow_section"]=$params["flow_section"];
		}
		//banner图片
		if(isset($params["banner_img"])&&!empty($params["banner_img"])){
			$condition["banner_img"]=$params["banner_img"];
		}
    	if(count($condition)==0){
    		throw new Exception('参数错误。');
    	}
		TZ_Loader::service('Config','Api')->setUserEquipmentConfig($imeis,$params["agent_id"], $condition);
		TZ_Request::success();
    }
  
}