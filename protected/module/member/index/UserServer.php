<?php
/**
 * User: fu
 * Date: 2017/9/28
 * Time: 23:23
 */

namespace module\member\index;


use biz\Session;
use CC\db\base\select\ItemModel;

class UserServer
{
    public static function getLevelName($user)
    {
        return '普通会员';
    }

    public static function getUser($uid = null)
    {
        return ItemModel::make('users')->addColumnsCondition(array(
            'user_id' => $uid?$uid:Session::getUserID(),
        ))->execute();

    }
    public static function getRecommUser()
    {
        $first_leader = self::getUser()['first_leader'];
        return $first_leader?self::getUser($first_leader)['nickname']:'无';
    }

    public static function getAvatar()
    {
        return self::getUser()['head_pic'];
    }

}