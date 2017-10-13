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
use CC\util\number\NumberUtil;
use module\groupon\index\enum\GroupTypeEnum;

class OrderServer
{
    protected $address_id;
    protected $prom_type;
    protected $cart_ids;
    protected $cart_list = [];
    protected $prom_id = 0;
    protected $total_person_num;
    protected $is_show = 0;
    public static function instance($address_id,$prom_type,$cart_ids,$total_person_num)
    {
        $obj = new static();
        $obj->address_id = $address_id;
        $obj->prom_type = $prom_type;
        $obj->cart_ids = $cart_ids;
        $obj->total_person_num = $total_person_num;
        return $obj;
    }
    public  function addOrder()
    {
        $this->cart_list = CartServer::getListByIds($this->prom_type,$this->cart_ids);
        $car_price = $this->calculatePrice();
        $this->genPromid($car_price);
        $this->genIsShow();
        $order_id = $this->addOrderInfo($car_price);
        $this->addOrderGoods($order_id);
        return $order_id;
    }

    protected function genIsShow()
    {
        if($this->prom_type == PromTypeEnum::NORMAL) {
            $this->is_show = 1;
        }
    }
    protected function genPromid($car_price)
    {
        if($this->prom_type == PromTypeEnum::GROUP_OPNE||$this->prom_type == PromTypeEnum::GROUP_OWN_OPEN){

            $group_buy_id = 0;
            if($this->prom_type == PromTypeEnum::GROUP_OWN_OPEN){
                $total_num = $this->total_person_num;
                $group_type = GroupTypeEnum::TYPE_OWN;
            }else{
                $group_type = GroupTypeEnum::TYPE_LIMIT;
                $group_buy = ItemModel::make('group_buy')->addId($this->cart_list[0]['prom_id'])->execute();
                $group_buy_id = $group_buy['id'];
                $total_num = $group_buy['goods_num'];
            }
            $id = InsertModel::make('group_one')->addData(array(
                'group_buy_id' => $group_buy_id,
                'goods_id' => $this->cart_list[0]['goods_id'],
                'uid' => Session::getUserID(),
                'total_num' => $total_num,
                'finish_num' => 0,
                'remain_num' => $total_num,
                'crate_time' => time(),
                'is_finish' => 0,
                'pay_status' => 0,
                'group_type' => $group_type,
                'goods_price' => $car_price['goodsFee'],
            ))->execute();
            $this->prom_id = $id;
            InsertModel::make('group_one_member')->addData(array(
                'group_one_id' => $id,
                'uid' => Session::getUserID(),
                'is_leader' => 1,
                'time' => time(),
            ))->execute();

        }else if($this->prom_type == PromTypeEnum::GROUP_JOIN || $this->prom_type == PromTypeEnum::GROUP_OWN_JOIN){
            $this->prom_id = $this->cart_list[0]['prom_id'];
        }
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
        $car_price['order_prom_id'] = $this->prom_id;
        $car_price['order_prom_type'] = $this->prom_type;
        $car_price['order_prom_amount'] = 0;
        foreach ($this->cart_list as $cart) {
            $car_price['goodsFee'] += $cart['shop_price'];
        }
        if($this->prom_type == PromTypeEnum::GROUP_OWN_OPEN){
            $car_price['goodsFee'] =  NumberUtil::formatFloat(($car_price['goodsFee'] / $this->total_person_num));
        }
        $car_price['payables'] = $car_price['goodsFee'];
        return $car_price;
    }

    public static function getOrderSn()
    {
        return date('YmdHis').rand(1000,9999);
    }

    public static function addOrderBaseInfo($user_id,$order_amount,$order_prom_type,$order_prom_id)
    {
        $data =  array(
            'order_sn'         => self::getOrderSn(), // 订单编号
            'user_id'          =>$user_id, // 用户id
            'order_amount'          =>$order_amount, // 用户id
            'order_prom_type'    =>$order_prom_type,//'订单优惠活动id',
            'order_prom_id'    =>$order_prom_id,//'订单优惠活动id',
            'pay_name'         =>'微信支付',//支付方式，可能是余额支付或积分兑换，后面其他支付方式会替换
            'add_time'         =>time(), // 下单时间
        );
        return InsertModel::make('order')->addData($data)->execute();
    }
    private  function addOrderInfo($car_price)
    {
        $user_id = Session::getUserID();
        $address = ItemModel::make('user_address')->addColumnsCondition(["address_id"=>$this->address_id])->execute();
        $shipping_code = 0;
        $user_note = '';
        $pay_name = '微信支付';
        $data = array(
            'order_sn'         => self::getOrderSn(), // 订单编号
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
            'order_prom_type'    =>$this->prom_type,//'订单优惠活动id',
            'order_prom_id'    =>$this->prom_id,//'订单优惠活动id',
            'order_prom_amount'=>$car_price['order_prom_amount'],//'订单优惠活动优惠了多少钱',
            'is_show' => $this->is_show,
            'total_person_num' => $this->total_person_num,
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
            $data2['goods_price']        = $val['shop_price']; // 商品价               为照顾新手开发者们能看懂代码，此处每个字段加于详细注释
            $data2['spec_key']           = $val['spec_key']; // 商品规格
            $data2['spec_key_name']      = $val['spec_key_name']; // 商品规格名称
            $data2['member_goods_price'] = $val['member_goods_price']; // 会员折扣价
            $data2['cost_price']         = $val['cost_price']; // 成本价
            $data2['give_integral']      = $val['give_integral']; // 购买商品赠送积分
            $data2['prom_type']          = $this->prom_type; // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
            $data2['prom_id']            = $this->prom_id; // 活动id
            $data2['original_img']       = $val['original_img']; // 活动id
            InsertModel::make('order_goods')->addData($data2)->execute();
            // 扣除商品库存  扣除库存移到 付完款后扣除
            //M('Goods')->where("goods_id = ".$val['goods_id'])->setDec('store_count',$val['goods_num']); // 商品减少库存
        }
        DeleteModel::make('cart')->addColumnsCondition(array(
            'id' => ['in',$this->cart_ids],
        ))->execute();
    }
}