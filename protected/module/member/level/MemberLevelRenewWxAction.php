<?php
/**
 * User: fu
 * Date: 2017/10/11
 * Time: 1:54
 */

namespace module\member\level;


use biz\Session;
use CRequest;
use module\cart\index\server\OrderServer;
use module\cart\index\server\PromTypeEnum;
use module\member\index\server\UserLevelServer;

class MemberLevelRenewWxAction extends \CAction
{
    public $renew_type;
    public $money;
    public function execute(CRequest $request)
    {
        if($this->renew_type == UserLevelServer::LEVEL_RENEW_TRUN_MONEY){
            $id = OrderServer::addOrderBaseInfo(Session::getUserID(),$this->money,PromTypeEnum::USER_LEVEL_RENEW_TRUN_MONEY,Session::getUserID());
            return new \CRedirectData('pay/index/index',['order_id' => $id]);
        }
        if($this->renew_type == UserLevelServer::LEVEL_RENEW_RECOMM_GOLDEN){
            UserLevelServer::renewLevel(Session::getUserID());
        }
        return new \CJsonData();
    }
}