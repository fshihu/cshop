<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 0:51
 */

namespace module\member\money\server;


use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use module\cart\index\server\PromTypeEnum;
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;

class MoneyServer
{
    const GROUP_BUY_RETURNED = 1;//团购退回
    const PROFIT_PRICE = 2;//合伙人获得的佣金
    const SERVICE_SUBSIDY =3;//服务补贴
    const MARKET_SERVICE_COMMISSION = 4;//服务预约佣金
    const RETURN_MONEY = 5;//退款金额
    const ORDER_GOLD_CART_DISCOUNT_PRICE  = 6;//金卡返现
    const ORDER_BLACK_CART_DISCOUNT_PRICE  = 6;//黑卡返现
    public static function addRecord($uid, $type, $money, $content, $data_id)
    {
        $user =    ItemModel::make('users')->addColumnsCondition(array(
                    'user_id' => $uid,
                ))->execute();

        InsertModel::make('user_money_record')->addData(array(
            'uid' => $uid,
            'money' => $money,
            'cur_money' => $user['user_money'] + $money,
            'content' => $content,
            'data_id' => $data_id,
            'type' => $type,
            'crate_time' => time(),
        ))->execute();
        UpdateModel::make('users')->addData(array(
            'user_money' => $user['user_money'] + $money
        ))->addColumnsCondition(array(
            'user_id' => $uid
        ))->execute();
    }

    public static function handlerOrder($order)
    {
        if($order['order_prom_type'] == PromTypeEnum::NORMAL){
            $list = ListModel::make('order_goods')->addColumnsCondition(array(
                'order_id' => $order['order_id']
            ))->leftJoin('goods','g','t.goods_id = g.goods_id')
                ->leftJoin('users','u','g.admin_uid = u.admin_uid')->select('t.*,u.merchant_ratio,u.user_id admin_to_uid,u.admin_uid')->execute();
            $order['integral_money'];
            $order['total_amount'];
            $order['order_amount'];
            /*
             * 例子：管理员后台设置合伙人佣金比例为10%，合伙人a，上传一款产品g，进货价设置50，商品价格设置100，金牌用户b，有足够积分（抵扣10%），购买了一件产品a，则：
             用户实际支付：100*（1-10%）=90
             商品利润：90-50=40
             合伙人获得佣金：40*10%=4
             */
            $good_count = count($list);
            $user = UserServer::getUser($order['user_id']);

            foreach ($list as $item) {
                //cost_price
                if($item['admin_uid']){

                    //goods_price
                    $gold_price = (int)($order['integral_money'] / $good_count);
                    $profit_price = $item['goods_price'] - $gold_price - $item['cost_price'];
                    $profit_price = $profit_price *  $item['merchant_ratio'] / 100 + $item['cost_price'] - $item['card_discount_price'];
                    if($profit_price > 0){
                        MoneyServer::addRecord($item['admin_to_uid'],MoneyServer::PROFIT_PRICE,$profit_price,'合伙人佣金',$item['rec_id']);
                    }
                }
            }

        }
    }
}