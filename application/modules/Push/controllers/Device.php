<?php

/**
 * Class DeviceController
 */
class DeviceController extends Yaf_Controller_Abstract{
   static private $_extName = array('xls','xlsx');
//public $cols = array('id','partnerid','imei','msg_data','msg_type','msg_title','msg_image','msg_content','msg_url','msg_app','msg_page','is_top','expire_time','is_immediate','release','audit_status','audit_time');
    public function indexAction(){
        
        $this->_view->display('device_list.tpl');
    }

    //获取设备列表
    public function getDeviceListAction(){
        $params    = $_GET;
        $condition = array();
       if (!empty($params['imei'])) {
            $condition['imei:eq'] = $params['imei'];
        }
        /*
       if (!empty($params['partnerid'])) {
       $condition['partnerid:eq'] = $params['partnerid'];
       }
       if (!empty($params['status'])) {
           $condition['status:eq'] = $params['status'];
       }
       if (empty($params['page']) || empty($params['size']))
           TZ_Request::error('params error.');

       if (($params['page'] < 1) || ($params['size'] < 1))
           TZ_Request::error('params error.');
*/
        $page = intval($params['page']);
        $size = intval($params['size']);
        //load service
        $service = TZ_Loader::service('Device', 'Push');
		
		
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
	
	/* public function importDataFromExcelAction()
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
						// if($key == 1) continue;
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
    }*/


    public function importDataFromExcelAction()
    {
        set_time_limit(0);
        ini_set('memory_limit', '200M');

        /*if (empty($_FILES["file-name"]))
        self::_die(array('msg'=>'表单name未定义.','code'=>0));*/


        $file = $_FILES["file-name"];
        $fileName = $file["name"];    //获取文件名

        if ($file['error'] > 0) {
            $result = json_encode(array('msg' => '文件上传失败.', 'code' => 0));
            $this->_callback($result);
        }
        $extName = substr($fileName, strrpos($fileName, '.') + 1);    //扩展名
        if (!in_array($extName, self::$_extName)) {
            $result = json_encode(array('msg' => '不支持此扩展的Excel文件.', 'code' => 0));
            $this->_callback($result);
        }
        $filePath = $file['tmp_name'];

        $excel = new TZ_Excel();
        $excel->loadExcel($filePath);


        $data = $excel->findAll();

        if (count($data) <= 1) {
            $result = json_encode(array('code' => 0, 'msg' => '无有效数据.'));
            $this->_callback($result);
        }

        unset($excel); //删除大数据变量

        $errorArr = [];


        TZ_loader::model('Device', 'Push')->beginTransaction();

        foreach ($data as $key => $val) {
            $err = [];
            if ($key == 1)
                continue;

            if (empty($val['A']) || empty($val['B']) || empty($val['C']) || empty($val['D'])) {
                $err['msg'] = '第' . $key . '行部分数据不能为空，请填写完整！';
                $errorArr[] = $err;
                continue;
            }


            //插入到数据库
            $rowdata = array();
            $rowdata["partnerid"] = $val['A'];
            $rowdata["imei"] = $val['B'];
            $rowdata["registration_id"] = $val['C'];
            $rowdata["status"] = $val['D'];
            $rowdata["mark"] = $val['E'];
            $rowdata["created_at"] = date('Y-m-d H:i:s');
            $rowdata["update_at"] = date('Y-m-d H:i:s');

          if (TZ_loader::model('Device', 'Push')->select(['imei:eq' => $rowdata['imei']], 'id', 'ROW')) {
                $err['msg'] = '第' . $key . '行imei已经存在，请更正！';
                $errorArr[] = $err;
                continue;
            }

           if (!TZ_loader::model('Device', 'Push')->insert($rowdata)) {
                $err['msg'] = '第' . $key . '行数据有误，请检查';
                $errorArr[] = $err;
                continue;
            }

        }

        //统计数据

        $total=count($data)-1;
        unset($data);
        $errtotal=count($errorArr);
        $rightotal=$total-$errtotal;


        if(!empty($errorArr)){
            TZ_loader::model('Device', 'Push')->rollback();
            $countMsg='共检测到'.$total.'条数据,其中<span style=color:#32CD32>'.$rightotal.'</span>条数据通过，<span style=color:#f00>'.$errtotal.'</span>条数据未通过，请检查';

            $result = usr_json_encode(array('msg'=>$errorArr,'code'=>1001,'countMsg'=>$countMsg));
            $this->_callback($result);
        }

        //完全没有错误,提交
        TZ_loader::model('Device', 'Push')->commit();

        $countMsg='共检测到'.$total.'条数据,全部通过';
        $this->_callback(json_encode(array('code'=>200, 'msg'=>'导入成功','countMsg'=>$countMsg)));

    }

    private function _callback($result)
    {
        $jsCode ='<script type="text/javascript">parent.alertResult(\''.$result.'\');</script>';
        die($jsCode);
    }


	
}
?>