
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
                            <p class="title"><?php if($_GET['butie']=='1'){echo '佣金补贴';}else{echo '我的财富';}?></p>
                        </div>
                         <a href="<?php echo $this->genurl('chong'); ?>" class="ft">充值</a>
                    </div>

                </div>

         <div class=" mem_money_index weui-panel_access  "  >
<div class="info">
	<?php $caifu=0;$butie=0;?>
	<?php foreach($list as $item):?><?php  
		
		if($item['content']=='退货退款'||$item['content']=='充值'||$item['content']=='我的财富提现成功'||$item['content']=='订单返现'||$item['content']=='拼团失败，退回支付款'||$item['content']=='订单金卡返现'||$item['content']=='订单黑卡返现'){
			$caifu=$caifu+$item['money'];
		}else{
			$butie=$butie+$item['money'];
		}
	?><?php endforeach?>
    <div class="t1_s">￥<?php if($_GET['butie']=='1'){ echo sprintf('%.2f',$butie);}else{echo sprintf('%.2f',$caifu);}?></div>
    <div class="t1_m">
        <span class="t1_m_1">累积财富：￥<?php echo sprintf('%.2f',$caifu+$butie+$user['extract_money']); ?></span>
		<?php if($_GET['butie']==1){?>
        <span class="t1_m_2">我的财富：￥<?php echo sprintf('%.2f',$caifu); ?></span>
		<?php }else{ ?>
		<span class="t1_m_2">佣金补贴：￥<?php echo sprintf('%.2f',$butie); ?></span>
		<?php }?>
    </div>
	<div class="t1_m">
		<span class="t1_m_2">已提现金额：￥<?php echo $user['extract_money'] ?></span>
    </div>
</div>
              <div class="weui-navbar navbar-sm">
                 <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
                     交易明细
                 </a>
				 <?php if($_GET['butie']=='1'){?>
                 <a href="<?php echo $this->genurl('extract',['butie'=>'1']); ?>" class="weui-navbar__item  ">
				 <?php }else{?>
				 <a href="<?php echo $this->genurl('extract'); ?>" class="weui-navbar__item  ">
				 <?php }?>
                     我要提现
                 </a>
               </div>

             <div class="weui-cells money_list">
			 <?php $money=0;?>
                 <?php foreach($list as $item):?>
				 <?php if($_GET['butie']!='1'){?>
				 <?php if($item['content']=='退货退款'||$item['content']=='我的财富提现成功'||$item['content']=='订单返现'||$item['content']=='拼团失败，退回支付款'||$item['content']=='订单金卡返现'||$item['content']=='订单黑卡返现'){?>
                         <div class="weui-cell">
                             <div class="weui-cell__bd">
                                 <div class="t1"><?php echo $item['content'] ?></div>
                                 <div class="t2"><?php echo date('Y-m-d H:i:s',$item['crate_time']) ?></div>
                             </div>
                             <div class="weui-cell__ft"><?php echo $item['money']>0?'+':'' ?><?php echo $item['money'] ?></div>
                         </div>
				<?php }?>
				<?php }else{?>
				<?php if($item['content']!='退货退款'&&$item['content']!='我的财富提现成功'&&$item['content']!='订单返现'&&$item['content']!='拼团失败，退回支付款'&&$item['content']!='订单金卡返现'&&$item['content']!='订单黑卡返现'){?>
						<div class="weui-cell">
                             <div class="weui-cell__bd">
                                 <div class="t1"><?php echo $item['content'] ?></div>
                                 <div class="t2"><?php echo date('Y-m-d H:i:s',$item['crate_time']) ?></div>
                             </div>
                             <div class="weui-cell__ft"><?php echo $item['money']>0?'+':'' ?><?php echo $item['money'] ?></div>
                         </div>
				<?php }?>
				<?php }?>
                 <?php endforeach?>
                       </div>
                    </div>


     </div>

</div>