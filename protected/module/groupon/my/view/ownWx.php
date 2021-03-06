
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
                        <p class="title">自建团订单</p>
                    </div>
                </div>

            </div>
    <div class="weui-navbar navbar-sm">
       <a href="<?php echo $this->genurl(''); ?>" class="weui-navbar__item <?php use CC\db\base\select\ListModel;
       use module\goods\server\GoodsServer;

       echo $is_end ==0?'weui-bar__item_on':'' ?>">
           待成团
           <?php if($group_own[0] > 0):?>
                                        <span class="weui-badge" style="position: absolute;top: -.4em;right:-3px;z-index: 1    ; ">
                                            <?php echo (int)$group_own[0]  ?>
                                        </span>
                   <?php endif;?>
       </a>
       <a href="<?php echo $this->genurl('',['is_end'=>1]) ?>" class="weui-navbar__item   <?php echo $is_end ==1?'weui-bar__item_on':'' ?>">
           待抽取
           <?php if($group_own[1] > 0):?>
                                        <span class="weui-badge" style="position: absolute;top: -.4em;right:-3px;z-index: 1    ; ">
                                            <?php echo (int)$group_own[1]  ?>
                                        </span>
                   <?php endif;?>
       </a>
       <a href="<?php echo $this->genurl('',['is_end'=>2]) ?>" class="weui-navbar__item   <?php echo $is_end ==2?'weui-bar__item_on':'' ?>">
           已完成
       </a>
     </div>

    <div class="list5">
        <?php foreach($list as $item):?>
     <div class="list_item">
         <div class="t1"><?php echo $end_desc ?></div>

         <?php $order_goods = ListModel::make('order_goods')->addColumnsCondition(array('order_id' => $item['order_id']))->execute(); ?>
         <?php foreach($order_goods as $order_good):?>
             <a href="<?php echo $this->genurl('goods/det/index',['id' => $order_good['goods_id']]); ?>">
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
             实支付： <span class="t3_s">￥ <?php echo $item['order_amount'] ?></span>
         </div>
              <?php if($is_end == 0):?>

         <div class="t5">
			<a href="<?php echo $this->genurl('groupon/one/index',['group_one_id'=> $item['order_prom_id']]) ?>" style="float:left;background:#2CC7C5; color:#fff; padding:0 5px; border-radius:5px; font-size:12px; height:22px; line-height:22px;">分享给好友</a>
            <span class="t5_2" style="height:22px; line-height:22px;">还差<?php echo $item['remain_num'] ?>人</span>
         </div>
              <?php endif;?>
              <?php if($is_end == 1):?>


         <div class="t5">

            <span class="t5_2">
                 <?php if($item['group_one_uid'] == \biz\Session::getUserID()):?>
                     <a href="<?php echo $this->genurl('raffle',['order_id' => $item['order_id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default  ">去抽奖</a>
                  <?php else:?>
                     等待团长抽奖
                 <?php endif;?>
            </span>
         </div>
              <?php endif;?>
         <?php if($is_end == 2):?>


         <div class="t5">

            <span class="t5_2">
                恭喜： <?php echo $item['nickname'] ?>
                 <?php if($item['win_uid']== \biz\Session::getUserID()):?>
                     ，请查看待发货订单
                 <?php endif;?>
            </span>
         </div>
              <?php endif;?>

     </div>
        <?php endforeach?>

     </div>
 </div>

</div>