<?php
/* 
 * 大客户表
 * @author nick <zhaozhiwei@747.cn>
 */
class AgentModel extends TZ_Db_Table
{
    public function __construct()
    {
        parent::__construct(Yaf_Registry::get('xiubao_system_db'), 'xiubao_system_db.agent');
    }
    //是否已存在
    public function exists($name)
    {
        $conditions['name:eq'] = $name;
        $row = $this->select($conditions,'id','ROW');
        if($row) return true;
        else return false;
    }
    //获取客户列表
    public function getAgent($conditions)
    {
        $conditions['order'] = ' `id` DESC ';
        $conditions['status:eq'] = 1;
        $list = $this->select($conditions,'`id`,`agentname`','ALL');
        return $list;
    }
}