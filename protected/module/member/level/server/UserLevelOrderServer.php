<?php
/**
 * User: fu
 * Date: 2017/10/11
 * Time: 1:34
 */

namespace module\member\level\server;


use module\cart\index\server\PromTypeEnum;
use module\member\index\server\UserLevelServer;

class UserLevelOrderServer
{
    public static function handle($order)
    {
        if($order['order_prom_type'] == PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY){
            UserLevelServer::updateLevel($order['user_id'],UserLevelServer::LEVEL_GOLDED_CARD);
        }
    }
}