
    <!--搜索栏-s-->
<div class="page  weui-tab__panel  " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">会议简介</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
      <div class="banner ban1">
         <div class="mslide" id="slideTpshop">
             <ul>
                 <!--广告表-->
                 <adv pid="2" limit="5" item="v">
                     <li>
                         <a href="{$v.ad_link}">
                             <img src="{$v[ad_code]}" title="{$v[title]}" style="{$v[style]}" alt="">
                         </a>
                     </li>
                 </adv>
             </ul>
         </div>
     </div>
     <div class="good_info">
         <div class="good_title">偶来也啊啊</div>
         <div class="t1">
             <span class="t1_s">团购价： <span class="t1_s_m">￥246元</span></span>
             <span class="t1_s">单买价： <span class=" ">￥246元</span></span>
         </div>
         <div class="t2">
             5人团，立省35元
         </div>
         <div class="buy_num_w">
             <span class="fl">数量</span>
             <span class="fr">
                 <span class="jian no_ac"></span>
                 <input type="text" class="text" value="1"/>
                 <span class="jia"></span>
             </span>
         </div>
         <div class="t3">
             剩余时间：3小时23分25秒
         </div>
     </div>
 <div class="m_title_1" >
    <span class="line"></span> 别人开的团 <span class="line"></span>
</div>

    <div class="list3_w">
        <div class="list3_item">
            <span class="fl">
                <img class="avatar" src="" alt="">
                <span class="t1">
                    <span class="t1_s">还是已经走</span>
                    <span class="t1_m">正在开团中</span>
                </span>
            </span>
            <span class="fr">
                <span class="t2">还差1人成团</span>
                <span class="btn_r">去参团</span>
            </span>
        </div>
        <div class="list3_item">
            <span class="fl">
                <img class="avatar" src="" alt="">
                <span class="t1">
                    <span class="t1_s">还是已经走</span>
                    <span class="t1_m">正在开团中</span>
                </span>
            </span>
            <span class="fr">
                <span class="t2">还差1人成团</span>
                <span class="btn_r">去参团</span>
            </span>
        </div>
    </div>

     <div class="weui-navbar navbar-sm">
         <a href="" class="weui-navbar__item weui-bar__item_on">
             待开会议
         </a>
         <a href="" class="weui-navbar__item  ">
             历史会议
         </a>
      </div>

     <div class="buy_btn">
         <a href="<?php echo $this->genurl('pay/index') ?>" class="bt_a bt_a1">
            <div class="t1">￥13</div>
            <div class="t2">单独购买</div>
         </a>
         <a href="" class="bt_a bt_a2">
             <div class="t1">￥13</div>
             <div class="t2">单独购买</div>
         </a>
     </div>
 </div>
                    </div>

     </div>

</div>
<?php include \biz\Util::getFooterNav()?>