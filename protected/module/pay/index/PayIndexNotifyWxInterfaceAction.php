<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:40
 */

namespace module\pay\index;


use biz\pay\weixin\WxPay;
use CRequest;
use module\cart\index\server\OrderHanderServer;

class PayIndexNotifyWxInterfaceAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {
        WxPay::instance()->notify(function ($data){
            return OrderHanderServer::instance($data)->handle();
        });
        return parent::execute($request);
    }
}