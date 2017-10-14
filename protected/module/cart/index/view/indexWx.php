
    <!--搜索栏-s-->
<div class="page   weui-tab__panel  " style="padding-bottom:92px;height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php use CC\util\number\NumberUtil;
                         use module\cart\index\server\PromTypeEnum;
                         use module\goods\server\GoodsServer;
                         use module\member\gold\server\GoldServer;

                         echo $this->genurl('member/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php echo $this->getPageTitle() ?></p>
                        </div>
                    </div>

                </div>
         <div class="  weui-panel_access  "  >

              <?php if($addr):?>
                  <div class="addr_info">
                       <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('member/addr/index',['is_sel'=>1,'prom_type'=>$prom_type]); ?>">
                                      <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/coordinates_icon.png" alt="" style="width:18px;margin-right:30px;margin-left:15px;display:block"></div>
                                      <div class="weui-cell__bd">
                                          <div class="t1">
                                                                  <span class="t1_s"><?php echo $addr['consignee'] ?></span>
                                                                  <span class="t1_m"><?php echo $addr['mobile'] ?></span>
                                                              </div>
                                                              <div class="t2">
                                                                  <?php echo $addr['p_name'] ?>
                                              <?php echo $addr['c_name'] ?>
                                              <?php echo $addr['d_name'] ?>
                                              <?php echo $addr['address'] ?>
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
                <?php $total_price = 0;$ids = ''; ?>
                <?php foreach($list as $item):?>
                <div class="list_4s_item">
                    <div  class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img style="" class="weui-media-box__thumb" src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <p class="weui-media-box__desc">
                                <?php echo $item['goods_name'] ?>
                            </p>
                            <p class="t1">价格：¥<?php echo $item['shop_price'] ?></span></p>
                        </div>

                    </div>
                    <div class="buy_num_w" data-price="<?php echo $item['shop_price'] ?>" style="<?php echo $prom_type == PromTypeEnum::GROUP_OWN_JOIN?'display:none;':'' ?>">
                        <span class="fl">数量</span>
                        <span class="fr">
                            <span class="jian no_ac"></span>
                            <input type="text" class="text" value="<?php echo $item['goods_num'] ?>"/>
                            <span class="jia"></span>
                        </span>
                    </div>

                </div>
                    <?php $total_price += $item['shop_price']*$item['goods_num'];
                    $ids .= ','.$item['id'];?>
                <?php endforeach?>


             </div>

              <?php if(!empty($list) && ($prom_type == PromTypeEnum::GROUP_OWN_OPEN || $prom_type == PromTypeEnum::GROUP_OWN_JOIN)):?>
             <div class="row-group  row-group-form_name  clearfix" style="background: #fff;border-top: 1px solid #dbdbdb; "><label class="data-label">
                     <span>开团人数：</span>
                 </label>
                 <div class="data-group data-group-form_name">
                      <?php if($prom_type == PromTypeEnum::GROUP_OWN_JOIN):?>
                          <?php echo $item['total_num'] ?>
                       <?php else:?>
                          <input type="text" id="form_renshu" value="1" class="" placeholder="请输入人数"
                                  >
                      <?php endif;?>
                 </div>
             </div>
             <div class="row-group  row-group-form_name  clearfix" style="background: #fff;margin-bottom:10px;border-bottom: 1px solid #dbdbdb;
border-top: 1px solid #dbdbdb;"><label class="data-label">
                     <span>人均支付：</span>
                 </label>
                 <div class="data-group data-group-form_name">
                     <span class="price_renjun"><?php echo $total_price ?></span>
                 </div>
             </div>
              <?php endif;?>

             <?php if(!empty($list)):?>
             <div class="buy_price">
                  <?php if($prom_type == PromTypeEnum::NORMAL):?>
                 <div class="buy_jifen">
                     <span class="checkbox jifen_check" style="vertical-align: middle;"></span>
                     <span class="jf_w" style="display: inline-block;vertical-align: middle;">
                         使用<span class="total_gold"><?php $total_gold = GoldServer::getGold();
                                                  $goldRatio = GoldServer::getGoldRatio();
                                                  $gold = min($total_gold, (int)($total_price* $goldRatio));
                                                                       echo $gold ?></span>积分,抵扣<span class="gold_price"><?php echo $gold ?></span>元
                     </span>
                 </div>
                  <?php endif;?>

                 <div class="buy_btn_w">
                     <span class="price">应支付： <span class="price_red">￥<span class="price_renjun"><?php echo $total_price?></span> （免运费）</span></span>

                     <a href="#" class="weui-btn weui-btn_mini weui-btn_warn buy_btn_red ">立即支付</a>
                 </div>
             </div>
              <?php endif;?>

                    </div>


     </div>

</div>
    <script type="text/javascript">
        var url = '<?php echo $this->genurl('cart/index/confirm',array('address_id' => $addr['address_id'],'prom_type'=>$prom_type,'cart_ids'=>$ids)); ?>';
        var tpl_url = url;
        var total_price = <?php echo $total_price ?>;
        var total_gold = <?php echo $total_gold ?>;
        var goldRatio = <?php echo $goldRatio ?>;
        $('.buy_btn_red ').click(function () {
            var s = <?php echo (int)$addr['address_id'] ?>;
            $(this).attr('href',url);
           if(!s){
               alert('请填写收货地址');
               return false;
           }
        });
        $('#form_renshu').keyup(function () {
            var val = $(this).val();
            if(val <= 0){
                $(this).val('');
                val = 1;
            }
            url = tpl_url+'&total_person_num='+ val;
            $('.price_renjun').text((total_price/val).toFixed(2));
        });
        $('.jia,.jian').click(function () {
            setTimeout(function () {
                var total_price = 0;
                $('.list4_s').find('.buy_num_w .text').each(function () {
                    total_price += $(this).val()*$(this).closest('.buy_num_w').data('price');
                });
                var gold = Math.min(total_gold,parseInt(total_price * goldRatio,10));
                $('.total_gold').text(gold);
                $('.gold_price').text(gold);
                if($('.buy_jifen .checkbox').hasClass('checkboxed')){
                    total_price -= $('.gold_price').text()*1;
                }

                $('.price_renjun').text(total_price);
            },20);

        });
        $('.jifen_check').click(function () {
            var ratio = <?php echo GoldServer::getGoldRatio() ?>;
            console.log(ratio);
            if($(this).hasClass('checkboxed')){
                url = tpl_url +'&use_gold=0';
                $(this).removeClass('checkboxed');
                $('.price_renjun').text($('.price_renjun').text()*1+$('.gold_price').text()*1);
            }else{
                url = tpl_url +'&use_gold=1';
                $('.price_renjun').text($('.price_renjun').text()*1-$('.gold_price').text()*1);
                $(this).addClass('checkboxed');
            }
        });
    </script>