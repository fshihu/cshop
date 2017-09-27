
<!--搜索栏-s-->
<div class="page   " style="height: 100%;">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="javascript:history.back();">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">资讯详情</p>
                    </div>
                </div>

            </div>
    <div class="  weui-panel_access  "  >
         <div class="news_det">
            <div class="new_tit">
                <div class="t1"><?php echo $data['title'] ?></div>
                <div class="t2">admin  <?php echo date('m-d H:i',$data['publish_time']) ?></div>
            </div>
            <div class="new_cont gooods_content">
           <?php echo html_entity_decode($data['content']) ?>

            </div>
            <div class="coloct_btn">
                <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default collect_btn">收藏</a>

            </div>
        </div>

              </div>

 </div>

</div>
<script type="text/javascript">
    $('.collect_btn').click(function () {
        ajax_request('<?php echo $this->genurl('collect/add');?>',{id:'<?php echo $data['article_id'] ?>'},function () {
           Tip('收藏成功');
        });
        return false;
    });
</script>