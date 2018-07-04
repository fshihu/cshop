<?php
/**
 * User: fu
 * Date: 2018/7/4
 * Time: 23:11
 */

namespace module\member\money;


use biz\Session;
use CRequest;
use module\cart\index\server\OrderServer;
use module\cart\index\server\PromTypeEnum;

class MemberMoneyChongWxAction extends \CAction
{
    public $money;
    public function execute(CRequest $request)
    {
        if($request->hasPost()){
            $id = OrderServer::addOrderBaseInfo(Session::getUserID(),$this->money,PromTypeEnum::CHOGN_ZHIG,Session::getUserID());
            return new \CRedirectData('pay/index/index',['order_id' => $id]);
        }
        return new \CRenderData();
    }
}