<?php

/**
 * 渠道卡管理
 * @author octopus <zhangguipo@747.cn>
 * @final 2015-10-12
 */
class ChannelcardnewController extends Yaf_Controller_Abstract
{
    static private $_extName = array('xls', 'xlsx');
    static private $_standardTemplate = '';
    static private $_stardendTempl = '78351fe54fa718ba1cb739de6e58a979';
    static private $_btn = 1;

    //渠道卡列表
    public function indexAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        $this->_view->display('channel_card_list_new.tpl');
    }

    //回调获取渠道卡列表
    public function getListAction()
    {
        $params = $_GET;

        if (!empty($params['iccid'])) {
            $condition['iccid:eq'] = $params['iccid'];
        }
        if (!empty($params['cid'])) {
            $condition['cid:eq'] = $params['cid'];
        }

        if (!empty($params['is_active'])) {
            $condition['is_active:eq'] = $params['is_active'] - 1;
        }

        if (!empty($params['is_binding'])) {
            $condition['is_binding:eq'] = $params['is_binding'] - 1;
        }
        if (!empty($params['is_recharge'])) {
            $condition['is_recharge:eq'] = $params['is_recharge'] - 1;
        }


        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);


        //load service
        $channel_cardService = TZ_Loader::service('ChannelCard', 'Admin');
        //get data
        $channel_cardTotal = $channel_cardService->getChannelCardTotal($condition);
        $channel_cardList = $channel_cardService->getChannelCardList($condition, $page, $size);

        //处理卡类型关联
        $type = TZ_Loader::model('Cardtype', 'Common')->select(['id:gt' => 0, 'id,name']);

        $ids = array();
        $names = array();

        foreach ($type as $key => $val) {
            $ids[] = $val['id'];
            $names[] = $val['name'];
        }

        foreach ($channel_cardList as $k => $v) {
            $key = array_search($v['card_type'], $ids);
            $channel_cardList[$k]['type_name'] = (false === $key) ? null : $names[$key];
        }


        //获取渠道用户名
        if ($channel_cardList) {
            foreach ($channel_cardList as &$v) {
                $v['user_name'] = TZ_Loader::model('User', 'Channel')->select(['cid:eq' => $v['cid']], 'user_name', 'ROW')['user_name'];
            }
        }

        //render
        $this->_view->assign('list', $channel_cardList);
        $channel_cardHtml = $this->_view->render('channel_card_list_row_new.tpl');

        //send
        $data = array(
            'total' => $channel_cardTotal,
            'html' => $channel_cardHtml
        );
        echo json_encode($data);
    }

    //添加产品页面
    public function addViewAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        $this->_view->display('channel_card_add.tpl');
    }

    //添加产品
    public function addAction()
    {
        $info = array();
        $params = $_POST;
        $info['iccid'] = $params['iccid'];
        $info['telephone'] = $params['telephone'];
        $info['cid'] = $params['cid'];
        $info['created_at'] = date('Y-m-d H:i:s');
        TZ_Loader::model('ChannelCard', 'Admin')->insert($info);
        header('Location:/admin/channelcard/index.html');
    }

    //删除配置
    public function delConfigAction()
    {
        $params = $_POST;
        if (empty($params['id']) || !is_numeric($params['id']))
            throw new Exception('参数错误.');
        $delStatus = TZ_Loader::model('ChannelCard', 'Admin')->delete(array('id:eq' => $params['id']));
        $delStatus ? TZ_Response::success() : TZ_Response::error(101);
    }


    /**
     * 新建动作，从excel中导入数据
     *
     */
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


        //获取cid列表
        $user = TZ_loader::model('User', 'Channel')->select([], 'cid');
        $userArr = [];
        foreach ($user as $k => $v) {
            $userArr[] = $v['cid'];
        }


        TZ_loader::model('ChannelCard', 'Admin')->beginTransaction();

        foreach ($data as $key => $val) {
            $err = [];
            if ($key == 1)
                continue;

            if (empty($val['A']) || empty($val['B']) || empty($val['C'])) {
                $err['msg'] = '第' . $key . '行部分数据不能为空，请填写完整！';
                $errorArr[] = $err;
                continue;
            }

            //插入到数据库
            $rowdata = array();
            $rowdata["iccid"] = $val['A'];
            //$rowdata["telephone"] = $val['B'];
            $rowdata["batch"] = $val['B'];
            $rowdata["cid"] = $val['C'];
            $packCode = $val['D'];
            $rowdata["created_at"] = date('Y-m-d H:i:s');


            if (TZ_loader::model('ChannelCard', 'Admin')->select(['iccid:eq' => $rowdata['iccid']], 'id', 'ROW')) {
                $err['msg'] = '第' . $key . '行iccid已经存在，请更正！';
                $errorArr[] = $err;
                continue;
            }

            //验证手机号是否存在渠道卡表
            /*if (TZ_loader::model('ChannelCard', 'Admin')->select(['telephone:eq' => $rowdata['telephone']], 'id', 'ROW')) {
                $err['msg'] = '第' . $key . '行手机号已经存在，请更正！';
                $errorArr[] = $err;
                continue;
            }*/

            //检查是否存在在原来的卡列表里
            $cardIccid = TZ_loader::model('Cardinfo', 'Common')->select(['iccid:eq' => $rowdata['iccid']], 'id,type_id,expire_time,telephone', 'ROW');
            if (!$cardIccid) {
                $err['msg'] = '第' . $key . '行iccid不在卡列表中，请更正！';
                $errorArr[] = $err;
                continue;
            }

            /*$cardTelephone = TZ_loader::model('Cardinfo', 'Common')->select(['telephone:eq' => $rowdata['telephone']], 'id', 'ROW');
            if (!$cardTelephone) {
                $err['msg'] = '第' . $key . '行手机号不在卡列表中，请更正！';
                $errorArr[] = $err;
                continue;
            }*/


            //检查渠道商cid是否存在
            if (!in_array($rowdata['cid'], $userArr)) {
                $err['msg'] = '第' . $key . '行cid不存在，请更正！';
                $errorArr[] = $err;
                continue;
            }

            //检查卡配置套餐是否存在
            $cardPackage = TZ_Loader::model('Cardpackage', 'Common')->select(['iccid:eq' => $rowdata['iccid']], 'id', 'ROW');
            if (!empty($cardPackage) && !empty($packCode)) {
                $err['msg'] = '第' . $key . '行此卡已经配置套餐编码，请更正！';
                $errorArr[] = $err;
                continue;
            } else {
                //处理卡套餐数据
                if ($packCode) {
                    //查询套餐数据
                    $packageData = TZ_Loader::model('Packages', 'Common')->select(['pack_code:eq' => $packCode], "*", "ROW");
                    $cardPack['type_id'] = $cardIccid['type_id'];
                    $cardPack['iccid'] = $rowdata['iccid'];
                    $cardPack['order_id'] = '';
                    $cardPack['telephone'] = $cardIccid['telephone'];
                    $cardPack['status'] = 0;
                    $cardPack['pack_code'] = $packCode;
                    $cardPack['pack_name'] = $packageData['pack_name'];
                    $cardPack['pack_type'] = $packageData['pack_type'];
                    $cardPack['pack_price'] = $packageData['pack_price'];
                    $cardPack['pack_flow'] = $packageData['pack_flow'];
                    $cardPack['pack_duration'] = $packageData['pack_duration'];
                    $cardPack['give_pack_code'] = $packageData['give_pack_code'];
                    $cardPack['give_pack_duration'] = $packageData['give_pack_duration'];
                    $cardPack['monthly_clearing'] = $packageData['monthly_clearing'];
                    $cardPack['effective_type'] = $packageData['effective_type'];
                    $cardPack['created_at'] = $cardPack['updated_at'] = date('Y-m-d H:i:s');
                    $cpRe = TZ_Loader::model('Cardpackage', 'Common')->insert($cardPack);
                    if (!$cpRe) {
                        $err['msg'] = '第' . $key . '行套餐数据有误，请检查';
                        $errorArr[] = $err;
                        continue;
                    }
                }
            }

            $rowdata["telephone"] = $cardIccid['telephone'];
            $rowdata["card_type"] = $cardIccid['type_id'];
            $rowdata["expire_time"] = $cardIccid['expire_time'];
            if (!TZ_loader::model('ChannelCard', 'Admin')->insert($rowdata)) {
                $err['msg'] = '第' . $key . '行数据有误，请检查';
                $errorArr[] = $err;
                continue;
            }

            //更新相对应的卡状态为出库、出库类型为渠道
            $update = array();
            $update['status'] = 2;
            $update['channel_type'] = 'CHANNEL';
            $ciRe = TZ_loader::model('Cardinfo', 'Common')->update($update, ['id:eq' => $cardIccid['id']]);
            if (!$ciRe) {
                $err['msg'] = '第' . $key . '行卡数据有误，请检查';
                $errorArr[] = $err;
                continue;
            }
        }

        //统计数据

        $total = count($data) - 1;
        unset($data);
        $errtotal = count($errorArr);
        $rightotal = $total - $errtotal;


        if (!empty($errorArr)) {
            TZ_loader::model('ChannelCard', 'Admin')->rollback();
            $countMsg = '共检测到' . $total . '条数据,其中<span style=color:#32CD32>' . $rightotal . '</span>条数据通过，<span style=color:#f00>' . $errtotal . '</span>条数据未通过，请检查';

            $result = usr_json_encode(array('msg' => $errorArr, 'code' => 1001, 'countMsg' => $countMsg));
            $this->_callback($result);
        }

        //完全没有错误,提交
        TZ_loader::model('ChannelCard', 'Admin')->commit();
        $countMsg = '共检测到' . $total . '条数据,全部通过';
        $this->_callback(json_encode(array('code' => 200, 'msg' => '导入成功', 'countMsg' => $countMsg)));

    }


    /**
     * 修改动作，从excel中导入数据
     *
     */
    public function editDataFromExcelAction()
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

        //获取cid列表
        $user = TZ_loader::model('User', 'Channel')->select([], 'cid');
        $userArr = [];
        foreach ($user as $k => $v) {
            $userArr[] = $v['cid'];
        }


        $errorArr = [];

        TZ_loader::model('ChannelCard', 'Admin')->beginTransaction();

        foreach ($data as $key => $val) {
            $err = [];
            if ($key == 1)
                continue;

            if (empty($val['A']) || empty($val['B'])) {
                $err['msg'] = '第' . $key . '行部分数据不能为空，请填写完整！';
                $errorArr[] = $err;
                continue;
            }

            //修改到数据库
            $rowdata = array();
            $iccid = $val['A'];
            $rowdata["cid"] = $val['B'];
            $rowdata["created_at"] = date('Y-m-d H:i:s');


            $ex = TZ_loader::model('ChannelCard', 'Admin')->select(['iccid:eq' => $iccid], 'id,is_active,is_binding', 'ROW');

            if (!$ex) {
                $err['msg'] = '第' . $key . '行iccid不存在，请更正！';
                $errorArr[] = $err;
                continue;
            }
            /*if($ex['is_active']){
                $err['msg']='第'.$key.'行号码已经激活了，请检查！';
                $errorArr[]=$err;
                continue;
            }*/

            if ($ex['is_binding']) {
                $err['msg'] = '第' . $key . '行号码已经被绑定了，请检查！';
                $errorArr[] = $err;
                continue;
            }

            //检查渠道商cid是否存在
            if (!in_array($rowdata['cid'], $userArr)) {
                $err['msg'] = '第' . $key . '行cid不存在，请更正！';
                $errorArr[] = $err;
                continue;
            }

            if (!TZ_loader::model('ChannelCard', 'Admin')->update($rowdata, ['iccid:eq' => $iccid])) {
                $err['msg'] = '第' . $key . '行数据有误，请检查';
                $errorArr[] = $err;
                continue;
            }
        }

        //统计数据

        $total = count($data) - 1;
        unset($data);
        $errtotal = count($errorArr);
        $rightotal = $total - $errtotal;


        if (!empty($errorArr)) {
            TZ_loader::model('ChannelCard', 'Admin')->rollback();
            $countMsg = '共检测到' . $total . '条数据,其中<span style=color:#32CD32>' . $rightotal . '</span>条数据通过，<span style=color:#f00>' . $errtotal . '</span>条数据未通过，请检查';

            $result = usr_json_encode(array('msg' => $errorArr, 'code' => 1001, 'countMsg' => $countMsg));
            $this->_callback($result);
        }

        //完全没有错误,提交
        TZ_loader::model('ChannelCard', 'Admin')->commit();
        $countMsg = '共检测到' . $total . '条数据,全部通过';
        $this->_callback(json_encode(array('code' => 200, 'msg' => '导入成功', 'countMsg' => $countMsg)));

    }

    private function _callback($result)
    {
        $jsCode = '<script type="text/javascript">parent.alertResult(\'' . $result . '\');</script>';
        die($jsCode);
    }

    //查看详情
    public function detailAction()
    {
        $id = intval($_GET['id']);
        if (!$id) {
            die('数据错误，id不存在');
        }
        $result = Tz_loader::model('ChannelCard', 'Admin')->select(array('id:eq' => $id), '*', 'ROW');
        if (!$result) {
            die('该记录不存在');
        }

        $result['type_name'] = TZ_Loader::model('Type', 'Card')->select(['id:eq' => $result['card_type']], 'name', 'ROW')['name'];

        $this->_view->assign('user_info', $result);
        $this->_view->display('channel_card_detail.tpl');

    }


    public function exportDataAction()
    {
        set_time_limit(0);
        ini_set('memory_limit', '200M');

        $params = $_GET;

        $where = ' where 1 ';

        if (!empty($params['iccid'])) {
            $where .= " and iccid='" . $params['iccid'] . "'";
        }
        if (!empty($params['cid'])) {
            $where .= " and cid='" . $params['cid'] . "'";
        }

        if (!empty($params['is_active'])) {
            $is_active = $params['is_active'] - 1;
            $where .= " and is_active=" . $is_active;

        }

        if (!empty($params['is_binding'])) {
            $is_binding = $params['is_binding'] - 1;
            $where .= " and is_binding=" . $is_binding;
        }

        if (!empty($params['is_recharge'])) {
            $is_recharge = $params['is_recharge'] - 1;
            $where .= " and is_recharge=" . $is_recharge;
        }


        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $where .= " and created_at between '" . $params['start_time'] . "' and '" . $params['end_time'] . "'";
        }

        $sql = 'select iccid,card_type,telephone,batch,is_active,is_binding,is_recharge,cid,cid as user_name,expire_time,created_at from channel_cards ';
        $sql .= $where;
        $sql .= ' order by created_at desc,cid asc';
        $result = TZ_loader::model('ChannelCard', 'Admin')->query($sql);
        $query = $result->fetchAll();

        $title = [
            [
                'iccid',
                '流量卡类型',
                '手机号',
                '出库批次号',
                'sim卡激活状态',
                '绑定状态',
                '充值状态',
                '渠道号',
                '渠道商',
                '有效期',
                '创建时间',
            ]
        ];

        if ($query) {
            $card_type = TZ_loader::model('Type', 'Card')->select([], 'id,name', 'ALL');
            $arr = [];
            foreach ($card_type as $v) {
                $arr[$v['id']] = $v['name'];
            }

            $arr_active = array(
                '0' => '未激活',
                '1' => '已激活'
            );

            $arr_binding = array(
                '0' => '未绑定',
                '1' => '已绑定'
            );

            $arr_recharge = array(
                '0' => '未充值',
                '1' => '已充值'
            );

            $user_name = TZ_loader::model('User', 'Channel')->select([], 'cid,user_name', 'ALL');
            $arr_user_name = [];
            foreach ($user_name as $v) {
                $arr_user_name[$v['cid']] = $v['user_name'];
            }

            foreach ($query as $k => &$v) {
                $v['card_type'] = $arr[$v['card_type']];

                $v['is_active'] = $arr_active[$v['is_active']];
                $v['is_binding'] = $arr_binding[$v['is_binding']];
                $v['is_recharge'] = $arr_recharge[$v['is_recharge']];
                $v['user_name'] = $arr_user_name[$v['cid']];
            }

            $query = array_merge($title, $query);
        } else {
            $query = $title;
        }

        $excel = new TZ_Excel();
        $excel->dump($query, '2007');
    }
}