<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 20:19
 */

namespace module\member\order;



use biz\Session;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use CRequest;
use module\cart\index\server\OrderStatusServer;
use module\cart\index\server\PromTypeEnum;
use module\member\gold\server\GoldServer;
use module\member\gold\server\UserGoldRecordServer;
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;
use module\member\money\server\MoneyServer;

class MemberOrderCommentWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {

        if($this->request->hasPost()){
            $order = ItemModel::make('order')->addColumnsCondition(array(
                'order_id' => $request->getParams('order_id'),
            ))->execute();
            $list = ListModel::make('order_goods')->addColumnsCondition(array(
                'order_id' => $order['order_id'],
            ))->execute();
            $user = UserServer::getUser();
            foreach ($list as $item) {
                InsertModel::make('comment')->addData(array(
                    'goods_id' => $item['goods_id'],
                    'content' => $request->getParams('content'),
                    'user_id' =>  $user['user_id'],
                    'username' => $user['nickname'],
                    'rating' => $request->getParams('rating'),
                    'add_time' => time(),
                ))->execute();
                if($item['card_discount_price'] > 0 && $order['order_prom_type'] == PromTypeEnum::NORMAL){
                    $type_name = '';
                    if(UserLevelServer::isGoldedCrad($user)){
                        $type_name = '金卡';
                    }
                    if(UserLevelServer::isBlackCrad($user)){
                        $type_name = '黑卡';
                    }
                    UserGoldRecordServer::addGold($user['user_id'],UserGoldRecordServer::TYPE_ORDER_CART_DISCOUNT_PRICE,$item['card_discount_price'],'订单'.$type_name.'返现',$item['rec_id']);
                }
            }
            if($order['order_prom_type'] == PromTypeEnum::NORMAL) {
                $get_gold = (int)($order['order_amount'] * GoldServer::getGoldRatio());
                if ($get_gold > 0) {
                    UserGoldRecordServer::addGold($order['user_id'], UserGoldRecordServer::TYPE_BUY_GOODS_GET, $get_gold, '购买商品获得积分', $order['order_id']);
                }
                UpdateModel::make('order')->addData(array(
                    'get_gold' => $get_gold,
                ))->addColumnsCondition(array(
                    'order_id' => $order['order_id'],
                ))->execute();

            }
            OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_FINISH);
            return new \CJsonData();
        }
        return new \CRenderData(

        );
    }



}