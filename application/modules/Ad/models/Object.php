<?php
/**
 * ad_objects model
  * @author octopus <zhangguipo@747.cn>
 * @final 2016-01-04
 */
class ObjectModel extends TZ_Db_Table
{	
	public function __construct()
	{
		parent::__construct( Yaf_Registry::get('showboom_user_db'), 'showboom_user_db.ad_objects' );
	}
	//查询tag信息
	public function getTagListByObject($aid){
		$sql="select tag_code,tag_name from showboom_user_db.ad_tags t,showboom_user_db.ad_object_tag m where ad_id=$aid and t.id=m.tag_id and m.status=1;";
		return  $this->_db->query($sql)->fetchAll();
	}
}
