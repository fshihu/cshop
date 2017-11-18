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
<div class="page  "  >
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">申请入驻商家</p>
                        </div>
                    </div>

                </div>
        <?php  if($merchant && $merchant['status'] != 2):?>
                 <?php if($merchant['status'] == 0):?>
                <div class="page msg_success js_show">
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <p class="weui-msg__desc">申请中</p>
                        </div>
                     </div>
                </div>
                  <?php endif;?>
                <?php if($merchant['status'] == 1):?>
                <div class="page msg_success js_show">
                    <div class="weui-msg">
                        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                        <div class="weui-msg__text-area">
                            <p class="weui-msg__desc">申请成功，您已经是商家了</p>
                        </div>
                     </div>
                </div>
                  <?php endif;?>
          <?php else:?>
            <?php if($merchant['status'] == 2):?>
        <div style="padding: 10px;">
                   申请失败，重新申请
        </div>
            <?php endif;?>
             <form action="">
             <div class="  weui-panel_access merchant_enter "  style="margin-bottom:20px;">
                  <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>联系人：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="text" name="name" id="form_name"  class="" placeholder="请输入联系人"
                                >
                     </div>
                 </div>
                 <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>联系方式：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="text" name="contact" id="form_contact"  class="" placeholder="请输入联系方式"
                                >
                     </div>
                 </div>
                 <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>邮箱：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="text" name="email" id="form_email"  class="" placeholder="请输入邮箱"
                                >
                     </div>
                 </div>

                 <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                     <span>联系人身份证：</span>
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
                         <input type="hidden" name="id_card_front" id="id_card_front"/>
                         <input type="hidden" name="id_card_behind" id="id_card_behind"/>
                     </div>
                 </div>
                 <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                     <span>营业执照：</span>
                     </label>
                     <div class="data-group data-group-form_cost_date">
                         <div class="  weui-cells_form" style="display: inline-block;" id="uploader2">
                             <div class=" ">
                                 <div class="weui-cell__bd">
                                     <div class="weui-uploader">
                                         <div class="weui-uploader__hd" style="display: none;">
                                             <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                         </div>
                                         <div class="weui-uploader__bd">
                                             <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                             <div class="weui-uploader__input-box weui-uploader__input-box2">
                                                 <input id="" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                             </div>
                                         </div>
                                      </div>
                                 </div>
                             </div>
                         </div>
                          <input type="hidden" name="business_license" id="business_license"/>
                     </div>
                 </div>
                 <div class="row-group  row-group-form_cost_date  clearfix"><label class="data-label">
                     <span>法人身份证：</span>
                     </label>
                     <div class="data-group data-group-form_cost_date">
                         <div class="  weui-cells_form" style="display: inline-block;" id="uploader3">
                             <div class=" ">
                                 <div class="weui-cell__bd">
                                     <div class="weui-uploader">
                                         <div class="weui-uploader__hd" style="display: none;">
                                             <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                         </div>
                                         <div class="weui-uploader__bd">
                                             <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                             <div class="weui-uploader__input-box weui-uploader__input-box3">
                                                 <input id="" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                             </div>
                                         </div>
                                      </div>
                                 </div>
                             </div>
                         </div>
                         <div class="  weui-cells_form"  style="display: inline-block;" id="uploader4">
                             <div class=" ">
                                 <div class="weui-cell__bd">
                                     <div class="weui-uploader">
                                         <div class="weui-uploader__hd" style="display: none;">
                                             <div class="weui-uploader__info"><span id="uploadCount">0</span>/5</div>
                                         </div>
                                         <div class="weui-uploader__bd">
                                             <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                                             <div class="weui-uploader__input-box weui-uploader__input-box4">
                                                 <input id="" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple="" />
                                             </div>
                                         </div>
                                      </div>
                                 </div>
                             </div>
                         </div>
                         <input type="hidden" name="legal_id_card_front" id="legal_id_card_front"/>
                         <input type="hidden" name="legal_id_card_behind" id="legal_id_card_behind"/>
                     </div>
                 </div>
                 <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>用户名：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="text" name="account" id="form_account"  class="" placeholder="请输入用户名"
                                >
                     </div>
                 </div>
                 <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>密码：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="password" name="pwd" id="form_pwd"  class="" placeholder="请输入密码"
                                >
                     </div>
                 </div>
                 <div class="row-group  row-group-form_name  clearfix"><label class="data-label">
                         <span>重复密码：</span>
                     </label>
                     <div class="data-group data-group-form_name">
                         <input type="password" name="repet_pwd" id="form_repet_pwd"  class="" placeholder="请输入重复密码"
                                >
                     </div>
                 </div>
                          </div>
             </form>
         <?php endif;?>
     </div>

</div>
<a href="javascript:;" class="btn sub_btn  ">提交申请</a>

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
            if($('#form_name').val() == ''){
                alert('请填写联系人');
                return false;
            }
            if($('#form_contact').val() == ''){
                alert('请填写联系方式');
                return false;
            }
            if($('#form_email').val() == ''){
                alert('请填写邮箱');
                return false;
            }
            if($('#id_card_front').val() == ''){
                alert('请上传身份证正面');
                return false;
            }
            if($('#id_card_behind').val() == ''){
                alert('请上传联系人身份证背面');
                return false;
            }
            if($('#business_license').val() == ''){
                alert('请上传营业执照');
                return false;
            }
            if($('#legal_id_card_front').val() == ''){
                alert('请上传法人身份证正面');
                return false;
            }
            if($('#legal_id_card_behind').val() == ''){
                alert('请上传法人身份证背面');
                return false;
            }
            if($('#form_account').val() == ''){
                alert('请填写用户名');
                return false;
            }
            if($('#form_pwd').val() == ''){
                alert('请填写密码');
                return false;
            }
            if($('#form_repet_pwd').val() == ''){
                alert('请填写重复密码');
                return false;
            }
            if($('#form_pwd').val() != $('#form_repet_pwd').val()){
                alert('2次输入密码不同，请重新输入');
                return false;
            }

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
        weui.uploader('#uploader2', {
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
               $('.weui-uploader__input-box2').hide();

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
               $('#business_license').val(ret.url);
               // return true; // 阻止默认行为，不使用默认的成功态
           },
           onError: function(err){
               console.log(this, err);
               // return true; // 阻止默认行为，不使用默认的失败态
           }
        });
        weui.uploader('#uploader3', {
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
               $('.weui-uploader__input-box3').hide();

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
               $('#legal_id_card_front').val(ret.url);
               // return true; // 阻止默认行为，不使用默认的成功态
           },
           onError: function(err){
               console.log(this, err);
               // return true; // 阻止默认行为，不使用默认的失败态
           }
        });
        weui.uploader('#uploader4', {
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
               $('.weui-uploader__input-box4').hide();

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
               $('#legal_id_card_behind').val(ret.url);
               // return true; // 阻止默认行为，不使用默认的成功态
           },
           onError: function(err){
               console.log(this, err);
               // return true; // 阻止默认行为，不使用默认的失败态
           }
        });
     </script>

