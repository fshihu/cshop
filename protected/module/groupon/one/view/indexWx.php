
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

                                    echo $data['original_img'] ?>" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <p class="weui-media-box__desc"><?php echo $data['goods_name'] ?></p>
                                    <p class="t1"><?php echo $group_one['total_num'] ?>人参团： <span class="t1_s">￥<?php echo $group_buy['price'] ?>/件</span></p>
                                </div>
                            </a>
                         </div>
            <div class="buy_user">
                <div class="avatar_label">
                    <?php foreach($group_one_members as $group_one_member):?>
                    <span class="avatar_label_item">
                        <img src="<?php echo $group_one_member['head_pic'] ?>" alt="" class="avatar">
                         <?php if($group_one_member['is_leader']):?>
                        <span class="weui-badge" style="margin-left: 5px;">团长</span>
                         <?php endif;?>
                    </span>
                    <?php endforeach?>
                   <span class="avatar_label_item">
                        <span class="t1">?</span>
                    </span>

                </div>
                <div class="t2">
                    剩余<?php echo $group_one['total_num'] - $group_one['finish_num'] ?>个名额
                </div>
                <div class="t3">
                    剩余时间 <span id="timer"></span>
                </div>
                <script language="javascript" type="text/javascript">

                     leftTimer(<?php echo date('Y,n,j,h,i,s',$group_buy['end_time']) ?>,'#timer');
                     </script>

                <a href="ecg" class="weui-btn  lijcantbtn btn2">立即参团</a>
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
                prom_type:<?php echo PromTypeEnum::GROUP_JOIN ?>
            },function () {
                location.href = '<?php echo $this->genurl('cart/index/index',array('prom_type'=> PromTypeEnum::GROUP_JOIN));?>';
            });
            return false;
        });

    </script>

