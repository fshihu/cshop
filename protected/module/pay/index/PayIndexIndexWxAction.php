<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:44
 */

namespace module\pay\index;


use biz\pay\weixin\WxPay;
use CC;
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
        $code = $request->getParams('code');
        if($code){
            if($_SESSION['code'] == $code){
                return new \CRedirectData('home/index/index');
            }else{
                $_SESSION['code'] = $code;
            }
        }
        $order_info = ItemModel::make('order')->addColumnsCondition(array(
            'order_id' => $request->getParams('order_id'),
        ))->execute();
        if($order_info['order_prom_type'] == PromTypeEnum::GROUP_JOIN || $order_info['order_prom_type'] == PromTypeEnum::GROUP_OWN_JOIN){
            $group_one = ItemModel::make('group_one')->addColumnsCondition(array('id' =>$order_info['order_prom_id']))->execute();
            if($group_one['is_finish']){
                throw new \CErrorException('团购已完成，无法再参加');
            }
        }

        $orderSn = OrderServer::getOrderSn();
        UpdateModel::make('order')->addData(array(
            'order_sn' => $orderSn,
        ))->addColumnsCondition(array('order_id' => $order_info['order_id']))->execute();
        $order_info['order_sn'] = $orderSn;
        $order_info['body'] = '微整形';
        $order_info['attach'] = 'wzx';
        $order_info['goods_tag'] = '微整形';
        $order_info['notify_url'] = CC::app()->request->getHostInfo(true).'/wxInterface/pay/index/notify';
//        var_dump($order_info['order_amount'])
        $order_info['order_amount'] = $order_info['order_amount'] * 100;
        $ok_url = $this->genurl('member/order/index',['wait_status' => OrderWaitStatusEnum::WAIT_SEND]);
        $err_url = $this->genurl('member/index/index');
        if($order_info['order_prom_type'] == PromTypeEnum::GROUP_OPNE||$order_info['order_prom_type'] == PromTypeEnum::GROUP_JOIN){
            $ok_url = $this->genurl('member/index/index');
            $err_url = $ok_url;
        }
        if($order_info['order_prom_type'] == PromTypeEnum::GROUP_OWN_OPEN||$order_info['order_prom_type'] == PromTypeEnum::GROUP_OWN_JOIN){
            $ok_url = $this->genurl('groupon/my/own');
            $err_url = $ok_url;
        }
        if($order_info['order_prom_type'] == PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY){
            $ok_url = $this->genurl('member/level/index');
            $err_url = $ok_url;
        }
        return new \CRenderData(array(
            'jsApiParameters' =>  WxPay::instance()->getJsApiParameters($order_info),
            'order_sn' => $orderSn,
            'ok_url' => $ok_url,
            'err_url' => $err_url,
        ));
    }
}