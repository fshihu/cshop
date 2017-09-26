<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 0:46
 */

namespace module\cart\index;


use biz\Session;
use CC\db\base\insert\InsertModel;
use CRequest;

class CartIndexAddWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $goods_id = $request->getParams('goods_id');
        $spec_key = $request->getParams('spec_key');

        InsertModel::make('cart','tp_')->addData(array(
            'user_id' => Session::getUserID(),
            'session_id' => session_id(),
            'goods_id' => $goods_id,
            'spec_key' => $spec_key,
            'add_time' => time(),
        ))->execute();
        return new \CJsonData();
    }
}