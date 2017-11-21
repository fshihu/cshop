<?php
/**
 * User: fu
 * Date: 2017/9/30
 * Time: 1:35
 */

namespace module\groupon\server;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use module\cart\index\server\OrderStatusServer;
use module\cart\index\server\PromTypeEnum;

class GroupOneServer
{
    public static function instance()
    {
        return new static();
    }

    public function handler($order)
    {
        if($order['order_prom_type'] == PromTypeEnum::GROUP_OPNE
            || $order['order_prom_type'] == PromTypeEnum::GROUP_JOIN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_OPEN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_JOIN){

            $group_one = ItemModel::make('group_one')->addId($order['order_prom_id'])->execute();
            $finish_num = $group_one['finish_num'] + 1;
            $is_finish = $group_one['total_num'] == $finish_num ? 1 : 0;
            UpdateModel::make('group_one')->addColumnsCondition(array(
                'id' => $order['order_prom_id']
            ))->addData(array(
                'pay_status' => 1,
                'finish_num' => $finish_num,
                'remain_num' => $group_one['total_num'] - $finish_num,
                'is_finish' => $is_finish,
            ))->execute();

            if($is_finish && ($order['order_prom_type'] == PromTypeEnum::GROUP_JOIN||$order['order_prom_type'] == PromTypeEnum::GROUP_OPNE)){
                $order_list = ListModel::make('order')->addColumnsCondition(array(
                    'order_prom_type' => ['in',[PromTypeEnum::GROUP_JOIN,PromTypeEnum::GROUP_OPNE]],
                    'order_prom_id' => $order['order_prom_id'],
                ))->execute();

                foreach ($order_list as $item) {
                    UpdateModel::make('order')->addData(array(
                        'is_show' => 1,
                    ))->addColumnsCondition(array(
                        'order_id' => $item['order_id']
                    ))->execute();
                    OrderStatusServer::instance($item['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
                }
            }
        }
        if($order['order_prom_type'] == PromTypeEnum::GROUP_JOIN || PromTypeEnum::GROUP_OWN_JOIN){
            InsertModel::make('group_one_member')->addData(array(
                'group_one_id' => $order['order_prom_id'],
                'uid' => $order['user_id'],
                'is_leader' => 0,
                'time' => time(),
            ))->execute();
        }
    }
}