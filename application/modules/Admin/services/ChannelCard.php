<?php
/**
 * 渠道卡服务
 * 
 * @author octopus <zhangguipo@747.cn>
 * @final 2016-01-27
 */
class ChannelCardService
{
   // 获取渠道卡列表
    public function getChannelCardList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc,cid asc';
        return TZ_Loader::model('ChannelCard', 'Admin')->select($condition);
    }

    // 获取渠道卡总数
    public function getChannelCardTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('ChannelCard', 'Admin')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }   

	public function insertData($data)
	{
		$insertData       = array();

		foreach ($data as $key => $val)
		{
			if ($key == 1)
			continue;
			if (empty($val['A'])||empty($val['B'])||empty($val['C'])||empty($val['D'])) {
				break;
			}
			//插入到数据库
			$rowdata["iccid"]=$val['A'];
			$rowdata["telephone"]=$val['B'];
			$rowdata["batch"]=$val['C'];
			$rowdata["cid"]=$val['D'];
			$rowdata["created_at"]=date('Y-m-d H:i:s');
			$insertData[]=$rowdata;

		}
		TZ_Loader::model('ChannelCard', 'Admin')->insert($insertData);
		return json_encode(array(
            'code' => 2000,
            'msg'  => "导入成功"));
    }
}