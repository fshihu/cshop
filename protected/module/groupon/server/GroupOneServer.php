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
        if($order['prom_type'] == PromTypeEnum::GROUP_OPNE){
            $group_buy = ItemModel::make('group_buy')->addId($order['prom_id'])->execute();
            $id = InsertModel::make('group_one')->addData(array(
                'group_buy_id' => $group_buy['id'],
                'uid' => $order['user_id'],
                'total_num' => $group_buy['goods_num'],
                'finish_num' => 0,
                'crate_time' => time(),
                'is_finish' => 0,
            ))->execute();
            InsertModel::make('group_one_member')->addData(array(
                'group_one_id' => $id,
                'uid' => $order['user_id'],
                'is_leader' => 1,
                'time' => time(),
            ))->execute();
        }
        if($order['prom_type'] == PromTypeEnum::GROUP_JOIN){
            $group_one = ItemModel::make('group_one')->addId($order['prom_id'])->execute();
//            UpdateModel::make('group_one')->
//            $id = InsertModel::make('group_one')->addData(array(
//                'group_buy_id' => $group_buy['id'],
//                'uid' => $order['user_id'],
//                'total_num' => $group_buy['goods_num'],
//                'finish_num' => 0,
//                'crate_time' => time(),
//                'is_finish' => 0,
//            ))->execute();
//            InsertModel::make('group_one_member')->addData(array(
//                'group_one_id' => $id,
//                'uid' => $order['user_id'],
//                'is_leader' => 1,
//                'time' => time(),
//            ))->execute();
        }
    }
}