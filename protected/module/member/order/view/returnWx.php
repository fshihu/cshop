<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
use CC\db\base\select\ListModel;
use module\cart\index\server\OrderWaitStatusEnum;
use module\goods\server\GoodsServer;

?>

<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%;background: #F8F8F8; ">
    <div class="page__bd" style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <a href="javascript:history.back();">
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <div class="weui-cell__bd">
                    <p class="title">申请退换货</p>
                </div>
            </div>

        </div>
        <div class="  weui-panel_access  ">

            <form action="" style="padding:10px;">
               <div style="margin-bottom:10px;">
                   售后类型
                                  <select name="type" id="" style="height: 25px;line-height: 25px;">
                                      <option value="2">换货</option>
                                      <option value="1">退货退款</option>
                                  </select>
               </div>
                 <textarea name="content" id="form_name" placeholder="退换货原因" style="width: 100%;height: 140px;border: none;border-radius: 5px;"></textarea>
                <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                    <span>商品正面图片：</span>
                    </label>
                    <div class="data-group data-group-form_cost_date">
                        <div class="  weui-cells_form" style="display: inline-block;" id="uploader">
                            <div class=" ">
                                <div class="weui-cell__bd">
                                    <div class="weui-uploader">
                                        <div class="weui-uploader__hd" style="display: none;">
                                            <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                        </div>
                                        <div class="weui-uploader__bd">
                                            <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                            <div class="weui-uploader__input-box weui-uploader__input-box0">
                                                <input id="" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_card_front" id="id_card_front"/>

                    </div>
                </div>
                <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                    <span>商品背面图片：</span>
                    </label>
                    <div class="data-group data-group-form_cost_date">
                        <div class="  weui-cells_form"  style="display: inline-block;" id="uploader1">
                            <div class=" ">
                                <div class="weui-cell__bd">
                                    <div class="weui-uploader">
                                        <div class="weui-uploader__hd" style="display: none;">
                                            <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                        </div>
                                        <div class="weui-uploader__bd">
                                            <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                            <div class="weui-uploader__input-box weui-uploader__input-box1">
                                                <input id="" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id_card_behind" id="id_card_behind"/>
                    </div>
                </div>

                <div class="addr_eidt_btn_w" >
                    <a href="javascript:;" style="width: 100%;" class="weui-btn weui-btn_primary addr_eidt_btn">提交申请</a>

                </div>
            </form>
        </div>

    </div>

</div>
<script type="text/javascript">
    $('.addr_eidt_btn').click(function () {
        if($('#form_name').val() == ''){
            alert('请填写原因');
            return false;
        }
        ajax_request('', $('form').serialize(), function () {
            Tip('提交成功');
            setTimeout(function () {
                location.href = '<?php echo $this->genurl('member/order/index',['wait_status' => OrderWaitStatusEnum::FINISH]);?>'
            }, 200);
        });
        return false;
    });
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
           $('.weui-uploader__input-box0').hide();

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
           $('#id_card_front').val(ret.url);
           // return true; // 阻止默认行为，不使用默认的成功态
       },
       onError: function(err){
           console.log(this, err);
           // return true; // 阻止默认行为，不使用默认的失败态
       }
    });
    weui.uploader('#uploader1', {
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
           $('.weui-uploader__input-box1').hide();

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
           $('#id_card_behind').val(ret.url);
           // return true; // 阻止默认行为，不使用默认的成功态
       },
       onError: function(err){
           console.log(this, err);
           // return true; // 阻止默认行为，不使用默认的失败态
       }
    });
</script>