
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="<?php echo $this->genurl('member/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">我的财富</p>
                        </div>
                    </div>

                </div>

         <div class=" mem_money_index weui-panel_access  "  >
<div class="info">
    <div class="t1_s">￥<?php echo $user['user_money'] ?></div>
    <div class="t1_m">
        <span class="t1_m_1">累积财富：￥<?php echo $user['accumulative_money'] ?></span>
        <span class="t1_m_2">已提现财富：￥<?php echo $user['extract_money'] ?></span>
    </div>
</div>
              <div class="weui-navbar navbar-sm">
                 <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
                     交易明细
                 </a>
                 <a href="<?php echo $this->genurl('extract'); ?>" class="weui-navbar__item  ">
                     我要提现
                 </a>
               </div>

             <div class="weui-cells money_list">
                 <?php foreach($list as $item):?>
                         <div class="weui-cell">
                             <div class="weui-cell__bd">
                                 <div class="t1"><?php echo $item['content'] ?></div>
                                 <div class="t2"><?php echo date('Y-m-d H:i:s',$item['crate_time']) ?></div>
                             </div>
                             <div class="weui-cell__ft"><?php echo $item['money']>0?'+':'' ?><?php echo $item['money'] ?></div>
                         </div>
                 <?php endforeach?>
                       </div>
                    </div>


     </div>

</div>