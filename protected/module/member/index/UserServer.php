<?php
/**
 * User: fu
 * Date: 2017/9/28
 * Time: 23:23
 */

namespace module\member\index;


use biz\Session;
use CC\db\base\select\ItemModel;
use module\member\index\server\UserLevelServer;

class UserServer
{
    public static function getLevelName($user)
    {
        if($user['level'] == UserLevelServer::LEVEL_GOLDED_CARD){
            return '金卡会员';
        }
        if($user['level'] == UserLevelServer::LEVEL_BLACK_CARD){
            return '黑卡会员';
        }
        if($user['level'] == UserLevelServer::LEVEL_BLACK_ATTACH_CARD){
            return '黑卡附属卡会员';
        }
        return '普通会员';
    }

    public static function getUser($uid = null)
    {
        return ItemModel::make('users')->addColumnsCondition(array(
            'user_id' => $uid?$uid:Session::getUserID(),
        ))->execute();

    }

    public static function getPhone()
    {
        return self::getUser()['mobile'];
    }
    public static function getRecommUser()
    {
        $first_leader = self::getUser()['first_leader'];
        return $first_leader?self::getUser($first_leader)['nickname']:'无';
    }

    public static function getAvatar($item = null)
    {
        if($item){
            return $item['head_pic'];
        }
        return self::getUser()['head_pic'];
    }

}