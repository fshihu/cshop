<div class="page weui-tab__panel  " style="height: 100%;">
    <div class="page__bd"  style="height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">商品分类</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access cate_list_page" >

<div class="cate_list">
    <ul class="cate_list_ul">
        <?php foreach($list as $item):?>
             <?php if($item['parent_id'] != 0){continue;}?>
        <li  >
            <div class="txt"><?php echo $item['name'] ?></div>
            <div class="c_s" style="display: none;">
                <?php foreach($list as $c_item):?>
                    <?php if($item['id'] != $c_item['parent_id']){continue;}?>
                <div class="cs_item">
                    <a href="<?php echo $this->genurl('goods',array('cate_id' => $c_item['id'])) ?>">
                    <img src="<?php echo $c_item['image'] ?>" width="70" height="70" alt="">
                        <div class="name"><?php echo $c_item['name'] ?></div>
                    </a>
                </div>
                <?php endforeach?>

            </div>
        </li>
        <?php endforeach?>
     </ul>
</div>
                    </div>

     </div>

</div>
<script type="text/javascript">
    $('.cate_list_ul li').click(function () {
        $('.cate_list_ul li').removeClass('ac');
        $('.cate_list_ul .c_s').hide();
        $(this).addClass('ac');
        $(this).find('.c_s').show();
    }).eq(0).click();
</script>
<?php include \biz\Util::getFooterNav();?>