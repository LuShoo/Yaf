<?php

/* 用户实名认证管理
 *@ author ziyang <hexiangcheng@showboom.cn>
 * @date 2016-05-27
 */

class IdentifyController extends Yaf_Controller_Abstract
{

    //列表
    public function indexAction()
    {
        $userInfo = TZ_Loader::service('Auth', 'Admin')->checkLogin(false);
        $this->_view->display('identify_list.tpl');
    }

    //Ajax 获取列表
    public function getlistAction()
    {

        $params = $_GET;

        $params['nick_name'] = trim($params['nick_name']);

        if (!empty($params['nick_name'])) {
            $arr = [];
            $data = TZ_Loader::model('Base', 'Custom')->select(['nick_name:eq' => trim($params['nick_name'])], 'id', 'ALL');
            if ($data) {
                foreach ($data as $v) {
                    $arr[] = $v['id'];
                }
            }

            if ($arr) {
                $condition['uid:in'] = $arr;
            } else {
                $condition['uid:eq'] = 0;
            }
        }

        if (!empty($params['card'])) {
            $condition['real_nric:eq'] = $params['card'];
        }

        if (!empty($params['status'])) {
            $condition['status:eq'] = $params['status'] - 1;
        }

        if (!empty($params['start_time']) && !empty($params['end_time'])) {
            $condition['created_at:between'] = array($params['start_time'], $params['end_time']);
        }
        if (empty($params['page']) || empty($params['size']))
            TZ_Request::error('params error.');

        if (($params['page'] < 1) || ($params['size'] < 1))
            TZ_Request::error('params error.');

        $page = intval($params['page']);
        $size = intval($params['size']);


        //load service
        $userService = TZ_Loader::service('Identify', 'Custom');
        //get data
        $userTotal = $userService->getUserTotal($condition);
        $userList = $userService->getUserList($condition, $page, $size);


        //这段算法，用来减少联表和循环查询数据库
        if ($userList) {
            $uidArr = [];
            foreach ($userList as $k => $v) {
                $uidArr[] = $v['uid'];
            }

            $result = TZ_Loader::model('Base', 'Custom')->select(['id:in' => $uidArr], 'id,nick_name', 'ALL');
            $infoArr = [];

            foreach ($result as $key => $val) {
                $infoArr[$val['id']] = $val['nick_name'];
            }

            foreach ($userList as &$v) {
                $v['nick_name'] = $infoArr[$v['uid']];
            }
        }

        //render
        $this->_view->assign('user_list', $userList);
        $userHtml = $this->_view->render('identify_list_row.tpl');

        //send
        $data = array(
            'total' => $userTotal,
            'html' => $userHtml
        );
        echo json_encode($data);
    }


    public function checkAction()
    {
        $params = $_POST;
        $status = $params['status'];
        $reason = $params['reason'];
        $id = $params['id'];
        $update['status'] = $status;
        if ($status == 1) {
            $update['desc'] = $reason;
        }
        if ($status == 2) {
            $update['desc'] = '';
        }
        $update['updated_at'] = date('Y-m-d H:i:s');
        file_put_contents(APP_PATH . '/static/log.txt', json_encode($update), FILE_APPEND);
        //user_identify_info
        TZ_Loader::model('Identify', 'Custom')->update($update, ['id:eq' => $id]);

        //获取实名认证数据
        $data = TZ_Loader::model('Identify', 'Custom')->select(['id:eq' => $id], '*', 'ROW');

        //需要更新其他数据
        if ($status == 2) {
            file_put_contents(APP_PATH . '/static/log.txt', '需要更新其他数据', FILE_APPEND);

            //personal_identify
            $personalIden = array();
            $personalIden['iden_type'] = 1;
            $personalIden['uid'] = $data['uid'];
            $personalIden['iden_name'] = $data['real_name'];
            $personalIden['iden_nric'] = $data['real_nric'];
            $personalIden['mobile'] = $data['mobile'];
            $personalIden['front_img'] = $data['front_img'];
            $personalIden['back_img'] = $data['back_img'];
            $personalIden['handheld_img'] = $data['handheld_img'];
            //$personalIden['card_img'] = $data[''];
            $personalIden['created_at'] = date('Y-m-d H:i:s');
            file_put_contents(APP_PATH . '/static/log.txt', json_encode($personalIden), FILE_APPEND);

            $perIden = TZ_Loader::model('Personalidentify', 'Common')->select(array('uid:eq' => $data['uid'], 'iden_name:eq' => $data['real_name'], 'iden_nric:eq' => $data['real_nric']), 'id', 'ROW');
            if (empty($perIden)) {
                TZ_Loader::model('Personalidentify', 'Common')->insert($personalIden);
            }

            //card_info
            $cardInfo = TZ_Loader::model('Cardinfo', 'Common')->select(array('iccid:eq' => $data['iccid']), 'iccid', 'ALL');
            if ($cardInfo) {
                $CIiccidArr = [];
                foreach ($cardInfo as $v) {
                    $CIiccidArr[] = $v['iccid'];
                }
                $cardIden['iden_type'] = 1;
                $cardIden['iden_id'] = $data['uid'];
                TZ_Loader::model('Cardinfo', 'Common')->update($cardIden, ['iccid:in' => $CIiccidArr]);
            }

            //通用版实名 指定卡实名
            if ($data['uid'] == '9999999') {
                file_put_contents(APP_PATH . '/static/log.txt', "9999999", FILE_APPEND);
                //user_card
                $result = TZ_Loader::model('Card', 'Custom')->select(['uid:eq' => $data['uid'], 'iccid:eq' => $data['iccid'], 'is_identify:eq' => 0], 'iccid', 'ALL');
                if ($result) {
                    $iccidArr = [];
                    foreach ($result as $v) {
                        $iccidArr[] = $v['iccid'];
                    }
                    $up['is_identify'] = 1;
                    $up['iden_uid'] = $data['uid'];
                    $up['iden_name'] = $data['real_name'];
                    $up['iden_code'] = $data['real_nric'];
                    $up['identified_at'] = $data['updated_at'];
                    TZ_Loader::model('Card', 'Custom')->update($up, ['iccid:in' => $iccidArr]);
                }
            } else {
                //标准版实名 用户名下的卡全部实名
                //user_card
                $result = TZ_Loader::model('Card', 'Custom')->select(['uid:eq' => $data['uid'], 'is_identify:eq' => 0], 'iccid', 'ALL');
                if ($result) {
                    $iccidArr = [];
                    foreach ($result as $v) {
                        $iccidArr[] = $v['iccid'];
                    }
                    $up['is_identify'] = 1;
                    $up['iden_uid'] = $data['uid'];
                    $up['iden_name'] = $data['real_name'];
                    $up['iden_code'] = $data['real_nric'];
                    $up['identified_at'] = $data['updated_at'];
                    TZ_Loader::model('Card', 'Custom')->update($up, ['iccid:in' => $iccidArr]);
                }
                //加积分2000
                $this->_sendScore($data['uid']);
            }
        }

        //微信消息---实名认证提醒
        try {
            $openid = TZ_Loader::model('UserWx', 'Custom')->select(array('uid:eq' => $data['uid'], 'app_code:eq' => 'HM_FLOW'), 'openid', 'ROW')['openid'];
            $appId = TZ_Loader::model('WxConfig', 'Custom')->select(array('status:eq' => 1), 'app_id', 'ROW')['app_id'];
            file_put_contents(APP_PATH . '/static/log.txt', $appId, FILE_APPEND);
            file_put_contents(APP_PATH . '/static/log.txt', $openid, FILE_APPEND);
            if (!empty($openid)) {
                $apiUrl = Yaf_Registry::get('config')->weixin->api;
                $callbackurl = Yaf_Registry::get('config')->weixin->login;
                $template_id = Yaf_Registry::get('config')->weixin->identify->temp_id;
                $url = "$apiUrl/wechat/template/sendmsg";
                $type = 'post';
                if ($status == 2) {
                    //发送实名认证成功消息
                    $first = "恭喜您通过实名认证审核.";
                    $remark = "2000牛币已存入您的账户，充值时可当钱花，快来体验吧！";
                } elseif ($status == 1) {
                    //发送实名认证失败消息
                    $first = "很抱歉，您的实名认证审核失败.";
                    $remark = "为确保您的牛卡正常使用，请严格按照实名要求重新认证。";
                }
                $params = array(
                    'source' => 'HM_FLOW',
                    'template_id' => $template_id,
                    'touser' => $openid,
                    "url" => "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$callbackurl/flow/api/userlogin&response_type=code&scope=snsapi_userinfo&state=cardidauth#wechat_redirect",
                    "data" => array(
                        "first" => array(
                            "value" => $first,
                            "color" => "#000000"
                        ),
                        "keyword1" => array(
                            "value" => $data['real_name'],
                            "color" => "#173177"
                        ),
                        "keyword2" => array(
                            "value" => substr_replace($data['real_nric'], '****', 14),
                            "color" => "#173177"
                        ),
                        "remark" => array(
                            "value" => $remark,
                            "color" => "#000000"
                        )
                    )
                );
                TZ_RemoteTool::send($url, $type, $params);
            }
        } catch (Exception $e) {
            die(usr_json_encode(array('detail' => "发送消息失败，请联系管理员！")));
        }

        die(json_encode(array('detail' => "ok")));
    }


    //送积分
    private function _sendScore($uid)
    {

        //积分类型，获取第一条
        $type_id = TZ_Loader::model('Scoretype', 'Custom')->select([], 'id', 'ROW')['id'];

        $data = TZ_Loader::model('Score', 'Custom')->select(['uid:eq' => $uid, 'score_type:eq' => $type_id], 'id,score,total_score', 'ROW');

        $condition['id:eq'] = $data['id'];

        $update['score'] = $data['score'] + 2000;
        $update['total_score'] = $data['total_score'] + 2000;
        $update['updated_at'] = date('Y-m-d H:i:s');

        TZ_Loader::model('Score', 'Custom')->update($update, $condition);

        $log['uid'] = $uid;
        $log['score_type'] = $type_id;
        $log['user_score'] = $data['score'];
        $log['change_score'] = 2000;
        $log['result_score'] = $data['score'] + 2000;
        $log['source'] = 'heimiboss';
        $log['desc'] = '实名送牛币';
        $log['created_at'] = date('Y-m-d H:i:s');
        TZ_Loader::model('ScoreLogs', 'Custom')->insert($log);

    }

}