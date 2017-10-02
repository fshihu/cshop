<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */
use module\member\bank\enum\BankEnum;

?>

<!--搜索栏-s-->
<div class="page   " style="min-height: 100%; background:#f3f7f8;  ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">我的银行卡</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  " >
        <div class="list7">
            <?php foreach($list as $item):?>
            <div class="list_item">
                <img src="<?php echo BankEnum::getIconByIndex($item['bank_name']) ?>" alt="" class="img">
                <div class="icont">
                    <span class="checkbox checkboxed"></span>
                    <div class="t1">
                        <?php echo $item['name'] ?> &nbsp; &nbsp; <?php echo $item['bank_name'] ?>
                    </div>
                    <div class="t2"><?php echo substr_replace($item['contact'],'****',3,4) ?></div>
                    <div class="t3">**** &nbsp; &nbsp; **** &nbsp; &nbsp; <?php echo substr($item['bank_card'],0,-4) ?></div>
                    <div class="t4">
                        <a href="<?php echo $this->genurl('add',['id'=>$item['id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default">修改</a>
                          <a href="<?php echo $this->genurl('delete',['id'=>$item['id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default">删除</a>
                    </div>
                </div>
            </div>
            <?php endforeach?>
         </div>
        <div class="addr_eidt_btn_w">
            <a href="<?php echo $this->genurl('add') ?>" class="weui-btn weui-btn_primary addr_eidt_btn">添加</a>

        </div>

                  </div>

 </div>

</div>
