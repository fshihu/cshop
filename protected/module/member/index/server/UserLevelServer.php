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
    const LEVEL_GOLDED_CARD = 2;//金卡
    const LEVEL_BLACK_CARD = 3;//黑卡

    const LEVEL_UPGRADE_FULL_MONEY = 1;//满钱升级
    const LEVEL_UPGRADE_TRUN_MONEY = 2;//交钱升级
    const LEVEL_UPGRADE_RECOMM_GOLDEN = 3;//推荐升级

    const LEVEL_RENEW_TRUN_MONEY = 1;//交钱续费
    const LEVEL_RENEW_RECOMM_GOLDEN = 2;//推荐续费
    public static function isNormal($user)
    {
        return $user['level'] == self::LEVEL_NORMAL;
    }
    public static function isGoldedCrad($user)
    {
        return $user['level'] == self::LEVEL_GOLDED_CARD;
    }
}