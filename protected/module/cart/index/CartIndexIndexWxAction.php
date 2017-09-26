<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 18:17
 */

namespace module\cart\index;


use biz\Session;
use CC\db\base\select\ListModel;
use CRequest;

class CartIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $list = ListModel::make('cart')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->select('t.*,g.goods_name,g.original_img,sgp.key_name,g.shop_price')->leftJoin('goods','g','t.goods_id = g.goods_id')
            ->leftJoin('spec_goods_price','sgp','t.goods_id = sgp.goods_id and t.spec_key = sgp.key')->execute();
        return new \CRenderData(array(
            'list' => $list,
        ));
    }
}