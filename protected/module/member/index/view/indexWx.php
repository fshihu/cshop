<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */
use module\cart\index\server\OrderStatusEnum;
use module\cart\index\server\OrderWaitStatusEnum;

?>

<!--搜索栏-s-->
<div class="page   " style=" background:#f3f7f8;  ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('home/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">我的</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
        <div class="my">
            <div class="info">
                <img src="<?php echo \module\member\index\UserServer::getAvatar() ?>" alt="" class="avatar">
                <div class="t1"><?php echo \biz\Session::getName() ?></div>
                <a href="<?php echo $this->genurl('info/qrcode') ?>">
                    <img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Qrcode_icon.png" alt="" class="code">
                </a>
                <div class="t2">
                    <div class="t2_s t2_s1">
                        <div class="t2_s_m_1">
                            <?php echo $user['gold'] ?>
                        </div>
                        <div class="t2_s_m_2">
                            我的积分
                        </div>
                    </div>
                    <div class="t2_s t2_s2">
                        <div class="t2_s_m_1">
                            <?php echo \module\member\index\UserServer::getLevelName($user) ?>
                        </div>
                        <div class="t2_s_m_2">
                            我的等级
                        </div>
                    </div>
                    <div class="t2_s t2_s3">
                        <div class="t2_s_m_1">
                            <?php echo \module\member\index\UserServer::getRecommUser() ?>
                        </div>
                        <div class="t2_s_m_2">
                            推荐人
                        </div>
                    </div>
                </div>
            </div>

            <div class="order">
                <div class="t1">我的订单</div>
                <div class="t2_w">
                    <a class="t2" href="<?php echo $this->genurl('order/index',['wait_status'=> OrderWaitStatusEnum::WAIT_PAY]) ?>">
                        <div class="t2_s_w">
                            <img style="width: 22px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/obligation_icon.png" alt="" class="t2_s">
                        </div>
                        <div class="t2_m">待付款</div>
                    </a>
                    <a class="t2" href="<?php echo $this->genurl('order/index',['wait_status'=> OrderWaitStatusEnum::WAIT_SEND]) ?>">
                        <div class="t2_s_w">
                            <img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Tosendthegoods_icon.png" alt="" class="t2_s">
                        </div>
                        <div class="t2_m">待发货</div>
                    </a>
                    <a class="t2" href="<?php echo $this->genurl('order/index',['wait_status'=> OrderWaitStatusEnum::WAIT_RECIVE]) ?>">
                        <div class="t2_s_w">
                            <img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Awaitingdelivery_icon.png" alt="" class="t2_s">
                        </div>
                        <div class="t2_m">待收货</div>
                    </a>
                    <a class="t2" href="<?php echo $this->genurl('order/index',['wait_status'=> OrderWaitStatusEnum::WAIT_COMMENT]) ?>">
                        <div class="t2_s_w">
                            <img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Toevaluate_icon.png" alt="" class="t2_s">
                        </div>

                        <div class="t2_m">待评价</div>
                    </a>
                    <a class="t2" href="<?php echo $this->genurl('order/index',['wait_status'=> OrderWaitStatusEnum::FINISH]) ?>">
                        <div class="t2_s_w">
                            <img style="width: 16px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/completed_icon.png" alt="" class="t2_s">
                        </div>

                        <div class="t2_m">已完成</div>
                    </a>
                </div>

            </div>


            <div class="weui-cells menu_s">

                <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('groupon/my/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/spelt_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的拼团</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('groupon/my/own') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Sincethegroup_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的自组团</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('service/my/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/service_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的服务</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access  " href="<?php echo $this->genurl('cart/index/index'); ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Shoppingcart_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的购物车</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access  li_borde" href="<?php echo $this->genurl('news/collect/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/collect_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>收藏和足迹</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('/member/merchant/enter') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/icon_Businessoccupancy.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>商家入驻</p>
                    </div>
                </a>

            </div>
            <div class="weui-cells menu_s">

                <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('money/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/wealth_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的财富</p>
                    </div>
                    <div class="weui-cell__ft">￥<?php echo $user['user_money'] ?></div>
                </a>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('gold/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/integral_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的积分</p>
                    </div>
                    <div class="weui-cell__ft"><?php echo $user['gold'] ?></div>
                </a>
                <a class="weui-cell weui-cell_access " href="<?php echo $this->genurl('level/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/members_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>会员等级</p>
                    </div>
                    <div class="weui-cell__ft"><?php echo \module\member\index\UserServer::getLevelName($user) ?></div>
                </a>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('msg/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/news_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>我的消息</p>
                    </div>
                    <div class="weui-cell__ft"><?php echo $user['msg_count'] ?></div>
                </a>

            </div>
            <div class="weui-cells menu_s">

                <a class="weui-cell weui-cell_access" href="<?php echo $this->genurl('info/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/information_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>个人信息</p>
                    </div>
                </a>
                 <?php if($user['is_sale'] || $user['is_merchant']):?>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('info/card') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Businesscard_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>电子名片</p>
                    </div>
                </a>
                 <?php endif;?>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('addr/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/address_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>地址管理</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access " href="<?php echo $this->genurl('bank/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/Bankcard_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>银行卡管理</p>
                    </div>
                </a>
                <a class="weui-cell weui-cell_access li_borde" href="<?php echo $this->genurl('recomm/index') ?>">
                    <div class="weui-cell__hd"><img src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/recommend_icon.png" alt="" class="icon"></div>
                    <div class="weui-cell__bd">
                        <p>推荐会员</p>
                    </div>
                    <div class="weui-cell__ft"><?php echo $user['recomm_count'] ?></div>
                </a>


            </div>

        </div>
                 </div>

 </div>

</div>
