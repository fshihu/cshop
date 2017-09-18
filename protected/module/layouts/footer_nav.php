<div class="weui-tabbar">
    <a href="{:U('Index/index')}" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" <if condition="CONTROLLER_NAME eq 'Index'">class="yello" </if> src="__STATIC__/images/home/index_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="{:U('Goods/categoryList')}" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" <if condition="CONTROLLER_NAME eq 'Index'">class="yello" </if> src="__STATIC__/images/home/classification_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">分类</p>
    </a>
    <a href="{:U('Service/serviceList')}" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" <if condition="CONTROLLER_NAME eq 'Index'">class="yello" </if> src="__STATIC__/images/home/service_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">服务</p>
    </a>
    <a href="{:U('Article/articleList')}" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" <if condition="CONTROLLER_NAME eq 'Index'">class="yello" </if> src="__STATIC__/images/home/information_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">资讯</p>
    </a>
    <a href="{:U('Index/index')}" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" <if condition="CONTROLLER_NAME eq 'Index'">class="yello" </if> src="__STATIC__/images/home/me_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">我的</p>
    </a>


</div>