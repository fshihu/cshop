<?php
/**
 * User: fu
 * Date: 2017/9/28
 * Time: 23:51
 */

namespace module\cart\index\server;


use biz\Session;
use CC\db\base\select\ListModel;

class CartServer
{
    public static function getListByIds($prom_type, $ids)
    {
        return self::getList($prom_type, $ids);
    }

    protected static function getList($prom_type, $ids = null)
    {
        $list_mode = ListModel::make('cart');
        $conditon = array(
            'user_id' => Session::getUserID(),
            't.prom_type' => $prom_type,
        );
        if ($ids) {
            $conditon['t.id'] = ['in', $ids];
        }
        $list_mode->addColumnsCondition($conditon)
            ->select('
            t.id,t.goods_id,t.goods_num,t.spec_key,t.prom_type,t.prom_id,
            g.goods_name,g.shop_price,g.original_img,
            sgp.key_name spec_key_name')
            ->leftJoin('goods', 'g', 't.goods_id = g.goods_id')
            ->leftJoin('spec_goods_price', 'sgp', 't.goods_id = sgp.goods_id and t.spec_key = sgp.key');
        if ($prom_type == PromTypeEnum::GROUP_OPNE) {
            $list_mode->leftJoin('group_buy', 'gb', 't.prom_id = gb.id')->addSelect('gb.price group_price');
        }else if($prom_type == PromTypeEnum::GROUP_JOIN){
            $list_mode->leftJoin('group_one','go','t.prom_id = go.id')->leftJoin('group_buy', 'gb', 'go.group_buy_id = gb.id')->addSelect('gb.price group_price');
        }
        $list = $list_mode->execute();
        if ($prom_type) {
            foreach ($list as $i => $item) {
                $list[$i]['shop_price'] = $item['group_price'];
            }
        }
        return $list;
    }

    public static function getMyList($prom_type)
    {
        return self::getList($prom_type);
    }
}