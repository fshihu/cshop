<div class="page   " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access">
                         <a  href="<?php echo $this->genurl('home/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">限时团购</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
     <div class="gl_nav">
         <a href="<?php echo $this->genurl(''); ?>" class="<?php echo $cate_id ==0?'ac':'' ?>">全部</a>
         <?php foreach($cate_list as $item):?>
         <a class="<?php echo $cate_id ==$item['id']?'ac':'' ?>" href="<?php echo $this->genurl('',['cate_id' =>$item['id']]); ?>" ><?php echo $item['name'] ?></a>
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
     <style type="text/css">
         .m_title_1{padding: 20px;background: #fff; color: #000;text-align: center;}
         .m_title_1 .line{display: inline-block; width:25px; height:1px;background: #000000;position: relative;top:-6px;}
     </style>
<div class="m_title_1" >
    <span class="line"></span> 正在进行的幸运轮商品 <span class="line"></span>
</div>
     <div class="h_item_1_w">
              <?php foreach($group_buys as $i => $group_buy):?>

           <div class="h_item_1">

               <a href="<?php echo $this->genurl('/groupon/index/det',['id'=>$group_buy['id']]) ?>">

             <div class="h_item_1_s">

                 <img class="img" src="<?php echo $group_buy['image'] ?>"alt="">
                            <div class="bg"></div>
                            <div class="times" id="times_ec<?php echo $i ?>">


                            </div>
                             <script type="text/javascript">
                                 leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>,'#times_ec<?php echo $i ?>',2);

                             </script>
             </div>
                 <div class="name"><?php echo $group_buy['title'] ?></div>
                 <div class="ft_s1">
                     <span class="fl">
                         <img width="13" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/purchasing_icon.png" alt="">
                         <span class="tuan_num"><?php echo $group_buy['goods_num'] ?>人团</span>
                         <span class="price">￥<?php echo $group_buy['price'] ?></span>
                     </span>
                     <span class="fr">
                        <span class="btn_r">立即开团</span>
                     </span>
                 </div>
             </a>

        </div>
         <?php endforeach?>


     </div>

 </div>
                    </div>

     </div>

</div>