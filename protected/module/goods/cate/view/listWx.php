<div class="page   " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php echo $cate_item['name'] ?></p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
     <div class="gl_nav">
         <a href="<?php echo $this->genurl(''); ?>" class="<?php echo $cate_id?'':'ac' ?>">全部</a>
         <?php foreach($cate_list as $item):?>
         <a class="<?php echo $item['cat_id']== $cate_id?'ac':'' ?>" href="<?php echo $this->genurl('',['cate_id'=>$item['cat_id']]); ?>"><?php echo $item['cat_name'] ?></a>
         <?php endforeach?>
         <a href="" style="display: none;">
             <img style="position: relative;top:-3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pull-down_icon.png" width="10" alt=""></a>
     </div>
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

     <div class="goods_item_w ">
         <?php foreach($list as $item):?>
         <div class="goods_item">
             <a href="<?php echo $this->genurl('goods/det/index',['id'=>$item['goods_id']]) ?>">
                 <img src="" alt="" width="100%" height="155">
                 <div class="txt"><?php echo $item['name'] ?></div>
                 <div class="price">￥<?php echo $item['shop_price'] ?></div>
             </a>
         </div>
         <?php endforeach?>

     </div>

 </div>
                    </div>

     </div>

</div>