
    <!--搜索栏-s-->
<div class="page   " style="height: 100%;background: #f3f7f8;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access"  >
                         <a href="<?php echo $this->genurl('member/index/index'); ?>">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">书签和资讯足记</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  "  >
  <div class="goods_list">
      <div class="weui-navbar navbar-sm">
          <a href="<?php echo $this->genurl(''); ?>" class="weui-navbar__item <?php echo $type ==0?'weui-bar__item_on':'' ?>">
               我的书签
          </a>
          <a href="<?php echo $this->genurl('',['type'=>1]); ?>" class="weui-navbar__item <?php echo $type ==1?'weui-bar__item_on':'' ?>  ">
              浏览记录
          </a>
       </div>

             <div class="list2_w" style="margin-top: 15px;background: #fff;border-top: 1px solid #dbdbdb">
                 <?php foreach($list as $item):?>
                 <div class="list2">
                         <div class="item_2 =">
                             <a  href="<?php echo $this->genurl('index/det',['id'=>$item['article_id']]) ?>">
                                 <img src="<?php echo $item['thumb'] ?>" alt="">
                                 <div class="conts"><?php echo $item['title']  ?></div>
                             </a>
                              <?php if($type == 0):?>
                             <div style="margin-top:10px;">
                                 <a style="color: #2CC7C5;" href="<?php echo $this->genurl('add',['id'=>$item['article_id'],'cancel'=>1]); ?>" class="collcet_cancel weui-btn weui-btn_mini weui-btn_default">取消书签</a>
                             </div>
                              <?php endif;?>

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
               Tip('取消书签成功');
               $this.closest('.list2').remove();
            });
            return false;
        });

    </script>