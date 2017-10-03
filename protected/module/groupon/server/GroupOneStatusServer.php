<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 11:40
 */

namespace module\groupon\server;


use CC\db\base\update\UpdateModel;

class GroupOneStatusServer
{
    const TO_RAFFLE = 1;
    const TO_FINISH = 2;
    const TO_INVALID = 3;
    protected $group_one_id;
    public static function instance($group_one_id)
    {
        $obj = new static();
        $obj->group_one_id = $group_one_id;
        return $obj;
    }

    public function changeStatus($status)
    {
        if($status == self::TO_RAFFLE){
            UpdateModel::make('group_one')->addColumnsCondition(array(
                'id' => $this->group_one_id
            ))->addData(array(
                'pay_status' => 1,
                'finish_num' => $finish_num,
                'remain_num' => $group_one['total_num'] - $finish_num,
                'is_finish' => $group_one['total_num'] == $finish_num?1:0,
            ))->execute();

        }
    }
}