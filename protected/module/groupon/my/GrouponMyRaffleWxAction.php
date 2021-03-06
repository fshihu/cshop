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
use module\basic\phone\server\PhoneServer;
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
        $order_list = ListModel::make('order')->addColumnsCondition(array(
            'order_prom_type' => ['in',[PromTypeEnum::GROUP_OWN_JOIN,PromTypeEnum::GROUP_OWN_OPEN]],
            'order_prom_id' => $order['order_prom_id'],
        ))->execute();

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
                'order_prom_type' => ['in',[PromTypeEnum::GROUP_OWN_JOIN,PromTypeEnum::GROUP_OWN_OPEN]],
                'order_prom_id' => $order['order_prom_id'],
            ))->execute();
            $goods = ItemModel::make('goods')->addColumnsCondition(array('goods_id' => $group_one['goods_id']))->execute();

            foreach ($order_list as $item) {
                if($item['user_id'] == $win_item['uid']){
                    $order = $item;
                }
                try{
                    $goods_name = $goods['goods_name'].',团号：'.$group_one['id'].' ';
                    if($item['user_id'] == $win_item['uid']){
                        PhoneServer::sendMsg($item['mobile'],'恭喜你参与的团购产品'. $goods_name .'成功获得产品');
                    }else{
                        PhoneServer::sendMsg($item['mobile'],'很遗憾你参与的团购产品'.$goods_name.'未获得产品');
                    }
                }catch (\Exception $e){

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
            'order_list' => $order_list,
        ));
    }
    protected function getIsOpenTransaction()
    {
        return true;
    }
}