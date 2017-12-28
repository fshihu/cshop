<?php
/**
 * User: fu
 * Date: 2017/11/23
 * Time: 20:44
 */

namespace module\member\order;


use biz\Session;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\update\UpdateModel;
use CRequest;

class MemberOrderReturnWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }
    public function execute(CRequest $request)
    {

        if($request->hasPost()){
            $order = ItemModel::make('order')->addColumnsCondition(array(
                'order_id' => $request->getParams('order_id'),
            ))->execute();
            $order_goods = ItemModel::make('order_goods')->addColumnsCondition(array(
                'order_id' => $request->getParams('order_id'),
            ))->execute();

            InsertModel::make('return_goods')->addData(array(
                'order_id' => $order['order_id'],
                'order_sn' => $order['order_sn'],
                'user_id' => Session::getUserID(),
                'goods_id' => $order_goods['goods_id'],
                'type' => $request->getParams('type'),
                'reason' => $request->getParams('content'),
                'refund_money' => $order['order_amount'],
                'id_card_front' => $request->getParams('id_card_front'),
                'id_card_behind' => $request->getParams('id_card_behind'),
                'admin_uid' => $order['admin_uid'],
                'addtime' => time(),
            ))->execute();
            UpdateModel::make('order')->addData(array(
                'return_status' => 10,
            ))->addColumnsCondition(array(
                'order_id' => $order['order_id'],
            ))->execute();

            return new \CJsonData();
        }

        return new \CRenderData(

        );
    }

}