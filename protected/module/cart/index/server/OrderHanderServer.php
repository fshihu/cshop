<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:52
 */

namespace module\cart\index\server;


use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;

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
        OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
        return true;
    }
}