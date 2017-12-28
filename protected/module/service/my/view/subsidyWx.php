<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 17:31
 */
?>
<?php echo \CC\util\common\server\AssetManager::instance()->getCssJs(array(
        '/public/biz/datepicker/css/mobiscroll.css',
        '/public/biz/datepicker/css/mobiscroll_date.css',
     '/public/biz/datepicker/js/mobiscroll_date.js',
        '/public/biz/datepicker/js/mobiscroll.js',
)) ?>
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
            <div class="row-group  row-group-form_money  clearfix"><label class="data-label">
                    <span>服务名称：</span>
                </label>
                <div class="data-group data-group-form_money">
                    <?php echo $service_reserve['name'] ?>
                </div>
            </div>
            <div class="row-group  row-group-form_money  clearfix"><label class="data-label">
                    <span>部位：</span>
                </label>
                <div class="data-group data-group-form_money">
                    <?php echo $service_reserve['part'] ?>

                </div>
            </div>
            <?php echo \CC\util\common\widget\widget\WidgetBuilder::build(new \CC\util\common\widget\widget\FormWidget($this,$data), \CC\util\common\widget\panel\FormPanel::instance()) ?>
            <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                    <span>上传单据：</span>
                </label>
                <div class="data-group data-group-form_cost_date">
                    <div class="  weui-cells_form" id="uploader">
                        <div class=" ">
                            <div class="weui-cell__bd">
                                <div class="weui-uploader">
                                    <div class="weui-uploader__hd" style="display: none;">
                                        <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                    </div>
                                    <div class="weui-uploader__bd">
                                        <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                        <div class="weui-uploader__input-box">
                                            <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                     </div>
        <div class="addr_eidt_btn_w">
            <a href="javascript:;" class="weui-btn weui-btn_primary addr_eidt_btn">添加</a>

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
        $('.addr_eidt_btn').click(function () {
            ajax_request('',$('form').serialize(),function () {
                alert('提交成功');
                location.href='<?php echo $this->genurl('member/index/index') ?>';
            });
            return false;
        });
        var currYear = (new Date()).getFullYear();
        	var opt={};
        	opt.date = {preset : 'date'};
        	opt.datetime = {preset : 'datetime'};
        	opt.time = {preset : 'time'};
        	opt.default = {
        		theme: 'android-ics light', //皮肤样式
        		display: 'modal', //显示方式
        		mode: 'scroller', //日期选择模式
        		dateFormat: 'yyyy-mm-dd',
        		lang: 'zh',
        		showNow: true,
        		nowText: "今天",
        		startYear: currYear -1, //开始年份
        		endYear: currYear + 10 //结束年份
        	};

        	$("#form_cost_date").mobiscroll($.extend(opt['date'], opt['default']));
        var uploadCount = 0;
        weui.uploader('#uploader', {
           url: '<?php echo $this->genurl('core/upfile/index');?>',
           auto: true,
           type: 'file',
           fileVal: 'fileVal',
           compress: {
               width: 1600,
               height: 1600,
               quality: .8
           },
           onBeforeQueued: function(files) {
               // `this` 是轮询到的文件, `files` 是所有文件
               $('.weui-uploader__input-box').hide();

               if(["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0){
                   weui.alert('请上传图片');
                   return false; // 阻止文件添加
               }
               if(this.size > 10 * 1024 * 1024){
                   weui.alert('请上传不超过10M的图片');
                   return false;
               }
               if (files.length > 5) { // 防止一下子选择过多文件
                   weui.alert('最多只能上传5张图片，请重新选择');
                   return false;
               }
               if (uploadCount + 1 > 5) {
                   weui.alert('最多只能上传5张图片');
                   return false;
               }

               ++uploadCount;

               // return true; // 阻止默认行为，不插入预览图的框架
           },
           onQueued: function(){
               console.log(this);

               // console.log(this.status); // 文件的状态：'ready', 'progress', 'success', 'fail'
               // console.log(this.base64); // 如果是base64上传，file.base64可以获得文件的base64

               // this.upload(); // 如果是手动上传，这里可以通过调用upload来实现；也可以用它来实现重传。
               // this.stop(); // 中断上传

               // return true; // 阻止默认行为，不显示预览图的图像
           },
           onBeforeSend: function(data, headers){
               console.log(this, data, headers);
               // $.extend(data, { test: 1 }); // 可以扩展此对象来控制上传参数
               // $.extend(headers, { Origin: 'http://127.0.0.1' }); // 可以扩展此对象来控制上传头部
               // return false; // 阻止文件上传
           },
           onProgress: function(procent){
               console.log(this, procent);
               // return true; // 阻止默认行为，不使用默认的进度显示
           },
           onSuccess: function (ret) {
               console.log(this, ret);
               $('input[name="bills_file"]').val(ret.url);
               // return true; // 阻止默认行为，不使用默认的成功态
           },
           onError: function(err){
               console.log(this, err);
               // return true; // 阻止默认行为，不使用默认的失败态
           }
        });
     </script>

