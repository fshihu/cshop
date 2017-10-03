<?php echo \CC\util\common\server\AssetManager::instance()->getCssJs([
        '/public/biz/turntable/js/jQueryRotate.js',
        '/public/biz/turntable/js/index.js',
        '/public/biz/turntable/css/index.css',
]) ?>
<!--搜索栏-s-->
<div class="page   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">抽取获得产品</p>
                    </div>
                </div>

            </div>
    <div class="trun_content" style="width: 200px;">
           <div class="wheel">
               <canvas class="item" id="wheelCanvas" width="422px" height="422px"></canvas>
               <div class="pointer">
                   <div class="pointer_inner"></div>
               </div>
           </div>
       </div>
       <div class="tips" >
           <span id="tip">jason</span>
       </div>
    <div class="avatar_label">
        <?php foreach($group_one_members as $group_one_member):?>
        <span class="avatar_label_item">
            <img src="<?php echo $group_one_member['head_pic'] ?>" alt="" class="avatar">
             <?php if($group_one_member['is_leader']):?>
            <span class="weui-badge" style="margin-left: 5px;">团长</span>
             <?php endif;?>
        </span>
        <?php endforeach?>


                    </div>
      <div class="tip_txt" style="margin: 10px 60px;">
          成团后团长随机抽取获得产品人员，并短信通知各位团员
      </div>
    </div>

</div>
<script type="text/javascript">

</script>