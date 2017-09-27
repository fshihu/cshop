
    <!--搜索栏-s-->
<div class="page  weui-tab__panel  " style="height: 100%; ">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">补充预约人信息</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " >
            <?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\FormWidget($this,$data), \CC\util\common\widget\panel\FormPanel::instance()) ?>

                     </div>

     </div>

</div>
    <div class="js_dialog" id="iosDialog2" style="display: none;">
                <div class="weui-mask"></div>
                <div class="weui-dialog">
                    <div class="weui-dialog__bd">
                        您填写的预约资料必须与服务是使用人资料需要一致才能上传资料进入返还流程
                    </div>
                    <div class="weui-dialog__ft">
                        <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
                    </div>
                </div>
            </div>
    <script type="text/javascript">
        function alerts(id) {
               $('#iosDialog2').fadeIn(200);

           }
           $('.weui-dialog__btn_primary').click(function () {
               $('#iosDialog2').fadeOut(200);
               location.href='<?php echo $this->genurl('ok') ?>';
           });
        $('.sub_btn').click(function () {
            alerts();return;
                ajax_request('',$('.form-panel form').serialize(),function () {
                   location.href='<?php echo $this->genurl('index');?>';
                });
        });

    </script>
