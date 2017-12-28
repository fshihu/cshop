
    <!--搜索栏-s-->
<div class="page   weui-tab__panel  " style="padding-bottom:120px;height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php use CC\util\number\NumberUtil;
                         use module\cart\index\server\PromTypeEnum;
                         use module\goods\server\GoodsServer;
                         use module\member\gold\server\GoldServer;
                         use module\member\index\server\UserLevelServer;

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

              <?php if(!empty($list)):?>
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
              <?php endif;?>

            <div class="weui-panel__bd list4 list4_s"  >
                <?php $total_price = 0;$ids = '';$total_freight_price = 0 ;$gold_card_discount_price = 0;$black_card_discount_price = 0;?>
                <?php foreach($list as $item):?>
                <div class="list_4s_item" style="position: relative;">
                     <?php if($has_del):?>
                    <span class="close_xs" data-id="<?php echo $item['id'] ?>" style="z-index:111;position: absolute;color:  red; right:6px;top:-5px;font-size: 22px;">×</span>
                     <?php endif;?>
                    <div  class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img style="" class="weui-media-box__thumb" src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <p class="weui-media-box__desc">
                                <?php echo $item['goods_name'] ?>
                            </p>
                            <p class="t1">价格：¥<?php echo $item['shop_price'] ?></span></p>
							<?php $user = \module\member\index\UserServer::getUser();
                            $discount = 0;
                            if( $user['level']== UserLevelServer::LEVEL_GOLDED_CARD){
                                $discount = $item['gold_card_discount_price'];
                            }
                            if( $user['level']== UserLevelServer::LEVEL_BLACK_CARD){
                                $discount = $item['black_card_discount_price'];
                            }
                        ?>
							<span class="dicount" style='display:none'><?php echo $discount; ?></span>
                        </div>

                    </div>
                    <div class="buy_num_w" data-freight_price="<?php echo $item['freight_price'] ?>" data-id="<?php echo $item['id'] ?>" data-price="<?php echo $item['shop_price'] ?>" data-discount="<?php echo $discount ?>"
                         style="<?php echo in_array($prom_type,[PromTypeEnum::GROUP_OWN_JOIN,PromTypeEnum::GROUP_OWN_OPEN])?'display:none;':'' ?>">
                        <span class="fl">数量</span>
                        <span class="fr">
                            <span class="jian no_ac"></span>
                            <input type="text" class="text" value="<?php echo $item['goods_num'] ?>"/>
                            <span class="jia"></span>
                        </span>
                    </div>

                </div>
                    <?php $total_price += $item['shop_price']*$item['goods_num'] + $item['freight_price'];
                    $total_freight_price += $item['freight_price'];
                    $gold_card_discount_price += $item['gold_card_discount_price'];
                    $black_card_discount_price += $item['black_card_discount_price'];
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
                          <input type="text" id="form_renshu" style="width:50px;text-align: center;" value="1" class="" placeholder="人数"
                                  > 人
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
                  <div style="padding: 15px 35px;color: red;font-size: 12px;">
                      成团后，团长运行随机抽取获得产品人员，并将抽取结果以短信形式通知各位团员
                  </div>
              <?php endif;?>


                    </div>


     </div>

</div>
    <?php if(!empty($list)):?>
    <div class="buy_price" style="z-index:999;">
    	<div class="buy_orderDetail">
        	<div class="buy_orderDetailMt" <?php if($_GET['prom_type']=='5'||$_GET['prom_type']=='6'){?>style='display:none'<?php }?>>
            	<span>账单详情</span>
                <img src="/public/biz/wx/common/images/clickImg1.png"  />
            </div>
            <div class="buy_orderDetailPull">
            	<div class="listDetail">
                    <p>
                        <span class="ltName">应付金额：</span>
                        <span  style='float: right;margin-right: 10px;'>￥<span class="rtPrice1"><?php echo $total_price - $total_freight_price ?></span></span>
                    </p>
                    <p>
                        <span class="ltName">抵扣积分：</span>
                        <span class="rtPrice2" style='float: right;margin-right: 10px;'>0</span>
                    </p>
                    <p>
                        <span class="ltName">运费：</span>
                        <span class="rtPrice3" style='float: right;margin-right: 10px;'>￥<?php echo $total_freight_price ?></span>
						<span class="freight_price" style='display:none'><?php echo $total_freight_price; ?></span>
                    </p>
                    <p>
                        <span class="ltName">实付：</span>
                        <span style='float: right;margin-right: 10px;'>￥<span class="rtPrice4"><?php echo $total_price  ?></span></span>
                    </p>
                </div>
                <div class="listDetail">
                	<p>
                        <span class="ltName">会员返现：</span>
                        <?php $user = \module\member\index\UserServer::getUser();
                            $fan_price = 0;
                            if( $user['level']== UserLevelServer::LEVEL_GOLDED_CARD){
                                $fan_price = $gold_card_discount_price;
                            }
                            if( $user['level']== UserLevelServer::LEVEL_BLACK_CARD){
                                $fan_price = $black_card_discount_price;
                            }
                        ?>
                        <span style='float: right;margin-right: 10px;'>￥ <span class="rtPrice6"><?php echo $fan_price ?></span></span>
                    </p>
                    <p>
                        <span class="ltName">到手价：</span>
                        <span style='float: right;margin-right: 10px;'>￥<span class="rtPrice5"><?php echo $total_price - $fan_price ?></span></span>
                    </p>
                </div>
            </div>
        </div>
         <?php if($prom_type == PromTypeEnum::NORMAL):?>
        <div class="buy_jifen">
            <span class="checkbox jifen_check" style="vertical-align: middle;"></span>
            <span class="jf_w" style="display: inline-block;vertical-align: middle;">
                使用<span class="total_gold"><?php $total_gold = GoldServer::getGold();
                                         $goldRatio = GoldServer::getUseGoldMaxRatio();
                                         $gold = min($total_gold, (int)($total_price* $goldRatio));
                                                              echo $gold ?></span>积分,抵扣<span class="gold_price"><?php echo $gold ?></span>元
            </span>
        </div>
         <?php endif;?>

        <div class="buy_btn_w">
			<a href="#" class="weui-btn weui-btn_mini weui-btn_warn buy_btn_red ">立即支付</a>
            <span class="price" style="padding-left:0px; float:right;">应支付： <span class="price_red">￥<span class="price_renjun"><?php echo $total_price?></span><?php  if($total_freight_price==''||$total_freight_price=='0'){ echo '（免运费）';}else{ echo "（运费 ￥$total_freight_price 元）";} ?> </span></span>
        </div>
    </div>
     <?php endif;?>

    <script type="text/javascript">
		//账单详情
		$(function(){
			$(".buy_orderDetailMt").click(function(){
				$(this).siblings(".buy_orderDetailPull").toggle();
				if($(this).siblings(".buy_orderDetailPull").is(":visible")){
					$(this).find("img").attr("src","/public/biz/wx/common/images/clickImg2.png");
					$(".weui-tab__panel").css("padding-bottom",$(".buy_orderDetailPull").height()+120);
				}else{
					$(this).find("img").attr("src","/public/biz/wx/common/images/clickImg1.png");
					$(".weui-tab__panel").css("padding-bottom","120px");
				}
			});
		});
        $('.close_xs').click(function () {
            ajax_request('<?php echo $this->genurl('del') ?>',{id:$(this).data('id')},function () {
                location.href = '';
            });
        });
        var url = '<?php echo $this->genurl('cart/index/confirm',array('address_id' => $addr['address_id'],'prom_type'=>$prom_type,'cart_ids'=>$ids)); ?>';
        var tpl_url = url;
        var total_price = <?php echo $total_price ?>;
        var total_gold = <?php echo (int)$total_gold ?>;
        var goldRatio = <?php echo (float)$goldRatio ?>;
        $('.buy_btn_red ').click(function () {
            var s = <?php echo (int)$addr['address_id'] ?>;
            var nums = [];
            $('.list_4s_item .buy_num_w ').each(function () {
                nums.push({id:$(this).data('id'),num:$(this).find('.text').val()});
            });
            url += '&nums='+JSON.stringify(nums);
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
				var discount=0;
                $('.list4_s').find('.buy_num_w .text').each(function () {
                    total_price += $(this).val()*$(this).closest('.buy_num_w').data('price');
                    total_price += $(this).closest('.buy_num_w').data('freight_price')*1;
					discount += $(this).val()*$(this).closest('.buy_num_w').data('discount');
                });
				$('.rtPrice6').text(discount);
                var gold = Math.min(total_gold,parseInt(total_price * goldRatio,10));
                $('.total_gold').text(gold);
                $('.gold_price').text(gold);
                if($('.buy_jifen .checkbox').hasClass('checkboxed')){
                    total_price -= $('.gold_price').text()*1;
                }
				$('.rtPrice1').text(total_price);
				//添加运费-柯岳
				$('.rtPrice2').text($('.gold_price').text()*1);
				total_price += $('.freight_price').text()*1;
                $('.price_renjun').text(total_price);
				$('.rtPrice4').text(total_price);
				$('.rtPrice5').text(total_price*1-discount*1);
            },20);

        });
        $('.jifen_check').click(function () {
            var ratio = <?php echo GoldServer::getUseGoldMaxRatio() ?>;
            console.log(ratio);
            if($(this).hasClass('checkboxed')){
                url = tpl_url +'&use_gold=0';
                $(this).removeClass('checkboxed');
                $('.price_renjun').text($('.price_renjun').text()*1+$('.gold_price').text()*1);
				$('.rtPrice2').text($('.rtPrice2').text()*1-$('.gold_price').text()*1);
				$('.rtPrice1').text($('.rtPrice1').text()*1+$('.gold_price').text()*1);
				$('.rtPrice4').text($('.rtPrice4').text()*1+$('.gold_price').text()*1);
				$('.rtPrice5').text($('.rtPrice5').text()*1+$('.gold_price').text()*1);
            }else{
                url = tpl_url +'&use_gold=1';
                $('.price_renjun').text($('.price_renjun').text()*1-$('.gold_price').text()*1);
                $(this).addClass('checkboxed');
				$('.rtPrice2').text($('.gold_price').text()*1);
				$('.rtPrice1').text($('.rtPrice1').text()*1-$('.gold_price').text()*1);
				$('.rtPrice4').text($('.rtPrice4').text()*1-$('.gold_price').text()*1);
				$('.rtPrice5').text($('.rtPrice5').text()*1-$('.gold_price').text()*1);
            }
			
        });
    </script>