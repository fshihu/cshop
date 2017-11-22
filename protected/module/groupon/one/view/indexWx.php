
    <!--搜索栏-s-->
<div class="page     " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">一键参团</p>
                        </div>
                    </div>

                </div>
         <div class="  weui-panel_access  "  >
            <div class="weui-panel__bd list4" style="background: #ffffff;">
                            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                                <div class="weui-media-box__hd">
                                    <img style="" class="weui-media-box__thumb" src="<?php use module\cart\index\server\PromTypeEnum;
                                    use module\goods\server\GoodsServer;
                                    use module\groupon\index\enum\GroupTypeEnum;

                                    echo GoodsServer::getImg($data['original_img']) ?>" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <p class="weui-media-box__desc"><?php echo $data['goods_name'] ?></p>
                                    <p class="t1"><?php echo $group_one['total_num'] ?>人参团： <span class="t1_s">￥<?php echo $group_one['goods_price'] ?>/件</span></p>
                                </div>
                            </a>
                         </div>
            <div class="buy_user">
                <div class="avatar_label">
                    <?php
                    $has_join = false;
                    foreach($group_one_members as $group_one_member):
                        if(!$has_join && $group_one_member['uid'] == \biz\Session::getUserID()){
                            $has_join = true;
                        }
                        ?>
                    <span class="avatar_label_item">
                        <img src="<?php echo $group_one_member['head_pic'] ?>" alt="" class="avatar">
                         <?php if($group_one_member['is_leader']):?>
                        <span class="weui-badge" style="margin-left: 5px;">团长</span>
                         <?php endif;?>
                    </span>
                    <?php endforeach?>
                     <?php if($group_one['remain_num'] > 0):?>
                   <span class="avatar_label_item">
                        <span class="t1">?</span>
                    </span>
                     <?php endif;?>

                </div>
                <div class="t2">
                    剩余<?php echo $group_one['remain_num'] ?>个名额
                </div>
                 <?php if($group_one['group_type'] == GroupTypeEnum::TYPE_LIMIT):?>
                <div class="t3">
                    剩余时间 <span id="timer"></span>
                </div>
                <script language="javascript" type="text/javascript">

                     leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>,'#timer');
                     </script>
                 <?php endif;?>

                 <?php if($has_join):?>
                     <a href="javascript:;" class="weui-btn    btn2">已参团</a>
                  <?php elseif($group_one['remain_num'] > 0):?>
                     <a href="ecg" class="weui-btn  lijcantbtn btn2">立即参团</a>
                 <?php endif;?>
            </div>
                    </div>


     </div>

</div>

    <script type="text/javascript">
        $('.lijcantbtn').click(function () {
            ajax_request('<?php echo $this->genurl('cart/index/add');?>',{
                goods_id:'<?php echo $data['goods_id'] ?>',
                goods_num:<?php echo $group_one['buy_num'] ?>,
                prom_id:'<?php echo $group_one['id'] ?>',
                prom_type:<?php echo $group_one['group_type']==GroupTypeEnum::TYPE_LIMIT?PromTypeEnum::GROUP_JOIN :PromTypeEnum::GROUP_OWN_JOIN?>
            },function () {
                location.href = '<?php echo $this->genurl('cart/index/index',array('prom_type'=>$group_one['group_type']==GroupTypeEnum::TYPE_LIMIT?PromTypeEnum::GROUP_JOIN :PromTypeEnum::GROUP_OWN_JOIN));?>';
            });
            return false;
        });

    </script>

