<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 11:53
 */

namespace module\groupon\my;


use app\admin\controller\Order;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use CErrorException;
use CRequest;
use module\cart\index\server\OrderStatusServer;
use module\cart\index\server\PromTypeEnum;
use module\member\money\server\MoneyServer;

class GrouponMyRaffleWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $order = ItemModel::make('order')->addColumnsCondition(array(
            'order_id' => $request->getParams('order_id'),
        ))->execute();
        $group_one_members = ListModel::make('group_one_member')->addColumnsCondition(array(
            't.group_one_id' => $order['order_prom_id'],
        ))->select('t.*,u.nickname,u.head_pic')->leftJoin('users','u','t.uid = u.user_id')->execute();

        if($request->getParams('start')){
            $group_one = ItemModel::make('group_one')->addId($order['order_prom_id'])->execute();
            if($group_one['is_clearing']){
                throw new CErrorException('已抽奖');
            }
            $win_i = mt_rand(0,count($group_one_members) - 1);;
            $win_item = $group_one_members[$win_i];
            UpdateModel::make('group_one_member')->addData(array(
                'is_win' => 1,
            ))->addId($win_item['id'])->execute();
            UpdateModel::make('group_one')->addId($order['order_prom_id'])
                ->addData(array(
                    'is_clearing' => 1,
                    'win_uid' => $win_item['uid'],
                ))->execute();

            $order_list = ListModel::make('order')->addColumnsCondition(array(
                'order_prom_type' => ['in',[PromTypeEnum::GROUP_JOIN,PromTypeEnum::GROUP_OPNE]],
                'order_prom_id' => $order['order_prom_id'],
            ))->execute();
            foreach ($order_list as $item) {
                if($item['user_id'] == $win_item['uid']){
                    $order = $item;
                }else{
                    MoneyServer::addRecord($item['user_id'],MoneyServer::GROUP_BUY_RETURNED,$item['order_amount'],'拼团失败，退回支付款',$item['order_id']);
                }
            }

            UpdateModel::make('order')->addData(array(
                'is_show' => 1,
            ))->addColumnsCondition(array(
                'order_id' => $order['order_id']
            ))->execute();

            OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_PAYED);
            return new \CJsonData(array(
                'win_i' => $win_i,
                'win_name' => $win_item['nickname'],
            ));
        }

        return new \CRenderData(array(
            'group_one_members' => $group_one_members,
        ));
    }
    protected function getIsOpenTransaction()
    {
        return true;
    }
}