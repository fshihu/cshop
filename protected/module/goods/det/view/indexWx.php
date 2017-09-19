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
             <span class="t1_k">市场价：¥546.00元 </span>
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
     </div>


     <div class="weui-navbar navbar-sm">
         <a href="" class="weui-navbar__item weui-bar__item_on">
             待开会议
         </a>
         <a href="" class="weui-navbar__item  ">
             历史会议
         </a>
      </div>
        <div class="commont_list">
            <div class="comm_item">
                <div class="t1">
                    <img class="img" src="" alt="">
                    <span class="t1_s">安妮宝贝</span>
                </div>
                <div class="t2">商品收到了，非常漂亮！商品收到了，非常漂亮！商品收到了，非常漂亮！商品收到了，非常漂亮！</div>
                <div class="t3">
                    09-07 14:23:33
                </div>
            </div>
            <div class="comm_item">
                <div class="t1">
                    <img class="img" src="" alt="">
                    <span class="t1_s">安妮宝贝</span>
                </div>
                <div class="t2">商品收到了，非常漂亮！商品收到了，非常漂亮！商品收到了，非常漂亮！商品收到了，非常漂亮！</div>
                <div class="t3">
                    09-07 14:23:33
                </div>
            </div>
        </div>
     <div class="buy_btn">
         <a href="<?php echo $this->genurl('cart/index/index') ?>" class="bt_a bt_a1">
            <div class="t3">加入购物车</div>
         </a>
         <a href="" class="bt_a bt_a2">
             <div class="t3">立即购买</div>
         </a>
     </div>

     <div class="buy_confirm" style="display: none;">
         <div class="bc_hd">
             <img class="bc_img" src="" alt="">
            <div class="bc_info">
                <div class="t1">￥245.00</div>
                <div class="t2">已选: <span class="t2_sm">杏色 中码</span></div>
            </div>
             <div class="bc_close">×</div>
         </div>
         <div class="bc_bd">
             <div class="bcb_item">
                 <div class="t1">颜色</div>
                 <div class="t2">
                     <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn">按钮</a>
                 </div>
             </div>
             <div class="bcb_item">
                 <div class="t1">颜色</div>
                 <div class="t2">
                     <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default">按钮</a>
                                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_warn">按钮</a>
                 </div>
             </div>

         </div>
         <a href="javascript:;" class="weui-btn confirm_btn weui-btn_warn">确认</a>

     </div>
 </div>
                    </div>

     </div>

</div>
    <?php include \biz\Util::getFooterNav()?>