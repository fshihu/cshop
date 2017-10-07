<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 11:53
 */

namespace module\groupon\my;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use CRequest;

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
            $win_i = mt_rand(0,count($group_one_members) - 1);;
            $win_item = $group_one_members[$win_i];
            UpdateModel::make('group_one_member')->addData(array(
                'is_win' => 1,
            ))->addId($win_item['id'])->execute();
            UpdateModel::make('group_one')->addId($order['order_prom_id'])
                ->addData(array(
                    'is_clearing' => 1,
                ))->execute();
            return new \CJsonData(array(
                'win_i' => $win_i,
                'win_name' => $win_item['nickname'],
            ));
        }

        return new \CRenderData(array(
            'group_one_members' => $group_one_members,
        ));
    }
}