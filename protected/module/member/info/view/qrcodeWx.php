<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
?>

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

