<?php
/**
 * User: fu
 * Date: 2017/10/14
 * Time: 14:18
 */

namespace module\member\gold\server;


use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;

class GoldServer
{
    public static function getGold()
    {
        $user = UserServer::getUser();
        $gold = $user['gold'];
        return $gold;
    }

    public static function getGoldRatio()
    {
        return 0.01;
    }
    public static function getUseGoldMaxRatio()
    {
        $user = UserServer::getUser();
        $ration = 0.05;
        /*普通会员购买产品最多抵扣产品价格5%，金卡会员购买产品最多抵扣产品价格10%，黑卡/黑卡附属卡会员购买产品最多抵扣产品价格20%。*/
         if($user['level'] == UserLevelServer::LEVEL_BLACK_CARD||$user['level'] == UserLevelServer::LEVEL_BLACK_ATTACH_CARD){
             $ration = 0.2;
         }
         if($user['level'] == UserLevelServer::LEVEL_GOLDED_CARD){
             $ration = 0.1;
         }
        return $ration;
    }
}