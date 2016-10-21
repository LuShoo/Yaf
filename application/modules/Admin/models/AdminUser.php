<?php
/**
 * admin model file
 * @author vincent <vincent@747.cn>
 * @final 2013-05-15
 */
class AdminUserModel extends TZ_Db_Table
{
	//init
	public function __construct()
	{
		parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.admin_user');
	}
	
	/**
	 * get info
	 * 
	 * @param string $username
	 * @return array
	 */
	public function getInfoByUsername($username)
	{
		$fields = array('id', 'username', 'password', 'nickname','user_type');
		$conditions['username:eq'] = $username;
		return $this->select($conditions, $fields, 'ROW');
	}
	
	/**
	 * get info
	 *
	 * @param string $userId
	 * @return array
	 */
	public function getInfoByUserId($userId)
	{
		$fields = array('id', 'username', 'password','branch','nickname','user_type');
		$conditions['id:eq'] = $userId;
		return $this->select($conditions, $fields, 'ROW');
	}
	
	/**
	 * 更新用户信息
	 * 
	 * @param array $conditions
	 * @param array $set
	 */
	public function updateUserInfo($set, $conditions)
	{
		return $this->update($set, $conditions);
	}
}