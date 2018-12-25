<?php
/**
 * User: fu
 * Date: 2018/12/24
 * Time: 21:01
 */

namespace module\pay\index;


use CRequest;
use module\cart\index\server\OrderHanderServer;

class PayIndexOkWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        OrderHanderServer::instance(array('out_trade_no' => $request->getParams('order_sn')))->handle();

        return new \CJsonData();
    }
}