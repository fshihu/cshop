
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

              <?php if($addr):?>
                  <div class="addr_info">
                       <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('member/addr/index'); ?>">
                                      <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/coordinates_icon.png" alt="" style="width:18px;margin-right:30px;margin-left:15px;display:block"></div>
                                      <div class="weui-cell__bd">
                                          <div class="t1">
                                                                  <span class="t1_s"><?php echo $addr['consignee'] ?></span>
                                                                  <span class="t1_m"><?php echo $addr['mobile'] ?></span>
                                                              </div>
                                                              <div class="t2">
                                                                  <?php echo $item['p_name'] ?>
                                              <?php echo $item['c_name'] ?>
                                              <?php echo $item['d_name'] ?>
                                              <?php echo $item['address'] ?>
                                                              </div>

                                      </div>
                           <div class="weui-cell__ft"></div>
                                  </a>
                  </div>
               <?php else:?>
                  <div class="addr_info">
                       <?php if(empty($list)):?>
                           <div style="padding: 40px;">
                               暂无数据
                           </div>
                        <?php else:?>
                           <a href="<?php echo $this->genurl('member/addr/index'); ?>">
                               <div class="no_addr">
                                   请填写收货地址
                               </div>

                           </a>
                       <?php endif;?>
                  </div>
              <?php endif;?>
            <div class="weui-panel__bd list4 list4_s"  >
                <?php $total_price = 0; ?>
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
                    <?php $total_price += $item['shop_price']*$item['goods_num'] ?>
                <?php endforeach?>


             </div>


              <?php if(!empty($list)):?>
             <div class="buy_price">
                 <div class="buy_jifen">
                     使用0积分,抵扣0元
                 </div>
                 <div class="buy_btn_w">
                     <span class="price">应支付： <span class="price_red">￥ <?php echo $total_price ?> （免运费）</span></span>
                     <a href="<?php echo $this->genurl('pay/index/index'); ?>" class="weui-btn weui-btn_mini weui-btn_warn buy_btn_red">立即支付</a>
                 </div>
             </div>
              <?php endif;?>

                    </div>


     </div>

</div>
