<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:06
 */

namespace module\cart\index\server;


use biz\Session;
use CC\db\base\delete\DeleteModel;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;

class OrderServer
{
    protected $address_id;
    protected $prom_type;
    protected $cart_ids;
    protected $cart_list = [];
    public static function instance($address_id,$prom_type,$cart_ids)
    {
        $obj = new static();
        $obj->address_id = $address_id;
        $obj->prom_type = $prom_type;
        $obj->cart_ids = $cart_ids;
        return $obj;
    }
    public  function addOrder()
    {
        $this->cart_list = CartServer::getListByIds($this->prom_type,$this->cart_ids);
        $car_price = $this->calculatePrice();
        $order_id = $this->addOrderInfo($car_price);
        $this->addOrderGoods($order_id);
        return $order_id;
    }

    private function calculatePrice()
    {
        $car_price['goodsFee'] = 0;//'商品价格'
        $car_price['postFee'] = 0;//'物流价格',
        $car_price['balance'] = 0;//'使用余额',
        $car_price['couponFee'] = 0;//'使用优惠
        $car_price['integral'] = 0;//'使用积分
        $car_price['pointsFee'] =0;//'使用积分抵扣机内
        $car_price['payables'] = 0;//'应付款金额
        $car_price['order_prom_id'] = 0;
        $car_price['order_prom_amount'] = 0;
        foreach ($this->cart_list as $cart) {
            $car_price['goodsFee'] += $cart['shop_price'];
        }
        return $car_price;
    }
    
    private  function addOrderInfo($car_price)
    {
        $user_id = Session::getUserID();
        $address = ItemModel::make('user_address')->addColumnsCondition(["address_id"=>$this->address_id])->execute();
        $shipping_code = 0;
        $user_note = '';
        $pay_name = '微信支付';
        $data = array(
            'order_sn'         => date('YmdHis').rand(1000,9999), // 订单编号
            'user_id'          =>$user_id, // 用户id
            'consignee'        =>$address['consignee'], // 收货人
            'province'         =>$address['province'],//'省份id',
            'city'             =>$address['city'],//'城市id',
            'district'         =>$address['district'],//'县',
            'twon'             =>$address['twon'],// '街道',
            'address'          =>$address['address'],//'详细地址',
            'mobile'           =>$address['mobile'],//'手机',
            'zipcode'          =>$address['zipcode'],//'邮编',
            'email'            =>$address['email'],//'邮箱',
            'shipping_code'    =>$shipping_code,//'物流编号',
            'shipping_name'    =>'', //'物流名称',                为照顾新手开发者们能看懂代码，此处每个字段加于详细注释
            'invoice_title'    =>'', //'发票抬头',
            'goods_price'      =>$car_price['goodsFee'],//'商品价格',
            'shipping_price'   =>$car_price['postFee'],//'物流价格',
            'user_money'       =>$car_price['balance'],//'使用余额',
            'coupon_price'     =>$car_price['couponFee'],//'使用优惠券',
            'integral'         =>$car_price['integral'], //'使用积分',
            'integral_money'   =>$car_price['pointsFee'],//'使用积分抵多少钱',
            'total_amount'     =>($car_price['goodsFee'] + $car_price['postFee']),// 订单总额
            'order_amount'     =>$car_price['payables'],//'应付款金额',
            'add_time'         =>time(), // 下单时间
            'order_prom_id'    =>$car_price['order_prom_id'],//'订单优惠活动id',
            'order_prom_amount'=>$car_price['order_prom_amount'],//'订单优惠活动优惠了多少钱',
            'user_note'        =>$user_note, // 用户下单备注
            'pay_name'         =>$pay_name,//支付方式，可能是余额支付或积分兑换，后面其他支付方式会替换
        );
        return InsertModel::make('order')->addData($data)->execute();

    }

    protected function addOrderGoods($order_id)
    {
        foreach($this->cart_list as $key => $val)
        {
            $data2['order_id']           = $order_id; // 订单id
            $data2['goods_id']           = $val['goods_id']; // 商品id
            $data2['goods_name']         = $val['goods_name']; // 商品名称
            $data2['goods_sn']           = $val['goods_sn']; // 商品货号
            $data2['goods_num']          = $val['goods_num']; // 购买数量
            $data2['market_price']       = $val['market_price']; // 市场价
            $data2['goods_price']        = $val['goods_price']; // 商品价               为照顾新手开发者们能看懂代码，此处每个字段加于详细注释
            $data2['spec_key']           = $val['spec_key']; // 商品规格
            $data2['spec_key_name']      = $val['spec_key_name']; // 商品规格名称
            $data2['member_goods_price'] = $val['member_goods_price']; // 会员折扣价
            $data2['cost_price']         = $val['cost_price']; // 成本价
            $data2['give_integral']      = $val['give_integral']; // 购买商品赠送积分
            $data2['prom_type']          = $val['prom_type']; // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            $data2['prom_id']            = $val['prom_id']; // 活动id
            InsertModel::make('order_goods')->addData($data2)->execute();
            // 扣除商品库存  扣除库存移到 付完款后扣除
            //M('Goods')->where("goods_id = ".$val['goods_id'])->setDec('store_count',$val['goods_num']); // 商品减少库存
        }
        DeleteModel::make('cart')->addColumnsCondition(array(
            'id' => ['in',$this->cart_ids],
        ))->execute();
    }
}