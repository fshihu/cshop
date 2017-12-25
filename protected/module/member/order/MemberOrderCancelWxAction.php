<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 23:22
 */

namespace module\member\order;


use CRequest;
use module\cart\index\server\OrderStatusServer;

class MemberOrderCancelWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {
        $order_id = $request->getParams('order_id');
        OrderStatusServer::instance($order_id)->changeStatus(OrderStatusServer::TO_CANCEL);
        return new \CJsonData();
    }
}