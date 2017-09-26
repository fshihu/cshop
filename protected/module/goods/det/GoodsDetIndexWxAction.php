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
        return new \CRenderData(array(
            'data' => $data,
            'goods_images' => $goods_images,
            'comment_list' => [],
        ));
    }
}