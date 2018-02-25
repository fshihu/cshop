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
use module\basic\phone\server\PhoneServer;
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
            $this->sendWiatMsg();

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

    protected function sendWiatMsg()
    {
        //尊敬的商户，你在商城上有新的订单请求，下单时间为2017-12-25 12:23:32，请及时受理，如已处理，可忽略此提醒。
        $order = ItemModel::make('order')->addColumnsCondition(['order_id' => $this->order_id])->execute();
        $user = ItemModel::make('users')->addColumnsCondition(array('admin_uid' =>$order['admin_uid']))->execute();
        $merchant = ItemModel::make('merchant')->addColumnsCondition(array('uid' => $user['user_id']))->execute();
        PhoneServer::sendMsg($merchant['contact'],'尊敬的商户，你在商城上有新的订单请求，下单时间为'.date('Y-m-d H:i:s',$order['add_time']).'，请及时受理，如已处理，可忽略此提醒。',false);
    }
}