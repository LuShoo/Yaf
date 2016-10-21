<?php
/**
 * portal log
 * @author octopus <zhangguipo@747.cn>
 *  @final 2016-01-20
 */
class PortalLogController extends Yaf_Controller_Abstract
{

	//用户设备
	public function indexAction()
	{
		$params = TZ_Request::getParams('post');
		if(!isset($params["agent_id"])||empty($params["agent_id"])){
			throw new Exception('请输入客户ID。');
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
		if (!empty($params['start_time']) && !empty($params['end_time'])) {
         		$condition['created_at:between'] = array($params['start_time'], $params['end_time']);
         	}
		$condition["agent_id:eq"]=$params["agent_id"];
		$limit = ($page-1)*$size;
		$total=TZ_Loader::service('PortalLog','Api')->getUserEquipmenetTotal($condition);
		if($total==0){
			throw new Exception('当前用户还没数据。');
		}
		$result=TZ_Loader::service('PortalLog','Api')->getUserEquipmenetList($condition, $limit, $size);
		TZ_Request::successData($total,$result);
    }
  
}