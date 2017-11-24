<?php echo \CC\util\common\server\AssetManager::instance()->getCssJs([
        '/public/biz/turntable/js/jQueryRotate.js',
        '/public/biz/turntable/js/index.js?4',
        '/public/biz/turntable/css/index.css?3',
]) ?>
<!--搜索栏-s-->
<div class="page   " style="height: 100%; ">
<div class="page__bd"  style="min-height: 100%;">
    <div class="weui-cells weui-title-title">

                 <div class="weui-cell weui-cell_access" href="javascript:;">
                     <a href="<?php echo $this->genurl('member/index/index'); ?>">
                         <div class="weui-cell__ft">
                         </div>
                     </a>
                    <div class="weui-cell__bd">
                        <p class="title">抽取获得产品</p>
                    </div>
                </div>

            </div>
    <div class="trun_content" style="width: 200px;">
           <div class="wheel">
               <canvas class="item" id="wheelCanvas" width="422px" height="422px"></canvas>
               <div class="pointer">
                   <div class="pointer_jiantou"></div>
                   <div class="pointer_inner">点击抽取</div>
               </div>
           </div>
       </div>
       <div class="tips" style="display: none;">
           <span id="tip">jason</span>
       </div>
    <div class="avatar_label">
        <?php foreach($group_one_members as $group_one_member):?>
        <span class="avatar_label_item"  >
            <img src="<?php echo $group_one_member['head_pic'] ?>" alt="" class="avatar">
             <?php if($group_one_member['is_leader']):?>
            <span class="weui-badge" style="margin-left: 5px;">团长</span>
             <?php endif;?>

        </span>
        <?php endforeach?>


                    </div>
      <div class="tip_txt" style="margin: 10px 60px;">
          成团后团长随机抽取获得产品人员，并短信通知各位团员
      </div>
    </div>

</div>
<script type="text/javascript">

    $(document).ready(function(){

        // 模拟数据，可以Ajax请求服务器数据，添加大转盘的奖品与奖品区域背景颜色
        /*
        $.ajax({
            type: "POST",
            url: "~/../json/data.json",
            data: null,
            async:false,
            dataType:"json", // 返回数据类型
            success: function(data){
                turnWheel.rewardNames = data["rewardNames"];
                turnWheel.colors = data["colors"];
            },
            error: function(data){
                alert("网络错误，请检查您的网络设置！");
                $("#tip").text("请求数据失败");
            }
        });
        */

        turnWheel.rewardNames = [
            <?php foreach($group_one_members as $group_one_member):?>
            "<?php echo $group_one_member['nickname'] ?>",
            <?php endforeach; ?> ];
        turnWheel.colors = [
            <?php foreach($group_one_members as $i => $group_one_member):?>
            "<?php echo $i%2?'#2CC7C5':'#58DDD8' ?>",
            <?php endforeach; ?>
            ];


        //旋转转盘 item:奖品序号，从0开始的; txt：提示语 ,count 奖品的总数量;
        var rotateFunc = function (item, tip,count){

            // 应该旋转的角度，旋转插件角度参数是角度制。
            var baseAngle = 360 / count;
            // 旋转角度 == 270°（当前第一个角度和指针位置的偏移量） - 奖品的位置 * 每块所占的角度 - 每块所占的角度的一半(指针指向区域的中间)
            angles = 360 * 3 / 4 - ( item * baseAngle) - baseAngle / 2; // 因为第一个奖品是从0°开始的，即水平向右方向
            $('#wheelCanvas').stopRotate();
            // 注意，jqueryrotate 插件传递的角度不是弧度制。
            // 哪个标签调用方法，旋转哪个控件
            $('#wheelCanvas').rotate({
                angle:0,
                animateTo:angles + 360 * 5, // 这里多旋转了5圈，圈数越多，转的越快
                duration:5000,
                callback:function (){ // 回调方法
                    $("#tip").text(tip);
                    turnWheel.bRotate = !turnWheel.bRotate;
//                    roatebg();
                    alert('恭喜：'+tip+'获得产品，抽取结果信息以短信形式通知各团员');
                    location.href='<?php echo $this->genurl('groupon/my/own',['is_end'=>2]) ?>'
                }
            });
        };

        // 抽取按钮按钮点击触发事件
        $('.pointer').click(function (){

            // 正在转动，直接返回
            if(turnWheel.bRotate) return;

            turnWheel.bRotate = !turnWheel.bRotate;
            var count = turnWheel.rewardNames.length;

            // 这里应该是从服务器获取用户真实的获奖信息（对应的获奖序号）
            // 简单模拟随机获取奖品的序号(奖品个数范围内)
            ajax_request('',{start:1},function (data) {
                rotateFunc(data.win_i, turnWheel.rewardNames[data.win_i],count);
            });
        });

    });

</script>