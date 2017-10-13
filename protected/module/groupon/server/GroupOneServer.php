<?php
/**
 * User: fu
 * Date: 2017/9/30
 * Time: 1:35
 */

namespace module\groupon\server;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use module\cart\index\server\PromTypeEnum;

class GroupOneServer
{
    public static function instance()
    {
        return new static();
    }

    public function handler($order)
    {
        if($order['order_prom_type'] == PromTypeEnum::GROUP_OPNE || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_OPEN){
            $group_one = ItemModel::make('group_one')->addId($order['order_prom_id'])->execute();
            $finish_num = $group_one['finish_num'] + 1;
            UpdateModel::make('group_one')->addColumnsCondition(array(
                'id' => $order['order_prom_id']
            ))->addData(array(
                'pay_status' => 1,
                'finish_num' => $finish_num,
                'remain_num' => $group_one['total_num'] - $finish_num,
                'is_finish' => $group_one['total_num'] == $finish_num?1:0,
            ))->execute();
        }
        if($order['order_prom_type'] == PromTypeEnum::GROUP_JOIN){
            InsertModel::make('group_one_member')->addData(array(
                'group_one_id' => $order['order_prom_id'],
                'uid' => $order['user_id'],
                'is_leader' => 0,
                'time' => time(),
            ))->execute();
        }
    }
}