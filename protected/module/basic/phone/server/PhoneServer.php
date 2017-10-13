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
    public static function sendMsg()
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = '';
        $mobile = '';
        $text = '';
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