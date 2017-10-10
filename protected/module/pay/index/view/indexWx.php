<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:45
 */
use module\cart\index\server\OrderWaitStatusEnum;

?>
<p>发起支付中...</p>

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
