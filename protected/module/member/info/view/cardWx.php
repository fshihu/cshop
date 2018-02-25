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
         <div class="mem_info_card">
            <div class="avatar_w">
                <img src="<?php echo $user['head_pic'] ?>" alt="" class="avatar">
            </div>
            <div class="card_list_w">
                <div class="card_list">
                    <span class="t1">姓名：</span>
                    <span class="t2"><?php echo $user['name'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">微信昵称：</span>
                    <span class="t2"><?php echo $user['nickname'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">联系方式：</span>
                    <span class="t2"><?php echo $user['mobile'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">邮箱：</span>
                    <span class="t2"><?php echo $user['email'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">职业：</span>
                    <span class="t2"><?php echo $user['occupation'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">爱好：</span>
                    <span class="t2"><?php echo $user['hobby'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">角色：</span>
                    <span class="t2"><?php echo \module\member\index\UserServer::getLevelName($user) ?></span>
                </div>

            </div>
        </div>

                 </div>

 </div>

</div>

