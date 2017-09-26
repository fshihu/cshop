<div class="page weui-tab__panel daily_detail " style="height: 100%;">
    <div class="page__bd">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <a href="javascript:history.back();">
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <div class="weui-cell__bd">
                    <p class="title">会议简介</p>
                </div>
                <div class="weui-cell__ft weui-title-menu">
                </div>

            </div>

        </div>
        <div class="  weui-panel_access">
            <div class="banner ban1">
                <div class="mslide" id="slideTpshop">
                    <ul>
                        <!--广告表-->
                        <?php foreach($ad_list as $ad):?>
                            <li>
                                <a href="<?php echo $ad['ad_link'] ?>">
                                    <img class="img" src="<?php echo $ad['ad_code'] ?>"alt="">
                                </a>
                            </li>
                        <?php endforeach?>
                     </ul>
                </div>
            </div>
            <div class="home_item_w">
                <div class="home_item">
                    <a href="<?php echo $this->genurl('goods/cate/list') ?>">
                        <img class="img" src="/public/upload/ad/2017/05-20/5b3261f64a247198d8c23a2d4bf3f8b7.jpg" alt="">
                        <div class="bg">
                                   <span class="txt">
                                       <span class="text1">健康会</span>
                                           <span class="text2">见客户1</span>
                                   </span>

                        </div>
                    </a>
                </div>
                <div class="home_item">
                    <a href="">
                        <img class="img" src="/public/upload/ad/2017/05-20/5b3261f64a247198d8c23a2d4bf3f8b7.jpg" alt="">
                        <div class="bg">
                                   <span class="txt">
                                       <span class="text1">健康会</span>
                                           <span class="text2">见客户1</span>
                                   </span>

                        </div>
                    </a>
                </div>
            </div>

            <div class="m_title">
                <span class="m_t_l">
                    <img class="mt_icon" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/shopping_icon.png" width="16" alt="">
                    <span class="mt_text">最新团购</span>
                </span>
                <span class="m_t_r">
                    <span class="mtr_text"> 更多 </span>
                    <img class="mtr_icon" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/more_left_icon.png" width="5" alt="">
                </span>
            </div>
            <div class="h_item_1_w">
                <a href="<?php echo $this->genurl('/groupon/index/index') ?>">
                    <div class="h_item_1">
                       <img class="img" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pic_Grouppurchasetwo.png"alt="">
                       <div class="bg"></div>
                       <div class="times">
                           <span class="time h">
                               <span class="t1">1</span>
                               <span class="t2">时</span>
                           </span>
                           <span class="time m">
                               <span class="t1">45</span>
                               <span class="t2">分</span>
                           </span>
                           <span class="time s">
                               <span class="t1">08</span>
                               <span class="t2">秒</span>
                           </span>
                       </div>
                   </div>

                </a>
                <div class="h_item_1">
                   <img class="img" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pic_Grouppurchasetwo.png"alt="">
                   <div class="bg"></div>
                   <div class="times">
                       <span class="time h">
                           <span class="t1">1</span>
                           <span class="t2">时</span>
                       </span>
                       <span class="time m">
                           <span class="t1">45</span>
                           <span class="t2">分</span>
                       </span>
                       <span class="time s">
                           <span class="t1">08</span>
                           <span class="t2">秒</span>
                       </span>
                   </div>
               </div>
                <div class="h_item_1">
                   <img class="img" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/pic_Grouppurchasetwo.png"alt="">
                   <div class="bg"></div>
                   <div class="times">
                       <span class="time h">
                           <span class="t1">1</span>
                           <span class="t2">时</span>
                       </span>
                       <span class="time m">
                           <span class="t1">45</span>
                           <span class="t2">分</span>
                       </span>
                       <span class="time s">
                           <span class="t1">08</span>
                           <span class="t2">秒</span>
                       </span>
                   </div>
               </div>


            </div>
        </div>


    </div>

</div>
<?php include \biz\Util::getFooterNav(); ?>
 