<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 20:14
 */

namespace module\member\order;

use CRequest;
use module\cart\index\server\OrderStatusServer;

class MemberOrderConfirmWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $order_id = $request->getParams('order_id');
        OrderStatusServer::instance($order_id)->changeStatus(OrderStatusServer::TO_CONFIRM);
        return new \CJsonData();
    }
}