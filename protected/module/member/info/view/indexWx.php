<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
?>

<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">个人信息修改</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
        <?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\FormWidget($this,$data), \CC\util\common\widget\panel\FormPanel::instance()) ?>

                 </div>

 </div>

</div>
<script type="text/javascript">
    $('.sub_btn').click(function () {
        ajax_request('',$('form').serialize(),function () {
            ajax_request('',$('.form-panel form').serialize(),function () {
                Tip('提交成功');
                setTimeout(function () {
                    location.href = '<?php echo $this->genurl('member/index/index');?>';
                },200);
            });
        });
        return false;
    });

</script>