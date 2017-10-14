<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 23:24
 */

namespace module\cart\index\server;


use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CC\util\db\YesNoEnum;
use CErrorException;
use module\member\gold\server\UserGoldRecordServer;

class OrderStatusServer
{
    const TO_CANCEL = 1;
    const TO_PAYED = 2;
    const TO_CONFIRM = 3;
    const TO_FINISH = 4;
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
            $order = ItemModel::make('order')->addColumnsCondition(array('order_id' => $this->order_id))->execute();
            if($order['order_status'] != OrderWaitStatusEnum::WAIT_PAY){
                throw new CErrorException('已取消');
            }
            UpdateModel::make('order')->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->addData(array(
                'deleted' => YesNoEnum::YES,
                'order_status' => OrderStatusEnum::CANCELED,
            ))->execute();
            if($order['integral'] > 0){
                UserGoldRecordServer::addGold($order['user_id'],UserGoldRecordServer::TYPE_BUY_GOODS_CANCEL,$order['integral'],'订单取消',$order['order_id']);
            }
        }elseif ($to_status == self::TO_PAYED){
            UpdateModel::make('order')->addData(array(
                'pay_status' => OrderPayStatusEnum::PAYED,
                'wait_status' => OrderWaitStatusEnum::WAIT_SEND,
                'pay_time' => time(),
            ))->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->execute();

        }elseif ($to_status == self::TO_CONFIRM){
            UpdateModel::make('order')->addData(array(
                'wait_status' => OrderWaitStatusEnum::WAIT_COMMENT,
                'order_status' => OrderStatusEnum::RECIVED,
            ))->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->execute();
        }
        elseif ($to_status == self::TO_FINISH){
            UpdateModel::make('order')->addData(array(
                'wait_status' => OrderWaitStatusEnum::FINISH,
                'order_status' => OrderStatusEnum::FINISH,
            ))->addColumnsCondition(array(
                'order_id' => $this->order_id,
            ))->execute();
        }
    }
}