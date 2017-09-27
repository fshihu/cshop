
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
             <span class="t1_s">团购价： <span class="t1_s_m">￥<?php echo $group_buy['price'] ?>元</span></span>
             <span class="t1_s">单买价： <span class=" ">￥<?php echo $data['shop_price'] ?>元</span></span>
         </div>
         <div class="t2">
         <?php echo $group_buy['goods_num'] ?>人团，立省<?php echo $data['shop_price']-$group_buy['price'] ?>元
         </div>
         <div class="buy_num_w">
             <span class="fl">数量</span>
             <span class="fr">
                 <span class="jian no_ac"></span>
                 <input type="text" class="text" value="1"/>
                 <span class="jia"></span>
             </span>
         </div>
         <div class="t3">
             剩余时间：<span id="timer"></span>     <script language="javascript" type="text/javascript">
                  function leftTimer(year,month,day,hour,minute,second){
                   var leftTime = (new Date(year,month-1,day,hour,minute,second)) - (new Date()); //计算剩余的毫秒数
                      console.log(leftTime);
                   var days = parseInt(leftTime / 1000 / 60 / 60 / 24 , 10); //计算剩余的天数
                   var hours = parseInt(leftTime / 1000 / 60 / 60 % 24 , 10); //计算剩余的小时
                   var minutes = parseInt(leftTime / 1000 / 60 % 60, 10);//计算剩余的分钟
                   var seconds = parseInt(leftTime / 1000 % 60, 10);//计算剩余的秒数
                   days = checkTime(days);
                   hours = checkTime(hours);
                   minutes = checkTime(minutes);
                   seconds = checkTime(seconds);
                      document.getElementById("timer").innerHTML = (days>0?(days+"天"):'') + hours+"小时" + minutes+"分"+seconds+"秒";
                   setTimeout(function () {
                       leftTimer(year,month,day,hour,minute,second);
                   },1000);
                  }
                  function checkTime(i){ //将0-9的数字前面加上0，例1变为01
                   if(i<10)
                   {
                    i = "0" + i;
                   }
                   return i;
                  }
                  leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>);
                  </script>

         </div>
     </div>
 <div class="m_title_1" >
    <span class="line"></span> 别人开的团 <span class="line"></span>
</div>

    <div class="list3_w">
        <div class="list3_item">
            <span class="fl">
                <img class="avatar" src="" alt="">
                <span class="t1">
                    <span class="t1_s">还是已经走</span>
                    <span class="t1_m">正在开团中</span>
                </span>
            </span>
            <span class="fr">
                <span class="t2">还差1人成团</span>
                <span class="btn_r">去参团</span>
            </span>
        </div>
        <div class="list3_item">
            <span class="fl">
                <img class="avatar" src="" alt="">
                <span class="t1">
                    <span class="t1_s">还是已经走</span>
                    <span class="t1_m">正在开团中</span>
                </span>
            </span>
            <span class="fr">
                <span class="t2">还差1人成团</span>
                <span class="btn_r">去参团</span>
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
         <a href="<?php echo $this->genurl('pay/index') ?>" class="bt_a bt_a1">
            <div class="t1">￥<?php echo $group_buy['price'] ?></div>
            <div class="t2">单独购买</div>
         </a>
         <a href="" class="bt_a bt_a2">
             <div class="t1">￥<?php echo $data['shop_price'] ?></div>
             <div class="t2">单独购买</div>
         </a>
     </div>
 </div>
                    </div>

     </div>

</div>
<?php include \biz\Util::getFooterNav()?>