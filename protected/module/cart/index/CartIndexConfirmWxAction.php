<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:03
 */

namespace module\cart\index;


use CRequest;
use module\cart\index\server\CartServer;
use module\cart\index\server\OrderServer;

class CartIndexConfirmWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {
        $prom_type = $request->getParams('prom_type', 0);
        $cart_ids = $request->getParams('cart_ids');
        $address_id = $request->getParams('address_id');
        if(empty($cart_ids)){
            return new \CRenderData();
        }
        $order_id = OrderServer::instance($address_id,$prom_type,$cart_ids)->addOrder();
        return new \CRedirectData('pay/index/index',['order_id' => $order_id]);
    }
}