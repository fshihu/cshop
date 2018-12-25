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
use module\cart\index\server\CartServer;
use module\cart\index\server\PromTypeEnum;

class CartIndexIndexWxAction extends \CAction
{
    public $prom_type = 0;
    public $is_buy_now = 0;
    public $goods_id = 0;
    public function getPageTitle()
    {
        if($this->prom_type == PromTypeEnum::GROUP_OWN_OPEN){
            return '自主建团';
        }
        if($this->prom_type == PromTypeEnum::GROUP_OPNE){
            return '一键开团';
        }
        if($this->is_buy_now){
            return  '立即购买';
        }
        return '我的购物车';
    }

    protected function getHasDel()
    {
        if($this->prom_type){
            return false;
        }
        if($this->is_buy_now){
            return  false;
        }
        return true;
    }

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

        $prom_type = $request->getParams('prom_type', 0);
        $ids = null;
        if($this->goods_id && $this->is_buy_now){
            $cart = ItemModel::make('cart')->addColumnsCondition(array(
                'goods_id' => $this->goods_id,
                'user_id' => Session::getUserID(),
                'prom_type' => $prom_type,
            ))->order('id desc')->execute();
            $ids = [$cart['id']];
        }
        return new \CRenderData(array(
            'list' => CartServer::getListByIds($prom_type,$ids),
            'addr' => $addr,
            'prom_type' => $prom_type,
            'has_del' => $this->getHasDel(),
        ));
    }
}