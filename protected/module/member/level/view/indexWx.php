<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use module\member\index\server\UserLevelServer;
use module\member\index\UserServer;

?>

<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
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
                <div class="weui-cell__hd"><?php echo UserServer::getLevelName($user) ?></div>
            </div>
              <?php if(!UserLevelServer::isNormal($user)):?>
            <div class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>
                        您的等级有效期</p>
                </div>
                <div class="weui-cell__hd"><?php echo date('Y-m-d',$user['level_start_time']) ?>至<?php echo date('Y-m-d',$user['level_end_time']) ?></div>
            </div>
              <?php endif;?>
            <div class="weui-cesll " style="    padding: 15px;
                border-top: 1px solid #d9d9d9;"  href="javascript:;">
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
                         <a class="update_link" href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_GOLDED_CARD,'update_type' => UserLevelServer::LEVEL_UPGRADE_FULL_MONEY]); ?>">
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
                    <a  href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_GOLDED_CARD,'money' => '880','update_type' => UserLevelServer::LEVEL_UPGRADE_TRUN_MONEY]); ?>">
                        <div class="shengji_fs">
                            <div class="t1">缴纳￥880，立即申请升级金卡会员</div>
                            <div class="t2">点击这里，缴交会费，审核后成为金牌会员</div>
                        </div>
                    </a>
                     <?php if($user['recomm_golden_num'] >= 5):?>
                         <a class="update_link" href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_GOLDED_CARD,'update_type' => UserLevelServer::LEVEL_UPGRADE_RECOMM_GOLDEN]); ?>">
                             <div class="shengji_fs">
                                 <div class="t1">推送5人成为金卡会员</div>
                                 <div class="t2">您推荐的好友中有<?php echo $user['recomm_golden_num'] ?>名金牌会员，可以升级</div>
                             </div>
                         </a>
                      <?php else:?>
                         <div class="shengji_fs">
                             <div class="t1">推送5人成为金卡会员</div>
                             <div class="t2">您推荐的好友中有<?php echo $user['recomm_golden_num'] ?>名金卡会员，暂时不能升级</div>
                         </div>
                     <?php endif;?>
                 </div>
                 <?php endif;?>
                 <?php if(UserLevelServer::isGoldedCrad($user)):?>
                <div class="weui-cell__bd"  >
                    <div class="shengji_desc">
                        <p class="t1">
                            续费金卡会员
                        </p>
                        <p class="t2">
                           *请选择以下几种方式进行续费
                        </p>
                    </div>

                    <a href="<?php echo $this->genurl('renew',['money'=>440,'renew_type' => UserLevelServer::LEVEL_RENEW_TRUN_MONEY]); ?>">
                        <div class="shengji_fs">
                            <div class="t1">缴交￥440，续费金卡会员</div>
                            <div class="t2">请点击这里，续交会费，审核后金卡会员有效期至<?php echo date('Y-m-d',strtotime('+1 year',$user['level_end_time'])) ?></div>
                        </div>
                    </a>
                    <?php if($user['recomm_golden_num'] >= 3):?>
                        <a class="update_link" href="<?php echo $this->genurl('renew',['renew_type' => UserLevelServer::LEVEL_RENEW_RECOMM_GOLDEN]); ?>">
                            <div class="shengji_fs">
                                <div class="t1">有效期内推荐3人成为金卡会员</div>
                                <div class="t2">您的会员有效期内，有<?php echo $user['recomm_golden_num'] ?>名推荐好友成为金牌会员满足自动续费要求</div>
                            </div>
                        </a>
                     <?php else:?>
                        <div class="shengji_fs">
                            <div class="t1">有效期内推荐3人成为金卡会员</div>
                            <div class="t2">您的会员有效期内，有<?php echo $user['recomm_golden_num'] ?>名推荐好友成为金牌会员暂时不能满足自动续费要求</div>
                        </div>
                    <?php endif;?>

                    <div class="shengji_desc">
                        <p class="t1">
                            升级黑卡会员
                        </p>
                        <p class="t2">
                           *请选择以下几种方式升级成为黑卡会员
                        </p>
                    </div>
                    <?php if($user['total_amount'] >= 500000):?>
                        <a class="update_link" href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_BLACK_CARD,'update_type' => UserLevelServer::LEVEL_UPGRADE_FULL_MONEY]); ?>">
                            <div class="shengji_fs">
                                <div class="t1">消费满￥500,000，点击这里升级</div>
                                <div class="t2">您金卡会员期限内消费金额为￥<?php echo $user['total_amount'] ?>，可以升级</div>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="shengji_fs">
                            <div class="t1">消费满￥500,000，点击这里升级</div>
                            <div class="t2">您金卡会员期限内消费金额为￥<?php echo $user['total_amount'] ?>，暂时不能升级</div>
                        </div>
                    <?php endif;?>

                </div>
                 <?php endif;?>
                 <?php if(UserLevelServer::isBlackCrad($user)):?>
                     <div class="weui-cell__bd"  >
                         <div class="shengji_desc">
                             <p class="t1">
                                 续费黑卡会员
                             </p>
                             <p class="t2">
                                *请选择以下几种方式进行续费
                             </p>
                         </div>

                         <a href="<?php echo $this->genurl('renew',['money' =>880,'renew_type' => UserLevelServer::LEVEL_RENEW_TRUN_MONEY]); ?>">
                             <div class="shengji_fs">
                                 <div class="t1">缴交￥880，续费黑卡会员</div>
                                 <div class="t2">请点击这里，续交会费，审核后黑卡会员有效期至<?php echo date('Y-m-d',strtotime('+1 year',$user['level_end_time'])) ?></div>
                             </div>
                         </a>
                         <?php if($user['recomm_golden_num'] >= 5):?>
                             <a href="<?php echo $this->genurl('renew',['renew_type' =>UserLevelServer::LEVEL_RENEW_RECOMM_GOLDEN]); ?>">
                                 <div class="shengji_fs">
                                     <div class="t1">有效期内推荐5人成为黑卡会员</div>
                                     <div class="t2">您的会员有效期内，有<?php echo $user['recomm_golden_num'] ?>名推荐好友成为金牌会员满足自动续费要求</div>
                                 </div>
                             </a>
                          <?php else:?>

                             <div class="shengji_fs">
                                 <div class="t1">有效期内推荐5人成为黑卡会员</div>
                                 <div class="t2">您的会员有效期内，有<?php echo $user['recomm_golden_num'] ?>名推荐好友成为金牌会员暂时不能满足自动续费要求</div>
                             </div>
                         <?php endif;?>

                         <div class="shengji_desc">
                             <p class="t1">
                                 赠送黑卡附属卡
                             </p>
                             <p class="t2">
                                 *请选择以下几种方式升级成为黑卡会员
                             </p>
                         </div>

                         <?php foreach(UserLevelServer::getBlackList() as $item):?>
                              <?php if($item['status'] == UserLevelServer::BLACK_STATSU_NO_GIVE):?>
                             <a href="<?php echo $this->genurl('give',['id'=>$item['id']]) ?>">
                                 <div class="shengji_fs">
                                     <div class="sanjiao">
                                     </div>
                                     <div class="t3"><?php echo UserLevelServer::getBlackStatusDesc($item['status']) ?></div>
                                     <div class="t1"><?php echo $item['name'] ?></div>
                                     <div class="t2">未赠送好友，点击选择好友赠送</div>
                                 </div>
                             </a>
                             <?php endif;?>
                         <?php if($item['status'] == UserLevelServer::BLACK_STATSU_GIVEED):?>
                                 <div class="shengji_fs">
                                     <div class="sanjiao">
                                     </div>
                                     <div class="t3"><?php echo UserLevelServer::getBlackStatusDesc($item['status']) ?></div>
                                     <div class="t1"><?php echo $item['name'] ?></div>
                                     <div class="t2">已赠送好友沁怡（账号：<?php substr_replace(UserServer::getUser($item['give_uid'])['mobile'],'****',3,4) ?>） <br> 好友已接受，并成为黑卡附属卡会员</div>
                                 </div>
                         <?php endif;?>
                             <?php if($item['status'] == UserLevelServer::BLACK_STATSU_WAIT_GIVE):?>
                                 <div class="shengji_fs">
                                     <div class="sanjiao">
                                     </div>
                                     <div class="t3"><?php echo UserLevelServer::getBlackStatusDesc($item['status']) ?></div>
                                     <div class="t1"><?php echo $item['name'] ?></div>
                                     <div class="t2">已赠送好友沁怡（账号：<?php substr_replace(UserServer::getUser($item['give_uid'])['mobile'],'****',3,4) ?>） <br>好友暂未接受成为黑卡附属卡会员</div>
                                 </div>
                             <?php endif;?>
                         <?php endforeach?>


                     </div>
                 <?php endif;?>
                <?php if(UserLevelServer::isBlackAttachCrad($user)):?>
                                <div class="weui-cell__bd">
                                    <div class="shengji_desc">
                                        <p class="t1">
                                            升级成为主卡
                                        </p>
                                        <p class="t2">
                                            *请选择以下几种方式进行升级
                                        </p>
                                    </div>

                                     <?php if($user['total_amount'] >= 500000):?>
                                         <a class="update_link" href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_BLACK_CARD,'update_type' => UserLevelServer::LEVEL_UPGRADE_FULL_MONEY]); ?>">
                                             <div class="shengji_fs">
                                                 <div class="t1">消费满￥500,000，点击这里升级</div>
                                                 <div class="t2">您黑卡附属卡会员期限内目前消费金额为￥<?php echo $user['total_amount'] ?>，暂时不能升级</div>
                                             </div>
                                         </a>
                                     <?php else: ?>
                                         <div class="shengji_fs">
                                             <div class="t1">消费满￥500,000，点击这里升级</div>
                                             <div class="t2">您当前的消费金额为<?php echo $user['total_amount'] ?>，暂时不能升级</div>
                                         </div>
                                     <?php endif;?>

                                 </div>
                                 <?php endif;?>
                 <?php if($black_card_give):?>
                     <div class="weui-cell__bd">
                         <div class="shengji_desc">
                             <p class="t1">
                                 升级黑卡附属卡会员
                             </p>
                             <p class="t2">
                                 *请选择以下几种方式升级成为黑卡附属卡会员
                             </p>
                         </div>
                         <a class="update_link" href="<?php echo $this->genurl('upgrade',['level' =>UserLevelServer::LEVEL_BLACK_ATTACH_CARD,'give_id' => $black_card_give['id'],'update_type' => UserLevelServer::LEVEL_UPGRADE_FRIEND_GIVE]); ?>">
                             <div class="shengji_fs">
                                 <div class="t1">您的好友探索者赠送您黑卡附属卡</div>
                                 <div class="t2">点击获取黑卡附属卡，成为黑卡附属卡会员</div>
                             </div>
                         </a>


                      </div>

                 <?php endif;?>
            </div>
        </div>

                 </div>

 </div>

</div>
<script type="text/javascript">
    $('.update_link').click(function () {
        ajax_request($(this).attr('href'),{},function () {
           Tip('成功');
           location.href = '';
        });
        return false;
    });
</script>