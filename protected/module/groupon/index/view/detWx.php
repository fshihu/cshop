
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
             剩余时间：<span id="timer"></span>
             <script language="javascript" type="text/javascript">

                  leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>,'#timer');
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
         <a href="<?php echo $this->genurl('goods/det/index',['id'=>$data['goods_id']]) ?>" class="bt_a bt_a1">
             <div class="t1">￥<?php echo $data['shop_price'] ?></div>
            <div class="t2">单独购买</div>
         </a>
         <a href="javascript:;" class="bt_a bt_a2">
             <div class="t1">￥<?php echo $group_buy['price'] ?></div>
             <div class="t2">一键开团</div>
         </a>
     </div>
 </div>
                    </div>

     </div>

</div>
    <script type="text/javascript">
        $('.buy_btn .bt_a .t2').click(function () {
            ajax_request('<?php echo $this->genurl('cart/index/add');?>',{
                goods_id:'<?php echo $data['goods_id'] ?>',
                goods_num:$('.buy_num_w .text').val(),
                prom_id:'<?php echo $group_buy['id'] ?>',
                prom_type:1
            },function () {
                location.href = '<?php echo $this->genurl('cart/index/index',array('prom_type'=>1));?>';
            });
            return false;
        });

    </script>
<?php include \biz\Util::getFooterNav()?>