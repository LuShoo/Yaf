<?php

/**
 * author: mengqi<zhangxuan@showboom.cn>
 * Time: 2016/6/23 14:44
 * 牛卡用户相关
 */
class CustomerController extends Yaf_Controller_Abstract
{
    public function indexAction()
    {
        TZ_Loader::service('Auth', 'Admin')->isAdmin($this->_view);
        $this->_view->display('customer_list.tpl');
    }

    public function getListAction()
    {
        $params = $_GET;
        $where = '1 = 1 ';
        if (!empty($params['uid'])) {
            $uid = $params['uid'];
            $conditions['uid:eq'] = $params['uid'];
            $where .= "and a.uid = '$uid'";
        }

        /*if (!empty($params['status'])) {
            $conditions['status:eq'] = $params['status'];
        }*/

        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);


        if (!empty($params['nick_name']) || !empty($params['telephone'])) {
            if (!empty($params['nick_name'])) {
                $nick_name = $params['nick_name'];
                $conditions['nick_name:like'] = $params['nick_name'];
                $where .= "and b.nick_name like " . "'%$nick_name%'";
            }

            if (!empty($params['telephone'])) {
                $telephone = $params['telephone'];
                $conditions['mobile:like'] = $params['telephone'];
                $where .= "and b.mobile = '$telephone'";
            }

            $start = ($page - 1) * $size;
            $query = "SELECT a.id,a.uid,b.nick_name,b.mobile,c.score FROM user_ext_db.user_cards AS a,user_center_db.user_base AS b,user_center_db.user_score AS c WHERE " . $where . " and a.uid = b.id AND a.uid = c.uid GROUP BY a.uid ORDER BY a.created_at DESC,a.uid ASC LIMIT $start,$size";
            $countQuery = "SELECT COUNT(*) AS total FROM user_ext_db.user_cards AS a,user_center_db.user_base AS b,user_center_db.user_score AS c WHERE " . $where . " and a.uid = b.id AND a.uid = c.uid";

            $resultTotal = TZ_loader::model('Customer', 'Custom')->query($countQuery);
            $cusTotal = $resultTotal->fetchAll()['0']['total'];
            $resultList = TZ_loader::model('Analysis', 'Channel')->query($query);
            $cusList = $resultList->fetchAll();

        } elseif (empty($params['nick_name']) && empty($params['telephone'])) {

            //load service
            $customerService = TZ_Loader::service('Customer', 'Custom');

            //get data
            $cusTotal = $customerService->getCusTotal($conditions);
            $cusList = $customerService->getCusList($conditions, $page, $size);

            //获取户nick_name
            if ($cusList) {
                foreach ($cusList as &$v) {
                    //昵称
                    $base = TZ_Loader::model('Base', 'Custom')->select(['id:eq' => $v['uid']], 'nick_name,mobile', 'ROW');
                    $v['nick_name'] = $base['nick_name'];
                    $v['mobile'] = $base['mobile'];
                    //实名认证
                    /*if ($v['is_identify'] == 1) {
                        $v['status'] = TZ_Loader::model('Identify', 'Custom')->select(['uid:eq' => $v['uid']], 'status', 'ROW')['status'];
                    } elseif ($v['is_identify'] == 0) {
                        $v['status'] = 4;
                    }*/
                    //牛币
                    $v['score'] = TZ_Loader::model('Score', 'Custom')->select(['uid:eq' => $v['uid']], 'score', 'ROW')['score'];
                }
            }
        }
        $this->_view->assign('list', $cusList);

        //render
        $wxHtml = $this->_view->render('customer_list_row.tpl');

        //send
        $data = array(
            'total' => $cusTotal,
            'html' => $wxHtml
        );
        echo json_encode($data);

    }

    /**
     * 查询积分详情
     */
    public function getScoreDetailAction()
    {
        $params = $_GET;

        $result = TZ_Loader::model('Base', 'Custom')->select(array('id:eq' => $params['id']), '*', 'ROW');
        $this->_view->assign('list', $result);
        $this->_view->assign('id', $params['id']);
        $this->_view->display('score_detail.tpl');
    }

    /**
     * 积分记录列表
     */
    public function getScoreListAction()
    {
        $params = $_GET;

        $conditions['uid:eq'] = $params['id'];

        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $conditions['created_at:between'] = array($params['start_time'], $params['end_time']);
        }

        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);

        //load service
        $scoreService = TZ_Loader::service('ScoreLogs', 'Custom');

        //get data
        $scoreTotal = $scoreService->getTotal($conditions);
        $scoreList = $scoreService->getList($conditions, $page, $size);

        //render
        $this->_view->assign('list', $scoreList);
        $scoreHtml = $this->_view->render('score_detail_row.tpl');

        //send
        $data = array(
            'total' => $scoreTotal,
            'html' => $scoreHtml
        );
        echo json_encode($data);
    }

    /**
     * 查询卡详情
     */
    public function getCardDetailAction()
    {
        $params = $_GET;

        $result = TZ_Loader::model('Base', 'Custom')->select(array('id:eq' => $params['id']), '*', 'ROW');
        $this->_view->assign('list', $result);
        $this->_view->assign('id', $params['id']);
        $this->_view->display('card_detail.tpl');
    }

    /**
     * 卡记录列表
     */
    public function getCardListAction()
    {
        $params = $_GET;

        $conditions['uid:eq'] = $params['id'];

        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $conditions['actived_at:between'] = array($params['start_time'], $params['end_time']);
        }

        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);

        //load service
        $cardService = TZ_Loader::service('CustomCard', 'Custom');
        //get data
        $cardTotal = $cardService->getTotal($conditions);
        $cardList = $cardService->getList($conditions, $page, $size);

        if ($cardList) {
            foreach ($cardList as &$value) {
                $value['card_name'] = TZ_Loader::model('CustomCardType', 'Custom')->select(['id:eq' => $value['card_type']], 'name', 'ROW')['name'];
            }
        }

        //render
        $this->_view->assign('list', $cardList);
        $cardHtml = $this->_view->render('card_detail_row.tpl');

        //send
        $data = array(
            'total' => $cardTotal,
            'html' => $cardHtml
        );
        echo json_encode($data);
    }
    
}