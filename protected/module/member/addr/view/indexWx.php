
<!--搜索栏-s-->
<div class="page   weui-tab__panel  " style="padding-bottom:92px;height: 100%;background: #f3f7f8;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access">
                     <a  href="<?php echo $this->genurl($is_sel?'cart/index/index':'member/index/index') ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">地址管理</p>
                    </div>
                </div>

            </div>
     <div class="  weui-panel_access  "  >
         <?php foreach($list as $item):?>
          <div class="addr_info addr_info_item">
         <div class="t1">
                                 <span class="t1_s"><?php echo $item['consignee'] ?></span>
                                 <span class="t1_m"><?php echo $item['mobile'] ?></span>
                             </div>
                             <div class="t2">
                                 <?php echo $item['p_name'] ?>
                                 <?php echo $item['c_name'] ?>
                                 <?php echo $item['d_name'] ?>
                                 <?php echo $item['address'] ?>
                             </div>
             <div class="t3">
                 <a href="<?php echo $this->genurl('default',['id'=>$item['address_id']]); ?>" class="addr_sel checkbox <?php echo $item['is_default']?'checkboxed':'' ?>  fl"></a>


                 <span class="fr">
                     <a href="<?php echo $this->genurl('add',['id' => $item['address_id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default">修改</a>
                     <a href="<?php echo $this->genurl('delete',['id'=>$item['address_id']]); ?>" class="weui-btn weui-btn_mini weui-btn_default delete_link">删除</a>
                 </span>
             </div>
         </div>
         <?php endforeach?>
 

        <div class="addr_eidt_btn_w">
            <a href="<?php echo $this->genurl('add') ?>" class="weui-btn weui-btn_primary addr_eidt_btn">添加</a>

        </div>



 </div>

</div>
<script type="text/javascript">
    $('body').on('click','.delete_link',function () {

        var $this = $(this);
        ajax_request($this.attr('href'),{},function () {
            $this.closest('.list_item').remove();
        });
        return false;
    });
    $('body').on('click','.addr_sel',function () {

        var $this = $(this);
        ajax_request($this.attr('href'),{},function () {
            location.href = '<?php echo $this->genurl($is_sel?'cart/index/index':'index') ?>';
        });
        return false;
    });
</script>