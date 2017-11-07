<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */
?>

<!--搜索栏-s-->
<div class="page   " style="height: 100%; background:#f3f7f8;  ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">系统消息</p>
                    </div>
                </div>

            </div>
    <style type="text/css">
        .list6 .list_item{background: #ffffff; margin-bottom:12px;border-bottom: 1px solid #DBDBDB; padding:10px;}
        .list6 .list_item .t1{ padding-top: 10px;}
        .list6 .list_item .t1_s{ font-size: 11px;}
        .list6 .list_item .t2{ text-indent: 2em; margin-top:10px;}

    </style>
    <div class="  weui-panel_access  " >
        <div class="list6">
            <?php foreach($list as $item):?>
            <div class="list_item">
                <div class="t1">
                    <span class="t1_m">系统管理员</span>
                    <span class="t1_s"><?php echo date('Y-m-d H:i:s',$item['time']) ?></span>
                </div>
                <div class="t2">
                    <?php echo $item['content'] ?>
                </div>
            </div>
            <?php endforeach?>
         </div>
                 </div>

 </div>

</div>
