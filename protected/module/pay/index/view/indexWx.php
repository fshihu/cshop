<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:45
 */
use module\cart\index\server\OrderWaitStatusEnum;

?>

<!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <div class="weui-cell__bd">
                        <p class="title">订单</p>
                    </div>
                </div>

            </div>
    <div class="page msg_success js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <p class="weui-msg__desc">调起微信支付中...</p>
            </div>
         </div>
    </div>
 </div>

</div>

    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg == 'get_brand_wcpay_request:ok'){
                    alert('支付成功');
                    location.href = '<?php echo $ok_url;?>';
                }else{
                    if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                        alert('支付取消');
                    }else{
                        alert('支付失败');
                    }
                    location.href = '<?php echo $err_url;?>';

                }
			}
		);
	}

	function callpay()
	{
	    $.post('<?php echo $this->genurl('ok');?>',{order_sn:'<?php echo $order_sn ?>'},function () {
            alert('支付成功');
            location.href = '<?php echo $ok_url;?>';
        });
	    return;
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}

 callpay();
	</script>
