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
        if($order['order_status']  != OrderStatusEnum::WAIT_PAY){
            return true;
        }
        UpdateModel::make('order')->addData(array(
            'order_status' => OrderStatusEnum::PAYED,
        ))->addColumnsCondition(array(
            'order_id' => $order['order_id']
        ))->execute();
        return true;
    }
}