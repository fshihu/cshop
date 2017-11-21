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
    public static function sendMsg($mobile,$text)
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        $text = "【灏维网络】".$text;
        $params = [
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ];
        $rs = \Curl::instance()->post($url,$params);
        $r = json_decode($rs,true);

        if($r['code']!= 0){
            \CC::log(['url' => $url,'params' => $params,'rs' => $rs],'phone_err');
            throw new CErrorException('短信发送失败：'.$r['msg']);
        }
        return true;
    }

    public static function checkCode($phone,$code )
    {
        $item = ItemModel::make('phone_code')->addColumnsCondition(array(
            'phone' => $phone,
            'c_time' => ['>',time() - 60 * 10],
        ))->order('id desc')->execute();
        if($item['code'] != $code){
            throw new CErrorException('验证码错误');
        }
    }
}