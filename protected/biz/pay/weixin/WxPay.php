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
require_once __DIR__.'/lib/WxPay.Notify.php';

use biz\wx\WxConf;
use JsApiPay;
use WxPayApi;
use WxPayConfig;
use WxPayNotify;
use WxPayOrderQuery;
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

    /**
     * @param $callback \Closure function($data){}
     * $data['out_trade_no']
     */
    public function notify($callback)
    {
        \CC::env()->debug = true;
        $notify = new PayNotifyCallBack();
        $notify->setFn(function () use($callback){
            return $callback();
        });
        $notify->Handle(false);
    }
    /**
     * @param $order_info
     * @return mixed
     */
    public function getJsApiParameters($order_info)
    {

//①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

//②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($order_info['body']);
        $input->SetAttach($order_info['attach']);
        $input->SetOut_trade_no($order_info['order_sn']);
        $input->SetTotal_fee(1);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($order_info['goods_tag']);
        $input->SetNotify_url($order_info['notify_url']);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        return $tools->GetJsApiParameters($order);
    }
}


class PayNotifyCallBack extends WxPayNotify
{
    protected $fn;
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}

	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
	    \CC::log($data,'wxpay_notify');
		$notfiyOutput = array();

		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
        $fn = $this->fn;
        return $fn($data);
	}

    /**
     * @param mixed $fn
     */
    public function setFn($fn)
    {
        $this->fn = $fn;
    }
}