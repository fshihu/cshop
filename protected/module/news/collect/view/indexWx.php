
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">收藏和足记</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  "  >
  <div class="goods_list">
      <div class="weui-navbar navbar-sm">
          <a href="<?php echo $this->genurl(''); ?>" class="weui-navbar__item <?php echo $type ==0?'weui-bar__item_on':'' ?>">
               我的收藏
          </a>
          <a href="<?php echo $this->genurl('',['type'=>1]); ?>" class="weui-navbar__item <?php echo $type ==1?'weui-bar__item_on':'' ?>  ">
              浏览记录
          </a>
       </div>

             <div class="list2_w" style="margin-top: 15px;background: #fff;border-top: 1px solid #dbdbdb">
                 <?php foreach($list as $item):?>
                 <div class="list2">
                         <div class="item_2 =">
                             <a  href="<?php echo $this->genurl('det',['id'=>$item['cat_id']]) ?>">
                                 <img src="<?php echo $item['thumb'] ?>" alt="">
                                 <div class="conts"><?php echo $item['title']  ?></div>
                             </a>
                             <div style="margin-top:10px;">
                                 <a style="color: #2CC7C5;" href="<?php echo $this->genurl('add',['id'=>$item['article_id'],'cancel'=>1]); ?>" class="collcet_cancel weui-btn weui-btn_mini weui-btn_default">取消收藏</a>
                             </div>

                         </div>
                 </div>
                 <?php endforeach?>

            </div>

 </div>
                    </div>

     </div>

</div>
    <script type="text/javascript">
        $('body').on('click','.collcet_cancel',function () {
            var $this = $(this);
            ajax_request($(this).attr('href'),{},function () {
               Tip('取消收藏成功');
               $this.closest('.list2').remove();
            });
            return false;
        });

    </script>