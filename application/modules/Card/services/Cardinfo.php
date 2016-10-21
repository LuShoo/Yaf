<?php
/**
 *
 * 卡管理服务
 *
 * @author ziyang <hexiangcheng@showboom.cn>
 * @final 2016-04-25
 */
class CardinfoService
{
	// 获取卡列表
	public function getOrderList($condition,$page, $size)
	{
		$start = ($page - 1) * $size;
		$condition['limit'] = array($start, $size);
		$condition['order'] = 'created_at desc';
		return TZ_Loader::model('Cardinfo', 'Common')->select($condition);
	}

	// 获取卡总数
	public function getOrderTotal($condition)
	{
		$fields = 'COUNT(id) total';
		$countInfo = TZ_Loader::model('Cardinfo', 'Common')->select($condition, $fields, 'ROW');
		return intval($countInfo['total']);
	}

	public function insertData($data)
	{
		$insertData=$packageData=$errIccid = array();
		// d($data);die;
		foreach ($data as $key => $val)
		{
			if ($key == 1)
			continue;

			$len=strlen($val['G']);//数据库字段状态有可能为0
			if (empty($val['A'])||empty($val['B'])||empty($val['C'])||empty($val['D'])||empty($val['E'])||empty($val['F'])||$len<1||empty($val['H'])) {
				break;
			}
			$rowdata=array();
			//插入到数据库
			$rowdata["type_id"]=$val['A'];
			$rowdata["iccid"]=$val['C'];
			$rowdata["batch"]=$val['D'];
			$rowdata["telephone"]=$val['E'];
			$rowdata["status"]=$val['F'];
			$rowdata["init_package"]=$val['G'];
			$rowdata["remark"]=$val['H'];
			$rowdata["verify_code"]=$this->getRandChar(4);

			if($val['I']){
				$rowdata["expire_time"]=$this->_excelTime($val['I']);
			}
			$rowdata["created_at"]=$rowdata["updated_at"]=date('Y-m-d H:i:s');
			$insertData[]=$rowdata;
			//判断是否有初始套餐	
			if(isset($val['J'])&&!empty($val['J'])){
				$rowdata["package"]=$val['J'];
				$packageData[]=$rowdata;
			}
			$isExist=TZ_loader::model('Cardinfo','Common')->select(array('iccid:eq'=>$rowdata['iccid'],'telephone:eq'=>$rowdata['telephone']),'id','ROW');
			if($isExist){
				$errIccid[]=$rowdata['iccid'];
			}
		}
		if(count($errIccid)>0){
			return array(
            'code' => 201,
            'msg'  => "iccid已经存在".implode(',',$errIccid));
		}
		//插入卡信息
		TZ_Loader::model('Cardinfo', 'Common')->insert($insertData);
		//插入卡套餐
		if(count($packageData)>0){
			$insertPackageData=$this->initCardpackage($packageData);
			TZ_Loader::model('Cardpackage', 'Common')->insert($insertPackageData);
		}

		return array(
            'code' => 200,
            'msg'  => "导入成功");
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
	//生成随机数
	function getRandChar($length=4){
		$str = null;
		$strPol = "ABCDEFGHJKMNPQRSTUVWXYZ123456789abcdefghjkmnpqrstuvwxyz";
		$max = strlen($strPol)-1;
		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
		}
		return $str;
	}
	//插入卡套餐
	public function initCardpackage($packageData){
		$insertData=array();
		//查询所有可用的套餐
		$packageList=TZ_Loader::model('Packages','Common')->select(array('pack_status:in'=>array(1,2)),'*','ALL');
		foreach ($packageData as $row){
			try {
				//查询套餐信息
				$packageInfo='';
				foreach ($packageList as $packageRow){
					if($packageRow['pack_code']==$row['package']){
						$packageInfo=$packageRow;
						break;
					}
				}
				if(empty($packageInfo)){
					continue;
				}
				$cardPackage=array();
				$cardPackage['type_id']=$row['type_id'];
				$cardPackage['iccid']=$row['iccid'];
				$cardPackage['order_id']='';
				$cardPackage['telephone']=$row['telephone'];
				$cardPackage['status']=0;
				$cardPackage['pack_code']=$packageInfo['pack_code'];
				$cardPackage['pack_name']=$packageInfo['pack_name'];
				$cardPackage['pack_type']=$packageInfo['pack_type'];
				$cardPackage['pack_price']=$packageInfo['pack_price'];
				$cardPackage['pack_flow']=$packageInfo['pack_flow'];
				$cardPackage['pack_duration']=$packageInfo['pack_duration'];
				$cardPackage['give_pack_code']=$packageInfo['give_pack_code'];
				$cardPackage['monthly_clearing']=$packageInfo['monthly_clearing'];
				$cardPackage['give_pack_duration']=$packageInfo['give_pack_duration'];
				$cardPackage['effective_type']=$packageInfo['effective_type'];
//				if($packageInfo['pack_type']==1){
//					//如果已前生效的套餐，并且套餐类型为 月套餐的
//					$Time=$this->getEffectiveTime($packageInfo);
//					$cardPackage['effective_time']=$Time['start'];
//					$cardPackage['expire_time']=$Time['end'];
//				}
				$cardPackage['created_at']=$cardPackage['updated_at']=date('Y-m-d H:i:s');
				$insertData[]=$cardPackage;
			} catch (Exception $e) {
			}
		}
		return $insertData;
	}
	//得到生效时间
	public function getEffectiveTime($packageInfo){
		//判断是否已经有套餐,如果有，续接套餐;如果没有，判断是否大于20号，1 当月生效，2 下月生效
		$month=$packageInfo['pack_duration']+$packageInfo['give_pack_duration'];
		$day=date('d');
		if($day>20){
			$start=date('Y-m',strtotime("+1 month")).'-01 00:00:00';
			$month+=1;
			$end=date('Y-m-d',strtotime("+$month month -1 day")).' 23:59:59';
		}else{
			$start=date('Y-m-d');
			$end=date('Y-m-d',strtotime("+$month month -1 day")).' 23:59:59';
			}
	
		return array($start,$end);
	}
}