
    <!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php echo $this->genurl('home/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">有机资讯</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  "  >
 <div class="goods_list">
     <div class="gl_nav" style="position: relative;">
         <a href="<?php echo $this->genurl(''); ?>" class="<?php echo $cate_id?'':'ac' ?>">全部</a>
         <?php foreach($cate_list as $item):?>
         <a class="<?php echo $item['cat_id']== $cate_id?'ac':'' ?>" href="<?php echo $this->genurl('',['cate_id'=>$item['cat_id']]); ?>"><?php echo $item['cat_name'] ?></a>
         <?php endforeach?>
         <a  class="right_xialat" style=" position: absolute;
             right: 10px;
             top: 15px;">
             <img style="position: relative;top:-3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pull-down_icon<?php echo $cate_i ?>.png" width="10" alt=""></a>
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

             <div class="list2_w">
                 <?php foreach($list as $item):?>
                <div class="list2">
                    <a  href="<?php echo $this->genurl('det',['id'=>$item['article_id']]) ?>">
                        <div class="item_2  ">
                            <img src="<?php echo $item['thumb'] ?>" alt="">
                            <div class="conts"><?php echo $item['title']  ?></div>
                        </div>
                    </a>
                </div>
                 <?php endforeach?>


            </div>

 </div>
                    </div>

     </div>

</div>
    <?php include \biz\Util::getFooterNav(); ?>
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
