<?php echo \CC\util\common\server\AssetManager::instance()->getCssJs(array(
        '/public/biz/datepicker/css/mobiscroll.css',
        '/public/biz/datepicker/css/mobiscroll_date.css',
     '/public/biz/datepicker/js/mobiscroll_date.js',
        '/public/biz/datepicker/js/mobiscroll.js',
)) ?>
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
                        您填写的预约资料必须与服务使用人资料需要一致才能上传资料进入返还流程
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
            ajax_request('',$('form').serialize(),function () {
                alerts();
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
        		startYear: currYear , //开始年份
        		endYear: currYear + 10 //结束年份
        	};

        	$("#form_date").mobiscroll($.extend(opt['date'], opt['default']));

         	var opt={};
        	opt.date = {preset : 'date'};
        	opt.datetime = {preset : 'datetime'};
        	opt.time = {preset : 'time'};
        	opt.default = {
        		theme: 'android-ics light', //皮肤样式
        		display: 'modal', //显示方式
        		mode: 'scroller', //日期选择模式
        		dateFormat: 'yyyy',
        		lang: 'zh',
        		showNow: false,
        		nowText: "今天",

                dateOrder: 'yy',
                headerText: function (year,month) { //自定义弹出框头部格式
                    console.log(year,month);
                    return year + "年" ;
                } ,
        		startYear: currYear-90 , //开始年份
        		endYear: currYear  //结束年份
        	};

        	$("#form_briday").mobiscroll($.extend(opt['date'], opt['default']));

     </script>
