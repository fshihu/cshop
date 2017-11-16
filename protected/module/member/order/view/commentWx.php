<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:32
 */
?>

<!--搜索栏-s-->
<div class="page weui-tab__panel   " style="height: 100%;background: #F8F8F8; ">
    <div class="page__bd" style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <a href="javascript:history.back();">
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <div class="weui-cell__bd">
                    <p class="title">评论</p>
                </div>
            </div>

        </div>
        <div class="  weui-panel_access  ">
            <form action="" style="padding:10px;">
                <div style="padding:10px 0;">
                    <span style="display: inline-block;vertical-align: middle;">满意度：</span>
                    <fieldset class="starability-fade" style="display: inline-block;vertical-align: middle;min-height: 0;">

                    		  <input type="radio" checked id="rate5-5" name="rating" value="5">
                    		  <label for="rate5-5"  title="Amazing">5 stars</label>

                    		  <input type="radio" id="rate4-5" name="rating" value="4">
                    		  <label for="rate4-5" title="Very good">4 stars</label>

                    		  <input type="radio" id="rate3-5" name="rating" value="3">
                    		  <label for="rate3-5" title="Average">3 stars</label>

                    		  <input type="radio" id="rate2-5" name="rating" value="2">
                    		  <label for="rate2-5" title="Not good">2 stars</label>

                    		  <input type="radio" id="rate1-5" name="rating" value="1">
                    		  <label for="rate1-5" title="Terrible">1 star</label>
                    		</fieldset>

                </div>
                <textarea name="content" style="width: 100%;height: 340px;border: none;border-radius: 5px;"></textarea>

                <div class="addr_eidt_btn_w" style="margin-top: -7px;">
                    <a href="javascript:;" style="width: 100%;" class="weui-btn weui-btn_primary addr_eidt_btn">提交评论</a>

                </div>
            </form>
        </div>

    </div>

</div>
<script type="text/javascript">
    $('.addr_eidt_btn').click(function () {
        ajax_request('', $('form').serialize(), function () {
            Tip('提交成功');
            setTimeout(function () {
                location.href = '<?php echo $this->genurl('member/index/index');?>';
            }, 200);
        });
        return false;
    });

</script>