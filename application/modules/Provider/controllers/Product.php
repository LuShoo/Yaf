<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/8/1 14:45
 *
 */
class ProductController extends Yaf_Controller_Abstract
{
    /**
     * 渠道卡列表
     */
    public function indexAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        $cardType = TZ_Loader::model('Cardtype', 'Common')->select();
        $this->_view->assign('cardType', $cardType);
        $this->_view->display('product_list.tpl');
    }
    
    /**
     * 回调获取渠道卡列表
     */
    public function getListAction()
    {
        $params = $_GET;
        
        if (!empty($params['card_type'])) {
            $condition['card_type:eq'] = $params['card_type'];
        }
        if (!empty($params['provider'])) {
            $condition['provider:eq'] = $params['provider'];
        }
        
        if (!empty($params['pack_type'])) {
            $condition['pack_type:eq'] = $params['pack_type'];
        }
        
        if (!empty($params['effective_type'])) {
            $condition['effective_type:eq'] = $params['effective_type'] - 1;
        }
        
        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');
        
        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');
        
        $page = intval($params['page']);
        $size = intval($params['size']);
        
        
        //load service
        $productService = TZ_Loader::service('Product', 'Provider');
        //get data
        $productTotal = $productService->getProductTotal($condition);
        $productList = $productService->getProductList($condition, $page, $size);
        
        if ($productList) {
            foreach ($productList as &$value) {
                $value['card_type_name'] = TZ_Loader::model('Cardtype', 'Common')->select(array('id:eq' => $value['card_type']), 'name', 'ROW')['name'];
            }
        }
        
        //render
        $this->_view->assign('list', $productList);
        $productHtml = $this->_view->render('product_list_row.tpl');
        
        //send
        $data = array(
            'total' => $productTotal,
            'html' => $productHtml
        );
        echo json_encode($data);
    }
    
    /**
     * 查看产品详情
     */
    public function detailAction()
    {
        $id = $_GET['id'];
        $result = TZ_Loader::model('Providerpackage', 'Common')->select(array('id:eq' => $id), '*', 'ROW');
        if ($result) {
            $result['card_type_name'] = TZ_Loader::model('Cardtype', 'Common')->select(array('id:eq' => $result['card_type']), 'name', 'ROW')['name'];
        }
        $this->_view->assign('list', $result);
        $this->_view->display('product_detail.tpl');
    }
    
    /**
     * 编辑产品视图
     * @throws Exception
     */
    public function editViewAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        if (empty($_GET['id']) || !is_numeric($_GET['id']))
            throw new Exception('id为空!');
        $result = TZ_Loader::model('Providerpackage', 'Common')->select(array('id:eq' => $_GET['id']), '*', 'ROW');
        if ($result) {
            $result['card_type_name'] = TZ_Loader::model('Cardtype', 'Common')->select(array('id:eq' => $result['card_type']), 'name', 'ROW')['name'];
        }
        $this->_view->assign('list', $result);
        $this->_view->display('product_edit.tpl');
    }
    
    /**
     * 编辑产品逻辑
     * @throws Exception
     */
    public function editAction()
    {
        $params = $_POST;
        if (empty($params['id']) || !is_numeric($params['id']))
            throw new Exception('id为空!');
        $info['provider'] = $params['provider'];
        $info['pack_name'] = $params['pack_name'];
        $info['pack_duration'] = $params['pack_duration'];
        $info['cost_price'] = $params['cost_price'];
        $info['monthly_clearing'] = $params['monthly_clearing'];
        $info['effective_type'] = $params['effective_type'];
        $info['created_at'] = date('Y-m-d H:i:s');
        TZ_Loader::model('Providerpackage', 'Common')->update($info, array('id:eq' => $params['id']));
        header('Location:/provider/product/index.html');
    }
    
    
    /**
     * 添加产品视图
     */
    public function addViewAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        $cardType = TZ_Loader::model('Cardtype', 'Common')->select();
        $this->_view->assign('cardType', $cardType);
        $this->_view->display('product_add.tpl');
    }
    
    /**
     * 添加产品逻辑
     * @throws Exception
     */
    public function addAction()
    {
        $info = array();
        $params = $_POST;
        
        $info['card_type'] = $params['card_type'];
        $info['provider'] = $params['provider'];
        $info['code'] = $params['code'];
        $info['pack_name'] = trim($params['pack_name']);
        $info['pack_type'] = $params['pack_type'];
        $info['pack_flow'] = $params['pack_flow'];
        $info['pack_duration'] = $params['pack_duration'];
        $info['cost_price'] = $params['cost_price'];
        $info['monthly_clearing'] = $params['monthly_clearing'];
        $info['effective_type'] = $params['effective_type'];
        $info['created_at'] = date('Y-m-d H:i:s');
        TZ_Loader::model('Providerpackage', 'Common')->insert($info);
        header('Location:/provider/product/index.html');
    }
    
    /**
     * 导出运营商产品
     */
    public function dataToExcelAction()
    {
        $params = $_GET;
        
        if (!empty($params['card_type'])) {
            $conditions['card_type:eq'] = $params['card_type'];
        }
        
        if (!empty($params['provider'])) {
            $conditions['provider:like'] = $params['provider'];
        }
        
        if (!empty($params['pack_type'])) {
            $conditions['pack_type:like'] = $params['pack_type'];
        }
        
        if (!empty($params['effective_type'])) {
            $conditions['effective_type:like'] = $params['effective_type'] - 1;
        }
        
        // 查询数据
        $detailDatas = TZ_Loader::model("Providerpackage", "Common")->select($conditions);
        $datas = array();
        if (!empty($detailDatas)) {
            foreach ($detailDatas as $key => $val) {
                $datas[$key]['card_type'] = TZ_Loader::model('Cardtype', 'Common')->select(array('id:eq' => $val['card_type']), 'name', 'ROW')['name'];
                if ($val['provider'] == 'CM') {
                    $datas[$key]['provider'] = '中国移动';
                } elseif ($val['provider'] == 'CN') {
                    $datas[$key]['provider'] = '中国联通';
                } elseif ($val['provider'] == 'CT') {
                    $datas[$key]['provider'] = '中国电信';
                }
                $datas[$key]['code'] = $val['code'];
                $datas[$key]['pack_name'] = $val['pack_name'];
                if ($val['pack_type'] == 1) {
                    $datas[$key]['pack_type'] = '月套餐';
                    $unit = '月';
                } elseif ($val['pack_type'] == 2) {
                    $datas[$key]['pack_type'] = '季度包';
                    $unit = '天';
                } elseif ($val['pack_type'] == 3) {
                    $datas[$key]['pack_type'] = '半年包';
                    $unit = '天';
                } elseif ($val['pack_type'] == 4) {
                    $datas[$key]['pack_type'] = '年包';
                    $unit = '天';
                } elseif ($val['pack_type'] == 5) {
                    $datas[$key]['pack_type'] = '加油包';
                    $unit = '月';
                } elseif ($val['pack_type'] == 0) {
                    $datas[$key]['pack_type'] = '无';
                }
                $datas[$key]['pack_flow'] = $val['pack_flow'];
                $datas[$key]['pack_duration'] = $val['pack_duration'] . $unit;
                $datas[$key]['cost_price'] = $val['cost_price'];
                if ($val[$key]['monthly_clearing'] == 0) {
                    $datas[$key]['monthly_clearing'] = '否';
                } elseif ($val[$key]['monthly_clearing'] == 1) {
                    $datas[$key]['monthly_clearing'] = '是';
                }
                if ($val['effective_type'] == 0) {
                    $datas[$key]['effective_type'] = '未指定';
                } elseif ($val['effective_type'] == 1) {
                    $datas[$key]['effective_type'] = '当月生效';
                } elseif ($val['effective_type'] == 2) {
                    $datas[$key]['effective_type'] = '下月生效';
                }
                $datas[$key]['created_at'] = $val['created_at'];
            }
        }
        
        $title = iconv('UTF-8', 'GBK', '运营商产品' . date('Y-m-d H:i:s'));
        (new TZ_Excel())->setTitle(array(
            "卡类型",
            "供应商",
            "卡运营商充值编码",
            "充值套餐名称",
            "套餐类型",
            "流量值",
            "套餐有效时限",
            "套餐成本价（运营商结算价）",
            "是否到月清零",
            "生效方式",
            "创建时间",
        ))
            ->setFileName($title)
            ->dump($datas, 2003);
    }
    
}