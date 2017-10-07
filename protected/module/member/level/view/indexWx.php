<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use module\member\index\server\UserLevelServer;

?>

<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">会员等级</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
         <div class="weui-cells mem_lvele_index ">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>您目前的等级</p>
                </div>
                <div class="weui-cell__hd"><?php echo \module\member\index\UserServer::getLevelName($user) ?></div>
            </div>
            <div class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>
                        您的等级有效期</p>
                </div>
                <div class="weui-cell__hd">2017-03-03至2018-03-03</div>
            </div>
            <div class="weui-cell weui-cell_access" href="javascript:;">
                 <?php if(UserLevelServer::isNormal($user)):?>
                <div class="weui-cell__bd">
                    <div class="shengji_desc">
                        <p class="t1">
                            升级金卡会员
                        </p>
                        <p class="t2">
                            *请选择以下几种方式升级金卡会员
                        </p>
                    </div>

                     <?php if($user['total_amount'] >= 50000):?>
                         <a href="<?php echo $this->genurl('upgrade',['update_type' => UserLevelServer::LEVEL_UPGRADE_FULL_MONEY]); ?>">
                             <div class="shengji_fs">
                                 <div class="t1">消费满￥50,000，点击这里升级</div>
                                 <div class="t2">您当前的消费金额为<?php echo $user['total_amount'] ?>，可以升级</div>
                             </div>
                         </a>
                     <?php else: ?>
                         <div class="shengji_fs">
                             <div class="t1">消费满￥50,000，点击这里升级</div>
                             <div class="t2">您当前的消费金额为<?php echo $user['total_amount'] ?>，暂时不能升级</div>
                         </div>
                     <?php endif;?>
                    <a href="<?php echo $this->genurl('upgrade',['update_type' => UserLevelServer::LEVEL_UPGRADE_TRUN_MONEY]); ?>">
                        <div class="shengji_fs">
                            <div class="t1">缴纳￥880，立即申请升级金卡会员</div>
                            <div class="t2">点击这里，缴交会费，审核后成为金牌会员</div>
                        </div>
                    </a>
                     <?php if($user['recomm_golden_num'] >= 5):?>
                         <a href="<?php echo $this->genurl('upgrade',['update_type' => UserLevelServer::LEVEL_UPGRADE_RECOMM_GOLDEN]); ?>">
                             <div class="shengji_fs">
                                 <div class="t1">推送5人成为金卡会员</div>
                                 <div class="t2">您推荐的好友中有<?php echo $user['recomm_golden_num'] ?>名金牌会员，可以升级</div>
                             </div>
                         </a>
                      <?php else:?>
                         <div class="shengji_fs">
                             <div class="t1">推送5人成为金卡会员</div>
                             <div class="t2">您推荐的好友中有<?php echo $user['recomm_golden_num'] ?>名金牌会员，暂时不能升级</div>
                         </div>
                     <?php endif;?>
                 </div>
                 <?php endif;?>
                <div class="weui-cell__bd" style="display: none;">
                    <div class="shengji_desc">
                        <p class="t1">
                            升级金卡会员
                        </p>
                        <p class="t2">
                            *请选择以下几种方式升级金卡会员
                        </p>
                    </div>

                    <div class="shengji_fs">
                        <div class="t1">消费满￥500,000，点击这里升级</div>
                        <div class="t2">您黑卡附属卡会员期限内目前消费金额为￥35,000，暂时不能升级</div>
                    </div>
                    <a href="<?php echo $this->genurl('give') ?>">
                        <div class="shengji_fs">
                            <div class="sanjiao">
                            </div>
                            <div class="t3">已赠送</div>
                            <div class="t1">消费满￥500,000，点击这里升级</div>
                            <div class="t2">您黑卡附属卡会员期限内目前消费金额为￥35,000，暂时不能升级</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

                 </div>

 </div>

</div>
