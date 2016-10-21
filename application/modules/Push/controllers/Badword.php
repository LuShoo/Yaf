<?php
/* 大客户管理
 * @author nick <zhaozhiwei@747.cn>
 */
class BadwordController extends Yaf_Controller_Abstract
{
  //消息列表
	public $cols = array('id','badword');

  public function indexAction()
  {
		$this->_view->display('badword_list.tpl');
  }
  //Ajax 获取列表
  public function getMsgListAction()
  {
    $params    = $_GET;
    $condition = array();
    if (!empty($params['badword'])) {
        $condition['badword:eq'] = $params['badword'];
    }

  	$page = intval($params['page']);
    $size = intval($params['size']);

    $service = TZ_Loader::service('Badword','Push');

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
    $this->_view->assign('list',$logList);
    $Html = $this->_view->render('badword_list_row.tpl');
    //send
    $data = array(
			'total' => $logTotal,
      'html'  => $Html
    );
    echo json_encode($data);
}
//添加消息
public function addMsgAction()
{
    $msginfo= array();
	foreach($this->cols AS $val) $msginfo[$val] = '';
	$this->_view->assign('msginfo',$msginfo);
	$this->_view->assign('title','添加坏词');
	$this->_view->display('badword_add.tpl');
}

//删除坏词
public function deleteMsgAction(){
	
	$cols = array();
    foreach($this->cols AS $val){
        if(isset($_POST[$val])){
            $cols[$val] =  trim($_POST[$val]);
        }
    }

	$cols['status']=0;
   // $cols['updated_at'] = date('Y-m-d H:i:s');
    $res = TZ_Loader::model('Badword','Push')->update($cols,array("id:eq"=>$cols['id']));
    die(json_encode(array('detail'=>'ok')));
}


//编辑消息
public function editMsgAction(){
  $id = intval($_GET['id']);
  if($id<1){
    die('参数无效!');
  }
  $this->_view->assign('title','编辑坏词');
  $msginfo = TZ_Loader::model('Badword','Push')->select(array('id:eq'=>$id),'*','ROW');
  $this->_view->assign('msginfo',$msginfo);
  $this->_view->display('badword_add.tpl');
}

	//添加
	public function createAction(){
		$cols = array();
		foreach($this->cols AS $val){
			if(isset($_POST[$val])){
				$cols[$val] =  trim($_POST[$val]);
			}
		} 
		$word = explode('，',$cols['badword']);
		$sql=TZ_Loader::model('Badword','Push')->select(array('badword:in'=>$word,'status:eq'=>1),'*','ROW');
		
		//var_dump($sql);exit;
		
		if($sql){
			die(json_encode(array('detail'=>"1000")));
		}else{
			if(!empty($cols['id'])){
				$res = TZ_Loader::model('Badword', 'Push')->update($cols,$cols['id']);
				die(json_encode(array('detail'=>"ok")));
			}else{  //添加
				foreach($word as $key=>$value){
					$word[$key]=$value;
					$cols['operatorid'] = '100010';
					$cols['badword'] = $word[$key];
					$cols['created_at'] = date('Y-m-d H:i:s');
					TZ_Loader::model('Badword', 'Push')->insert($cols);
				}
				die(json_encode(array('detail'=>"ok")));
			}
		}
		
	}

}
