
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php echo $this->genurl('index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php use CC\db\base\select\ListModel;
                                use module\cart\index\server\OrderWaitStatusEnum;
                                use module\goods\server\GoodsServer;

                                echo $wait_status_val ?>订单</p>
                        </div>
                    </div>

                </div>
  <div class="list5">
      <?php foreach($list as $item):?>
     <div class="list_item">
         <div class="t1"><?php echo $wait_status_val ?></div>
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
             实支付： <span class="t3_s">￥ <?php echo $item['goods_price'] ?></span>（免运费）
         </div>
          <?php if($wait_status == OrderWaitStatusEnum::WAIT_PAY):?>
          <div class="t4">

             <a href="<?php echo $this->genurl('cancel',['order_id'=>$item['order_id']]); ?>"  class="deletopbtn weui-btn weui-btn_mini weui-btn_default">取消订单</a>
             <a href="<?php echo $this->genurl('pay/index/index',['order_id' => $item['order_id']]); ?>" class="weui-btn weui-btn_mini weui-btn_warn">去支付</a>
         </div>
          <?php endif;?>
          <?php if($wait_status == OrderWaitStatusEnum::WAIT_RECIVE):?>
          <div class="t4">

             <a href="https://www.kuaidi100.com/chaxun?com=<?php echo $item['shipping_name'] ?>&nu=<?php echo $item['invoice_no'] ?>"  class="deletopbtn weui-btn weui-btn_mini weui-btn_default">查看物流</a>
             <a href="<?php echo $this->genurl('confirm',['order_id' => $item['order_id']]); ?>" class="weui-btn weui-btn_mini weui-btn_warn confrim_shouhuo">确认收货</a>
         </div>
          <?php endif;?>

     </div>
      <?php endforeach?>
  </div>
     </div>

</div>
    <script type="text/javascript">
        $('body').on('click','.deletopbtn',function () {
            var $list_item = $(this).closest('.list_item');
            ajax_request($(this).attr('href'),{},function () {
                $list_item.remove();
            });
            return false;
        });
        $('.confrim_shouhuo').click(function () {
            var $list_item = $(this).closest('.list_item');
            ajax_request($(this).attr('href'),{},function () {
                $list_item.remove();
            });
        });
    </script>