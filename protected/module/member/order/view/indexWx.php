
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php use CC\db\base\select\ListModel;

                                echo $wait_status_val ?>订单</p>
                        </div>
                    </div>

                </div>
  <div class="list5">
      <?php foreach($list as $item):?>
     <div class="list_item">
         <div class="t1"><?php echo $wait_status_val ?></div>
         <?php $order_goods = ListModel::make('order_goods')->addColumnsCondition(array('order_id' => $item['id']))->execute(); ?>
         <?php foreach($order_goods as $order_good):?>
         <div class="t2">
             <img class="t2_img" src="" alt="">
             <div class="ts_s">
                 <div class="t2_s_1"><?php echo $order_good['goods_name'] ?></div>
                 <div class="t2_s_2">¥<?php echo $order_good['goods_price'] ?>×<?php echo $order_good['goods_num'] ?></div>
             </div>
         </div>
         <?php endforeach?>
         <div class="t3">
             实支付： <span class="t3_s">￥ <?php echo $item['goods_price'] ?></span>（免运费）
         </div>
          <div class="t4">

             <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">取消订单</a>
             <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn">去支付</a>
         </div>
     </div>
      <?php endforeach?>
     <div class="list_item">
         <div class="t1">待发货</div>
         <div class="t2">
             <img class="t2_img" src="" alt="">
             <div class="ts_s">
                 <div class="t2_s_1">新版韩国进口粉润唇膏，时尚都市女性必备唇膏新版韩国进口粉润唇膏，时尚都市女性必备唇膏</div>
                 <div class="t2_s_2">¥34.5 ×1</div>
             </div>
         </div>
          <div class="t3">
             实支付： <span class="t3_s">￥34.6</span>（免运费）
         </div>
     </div>
 </div>
     </div>

</div>