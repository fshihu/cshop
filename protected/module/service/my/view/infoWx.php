<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use CC\util\date\DateUtil;
use CC\util\db\SexEnum;
use module\service\reserve\enum\MarriageEnum;
use module\service\reserve\enum\ReserveReasonEnum;

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
                        <p class="title">我的服务预约</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
         <div class="mem_info_card">
             <div class="card_list_w">
                <div class="card_list">
                    <span class="t1">预约人姓名：</span>
                    <span class="t2"><?php echo $service_reserve['consignee'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">预约手机号：</span>
                    <span class="t2"><?php echo $service_reserve['mobile'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">性别：</span>
                    <span class="t2"><?php echo SexEnum::getValueByIndex($service_reserve['sex']) ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">出生日期：</span>
                    <span class="t2"><?php echo DateUtil::formatDate($service_reserve['birthday'],'Y年m月d日') ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">职业：</span>
                    <span class="t2"><?php echo $service_reserve['occupation'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">出生地：</span>
                    <span class="t2">                                 <?php echo $service_reserve['p_name'] ?>
                                                     <?php echo $service_reserve['c_name'] ?>
                                                     <?php echo $service_reserve['d_name'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">婚姻状况：</span>
                    <span class="t2"><?php echo MarriageEnum::getValueByIndex($service_reserve['marriage']) ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">性格爱好：</span>
                    <span class="t2"><?php echo $service_reserve['hobby'] ?></span>
                </div>
                <div class="card_list">
                    <span class="t1">预约理由：</span>
                    <span class="t2"><?php echo ReserveReasonEnum::getValueByIndex($service_reserve['reserve_reason']).$service_reserve['reserve_reason_other'] ?>></span>
                </div>
                <div class="card_list">
                    <span class="t1">预约日期：</span>
                    <span class="t2"><?php echo DateUtil::formatDate($service_reserve['date'],'Y年m月d日') ?></span>
                </div>

            </div>
        </div>

                 </div>

 </div>

</div>

