<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
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
                        <p class="title">会议简介</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
         <?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\FormWidget($this,$data), \CC\util\common\widget\panel\FormPanel::instance()) ?>
        <div class="addr_eidt_btn_w">
            <a href="<?php echo $this->genurl('add') ?>" class="weui-btn weui-btn_primary addr_eidt_btn">确认修改</a>

        </div>

                 </div>

 </div>

</div>