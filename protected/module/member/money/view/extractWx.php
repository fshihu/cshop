
<!--搜索栏-s-->
<div class="page   " style="height: 100%;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php use module\member\bank\enum\BankEnum;

                     echo $this->genurl('index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">我要提现</p>
                    </div>
                </div>

            </div>
     <div class=" mem_money_ext weui-panel_access  "  >
         <form action="">
        <div class="weui-cells ">
            <div class="weui-cell">
                            <div class="weui-cell__bd">
                               <div class="t1">可提现金额</div>
                            </div>
                <div class="weui-cell__ft">￥<span class="total_money"><?php echo $user['user_money'] ?></span></div>

                        </div>
               <?php if(empty($bank_list)):?>
              <div class="weui-cell weui-cell_access">
                  <a href="<?php echo $this->genurl('member/bank/index') ?>">添加银行卡</a>
              </div>
                <?php else:?>
              <a class="weui-cell weui-cell_access" href="javascript:sel_bank();">
                   <?php $bank = $bank_list[0] ?>
                  <div class="weui-cell__bd">
                      <div class="t1 bank_name_ssr"><?php echo BankEnum::getValueByIndex($bank['bank_name']) ?>
                          尾号<?php echo substr($bank['bank_card'], -4) ?></div>
                      <input type="hidden" name="bank_id" id="bank_id" value="<?php echo $bank['id'] ?>"/>
                  </div>
                  <div class="weui-cell__ft">
                      更换银行卡
                  </div>

              </a>
               <?php endif;?>

          <div class="weui-cell money_info">
                          <div class="weui-cell__bd">
                             <div class="t1">请输入您提现的金额</div>
                             <div class="t2">
                                <span class="t2_s">
                                    ￥<input class="t2_s_ipt" name="money" style="border: none;
                                        font-size: 30px;
                                        width: 180px;
                                        padding: 0;
                                        margin-top: -11px;" type="text" value="0.00"/>
                                </span>
                              <a class="btsa" href="">全部提现</a></div>
                          </div>
                      </div>
      </div>


         </form>
     </div>
    <div class="addr_eidt_btn_w">
        <a class="weui-btn weui-btn_primary addr_eidt_btn">申请提现</a>

    </div>


 </div>

</div>
<script type="text/javascript">
    $('.addr_eidt_btn').click(function () {
        ajax_request('',$('form').serialize(),function () {
            Tip('申请成功');
           location.href='<?php echo $this->genurl('index');?>';
        });
        return false;
    });
    $('.btsa').click(function () {
         $('.t2_s_ipt').val($('.total_money').text());
         return false;
    });

    function sel_bank() {
        var actions = [
            <?php foreach($bank_list as $item):?>
            {
                label: '<?php echo BankEnum::getValueByIndex($item['bank_name']) ?> 尾号<?php echo substr($item['bank_card'], -4) ?>',
                onClick: function () {
                    $('#bank_id').val(<?php echo $item['id'] ?>);
                    $('.bank_name_ssr').text('<?php echo BankEnum::getValueByIndex($item['bank_name']) ?> 尾号<?php echo substr($item['bank_card'], -4) ?>');
                }
            },
            <?php endforeach?>

        ];
        weui.actionSheet(actions, [
            {
                label: '取消',
                onClick: function () {
                    console.log('取消');
                }
            }
        ], {
            className: 'custom-classname'
        });

    }
</script>