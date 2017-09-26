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
                            <p class="title"><?php echo $data['goods_name'] ?></p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
      <div class="banner ban1">
         <div class="mslide" id="slideTpshop">
             <ul>
                <?php foreach($goods_images as $goods_image):?>
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
             <img class="bc_img" src="<?php echo $data['original_img'] ?>" alt="">
            <div class="bc_info">
                <div class="t1">￥245.00</div>
                <div class="t2">已选: <span class="t2_sm">杏色 中码</span></div>
            </div>
             <div class="bc_close">×</div>
         </div>
         <div class="bc_bd">
             <div class="bcb_item">
                 <div class="t1">颜色</div>
                 <div class="t2">
                     <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn">按钮</a>
                 </div>
             </div>
             <div class="bcb_item">
                 <div class="t1">颜色</div>
                 <div class="t2">
                     <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn">按钮</a>
                 </div>
             </div>

         </div>
         <a href="javascript:;" class="weui-btn confirm_btn weui-btn_warn">确认</a>

     </div>
 </div>
                    </div>

     </div>

</div>
    <script type="text/javascript">
        $('.buy_confirm').show().css({bottom:-$('.buy_confirm').height()-20});
        $('.buy_btn .bt_a1').click(function () {
            $('.buy_confirm').show().animate({bottom:0});
           return false;
        });
        $('.buy_confirm .bc_hd .bc_close').click(function () {
            $('.buy_confirm').show().animate({bottom:-$('.buy_confirm').height()-20});
        });
    </script>
    <?php include \biz\Util::getFooterNav()?>