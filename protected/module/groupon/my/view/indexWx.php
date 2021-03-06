
<!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">拼团订单</p>
                    </div>
                </div>

            </div>
    <div class="weui-navbar navbar-sm">
       <a href="<?php use CC\db\base\select\ListModel;
       use module\goods\server\GoodsServer;

       echo $this->genurl(''); ?>" class="weui-navbar__item <?php echo $is_end?'':'weui-bar__item_on' ?>">
           待成团
            <?php if($user['group_my_num'] > 0):?>
                                 <span class="weui-badge" style="position: absolute;top: -.4em;right:-3px;z-index: 1    ; ">
                                     <?php echo (int)$user['group_my_num']  ?>
                                 </span>
            <?php endif;?>

       </a>
       <a href="<?php echo $this->genurl('',['is_end' =>1]) ?>" class="weui-navbar__item  <?php echo !$is_end?'':'weui-bar__item_on' ?> ">
           已过期
       </a>
     </div>

<div class="list5">
    <?php foreach($list as $item):?>
 <div class="list_item">
     <div class="t1"><?php echo $end_desc ?></div>

     <?php $order_goods = ListModel::make('order_goods')->addColumnsCondition(array('order_id' => $item['order_id']))->execute(); ?>
     <?php foreach($order_goods as $order_good):?>
         <a href="<?php echo $this->genurl('groupon/index/det',['id' => $item['group_buy_id']]); ?>">
             <div class="t2">
                          <img class="t2_img" src="<?php echo GoodsServer::getImg($order_good['original_img']) ?>" alt="">
                          <div class="ts_s">
                              <div class="t2_s_1"><?php echo $order_good['goods_name'] ?></div>
                              <div class="t2_s_2">¥<?php echo $order_good['goods_price'] ?>×<?php echo $order_good['goods_num'] ?></div>
                          </div>
                      </div>
         </a>
     <?php endforeach?>
     <div class="t3">
         实支付： <span class="t3_s">￥ <?php echo $item['goods_price'] ?></span>（免运费）
     </div>
     <div class="t5">
        <span class="t5_1">剩余 <span id="timer_<?php echo $item['order_id'] ?>"></span> 结束拼团</span>
         <script language="javascript" type="text/javascript">

              leftTimer(<?php echo date('Y,n,j,h,i,s',$item['end_time']) ?>,'#timer_<?php echo $item['order_id'] ?>');
              </script>

        <span class="t5_2">还差<?php echo $item['remain_num'] ?>人</span>
     </div>
 </div>
    <?php endforeach?>

 </div>
 </div>

</div>