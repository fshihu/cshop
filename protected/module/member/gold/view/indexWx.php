
<!--搜索栏-s-->
<div class="page   " style="height: 100%;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">我的积分</p>
                    </div>
                </div>

            </div>

     <div class=" mem_money_index weui-panel_access  "  >
<div class="info">
<div class="t2_s">￥<?php echo $user['gold'] ?></div>
<div class="t2_m">
    当前财富
</div>

</div>
          <div class="weui-navbar navbar-sm">
             <a href="" class="weui-navbar__item weui-bar__item_on">
                 积分明细
             </a>
             <a href="<?php echo $this->genurl('give') ?>" class="weui-navbar__item  ">
                 转增积分
             </a>
           </div>

         <div class="weui-cells money_list">
             <?php foreach($list as $item):?>
                     <div class="weui-cell">
                         <div class="weui-cell__bd">
                             <div class="t1"><?php echo $item['content'] ?></div>
                             <div class="t2"><?php echo date('Y-m-d H:i:s',$item['create_time']) ?></div>
                         </div>
                         <div class="weui-cell__ft"><?php echo $item['money']>0?'+':'' ?><?php echo $item['money'] ?></div>
                     </div>
             <?php endforeach?>
                   </div>
                </div>


 </div>

</div>