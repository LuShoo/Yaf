<?php
/**
 * apn管理
 * @author octopus <zhangguipo@747.cn>
 *  @final 2015-12-09
 */
class ApnController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
		}
		$condition["agent_id:eq"]=$params["agent_id"];
		if(isset($params["name"])&&!empty($params["name"])){
			$condition["name:like"]=$params["name"];
		}
		if(isset($params["apn"])&&!empty($params["apn"])){
			$condition["apn:like"]=$params["apn"];
		}
    	//得到页数和每页条数
		$page =intval(empty($params['page'])?1:$params['page']);
		$size = intval(empty($params['size'])?20:$params['size']);
		if($page<=0){
			throw new Exception('页号错误');
		}
		//判断是否是正整数
		if($size<=0){
			throw new Exception('每页数量错误');
		}
		$limit = ($page-1)*$size;
		$total=TZ_Loader::service('Apn','Api')->getApnTotal($condition);
		if($total==0){
			throw new Exception('当前用户还没有apn。');
		}
		$result=TZ_Loader::service('Apn','Api')->getApnList($condition, $limit, $size);
		TZ_Request::successData($total,$result);
    }
  
}