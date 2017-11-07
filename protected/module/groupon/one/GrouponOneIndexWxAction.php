<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:45
 */

namespace module\groupon\one;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CRequest;

class GrouponOneIndexWxAction extends \CAction
{
    public $group_one_id;
    public function execute(CRequest $request)
    {
        $group_one = ItemModel::make('group_one')->addId($this->group_one_id)->execute();
        $group_buy = ItemModel::make('group_buy')->addColumnsCondition(array(
            'id' => $group_one['group_buy_id'],
        ))->execute();
        $data = ItemModel::make('goods')->addColumnsCondition(array(
            'goods_id' => $group_one['goods_id'],
        ))->execute();
        $group_one_members = ListModel::make('group_one_member')->addColumnsCondition(array(
            't.group_one_id' => $this->group_one_id,
        ))->select('t.*,u.nickname,u.head_pic')->leftJoin('users','u','t.uid = u.user_id')->execute();
        return new \CRenderData(array(
            'group_one' => $group_one,
            'data' => $data,
            'group_one_members' => $group_one_members,
            'group_buy' => $group_buy,
        ));
    }
}
