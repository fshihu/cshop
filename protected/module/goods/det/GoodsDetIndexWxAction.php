<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 18:14
 */

namespace module\goods\det;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\util\arr\ArrayUtil;
use CRequest;

class GoodsDetIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        $data = ItemModel::make('goods','tp_')->addColumnsCondition(array(
            'goods_id' => $request->getParams('id'),
        ))->execute();
        $goods_images = ListModel::make('goods_images','tp_')->addColumnsCondition(array(
            'goods_id' => $request->getParams('id'),
        ))->execute();
        $spec_goods_prices = ListModel::make('spec_goods_price','tp_')->addColumnsCondition(array(
            'goods_id' => $request->getParams('id'),
        ))->execute();
        $specs = ListModel::make('spec','tp_')->addColumnsCondition(array(
            'type_id' => $data['goods_type'],
        ))->execute();
        $spec_items = ListModel::make('spec_item','tp_')->addColumnsCondition(array(
            'spec_id' => ['in',ArrayUtil::arrayColumn($specs)],
        ))->execute();

        return new \CRenderData(array(
            'data' => $data,
            'goods_images' => $goods_images,
            'comment_list' => [],
            'spec_goods_prices' => ArrayUtil::arrayFillKey($spec_goods_prices,'key'),
            'specs' => $specs,
            'spec_items' => $spec_items,
        ));
    }
}