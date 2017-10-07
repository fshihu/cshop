<?php
/**
 * User: fu
 * Date: 2017/10/7
 * Time: 22:44
 */

namespace module\member\gold\server;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use module\member\index\UserServer;

class UserGoldRecordServer
{
    const TYPE_GIVE = 1;
    const TYPE_REVICE_GIVE = 2;
    public static function addGold($uid,$type,$gold,$content,$data_id)
    {
        $user =    ItemModel::make('users')->addColumnsCondition(array(
                    'user_id' => $uid,
                ))->execute();

        InsertModel::make('user_gold_record')->addData(array(
            'uid' => $uid,
            'money' => $gold,
            'cur_money' => $user['gold'] - $gold,
            'content' => '转增积分',
            'data_id' => $data_id,
            'type' => $type,//转增
            'crate_time' => time(),
        ))->execute();

    }
}