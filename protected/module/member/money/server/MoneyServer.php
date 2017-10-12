<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 0:51
 */

namespace module\member\money\server;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;

class MoneyServer
{
    const GROUP_BUY_RETURNED = 1;//团购退回
    public static function addRecord($uid, $type, $money, $content, $data_id)
    {
        $user =    ItemModel::make('users')->addColumnsCondition(array(
                    'user_id' => $uid,
                ))->execute();

        InsertModel::make('user_money_record')->addData(array(
            'uid' => $uid,
            'money' => $money,
            'cur_money' => $user['user_money'] + $money,
            'content' => $content,
            'data_id' => $data_id,
            'type' => $type,
            'crate_time' => time(),
        ))->execute();
        UpdateModel::make('users')->addData(array(
            'user_money' => $user['user_money'] + $money
        ))->addColumnsCondition(array(
            'user_id' => $uid
        ))->execute();
    }
}