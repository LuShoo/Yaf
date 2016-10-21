<?php

/**
 * Class DeviceController
 */
class DeviceController extends Yaf_Controller_Abstract{
   //static private $_extName = array('xls','xlsx');
//public $cols = array('id','partnerid','imei','msg_data','msg_type','msg_title','msg_image','msg_content','msg_url','msg_app','msg_page','is_top','expire_time','is_immediate','release','audit_status','audit_time');
    public function indexAction(){
        
        $this->_view->display('device_list.tpl');
    }

    //获取设备列表
    public function getDeviceListAction(){
        $params    = $_GET;
        $condition = array();
        $page = intval($params['page']);
        $size = intval($params['size']);
        $service = TZ_Loader::service('Device', 'Device');
        if (!empty($params['start_time']) && !empty($params['end_time']))
        {
            $condition['created_at:between'] = array(
                $params['start_time'],
                $params['end_time']);
        }
        //get data
        $limit    = ($page - 1) * $size;
        $logTotal = $service->getTotal($condition);
        $logList  = $service->getList($condition, $limit, $size);
        
		//var_dump($logList);
		
		//render
        $this->_view->assign('list', $logList);
        $listHtml = $this->_view->render('device_list_row.tpl');

        //send
        $data = array(
            'total' => $logTotal,
            'html'  => $listHtml
        );
        echo json_encode($data);
    }
	
	 public function importDataFromExcelAction()
    {
		$fileName = $_FILES['upload']['name'];//上传的文件名
		$ext = pathinfo($fileName)['extension'];//获得后缀名		
		$allowExt = array('xls','xlsx');	
		 if(!in_array($ext,$allowExt)){
			exit('后缀名不符');
		}
		 $suffName = md5(date('YmdHis')).rand(1000,9999).rand(1000,9999).'.'.$ext;
		 
		$filePath = './static/';
		$uploadfile=$filePath.$suffName;
		$result=move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile);
		  
			if($result){
				$excel = new TZ_Excel();

				$objPHPExcel=$excel->loadExcel($uploadfile);
				
				$data = $excel->findAll();
				var_dump($data);
				// $time = date('Y-m-d H:i:s');
					 foreach ($data as $key=>$val){
						 if($key == 1) continue;
						$conditions['partnerid'] = $val['A'];
						$conditions['imei'] = $val['B'];
						$conditions['registration_id'] = $val['C'];
						 $conditions['status'] = $val['D'];
						$conditions['mark'] = $val['E'];
						$conditions['created_at'] = date('Y-m-d H:i:s');
						TZ_Loader::model('Api', 'Server')->insert($conditions);
						
					}
				//die(json_encode(array('code'=>"1",'message'=>'设备成功')));
			}	   
    }
	
	
}
?>