<div class="page weui-tab__panel daily_detail " style="height: 100%;">
    <div class="page__bd">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                 <div class="weui-cell__bd">
                    <p class="title">美丽服务商城</p>
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
                <?php foreach($cate_list as $cate):?>
                <div class="home_item">
                    <a href="<?php echo $this->genurl('goods/cate/list') ?>">
                        <img class="img" src="<?php echo $cate['image'] ?>" alt="">
                        <div class="bg">
                                   <span class="txt">
                                       <span class="text1"><?php echo $cate['mobile_name'] ?></span>
                                           <span class="text2"><?php echo $cate['name'] ?></span>
                                   </span>

                        </div>
                    </a>
                </div>
                <?php endforeach?>
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
                <?php foreach($group_buys as $i => $group_buy):?>
                <a href="<?php echo $this->genurl('/groupon/index/index',['id'=>$group_buy['id']]) ?>">
                    <div class="h_item_1">
                       <img class="img" src="<?php echo $group_buy['image'] ?>"alt="">
                       <div class="bg"></div>
                       <div class="times" id="times_ec<?php echo $i ?>">


                       </div>
                        <script type="text/javascript">
                            leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>,'#times_ec<?php echo $i ?>',2);

                        </script>
                   </div>

                </a>
                <?php endforeach?>



            </div>
        </div>


    </div>

</div>
<?php include \biz\Util::getFooterNav(); ?>
 