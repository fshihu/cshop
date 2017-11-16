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
        $id = $request->getParams('id');
        $data = ItemModel::make('goods')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        $goods_images = ListModel::make('goods_images')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        $spec_goods_prices = ListModel::make('spec_goods_price')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->execute();
        $specs = ListModel::make('spec')->addColumnsCondition(array(
            'type_id' => $data['goods_type'],
        ))->execute();
        $spec_items = ListModel::make('spec_item')->addColumnsCondition(array(
            'spec_id' => ['in',ArrayUtil::arrayColumn($specs)],
        ))->execute();
        $comment_list = ListModel::make('comment')->addColumnsCondition(array(
            'goods_id' => $id,
        ))->leftJoin('users','u','t.user_id = u.user_id')->order('t.comment_id desc')
            ->select('t.content comment_content,t.rating,t.add_time comment_time,u.nickname uname,u.head_pic ')->execute();
        return new \CRenderData(array(
            'data' => $data,
            'goods_images' => $goods_images,
            'comment_list' => $comment_list,
            'spec_goods_prices' => ArrayUtil::arrayFillKey($spec_goods_prices,'key'),
            'specs' => $specs,
            'spec_items' => $spec_items,
        ));
    }
}