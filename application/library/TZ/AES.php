<?php

/**
 * author: mengqi<zhangxuan@heimilink.com>.
 * Time: 2016/9/4 16:06
 * Info: AES 256加密类
 */
class TZ_AES
{
    static protected $cipher = MCRYPT_RIJNDAEL_256;
    static protected $mode = MCRYPT_MODE_ECB;
    static protected $pad_method = 'pkcs5';
    static public $secret_key = 'CA4F3151A97241F4A2532CC1B059C2F4';
    static protected $iv = '';


    static public function set_cipher($cipher)
    {
        self::$cipher = $cipher;
    }

    static public function set_mode($mode)
    {
        self::$mode = $mode;
    }

    static public function set_iv($iv)
    {
        self::$iv = $iv;
    }


    static protected function pad_or_unpad($str, $ext)
    {
        if (is_null(self::$pad_method)) {
            return $str;
        } else {
            $func_name = __CLASS__ . '::' . self::$pad_method . '_' . $ext . 'pad';
            if (is_callable($func_name)) {
                $size = mcrypt_get_block_size(self::$cipher, self::$mode);
                return call_user_func($func_name, $str, $size);
            }
        }
        return $str;
    }

    static protected function pad($str)
    {
        return self::pad_or_unpad($str, '');
    }

    static protected function unpad($str)
    {
        return self::pad_or_unpad($str, 'un');
    }
//加密
    public static function encrypt($str)
    {
        $str = self::pad($str);
        $td = mcrypt_module_open(self::$cipher, '', self::$mode, '');

        if (empty(self::$iv)) {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        } else {
            $iv = self::$iv;
        }

        mcrypt_generic_init($td, self::$secret_key, $iv);
        $cyper_text = mcrypt_generic($td, $str);
        $rt = base64_encode($cyper_text);
        //$rt = bin2hex($cyper_text);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return $rt;
    }

//解密
    public static function decrypt($str)
    {
        $td = mcrypt_module_open(self::$cipher, '', self::$mode, '');

        if (empty(self::$iv)) {
            $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        } else {
            $iv = self::$iv;
        }

        mcrypt_generic_init($td, self::$secret_key, $iv);
        //$decrypted_text = mdecrypt_generic($td, self::hex2bin($str));
        $decrypted_text = mdecrypt_generic($td, base64_decode($str));
        $rt = $decrypted_text;
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return self::unpad($rt);
    }

    public static function hex2bin($hexdata)
    {
        $bindata = '';
        $length = strlen($hexdata);
        for ($i = 0; $i < $length; $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }

    public static function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (@strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public static function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }
}