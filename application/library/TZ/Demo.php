<?php

/**
 * 黑米流量接口demo
 * curl 方法模拟请求
 * version 1.0
 * date 2016-06-18
 * require :安装php curl扩展
 */

class TZ_Demo
{
    
    protected static $url='http://csi.test.heimilink.com/api/api/index';

    protected $partner='aaaaaaaaaaa';   //开发者id

    protected $hmkey='1111111111111111'; //开发者秘钥

    public function test($arg)
    {
        $arg['partner']=$this->partner;

        //生成签名
        $sign=$this->_getSign($arg);

        //参数urlencode
        foreach($arg as $k=>$v){
            $arg[$k]=urlencode($v);
        }

        $arg['sign']=$sign;


        $res=CurlTool::sendcurl(self::$url,'post',$arg);  //只支持post请求方式

        //json_encode 处理

        //$res=json_decode($res);
        return $res;
    }


    function createLinkstring($para)
    {
        $arg = "";
        while (list ($key, $val) = each($para))
        {
            $arg.=$key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc())
        {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return 去掉签名参数后的新签名参数组
     */
    function paraFilter($para)
    {
        $para_filter = array();
        while (list ($key, $val) = each($para))
        {
            if ($key == "sign")
                continue;
            else
                $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }


    //生成签名
    private  function _getSign($para_temp)
    {
        //待请求参数数组
        $para = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para);

        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $prestr=$this->hmkey.$prestr.$this->hmkey;

        $sign=sha1($prestr);

        return $sign;
    }
}

/* $arg=array(
    'service'=>'heimi_test', //测试接口名

     //以下为必填参数
    'arg1'=>'vlaue1',
    'arg2'=>'vlaue2',

);


$demo=new Demo();
$info=$demo->test($arg);

var_dump($info); */

//curl 工具类
class CurlTool {

    //等待时长，单位秒
    static public $timeout = 10;

    /**
     * send request
     *
     * @param  $url			需要访问的URL
     * @param  $type			传输类型，get或post
     * @param  $args			参数
     * @param  $needcharset	需要转换成的字符编码
     * @param  $charset		数据本身编码
     *
     * @Returns
     */
    public static function sendcurl($url, $type = 'get', $args = array(), $charset = 'utf-8', $needcharset = 'utf-8', $delimiter = '?') {
        if (!is_array($args)) {
            throw new Exception('传入参数必须为数组');
        }
        if ($charset == 'gbk' || $needcharset == 'gbk') {
            foreach ($args as &$val) {
                $val = mb_convert_encoding($val, $needcharset, $charset);
            }
        }
        if ($type == 'post') {
            $returnValue = self::_post($url, $args, $charset);
        } else {
            $url .= $delimiter . http_build_query($args);
            $returnValue = self::_get($url, $charset);
        }
        return $returnValue;
    }

    private static function _post($url, $arguments, $charset = 'utf-8') {
        if (is_array($arguments)) {
            $postData = http_build_query($arguments);
        } else {
            $postData = $arguments;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$timeout);

        $returnValue = curl_exec($ch);
        curl_close($ch);
        if ($charset != 'utf-8') {
            $returnValue = iconv($charset, $charset, $returnValue);
        }
        return $returnValue;
    }

    private static function _get($url, $charset = 'utf-8') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $returnValue = curl_exec($ch);
        curl_close($ch);
        if ($charset != 'utf-8') {
            $returnValue = iconv($charset, $charset, $returnValue);
        }
        return $returnValue;
    }
}




