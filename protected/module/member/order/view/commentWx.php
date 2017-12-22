<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use CC\db\base\select\ListModel;
use module\cart\index\server\OrderWaitStatusEnum;
use module\goods\server\GoodsServer;

?>
<style>
.starability-fade > input:checked ~ label, .starability-fade > input:focus ~ label, .starability-fade > input:hover ~ label{background-position:0 -20px;}
.starability-fade > label {
    width: 20px;
    height: 20px;
	margin:0 3px;
}
.starability-fade > label:before {
    width: 20px;
    height: 20px;
    background-position: 0 -20px;
    bottom:20px;
}
@media (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi), screen and (-webkit-min-device-pixel-ratio: 2) {
    .starability-fade > label {background-size:20px auto;}
@media (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi), screen and (-webkit-min-device-pixel-ratio: 2) {
    .starability-slot > label {background-size:20px auto }
}
@media (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi), screen and (-webkit-min-device-pixel-ratio: 2) {
    .starability-fade > label:before {background-size:20px auto }
}
</style>
<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%;background: #F8F8F8; ">
    <div class="page__bd" style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <a href="javascript:history.back();">
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <div class="weui-cell__bd">
                    <p class="title">商品评论</p>
                </div>
            </div>

        </div>
		<?$num=0;?>
        <div class="  weui-panel_access  ">
            <div class="list5">
                <?php foreach([['order_id' => $_GET['order_id']]] as $item):?>
               <div class="list_item" style="border-top:1px solid #e3e5e9; border-bottom:1px solid #e3e5e9; margin-top:5px;">
                   <div class="t1"> <?php echo $wait_status_val ?></div>
                   <?php $order_goods = ListModel::make('order_goods')->addColumnsCondition(array('order_id' => $item['order_id']))->execute(); ?>

                   <?php foreach($order_goods as $order_good):?>
							<?php $num=$num+$order_good['goods_num'];?>
                           <a href="<?php echo $this->genurl('goods/det/index',['id' => $order_good['goods_id']]); ?>">
                           <div class="t2" style="background:#fff;">
                                        <img class="t2_img" style="width:68px; height:68px; border:1px solid #F0F2F4;" src="<?php echo GoodsServer::getImg($order_good['original_img']) ?>" alt="">
                                        <div class="ts_s">
                                            <div class="t2_s_1"><?php echo $order_good['goods_name'] ?></div>
                                        </div>
                                    </div>
                       </a>			   
                   <?php endforeach?>


               </div>
                <?php endforeach?>
            </div>
			<?php $orderms = ListModel::make('order')->addColumnsCondition(array('order_id' => $_GET['order_id']))->execute(); 
					$orderms[0]['pay_time']=date('Y-m-d H:i:s',$orderms[0]['pay_time']);
			?>
            <div style="background:#fff; line-height:24px; padding:8px 15px; margin:5px 0; border-top:1px solid #e3e5e9; border-bottom:1px solid #e3e5e9;">
            	<p>购买数量：<?php echo $num ?></p>
                <p>支付金额：<span style="color:#eb3030;">￥<?php echo $orderms[0]['total_amount'] ?></span></p>
                <p>订单编号：<?php echo $orderms[0]['order_sn'] ?></p>
                <p>购买时间：<?php echo $orderms[0]['pay_time'] ?></p>
            </div>

            <form action="" style="padding:0 15px 10px 15px; background:#fff; border-top:1px solid #e3e5e9;">
                <div style="padding:10px 0;">
                    <span style="display: inline-block;vertical-align: middle;">满意度</span>
                    <fieldset class="starability-fade" style="display: inline-block;vertical-align: middle;min-height: 0;">

                    		  <input type="radio" checked id="rate5-5" name="rating" value="5">
                    		  <label for="rate5-5"  title="Amazing">5 stars</label>

                    		  <input type="radio" id="rate4-5" name="rating" value="4">
                    		  <label for="rate4-5" title="Very good">4 stars</label>

                    		  <input type="radio" id="rate3-5" name="rating" value="3">
                    		  <label for="rate3-5" title="Average">3 stars</label>

                    		  <input type="radio" id="rate2-5" name="rating" value="2">
                    		  <label for="rate2-5" title="Not good">2 stars</label>

                    		  <input type="radio" id="rate1-5" name="rating" value="1">
                    		  <label for="rate1-5" title="Terrible">1 star</label>
                    		</fieldset>

                </div>
                <textarea name="content" placeholder="请输入评价内容" style="width:100%; padding:10px; height:115px; resize:none; border:none;border-radius:5px; background:#F5F5F5;"></textarea>

                
            </form>
            <div class="addr_eidt_btn_w" style="width:50%; margin:0 auto;margin-top:20px; ">
                <a href="javascript:;" style="width: 100%;" class="weui-btn weui-btn_primary addr_eidt_btn">提交评论</a>

            </div>
        </div>

    </div>

</div>
<script type="text/javascript">
    $('.addr_eidt_btn').click(function () {
        ajax_request('', $('form').serialize(), function () {
            Tip('提交成功');
            setTimeout(function () {
                location.href = '<?php echo $this->genurl('member/order/index',['wait_status' => OrderWaitStatusEnum::FINISH]);?>'
            }, 200);
        });
        return false;
    });

</script>