
    <!--搜索栏-s-->
<div class="page   weui-tab__panel  " style="padding-bottom:92px;height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">我的购物车</p>
                        </div>
                    </div>

                </div>
         <div class="  weui-panel_access  "  >

             <div class="addr_info">
                 <a href="<?php echo $this->genurl('member/addr/index'); ?>">
                     <div class="no_addr">
                         请填写收货地址
                     </div>

                 </a>
             </div>
             <div class="addr_info">
                  <div class="weui-cell weui-cell_access" href="javascript:;">
                                 <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/coordinates_icon.png" alt="" style="width:18px;margin-right:30px;margin-left:15px;display:block"></div>
                                 <div class="weui-cell__bd">
                                     <div class="t1">
                                                             <span class="t1_s">代代</span>
                                                             <span class="t1_m">18789836748</span>
                                                         </div>
                                                         <div class="t2">
                                                             四川 成都 金牛区 红旗大道46号
                                                         </div>

                                 </div>
                      <div class="weui-cell__ft"></div>
                             </div>
             </div>
            <div class="weui-panel__bd list4 list4_s"  >
                <?php foreach($list as $item):?>
                <div class="list_4s_item">
                    <div  class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img style="" class="weui-media-box__thumb" src="<?php echo $item['original_img'] ?>" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <p class="weui-media-box__desc">
                                <?php echo $item['goods_name'] ?>
                            </p>
                            <p class="t1">价格：¥<?php echo $item['shop_price'] ?></span></p>
                        </div>

                    </div>
                    <div class="buy_num_w">
                        <span class="fl">数量</span>
                        <span class="fr">
                            <span class="jian no_ac"></span>
                            <input type="text" class="text" value="<?php echo $item['goods_num'] ?>"/>
                            <span class="jia"></span>
                        </span>
                    </div>

                </div>
                <?php endforeach?>


             </div>


             <div class="buy_price">
                 <div class="buy_jifen">
                     使用0积分,抵扣0元
                 </div>
                 <div class="buy_btn_w">
                     <span class="price">应支付： <span class="price_red">￥65.9 （免运费）</span></span>
                     <span class="weui-btn weui-btn_mini weui-btn_warn buy_btn_red">立即支付</span>
                 </div>
             </div>
                    </div>


     </div>

</div>
