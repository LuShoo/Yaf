<?php
/**
 *
 * 卡管理服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-25
 */
class CardService
{
   // 获取卡列表
    public function getOrderList($condition,$page, $size)
    {
        $start = ($page - 1) * $size;
        $condition['limit'] = array($start, $size);
        $condition['order'] = 'created_at desc';
        return TZ_Loader::model('Card', 'Card')->select($condition);
    }

    // 获取卡总数
    public function getOrderTotal($condition)
    {
        $fields = 'COUNT(id) total';
        $countInfo = TZ_Loader::model('Card', 'Card')->select($condition, $fields, 'ROW');
        return intval($countInfo['total']);
    }

    public function insertData($data)
    {
        $insertData       = array();
       // d($data);die;

        foreach ($data as $key => $val)
        {
            if ($key == 1)
                continue;

            $len=strlen($val['G']);//数据库字段状态有可能为0
            if (empty($val['A'])||empty($val['B'])||empty($val['C'])||empty($val['D'])||empty($val['E'])||empty($val['F'])||$len<1||empty($val['H'])) {
                break;
            }
            //插入到数据库
            $rowdata["type_id"]=$val['A'];
            $rowdata["unique_id"]=$val['C'];
            $rowdata["iccid"]=$val['D'];
            $rowdata["batch"]=$val['E'];
            $rowdata["telephone"]=$val['F'];
            $rowdata["status"]=$val['G'];
            $rowdata["set_meal"]=$val['H'];
            $rowdata["remark"]=$val['I'];
            $rowdata["tag"]=md5($val['D']);

            if($val['J']){
                $rowdata["expire_time"]=$this->_excelTime($val['J']);
            }
            $rowdata["created_at"]=date('Y-m-d H:i:s');
            $insertData[]=$rowdata;
        }

        TZ_Loader::model('Card', 'Card')->insert($insertData);
        return json_encode(array(
            'code' => 200,
            'msg'  => "导入成功"));
    }

    private function _excelTime($date,$time=false)
    {

        if(is_numeric($date)){
            $jd = GregorianToJD(1, 1, 1970);
            $gregorian = JDToGregorian($jd+intval($date)-25569);
            $date = explode('/',$gregorian);
            $date_str = str_pad($date[2],4,'0', STR_PAD_LEFT)
                ."-".str_pad($date[0],2,'0', STR_PAD_LEFT)
                ."-".str_pad($date[1],2,'0', STR_PAD_LEFT)
                .($time?" 00:00:00":'');
            return $date_str;
        }
        return $date;
    }

}