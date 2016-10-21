<?php
/**
 * 用户分时统计数据类
 * 
 * @author 子龙 <songyang@747.cn>
 * @final 2015-03-21
 */
class ChannelCardModel extends TZ_Db_Table
{
	public function __construct()
	{
		parent::__construct(Yaf_Registry::get('rebate_db'), 'rebate_db.channel_cards');
	}

}
