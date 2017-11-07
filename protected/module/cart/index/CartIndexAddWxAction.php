<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 0:46
 */

namespace module\cart\index;


use biz\Session;
use CC\db\base\delete\DeleteModel;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CRequest;

class CartIndexAddWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $goods_id = $request->getParams('goods_id');
        $spec_key = $request->getParams('spec_key','');
        $prom_type = $request->getParams('prom_type',0);
        $prom_id = $request->getParams('prom_id',0);
        if($prom_type){
            DeleteModel::make('cart')->addColumnsCondition(array(
                'user_id' => Session::getUserID(),
                'prom_type' => $prom_type,
            ))->execute();
        }
        $old = ItemModel::make('cart')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'goods_id' => $goods_id,
            'spec_key' => $spec_key,
            'prom_type' => $prom_type,
            'prom_id' => $prom_id,
        ))->execute();
        if($old){
            return new \CJsonData();
        }
        InsertModel::make('cart')->addData(array(
            'user_id' => Session::getUserID(),
            'session_id' => session_id(),
            'goods_id' => $goods_id,
            'goods_num' => $request->getParams('goods_num'),
            'spec_key' => $spec_key,
            'add_time' => time(),
            'prom_type' => $prom_type,
            'prom_id' => $prom_id,
        ))->execute();
        return new \CJsonData();
    }
}