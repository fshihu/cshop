<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 16:20
 */

namespace module\ad\index;
use CC\db\base\select\ListModel;


class AdServer
{
    public static function getList($position)
    {
        return ListModel::make('ad')->addColumnsCondition(array(
            'pid' => $position,
        ))->execute();
    }
}