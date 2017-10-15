
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">服务预约</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " >
 <div class="goods_list">
     <div class="goods_item_w server_itme_w">
         <?php foreach($list as $item):?>
         <div class="goods_item">
             <a href="<?php echo $this->genurl('det',['id'=>$item['id']]) ?>">
                 <img src="<?php echo $item['image'] ?>" alt="" width="100%" height="155">
                 <div class="txt"><?php echo $item['name'] ?></div>
             </a>
         </div>
         <?php endforeach?>

     </div>

 </div>
                    </div>

     </div>

</div>
<?php include \biz\Util::getFooterNav(); ?>
