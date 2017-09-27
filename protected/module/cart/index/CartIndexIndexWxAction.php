<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 18:17
 */

namespace module\cart\index;


use biz\Session;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CRequest;

class CartIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $addr_condition = array(
            'user_id' => Session::getUserID(),
        );
        if($request->getParams('sel_addr_id')){
            $addr_condition['address_id'] = $request->getParams('sel_addr_id');
        }else{
            $addr_condition['is_default'] = 1;
        }
        $addr = ItemModel::make('user_address')
            ->select('t.*,p.name p_name,c.name c_name,d.name d_name')
            ->leftJoin('region','p','t.province = p.id')
            ->leftJoin('region','c','t.city = c.id')
            ->leftJoin('region','d','t.district = d.id')
            ->addColumnsCondition($addr_condition)->execute();

        $list_mode = ListModel::make('cart');
        $prom_type = $request->getParams('prom_type', 0);
        $list_mode->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            't.prom_type' => $prom_type,
        ))->select('t.*,g.goods_name,g.original_img,sgp.key_name,g.shop_price')->leftJoin('goods','g','t.goods_id = g.goods_id')
            ->leftJoin('spec_goods_price','sgp','t.goods_id = sgp.goods_id and t.spec_key = sgp.key');
       if($prom_type){
           $list_mode->leftJoin('group_buy','gb','t.prom_id = gb.id')->addSelect('gb.price group_price');
       }
        $list = $list_mode->execute();
       if($prom_type){
           foreach ($list as $i => $item) {
               $list[$i]['shop_price'] = $item['group_price'];
          }
       }

        return new \CRenderData(array(
            'list' => $list,
            'addr' => $addr,
        ));
    }
}