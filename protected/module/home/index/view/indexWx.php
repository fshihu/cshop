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
            <div class="home_item_w">
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
                    <img class="mt_icon" src="__STATIC__/images/home/shopping_icon.png" width="16" alt="">
                    <span class="mt_text">最新团购</span>
                </span>
                <span class="m_t_r">
                    <span class="mtr_text"> 更多 </span>
                    <img class="mtr_icon" src="__STATIC__/images/home/more_left_icon.png" width="5" alt="">
                </span>
            </div>
            <div class="h_item_1_w">
                <div class="h_item_1">
                   <img class="img" src="__STATIC__/images/home/pic_Grouppurchasetwo.png"alt="">
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
                   <img class="img" src="__STATIC__/images/home/pic_Grouppurchasetwo.png"alt="">
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
                   <img class="img" src="__STATIC__/images/home/pic_Grouppurchasetwo.png"alt="">
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

<!--底部导航-start-->
<include file="public/footer_nav"/>
<!--底部导航-end-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
<script type="text/javascript">
    /**
     * 秒杀模块倒计时
     * */
    function GetRTime(end_time) {
        var NowTime = new Date();
        var t = (end_time * 1000) - NowTime.getTime();
        var d = Math.floor(t / 1000 / 60 / 60 / 24);
        var h = Math.floor(t / 1000 / 60 / 60 % 24);
        var m = Math.floor(t / 1000 / 60 % 60);
        var s = Math.floor(t / 1000 % 60);
        if (s >= 0)
            return (d * 24 + h) + '时' + m + '分' + s + '秒';
    }
    function GetRTime2() {
        var text = GetRTime('{$end_time}');
        if (text == 0) {
            $(".hms").text('活动已结束');
        } else {
            $(".hms").text(text);
        }
    }
    setInterval(GetRTime2, 1000);

    /**
     * 继续加载猜您喜欢
     * */
    var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
    var page = 0;
    function ajax_sourch_submit() {
        if (before_request == 0)// 上一次请求没回来 不进行下一次请求
            return false;
        before_request = 0;
        page++;
        $.ajax({
            type: "get",
            url: "/index.php?m=Mobile&c=Index&a=ajaxGetMore&p=" + page,
            success: function (data) {
                if (data) {
                    $("#J_ItemList>ul").append(data);
                    before_request = 1;
                } else {
                    $('.get_more').hide();
                }
            }
        });
    }
</script>
</body>
</html>
