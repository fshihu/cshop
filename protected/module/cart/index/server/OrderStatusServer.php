<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 23:24
 */

namespace module\cart\index\server;


use CC\db\base\update\UpdateModel;
use CC\util\db\YesNoEnum;

class OrderStatusServer
{
    const TO_CANCEL = 1;
    const TO_PAYED = 2;
    protected $order_id;
    public static function instance($order_id)
    {
        $obj = new static();
        $obj->order_id = $order_id;
        return $obj;
    }
    public function changeStatus($to_status)
    {
        if($to_status == self::TO_CANCEL){
            UpdateModel::make('order')->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->addData(array(
                'deleted' => YesNoEnum::YES,
                'order_status' => OrderStatusEnum::CANCELED,
            ))->execute();
        }elseif ($to_status == self::TO_PAYED){
            UpdateModel::make('order')->addData(array(
                'pay_status' => OrderPayStatusEnum::PAYED,
                'wait_status' => OrderWaitStatusEnum::WAIT_SEND,
            ))->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->execute();

        }

    }
}