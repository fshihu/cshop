    <!--搜索栏-s-->
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<div class="page  weui-tab__panel  " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php echo \biz\Util::subString($data['goods_name'],6) ?></p>
                        </div>
                          <?php if($data['is_create_group']):?>
                         <a href="javascript:;" class="own_create_btn" style="position:absolute; right:10px; top:0px;">
                         	 <img src="/public/biz/wx/common/images/my/xyl_Img.png" style="width:22px; border-radius:30px; margin-top:11px;" />
                             <!--幸运轮-->
                         </a>
                          <?php endif;?>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
      <div class="banner ban1">
         <div class="mslide" id="slideTpshop_noauto">
             <ul>
                <?php use module\cart\index\server\PromTypeEnum;
                use module\goods\server\GoodsServer;
                use module\member\index\UserServer;

                foreach($goods_images as $goods_image):?>
                     <li>
                             <img src="<?php echo $goods_image['image_url'] ?>" title="{$v[title]}" style="{$v[style]}" alt=""  onclick="changeImg(this)" />
                     </li>
                     <?php endforeach?>
             </ul>
         </div>
     </div>
     <div class="good_info">
         <div class="good_title"><?php echo $data['goods_name'] ?></div>
         <div class="t1" style='padding-top:5px;padding-bottom:5px'>
             <span class="t1_s">价格： <span class="t1_s_m">￥<?php echo $data['shop_price'] ?>元</span></span>
             <span class="t1_k">市场价：¥<?php echo $data['market_price'] ?>元 </span>
         </div>
		 <div class="t1" style='padding-top:5px;'>
             <span class="t1_s">金卡会员购买返现： <span style='color:red'>￥<?php echo $data['gold_card_discount_price'] ?>元</span></span>
         </div>
		 <div class="t1" style='padding-bottom:10px'>
             <span class="t1_s">黑卡会员购买返现： <span style='color:red'>￥<?php echo $data['black_card_discount_price'] ?>元</span></span>
         </div>
          <?php if($merchant['wx_account']):?>
         <div class="t1">
             <span class="t1_s">客服微信号： <span class="t1_s_"><?php echo $sys_conf['weixinNumber'] ?></span></span>
         </div>
          <?php endif;?>
          <div class="buy_num_w">
             <span class="fl">数量</span>
             <span class="fr">
                 <span class="jian no_ac"></span>
                 <input type="text" class="text" value="1"/>
                 <span class="jia"></span>
             </span>
         </div>
     </div>
     <?php if($data['is_create_group']):?>

     <div class="m_title_1" >
        <span class="line"></span> 正在进行的幸运轮 <span class="line"></span>
    </div>

        <div class="list3_w">
            <?php foreach($other_group_buys as $other_group_buy):?>
            <div class="list3_item">
                <span class="fl">
                    <img class="avatar" src="<?php echo $other_group_buy['head_pic'] ?>" alt="">
                    <span class="t1">
                        <span class="t1_s"><?php echo $other_group_buy['nickname'] ?></span>
                        <span class="t1_m">正在进行幸运轮</span>
                    </span>
                </span>
                <span class="fr">
                    <span class="t2">还差<?php echo $other_group_buy['remain_num'] ?>人</span>
                    <a href="<?php echo $this->genurl('groupon/one/index',['group_one_id'=>$other_group_buy['id']]); ?>" class="btn_r">参加</a>
                </span>
            </div>
            <?php endforeach?>
             <?php if(empty($other_group_buys)):?>
                 <div style="text-align: center;padding: 10px;">暂无</div>
             <?php endif;?>
         </div>
     <?php endif;?>

      <div class="weui-navbar navbar-sm nav_click detailClick">
         <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
             商品详情
         </a>
         <a href="javascript:;" class="weui-navbar__item  ">
             用户评价
         </a>
      </div>
     <div class="nav_click_cont">
     	<div class="specifTab">
            <table>
                <tbody>
					<?php if($data['g1']!=''){ ?>
                    <tr>
                        <td>商品品牌</td>
                        <td><?php echo $data['g1'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g2']!=''){ ?>
                    <tr>
                        <td>商品产地</td>
                        <td><?php echo $data['g2'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g3']!=''){ ?>
                    <tr>
                        <td>单品分类</td>
                        <td><?php echo $data['g3'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g4']!=''){ ?>
                    <tr>
                        <td>批准文号</td>
                        <td><?php echo $data['g4'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g5']!=''){ ?>
                    <tr>
                        <td>产品功效</td>
                        <td><?php echo $data['g5'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g6']!=''){ ?>
                    <tr>
                        <td>保质期限</td>
                        <td><?php echo $data['g6'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g7']!=''){ ?>
                    <tr>
                        <td>上市时间</td>
                        <td><?php echo $data['g7'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g8']!=''){ ?>
                    <tr>
                        <td>产品型号</td>
                        <td><?php echo $data['g8'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g9']!=''){ ?>
                    <tr>
                        <td>产品规格</td>
                        <td><?php echo $data['g9'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g10']!=''){ ?>
                    <tr>
                        <td>包装含量</td>
                        <td><?php echo $data['g10'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g11']!=''){ ?>
                    <tr>
                        <td>材质成分</td>
                        <td><?php echo $data['g11'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g12']!=''){ ?>
                    <tr>
                        <td>适应类别</td>
                        <td><?php echo $data['g12'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g13']!=''){ ?>
                    <tr>
                        <td>操作方式</td>
                        <td><?php echo $data['g13'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g14']!=''){ ?>
                    <tr>
                        <td>颜色分类</td>
                        <td><?php echo $data['g14'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g15']!=''){ ?>
                    <tr>
                        <td>售后服务</td>
                        <td><?php echo $data['g15'];?></td>
                    </tr>
					<?php }?>
					<?php if($data['g16']!=''){ ?>
                    <tr>
                        <td>同城服务</td>
                        <td><?php echo $data['g16'];?></td>
                    </tr>
					<?php }?>

                    
                </tbody>
            </table>
        </div>
         <div class="nav_click_cont_item gooods_content detailImg">
<?php echo html_entity_decode($data['goods_content']) ?>
         </div>
            <div class="nav_click_cont_item commont_list" style="display: none;">
                <?php foreach($comment_list as $comment_item):?>
                <div class="comm_item" style="padding:20px 10px;">
                    <div class="t1">
                        <img class="img" src="<?php echo UserServer::getAvatar($comment_item) ?>" alt="">
                        <span class="t1_s" style="margin-left:5px; font-size:14px; color:#2CC7C5; font-size:14px;"><?php echo $comment_item['uname'] ?></span>
                    </div>
                    <div class="t2" style="margin-left:40px; padding:0 0 10px 0;"><?php echo $comment_item['comment_content'] ?></div>
                     <?php if($comment_item['comment_reply']):?>
                    <div class="t2" style="margin-left:40px; font-size:12px; background:#F8F8F8; padding:10px 0 10px 5px; margin-bottom:10px;">商家回复：<?php echo $comment_item['comment_reply'] ?></div>
                     <?php endif;?>
                    <div class="t3" style="margin-left:40px;">
						<?php for($i =0; $i< $comment_item['rating'];$i++):?>
                        <span style="background: url(<?php echo $baseUrl ?>/public/biz/starability/starability-images/icons-checkmark@2x.png);
                                width: 10px;
                                height: 10px;
                                display: inline-block;
                                background-size: 10px;
                                background-position: 0px -10px;"></span>
                        <?php endfor;?>
                        <?php for($i =0; $i< 5-$comment_item['rating'];$i++):?>
                        <span style="background: url(<?php echo $baseUrl ?>/public/biz/starability/starability-images/icons-checkmark@2x.png);
                                width: 10px;
                                height: 10px;
                                display: inline-block;
                                background-size: 10px;
                                background-position: 0px 0;"></span>
                        <?php endfor;?>

                        <?php echo date('Y-m-d h:i:s',$comment_item['comment_time']) ?>
                    </div>
                </div>
                <?php endforeach?>

             </div>
     </div>


 </div>

            <div class="weui-navbar navbar-sm  ">
                     <a href="javascript:;" class="weui-navbar__item ">
                         商品推荐
                     </a>
                   </div>
            <div class="goods_list">

                <div class="goods_item_w server_itme_w">
                    <?php foreach($recomm_list as $item):?>
                    <div class="goods_item">
                        <a href="<?php echo $this->genurl('goods/det/index',array('id' => $item['goods_id'])) ?>">
                            <img src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="" width="100%" height="155">
                            <div class="txt"><?php echo $item['goods_name'] ?></div>
                            <div class="price">￥<?php echo $item['shop_price'] ?></div>
                        </a>
                    </div>
                    <?php endforeach?>
                 </div>

            </div>

                    </div>

     </div>

</div>
    <div class="js_dialog" id="iosDialog2" style="display: none;">
                <div class="weui-mask"></div>
                <div class="weui-dialog">
                    <div class="weui-dialog__bd">
                        <span class="t1_s">客服微信号：<span class="t1_s_" id="weixinNumber"><?php echo $sys_conf['weixinNumber'] ?></span></span>
                    </div>
                    <div class="weui-dialog__ft">
                        <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary js_dialog_proy_2">确定</a>
                    </div>
                </div>
            </div>

    <a class="cart_btn cart_btn1 " style="" href="<?php echo $this->genurl('cart/index/index') ?>">
        <img src="/public/biz/wx/common/images/my/shopping_cart_2.png" alt="" class="icon">
    </a>
    <div class="buy_btn">
    	<a class="bt_aKf cart_btn_sr" style="position:relative;" href="javascript:;">
        	<textarea id="biao1"  onClick="copyUrl2()" readonly style="position:absolute; left:0px; top:0px; width:100%; height:100%; opacity:0; z-index:9; padding:0px;"></textarea>
            <img src="/public/biz/wx/common/images/kfu_s.png" alt="" class="icon">
            <p>客服</p>
        </a>
       <a href="<?php echo $this->genurl('cart/index/index') ?>" class="bt_a bt_a1">
          <div class="t3" style='padding-left:12px'>加入购物车</div>
       </a>
       <a href="" class="bt_a bt_a2">
           <div class="t3">立即购买</div>
       </a>
   </div>

   <div class="buy_confirm" style="display: none;">
       <div class="bc_bg" style="position: fixed;width: 100%;top:0;bottom: 0;display: none;z-index: 11;background: rgba(0,0,0,.2)"></div>
       <div class="bc_bd_w" style="position: relative;z-index: 12;background: #fff">
       <div class="bc_hd">
           <img class="bc_img" src="<?php echo GoodsServer::getImg($data['original_img']) ?>" alt="">
          <div class="bc_info">
              <div class="t1">￥<?php echo $data['shop_price'] ?></div>
              <div class="t2" style="display: none;">已选: <span class="t2_sm">杏色 中码</span></div>
          </div>
           <div class="bc_close">×</div>
       </div>
       <div class="bc_bd">
           <?php foreach($specs as $spec):?>
           <div class="bcb_item">
               <div class="t1"><?php echo $spec['name'] ?></div>
               <div class="t2 btn_group_sel">
                   <?php foreach($spec_items as $spec_item):?>
                       <?php if($spec['id'] != $spec_item['spec_id']){continue;} ?>
                   <a data-id="<?php echo $spec_item['id'] ?>" href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default "><?php echo $spec_item['item'] ?></a>
                   <?php endforeach?>

               </div>
           </div>
           <?php endforeach?>


       </div>
       <a href="javascript:;" class="weui-btn confirm_btn weui-btn_warn">确认</a>
       </div>
   </div>
    <div id="toast" style="display: none;">
            <div class="weui-mask_transparent"></div>
            <div class="weui-toast">
                <i class="weui-icon-success-no-circle weui-icon_toast"></i>
                <p class="weui-toast__content">已完成</p>
            </div>
        </div>
 

<!--图片放大-->
<div id="bigImg">
	<img src="images/a.jpg" />
</div>
<!--图片放大-->
    <script type="text/javascript">
	function copyUrl2(){
		$("#biao1").val($("#weixinNumber").text());
		var Url2=document.getElementById("biao1");
		Url2.select(); // 选择对象
		document.execCommand("Copy"); // 执行浏览器复制命令
		//alert("已复制好，可贴粘。");
	}
	function changeImg(obj){
		$("#bigImg").find("img").css({
			"height":"",
			"margin-top":""
		});
		var imgSrc=$(obj).attr("src");
		$("#bigImg").find("img").attr("src",imgSrc);
		setTimeout(function(){
			$("#bigImg").find("img").css({
				"height":$("#bigImg").find("img").height(),
				"margin-top":($(document).height()-$("#bigImg").find("img").height())/2
			});
		});
		$("#bigImg").show();
	}
	$(function(){
		/*$(".detailImg").find("img").bind("click",function(){
	   		$("#bigImg").find("img").css({
				"height":"",
				"margin-top":""
			});
			var imgSrc=$(this).attr("src");
			$("#bigImg").find("img").attr("src",imgSrc);
			setTimeout(function(){
				$("#bigImg").find("img").css({
					"height":$("#bigImg").find("img").height(),
					"margin-top":($(document).height()-$("#bigImg").find("img").height())/2
				});
			});
			$("#bigImg").show();
		});*/
		$("#bigImg").click(function(){
			$("#bigImg").hide();
		});
		 $('.cart_btn_sr').click(function () {
            $('#iosDialog2').fadeIn(200);
        });
        $('.js_dialog_proy_2').click(function () {
            $('#iosDialog2').fadeOut(200);
        });
		$(".detailClick").find("a").eq(0).click(function(){
			$(".specifTab").show();
		});
		$(".detailClick").find("a").eq(1).click(function(){
			$(".specifTab").hide();
		});
	});
       
        <?php $signPackage = \biz\wx\WxJs::getSignPackage(); ?>
        wx.config({

            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

            appId: '<?php echo $signPackage['appId'] ?>', // 必填，公众号的唯一标识

            timestamp: <?php echo $signPackage['timestamp'] ?>, // 必填，生成签名的时间戳

            nonceStr: '<?php echo $signPackage['nonceStr'] ?>', // 必填，生成签名的随机串

            signature: '<?php echo $signPackage['signature'] ?>',// 必填，签名，见附录1

            jsApiList: ['previewImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

        });
        $('.gooods_content img').click(function () {
            var urls = [];
            $('.gooods_content img').each(function () {
                urls.push(location.origin+$(this).attr('src'));
            });
            wx.previewImage({

                current: $(this).attr('src'), // 当前显示图片的http链接

                urls: urls // 需要预览的图片http链接列表

            });
        });
        $('.buy_confirm').show().css({bottom:-$('.buy_confirm').height()-20});
        var click_type = 1;
        $('.buy_btn .bt_a1,.buy_btn .bt_a2').click(function () {
            if($(this).hasClass('bt_a2')){
                click_type = 2;
            }
            show_buy_confirm();
           return false;
        });
        function show_buy_confirm() {
            $('.buy_confirm').show().animate({bottom:0});
            $('.buy_confirm .bc_bg').show();
        }
        function hide_buy_confirm() {
            $('.buy_confirm').show().animate({bottom:-$('.buy_confirm').height()-20});
            $('.buy_confirm .bc_bg').hide();
        }
        var spec_goods_prices = <?php echo json_encode($spec_goods_prices) ?>;
        $('.buy_confirm .bc_hd .bc_close,.buy_confirm .bc_bg').click(function () {
            hide_buy_confirm();
        });
        function getAttr() {
            var has = true;
            var attr_id = [];
            var price = 0;
            $('.btn_group_sel').each(function () {
                var $btn_group_sel = $(this);
                if(has && !$btn_group_sel.find('.weui-btn_warn').length){
                    has = false;
                }
                if(has){
                    attr_id.push($btn_group_sel.find('.weui-btn_warn').attr('data-id'));
                }
            });
            var key = '';
            var key_name = '';
            if(has){
                var specGoodsPrice = spec_goods_prices[attr_id.join('_')];
                if(specGoodsPrice){
                    price = specGoodsPrice.price;
                    key = specGoodsPrice.key;
                    key_name = specGoodsPrice.key_name;
                }
            }
            return {has:has,price:price,key:key,key_name:key_name};
        }
        $('.btn_group_sel .weui-btn').click(function () {
            setTimeout(function () {
                var attr = getAttr();
                           if(attr.has){
                               $('.buy_confirm .bc_hd .bc_info .t1').text('￥'+attr.price);
                               $('.buy_confirm .bc_hd .bc_info .t2').show().text(attr.key_name);
                           }
            },100);

        });
        $('.buy_confirm .confirm_btn').click(function () {
            var attr = getAttr();
            if(!attr.has){
                Tip('请选择商品规格','error');
            }else{
                var prom_type = 0;
                if(click_type == 3){
                    prom_type = '<?php echo PromTypeEnum::GROUP_OWN_OPEN ?>';
                }
                ajax_request('<?php echo $this->genurl('cart/index/add');?>',{
                    goods_id:'<?php echo $data['goods_id'] ?>',
                    goods_num:$('.buy_num_w .text').val(),
                    spec_key:attr.key,
                    prom_type:prom_type
                },function () {
                    hide_buy_confirm();
                    if(click_type == 2){
                        location.href = '<?php echo $this->genurl('cart/index/index',['is_buy_now' => 1,'goods_id' => $data['goods_id']]);?>';
                    }else if(click_type == 3){
                        location.href = '<?php echo $this->genurl('cart/index/index',['prom_type'=>PromTypeEnum::GROUP_OWN_OPEN]);?>';
                    }else{
                        Tip('添加成功');
                    }
                })
            }
            return false;
        });
        $('.own_create_btn').click(function () {
            click_type = 3;
            show_buy_confirm();
            return false;
        });
    </script>
    <?php include \biz\Util::getFooterNav()?>