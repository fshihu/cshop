    <!--搜索栏-s-->
<div class="page  weui-tab__panel  " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">商品详情</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
      <div class="banner ban1">
         <div class="mslide" id="slideTpshop">
             <ul>
                <?php use module\goods\server\GoodsServer;

                foreach($goods_images as $goods_image):?>
                     <li>
                             <img src="<?php echo $goods_image['image_url'] ?>" title="{$v[title]}" style="{$v[style]}" alt="">
                     </li>
                     <?php endforeach?>
             </ul>
         </div>
     </div>
     <div class="good_info">
         <div class="good_title"><?php echo $data['goods_name'] ?></div>
         <div class="t1">
             <span class="t1_s">价格： <span class="t1_s_m">￥<?php echo $data['shop_price'] ?>元</span></span>
             <span class="t1_k">市场价：¥<?php echo $data['market_price'] ?>元 </span>
         </div>
          <div class="buy_num_w">
             <span class="fl">数量</span>
             <span class="fr">
                 <span class="jian no_ac"></span>
                 <input type="text" class="text" value="1"/>
                 <span class="jia"></span>
             </span>
         </div>
     </div>

      <div class="weui-navbar navbar-sm nav_click">
         <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
             商品详情
         </a>
         <a href="javascript:;" class="weui-navbar__item  ">
             用户评价
         </a>
      </div>
     <div class="nav_click_cont">
         <div class="nav_click_cont_item gooods_content">
<?php echo html_entity_decode($data['goods_content']) ?>
         </div>
            <div class="nav_click_cont_item commont_list" style="display: none;">
                <?php foreach($comment_list as $comment_item):?>
                <div class="comm_item">
                    <div class="t1">
                        <img class="img" src="<?php echo $comment_item['avatar'] ?>" alt="">
                        <span class="t1_s"><?php echo $comment_item['uname'] ?></span>
                    </div>
                    <div class="t2"><?php echo $comment_item['comment_content'] ?></div>
                    <div class="t3">
                        <?php echo $comment_item['comment_time'] ?>
                    </div>
                </div>
                <?php endforeach?>

             </div>
     </div>

      <div class="buy_btn">
         <a href="<?php echo $this->genurl('cart/index/index') ?>" class="bt_a bt_a1">
            <div class="t3">加入购物车</div>
         </a>
         <a href="" class="bt_a bt_a2">
             <div class="t3">立即购买</div>
         </a>
     </div>

     <div class="buy_confirm" style="display: none;">
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
                    </div>

     </div>

</div>
    <div id="toast" style="display: none;">
            <div class="weui-mask_transparent"></div>
            <div class="weui-toast">
                <i class="weui-icon-success-no-circle weui-icon_toast"></i>
                <p class="weui-toast__content">已完成</p>
            </div>
        </div>

    <script type="text/javascript">
        $('.buy_confirm').show().css({bottom:-$('.buy_confirm').height()-20});
        var click_type = 1;
        $('.buy_btn .bt_a1,.buy_btn .bt_a2').click(function () {
            if($(this).hasClass('bt_a2')){
                click_type = 2;
            }
            $('.buy_confirm').show().animate({bottom:0});
           return false;
        });
        var spec_goods_prices = <?php echo json_encode($spec_goods_prices) ?>;
        $('.buy_confirm .bc_hd .bc_close').click(function () {
            $('.buy_confirm').show().animate({bottom:-$('.buy_confirm').height()-20});
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
                ajax_request('<?php echo $this->genurl('cart/index/add');?>',{
                    goods_id:'<?php echo $data['goods_id'] ?>',
                    goods_num:$('.buy_num_w .text').val(),
                    spec_key:attr.key
                },function () {
                    $('.buy_confirm').show().animate({bottom:-$('.buy_confirm').height()-20});
                    if(click_type == 2){
                        location.href = '<?php echo $this->genurl('cart/index/index');?>';
                    }else{
                        Tip('添加成功');
                    }
                })
            }
            return false;
        });
    </script>
    <?php include \biz\Util::getFooterNav()?>