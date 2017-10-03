
<!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">预约服务</p>
                    </div>
                </div>

            </div>
    <div class="gl_nav swiper-container" style="height: 20px;">
        <div class="swiper-wrapper">
            <a href="<?php use module\service\index\enum\ServiceStatusEnum;

                echo $this->genurl(''); ?>" class="swiper-slide <?php echo $status == 0 ?'ac':'' ?>">待审核</a>
                <a class="swiper-slide <?php echo $status == 1 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_WAIT_SERVICE]); ?>">待服务</a>
                <a class="swiper-slide <?php echo $status == 2 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_NO_PASS]); ?>">未通过</a>
                <a class="swiper-slide <?php echo $status == 3 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_WAIT_COMMONT]); ?>">待评价</a>
                <a class="swiper-slide <?php echo $status == 4 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_WAIT_SUBSIDY]); ?>">待补贴</a>
                <a class="swiper-slide <?php echo $status == 5 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_SUBSIDY_NO_PADD]); ?>">补贴申请未通过</a>
                <a class="swiper-slide <?php echo $status == 6 ?'ac':'' ?>" href="<?php echo $this->genurl('',['status' => ServiceStatusEnum::STATUS_FINISH]); ?>">已完成</a>
        </div>

    </div>

<div class="list5">
    <?php foreach($list as $item):?>
 <div class="list_item">
     <div class="t1"><?php echo $status_desc ?></div>

     <a href="<?php echo $this->genurl('service/index/det',['id'=>$item['service_id']]); ?>">

     <div class="t2">
         <img class="t2_img" src="<?php echo $item['image'] ?>" alt="">
         <div class="ts_s">
             <div class="t2_s_1"><?php echo $item['name'] ?></div>
         </div>
     </div>
     </a>

      <?php if($item['status'] == ServiceStatusEnum::STATUS_WAIT_CHECK):?>
     <div class="t4">

         <a href="<?php echo $this->genurl('info',['id'=>$item['id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default">点击查看我的预约信息</a>
     </div>
      <?php endif;?>
     <?php if($item['status'] == ServiceStatusEnum::STATUS_WAIT_SERVICE):?>
     <div class="t4" style="padding-bottom: 10px;">
         <span style="font-size: 11px;">
             您的服务预约已经通过，请与预约时间到医院进行服务
         </span>

     </div>
     <?php endif;?>
     <?php if($item['status'] == ServiceStatusEnum::STATUS_NO_PASS):?>
     <div class="t4" style="padding-bottom: 10px;">
         <span style="font-size: 11px;">
             您的服务预约申请未能通过审核，请重新预约
         </span>

     </div>
     <?php endif;?>
     <?php if($item['status'] == ServiceStatusEnum::STATUS_WAIT_COMMONT):?>
     <div class="t4" style="padding-bottom: 10px;">
         <a href="<?php echo $this->genurl('comment',['id'=>$item['id']]); ?>" style="font-size: 11px;">
             请消费完成后评价服务，并进入补贴返还流程
         </a>

     </div>
     <?php endif;?>
     <?php if($item['status'] == ServiceStatusEnum::STATUS_WAIT_SUBSIDY):?>
     <div class="t4" style="padding-bottom: 10px;">
          <?php if($item['bills']):?>
              已上传，等待审核
           <?php else:?>
              <a href="<?php echo $this->genurl('subsidy',['id'=>$item['id']]); ?>" style="font-size: 11px;">
                  请点击并上传消费单据，审核成功后将补贴返还到您的系统钱包
              </a>
          <?php endif;?>

     </div>
     <?php endif;?>
     <?php if($item['status'] == ServiceStatusEnum::STATUS_SUBSIDY_NO_PADD):?>
     <div class="t4" style="padding-bottom: 10px;">
          <?php if($item['bills']):?>
              已上传，等待审核
           <?php else:?>
              <a href="<?php echo $this->genurl('subsidy',['id'=>$item['id']]); ?>" style="font-size: 11px;">
                  您上传的消费单据有误，申请审核未通过，请重新上传
              </a>
          <?php endif;?>

     </div>
     <?php endif;?>

 </div>
    <?php endforeach?>

 </div>
 </div>

</div>
<script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
         pagination: '.swiper-pagination',
         slidesPerView: 'auto',
         paginationClickable: true,
 //        spaceBetween: 30
     });

</script>