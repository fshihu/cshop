
    <!--搜索栏-s-->
<div class="page   " style="min-height: 100%;background: #f3f7f8">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title"><?php use module\goods\server\GoodsServer;

                                echo $this->getPageTitle() ?></p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="">
            <div style="padding: 15px 50px 0 50px;">
                <div class="weui-navbar navbar-sm nav_click  " style="    border: 1px solid #ccc;
                    border-bottom: none;">
                                        <a href="javascript:;" class="weui-navbar__item weui-bar__item_on">
                                            商品
                                        </a>
                                        <a href="javascript:;" class="weui-navbar__item">
                                            服务
                                        </a>
                                     </div>
            </div>

 <div class="goods_list">

     <div class="goods_item_w server_itme_w">
         <?php foreach($list as $item):?>
         <div class="goods_item goods_item_s">
             <a href="<?php echo $this->genurl('goods/det/index',array('id' => $item['goods_id'])) ?>">

                 <img src="<?php echo GoodsServer::getImg($item['original_img']) ?>" alt="" width="100%" height="155">
                 <?php if($item['is_create_group']):?>
                   <img class="sanjiao" src="<?php echo $baseUrl; ?>/public/biz/wx/common/images/my/xingyun1.png" alt="">
                    <?php endif;?>
                 <div class="txt"><?php echo $item['goods_name'] ?></div>
                 <div class="price">￥<?php echo $item['shop_price'] ?></div>
             </a>
         </div>
         <?php endforeach?>
      </div>

 </div>
                    </div>

     </div>

</div> 