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
use module\member\level\server\UserLevelOrderServer;

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
            return true;
        }

        if($order['order_prom_type'] == PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY || $order['order_prom_type'] == PromTypeEnum::USER_LEVEL_RENEW_TRUN_MONEY){
            UserLevelOrderServer::handle($order);
        }else{
            OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
        }
        if($order['order_prom_type'] == PromTypeEnum::GROUP_OPNE || $order['order_prom_type'] == PromTypeEnum::GROUP_JOIN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_OPEN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_JOIN){
            GroupOneServer::instance()->handler($order);
        }
        return true;
    }
}