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
                        <p class="title"><?php echo $user['nickname'] ?></p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
         <div class="mem_info_qrcode">
            <div class="qrcode_w">
                <img src="<?php echo $user['qr_code_url'] ?>" alt="" class="qrcode">
            </div>
             <div class="weui-cell info">
                             <div class="weui-cell__hd"><img class="ims" src="<?php echo \module\member\index\UserServer::getAvatar() ?>" alt=""  ></div>
                             <div class="weui-cell__bd">
                                 <div class="t1"><?php echo $user['nickname'] ?></div>
                                 <div class="t2">推广链接</div>
                                 <div class="t2"><?php echo $user['recomm_url'] ?></div>
                                 <div class="t3">请扫描二维码或长按链接复制给用户</div>
                             </div>
                         </div>
         </div>
                 </div>

 </div>

</div>

