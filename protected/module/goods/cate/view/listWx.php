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
            .h_item_1_s{ padding:10px;}
            .sanjiao{position: absolute;
                left: 6px;
                top: 6px;
                width: 40px;}
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
     <div class="weui-search-bar" id="searchBar">
                 <form class="weui-search-bar__form" action="<?php echo $this->genurl('search/index/index'); ?>">
                     <div class="weui-search-bar__box">
                         <i class="weui-icon-search"></i>
                         <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
                         <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                     </div>
                     <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
                         <i class="weui-icon-search"></i>
                         <span>搜索</span>
                     </label>
                 </form>
                 <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
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
     <div class="h_item_1_w" style="margin-top:10px;">
         <?php $group_buys = array(
                 array('image' => '/public/upload/category/2017/09-28/c3dd6d0f590d127fa2d8c98579e3f390.png')
         ) ?>
              <?php foreach($group_buys as $i => $group_buy):?>

           <div class="h_item_1">

               <a href="<?php echo $this->genurl('/groupon/index/det',['id'=>$group_buy['id']]) ?>">

             <div class="h_item_1_s">

                 <img class="img" src="<?php echo $group_buy['image'] ?>"alt="">
                 <img class="sanjiao" src="/public/biz/wx/common/images/my/xingyun1.png" alt="">
              </div>
               </a>

        </div>
         <?php endforeach?>


     </div>
     <div style="padding: 0px 50px 0 50px;">
         <div class="weui-navbar navbar-sm nav_click  " style="    border: 1px solid #ccc;
             border-bottom: none;">
                                 <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
                                     商品
                                 </a>
                                 <a href="javascript:;" class="weui-navbar__item">
                                     服务
                                 </a>
                              </div>
     </div>
     <div class="goods_item_w ">
         <?php foreach($list as $item):?>
         <div class="goods_item">
             <a href="<?php echo $this->genurl('goods/det/index',['id'=>$item['goods_id']]) ?>">
                 <img src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="" width="100%" height="155">
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
    $(function(){
        var $searchBar = $('#searchBar'),
            $searchResult = $('#searchResult'),
            $searchText = $('#searchText'),
            $searchInput = $('#searchInput'),
            $searchClear = $('#searchClear'),
            $searchCancel = $('#searchCancel');

        function hideSearchResult(){
            $searchResult.hide();
            $searchInput.val('');
        }
        function cancelSearch(){
            hideSearchResult();
            $searchBar.removeClass('weui-search-bar_focusing');
            $searchText.show();
        }

        $searchText.on('click', function(){
            $searchBar.addClass('weui-search-bar_focusing');
            $searchInput.focus();
        });
        $searchInput
            .on('blur', function () {
                if(!this.value.length) cancelSearch();
            })
            .on('input', function(){
                if(this.value.length) {
                    $searchResult.show();
                } else {
                    $searchResult.hide();
                }
            })
        ;
        $searchClear.on('click', function(){
            hideSearchResult();
            $searchInput.focus();
        });
        $searchCancel.on('click', function(){
            cancelSearch();
            $searchInput.blur();
        });
    });

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