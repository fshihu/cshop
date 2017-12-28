<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
?>
<script>
//微信分享
var wimg = "分享图片网址123";
var wurl = "分享网址123";
var wdesc = '分享内容123';
var wtit = '分享标题123';
var wappid = '';
 
function shareMsg() {//<span style="font-family: Arial, Helvetica, sans-serif;">发送给好友</span><span style="font-family: Arial, Helvetica, sans-serif;">标题和内容默认都显示</span>
    WeixinJSBridge.invoke('sendAppMessage',{
        "appid": wappid,
        "img_url": wimg,
        "img_width": "200",
        "img_height": "200",
        "link": wurl,
        "desc": wdesc,
        "title": wtit,
    })
}
function shareQuan() {  //<span style="font-family: Arial, Helvetica, sans-serif;">分享到朋友圈只有标题显示</span>
    WeixinJSBridge.invoke('shareTimeline',{
        "img_url": wimg,
        "img_width": "200",
        "img_height": "200",
        "link": wurl,
        "desc": wdesc,
        "title": wtit
    });
}
function shareWeibo() { <span style="font-family: Arial, Helvetica, sans-serif;">//</span><span style="font-family: Arial, Helvetica, sans-serif;">分享到微博只有内容显示</span>
    WeixinJSBridge.invoke('shareWeibo',{
        "content": wdesc,
        "url": wurl,
    });
}
// 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
    // 发送给好友
    WeixinJSBridge.on('menu:share:appmessage', function(argv){
        shareMsg();
    });
    // 分享到朋友圈
    WeixinJSBridge.on('menu:share:timeline', function(argv){
        shareQuan();
    });
    // 分享到微博
    WeixinJSBridge.on('menu:share:weibo', function(argv){
        shareWeibo();
    });
}, false);
</script>


<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%;background: #f3f7f8; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">推广二维码</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " style="padding: 10px;">
        <img src="<?php echo $user['qr_code_url'] ?>" style="width: 100%;" alt="" class="qrcode">
    </div>

 </div>

</div>

