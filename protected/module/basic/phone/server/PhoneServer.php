<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 1:51
 */

namespace module\basic\phone\server;


use CC\db\base\select\ItemModel;
use CErrorException;

class PhoneServer
{
    public static function sendMsg($mobile,$code,$text = '')
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        if($text == ''){
            $text = "【灏维网络】您的验证码是".$code."。如非本人操作，请忽略本短信";
        }
        $r = \Curl::instance()->post($url,array(
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ));
        $r = json_decode($r,true);

        if($r['code']!= 0){
            throw new CErrorException($r['msg']);
        }
        return true;
    }

    public static function checkCode($phone,$code )
    {
        $item = ItemModel::make('phone_code')->addColumnsCondition(array(
            'phone' => $phone,
            'c_time' => ['>',time() - 60 * 5],
        ))->execute();
        if($item['code'] != $code){
            throw new CErrorException('验证码错误');
        }
    }
}