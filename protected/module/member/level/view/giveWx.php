<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use module\member\index\UserServer;

?>

<!--搜索栏-s-->
<div class="page   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title"><?php echo $black_card_give['name'] ?></p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
         <div class="mem_level_give">
            <div class="binfo">
                <img class="avatar" src="<?php echo UserServer::getAvatar($user) ?>"/>
                <div class="t1"><?php echo $user['nickname'] ?></div>
            </div>

        </div>
        <?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\FormWidget($this,$data), \CC\util\common\widget\panel\FormPanel::instance()) ?>
        <div class="addr_eidt_btn_w">
            <a href="<?php echo $this->genurl('add') ?>" class="weui-btn weui-btn_primary addr_eidt_btn">确认转赠</a>

        </div>
        <input type="hidden" id="own_phone" value="<?php echo \module\member\index\UserServer::getPhone() ?>"/>

                 </div>

 </div>

</div>
<script type="text/javascript">
    $('.addr_eidt_btn').click(function () {
        ajax_request('',$('form').serialize(),function () {
            Tip('赠送成功');
           location.href='<?php echo $this->genurl('index');?>';
        });
        return false;
    });

</script>