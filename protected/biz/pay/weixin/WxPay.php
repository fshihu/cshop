<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 15:40
 */

namespace biz\pay\weixin;

require_once __DIR__ . "/lib/WxPay.Api.php";
require_once __DIR__ . "/example/WxPay.JsApiPay.php";
use biz\wx\WxConf;
use JsApiPay;
use WxPayApi;
use WxPayConfig;
use WxPayUnifiedOrder;

class WxPay
{
    public static function instance()
    {
        WxPayConfig::setAPPID(WxConf::getAppid());
        WxPayConfig::setAPPSECRET(WxConf::getAppSecret());
        WxPayConfig::setMCHID(WxConf::getMchid());
        WxPayConfig::setKEY(WxConf::getKey());
        return new self();
    }

    public function getJsApiParameters()
    {

//①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

//②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::getMCHID() . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);

        $order = WxPayApi::unifiedOrder($input);

        return $tools->GetJsApiParameters($order);
    }
}