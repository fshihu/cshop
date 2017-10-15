<div class="weui-tabbar">
    <a href="<?php echo $this->genurl('/home/index/index') ?>" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/index_icon<?php echo \biz\Util::isPageHome() ?>.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="<?php echo $this->genurl('/goods/cate/index') ?>" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/classification_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">分类</p>
    </a>
    <a href="<?php echo $this->genurl('/service/index/index') ?>" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/service_icon<?php echo \biz\Util::isPageHome() ?>.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">服务</p>
    </a>
    <a href="<?php echo $this->genurl('/news/index/index') ?>" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/information_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">资讯</p>
    </a>
    <a href="<?php echo $this->genurl('member/index/index') ?>" class="weui-tabbar__item">
        <span style="display: inline-block;position: relative;">
            <img style="width:20px;height:20px;margin-top:3px;" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/me_icon.png" alt="" class="weui-tabbar__icon">
        </span>
        <p class="weui-tabbar__label">我的</p>
    </a>


</div>