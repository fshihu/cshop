<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:03
 */

namespace module\cart\index;


use CC\db\base\update\UpdateModel;
use CC\util\arr\ArrayUtil;
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
        $total_person_num = $request->getParams('total_person_num',1);
        $use_gold = $request->getParams('use_gold',0);
        $nums = $request->getParams('nums');
        $nums = json_decode($nums,true);
        if(is_array($nums)){
            foreach ($nums as $item) {
                UpdateModel::make('cart')->addId($item['id'])->addData(array(
                    'goods_num' => $item['num'],
                ))->execute();
            }
        }
        $cart_ids = ArrayUtil::explodeStr($cart_ids);
        if(empty($cart_ids)){
            return new \CRenderData();
        }
        $order_id = OrderServer::instance($address_id,$prom_type,$cart_ids,$total_person_num,$use_gold)->addOrder();
        return new \CRedirectData('pay/index/index',['order_id' => $order_id]);
    }
}