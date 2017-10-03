<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 11:53
 */

namespace module\groupon\my;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
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
        return new \CRenderData(array(
            'group_one_members' => $group_one_members,
        ));
    }
}