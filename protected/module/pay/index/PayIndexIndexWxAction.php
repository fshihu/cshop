<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:44
 */

namespace module\pay\index;


use biz\pay\weixin\WxPay;
use CC\db\base\select\ItemModel;
use CRequest;
use module\cart\index\server\OrderServer;

class PayIndexIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        $order_info = ItemModel::make('order')->addColumnsCondition(array(
            'order_id' => $request->getParams('order_id'),
        ))->execute();
        $order_info['body'] = '微整形';
        $order_info['attach'] = 'wzx';
        $order_info['goods_tag'] = '微整形';
        $order_info['notify_url'] = $this->genurl('pay/index/notify',[],true);
        return new \CRenderData(array(
            'jsApiParameters' => WxPay::instance()->getJsApiParameters($order_info),
        ));
    }
}