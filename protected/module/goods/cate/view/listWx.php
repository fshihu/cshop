<div class="page  weui-tab__panel " style="min-height: 100%;padding-bottom:0;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php echo $this->genurl('home/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php use module\goods\server\GoodsServer;

                                echo $cate_item['name'] ?></p>
                        </div>
                    </div>

                </div>
        <style type="text/css">
            .cate_goods_list_1 .gl_nav a.ac{ color: #d27b43;border-bottom-color: #d27b43;}
            .cate_goods_list_1 .goods_item a .price{ color: #d27b43;}
            .cate_goods_list_2 .gl_nav a.ac{ color: #5C9242;border-bottom-color: #5C9242;}
            .cate_goods_list_2 .goods_item a .price{ color: #5C9242;}
            .cate_goods_list_3 .gl_nav a.ac{ color: #375767;border-bottom-color: #375767;}
            .cate_goods_list_3 .goods_item a .price{ color: #375767;}

        </style>
        <div class="  weui-panel_access  " style="">
 <div class="goods_list cate_goods_list_<?php echo $cate_i ?>">
     <div class="gl_nav" style="position: relative;">
         <a href="<?php echo $this->genurl('',['id' =>$id]); ?>" class="<?php echo $cate_id?'':'ac' ?>">全部</a>
         <?php foreach($cate_list as $item):?>
         <a class="<?php echo $item['id']== $cate_id?'ac':'' ?>" href="<?php echo $this->genurl('',['id' => $id,'cate_id'=>$item['id']]); ?>"><?php echo $item['name'] ?></a>
         <?php endforeach?>
         <a  class="right_xialat" style=" position: absolute;
             right: 10px;
             top: 15px;">
             <img style="position: relative;top:-3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pull-down_icon<?php echo $cate_i ?>.png" width="10" alt=""></a>
     </div>
      <?php if(!empty($ad_list)):?>
     <div class="banner ban1">
         <div class="mslide" id="slideTpshop">
             <ul>
                 <!--广告表-->
                 <?php foreach($ad_list as $ad):?>
                     <li>
                         <a href="<?php echo $ad['ad_link'] ?>">
                             <img class="img" src="<?php echo $ad['ad_code'] ?>"alt="">
                         </a>
                     </li>
                 <?php endforeach?>
              </ul>
         </div>
     </div>
      <?php endif;?>

     <div class="goods_item_w ">
         <?php foreach($list as $item):?>
         <div class="goods_item">
             <a href="<?php echo $this->genurl('goods/det/index',['id'=>$item['goods_id']]) ?>">
                 <div style="height: 155px;">
                     <img src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="" width="100%" height="155">
                 </div>
                  <?php if($item['is_create_group']):?>
                 <img class="sanjiao" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/xingyun1.png" alt="">
                  <?php endif;?>
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
<a class="cart_btn cart_btn_no_bottom" style="" href="<?php echo $this->genurl('cart/index/index') ?>">
    <img src="/public/biz/wx/common/images/my/Shoppingcart_icon.png" alt="" class="icon">
</a>
<script type="text/javascript">
    var is_click = false;
    $('.right_xialat').click(function () {
        if(!is_click){
            is_click = true;
            $('.gl_nav').css({'height':'auto'});
        }else {
            is_click = false;
            $('.gl_nav').css({'height':'20px'});
        }
    })
</script>