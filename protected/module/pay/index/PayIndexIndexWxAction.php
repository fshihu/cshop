<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:44
 */

namespace module\pay\index;


use biz\pay\weixin\WxPay;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CRequest;
use module\cart\index\server\OrderServer;
use module\cart\index\server\OrderWaitStatusEnum;
use module\cart\index\server\PromTypeEnum;

class PayIndexIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        $order_info = ItemModel::make('order')->addColumnsCondition(array(
            'order_id' => $request->getParams('order_id'),
        ))->execute();
        $orderSn = OrderServer::getOrderSn();
        UpdateModel::make('order')->addData(array(
            'order_sn' => $orderSn,
        ))->addColumnsCondition(array('order_id' => $order_info['order_id']))->execute();
        $order_info['order_sn'] = $orderSn;
        $order_info['body'] = '微整形';
        $order_info['attach'] = 'wzx';
        $order_info['goods_tag'] = '微整形';
        $order_info['notify_url'] = $this->genurl('pay/index/notify',[],true);
        $order_info['order_amount'] = 1;//$order_info['order_amount'];
        $ok_url = $this->genurl('member/order/index',['wait_status' => OrderWaitStatusEnum::WAIT_SEND]);
        $err_url = $this->genurl('member/index/index');
        if($order_info['order_prom_type'] == PromTypeEnum::GROUP_OPNE||$order_info['order_prom_type'] == PromTypeEnum::GROUP_JOIN){
            $ok_url = $this->genurl('member/index/index');
            $err_url = $ok_url;
        }
        if($order_info['order_prom_type'] == PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY){
            $ok_url = $this->genurl('member/level/index');
            $err_url = $ok_url;
        }
        return new \CRenderData(array(
            'jsApiParameters' =>  WxPay::instance()->getJsApiParameters($order_info),
            'ok_url' => $ok_url,
            'err_url' => $err_url,
        ));
    }
}