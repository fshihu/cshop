<!--搜索栏-s-->
<div class="page   " style="height: 100%;">
    <div class="page__bd" style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

            <div class="weui-cell weui-cell_access" href="javascript:;">
                <a href="<?php echo $this->genurl('member/money/index'); ?>">
                    <div class="weui-cell__ft">
                    </div>
                </a>
                <div class="weui-cell__bd">
                    <p class="title">充值</p>
                </div>
            </div>

        </div>

        <div class=" mem_money_index weui-panel_access  ">
            <form action="" class="chogn_fomr" method="post" style="padding-top:20px;">
            <div class="row-group  row-group-form_code  clearfix"><label class="data-label">
                    <span>充值金额：</span>
                </label>
                <div class="data-group data-group-form_code">
                    <input type="text" style="width: 100px;" class="money" name="money" id="form_code" value=""
                           placeholder="充值金额"
                           >
                    <input class="btn btn-primary   " type="submit" value="去充值"/>

                </div>
            </div>
            </form>
        </div>


    </div>

</div>
<script type="text/javascript">
    $('.chogn_fomr').submit(function () {
        var val = $('.money').val();
        if(val <= 0){
            alert('请输入充值金额');
            return false;
        }
        if(val != parseInt(val)){
            alert('金额只能为整数');
            return false;
        }

    });
</script>