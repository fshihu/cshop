<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/11/16
 * Time: 18:37
 */

namespace app\admin\logic;


class Phone
{
    public static function sendMsg($mobile,$text)
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        $text = "【灏维网络】".$text;
        $r = \Curl::instance()->post($url,array(
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ));
        $r = json_decode($r,true);

        if($r['code']!= 0){
            return false;
        }
        return true;
    }

}