<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:52
 */

namespace module\cart\index\server;


use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use module\groupon\server\GroupOneServer;

class OrderHanderServer
{
    protected $data;
    public static function instance($data)
    {
        $obj = new static();
        $obj->data = $data;
        return $obj;
    }

    public function handle()
    {
        $order = ItemModel::make('order')->addColumnsCondition(['order_sn' => $this->data['out_trade_no']])->execute();
        if($order['pay_status']  == OrderPayStatusEnum::PAYED){
//            return true;
        }

        var_export($order['prom_type']);
//        OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
        if($order['order_prom_type'] == PromTypeEnum::GROUP_OPNE || $order['order_prom_type'] == PromTypeEnum::GROUP_JOIN){
            GroupOneServer::instance()->handler($order);
        }
        return true;
    }
}