<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 18:09
 */

namespace module\groupon\index;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CRequest;

class GrouponIndexDetWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $group_buy = ItemModel::make('group_buy')->addColumnsCondition(array(
            'id' => $request->getParams('id'),
        ))->execute();
        $data = ItemModel::make('goods')->addColumnsCondition(array(
            'goods_id' => $group_buy['goods_id'],
        ))->execute();
        $goods_images = ListModel::make('goods_images')->addColumnsCondition(array(
            'goods_id' => $group_buy['goods_id'],
        ))->execute();

        return new \CRenderData(array(
            'group_buy' => $group_buy,
            'data' => $data,
            'comment_list' => [],
            'goods_images' => $goods_images,
        ));
    }
}