<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:52
 */

namespace module\cart\index\server;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\IncrementModel;
use CC\db\base\update\UpdateModel;
use module\groupon\server\GroupOneServer;
use module\member\gold\server\GoldServer;
use module\member\gold\server\UserGoldRecordServer;
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;
use module\member\level\server\UserLevelOrderServer;
use module\member\money\server\MoneyServer;

class OrderHanderServer
{
    protected $data;
    public static function instance($data)
    {
        $obj = new static();
        $obj->data = $data;
        return $obj;
    }

    public function handle()
    {
        $order = ItemModel::make('order')->addColumnsCondition(['order_sn' => $this->data['out_trade_no']])->execute();
        if($order['pay_status']  == OrderPayStatusEnum::PAYED){
            return true;
        }

        OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
        UpdateModel::make('order')->addColumnsCondition(array(
            'order_id' => $order['order_id'],
        ))->addData(array(
            'wx_order_sn' => $this->data['transaction_id'],
        ))->execute();

        if($order['order_prom_type'] == PromTypeEnum::USER_LEVEL_UPGRADE_TRUN_MONEY || $order['order_prom_type'] == PromTypeEnum::USER_LEVEL_RENEW_TRUN_MONEY){
            UserLevelOrderServer::handle($order);
        }
        if($order['order_prom_type'] == PromTypeEnum::CHOGN_ZHIG){
            UserGoldRecordServer::addGold($order['user_id'],UserGoldRecordServer::TYPE_CHOGNZHI,$order['order_amount'],'充值',null);
            $list = ListModel::make('sys_conf')->execute();
            $sys_conf = [];
            foreach ($list as $item) {
                $sys_conf[$item['name']] = $item['val'];
            }
            if($sys_conf['fanxian_open']){
                if($sys_conf['zuidi_fanxian'] <= $order['order_amount']){
                    if($sys_conf['fanxian_bili'] > 0 && $sys_conf['fanxian_bili'] <= 100){
                        $fanxian = $order['order_amount'] * $sys_conf['fanxian_bili'] / 100 ;
                        if($sys_conf['fanxian_yueshu'] > 0){
                            $fanxian = $fanxian / $sys_conf['fanxian_yueshu'];
                        }
                        $fanxian = (int)$fanxian;
                        if($fanxian >0){
                            UserGoldRecordServer::addGold($order['user_id'],UserGoldRecordServer::TYPE_CHOGNZHI_FANXIAN,$fanxian,'充值返现',$order['order_id']);
//                            MoneyServer::addRecord($order['user_id'],MoneyServer::CHONG_ZHI_FANXIAN,$fanxian,'充值返现',null);
                        }
                    }
                }
            }
        }
        if($order['order_prom_type'] == PromTypeEnum::NORMAL){

            IncrementModel::make('users')->addColumnsCondition(array(
                'user_id' => $order['user_id'],
            ))->addData(array(
                'total_amount' => $order['order_amount'],
            ))->execute();

            MoneyServer::handlerOrder($order);
        }
        if($order['order_prom_type'] == PromTypeEnum::NORMAL){
            $list = ListModel::make('order_goods')->addColumnsCondition(array(
                'order_id' => $order['order_id']
            ))->leftJoin('goods','g','t.goods_id = g.goods_id')
                ->leftJoin('users','u','g.admin_uid = u.admin_uid')->select('t.*,u.merchant_ratio,u.user_id admin_to_uid,u.admin_uid')->execute();
            $type_name = '';
            foreach ($list as $item) {
                if($item['card_discount_price'] > 0){
                    $user = UserServer::getUser($order['user_id']);

                    if(UserLevelServer::isGoldedCrad($user)){
                        $type_name = '金卡';
                    }
                    if(UserLevelServer::isBlackCrad($user)){
                        $type_name = '黑卡';
                    }
                    UserGoldRecordServer::addGold($user['user_id'],UserGoldRecordServer::TYPE_ORDER_CART_DISCOUNT_PRICE,$item['card_discount_price'],'订单'.$type_name.'返现',$item['rec_id']);

                }
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
        if($order['order_prom_type'] == PromTypeEnum::GROUP_OPNE || $order['order_prom_type'] == PromTypeEnum::GROUP_JOIN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_OPEN
            || $order['order_prom_type'] == PromTypeEnum::GROUP_OWN_JOIN){
            GroupOneServer::instance()->handler($order);
        }
        return true;
    }
}