<?php
/**
 * User: fu
 * Date: 2017/10/7
 * Time: 23:07
 */

namespace module\member\index\server;


class UserLevelServer
{
    const LEVEL_NORMAL = 1;

    const LEVEL_UPGRADE_FULL_MONEY = 1;//满钱升级
    const LEVEL_UPGRADE_TRUN_MONEY = 2;//交钱升级
    const LEVEL_UPGRADE_RECOMM_GOLDEN = 3;//推荐升级

    public static function isNormal($user)
    {
        return true;
    }
}