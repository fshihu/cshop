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
        ))->leftJoin('goods','g','t.goods_id = g.goods_id')->execute();
        foreach ($list as $item) {

        }

        return new \CRenderData();
    }
}