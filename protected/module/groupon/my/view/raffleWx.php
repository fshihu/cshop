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
			 <span><?php echo $group_one_member['nickname'] ?></span>
        </span>

        <?php endforeach?>


                    </div>
      <div class="tip_txt" style="margin: 30px 60px;">
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
            "<?php echo $group_one_member['head_pic'] ?>",
        <?php endforeach; ?> ];
        turnWheel.colors = [
            "#85ECFF","#FF510A",
			"#FFC736","#64FF01",
			"#A588FE"];


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
                rotateFunc(data.win_i, data.win_name,count);
            });
        });

    });
// 图片信息
/*var imgQb = new Image();
imgQb.src = "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1513917854&di=3e2d577b865472ef128aa6d986fdfdd5&imgtype=jpg&er=1&src=http%3A%2F%2Fimg.name2012.com%2Fuploads%2Fallimg%2F2014-10%2F17-025737_964.jpg";
var imgSorry = new Image();
imgSorry.src = "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1513917854&di=3e2d577b865472ef128aa6d986fdfdd5&imgtype=jpg&er=1&src=http%3A%2F%2Fimg.name2012.com%2Fuploads%2Fallimg%2F2014-10%2F17-025737_964.jpg";
*/



var imgQb = new Image();
//imgQb.src = "http://wx.qlogo.cn/mmopen/vi_32/wz3yIkZ7aSKfkyliaH2XDcxZuic04ORgXvokianSBibbOSc0T0VKDvcZMKYbHSEETyYcTAMF91vEYgE5jb67CkVo6Q/0";


/*
返回在n和m之间的随机整数
n<= random <=m
*/
function randomNum(n, m){
    /* Math.floor(Math.random()*10);时，可均衡获取0到9的随机整数。 */
    var random = Math.floor(Math.random()*(m-n)) + n;
    return random;

}

//页面所有元素加载完毕后执行drawWheelCanvas()方法对转盘进行渲染
window.onload=function(){
    drawWheelCanvas();
};

/*
 * 渲染转盘
 * */
function drawWheelCanvas(){
//debugger
    // 获取canvas画板，相当于layer？？
    var canvas = document.getElementById("wheelCanvas");
//    var canvas = ($("#wheelCanvas")).get()[0]; // 注意，jQuery获取的是包装过的对象，不是DOM对象,可以进行转换

    // 计算每块占的角度，弧度制
    var baseAngle = Math.PI * 2 / (turnWheel.rewardNames.length);
    // 获取上下文
    var ctx=canvas.getContext("2d");

    var canvasW = canvas.width; // 画板的高度
    var canvasH = canvas.height; // 画板的宽度
    //在给定矩形内清空一个矩形
    ctx.clearRect(0,0,canvasW,canvasH);

    //strokeStyle 绘制颜色
    ctx.strokeStyle = "#2CC7C5"; // 红色
    //font 画布上文本内容的当前字体属性
    ctx.font = '26px Microsoft YaHei';

    // 注意，开始画的位置是从0°角的位置开始画的。也就是水平向右的方向。
    // 画具体内容
    for(var index = 0 ; index < turnWheel.rewardNames.length ; index++)
    {
        // 当前的角度
        var angle = turnWheel.startAngle + index * baseAngle;
        // 填充颜色
        ctx.fillStyle = turnWheel.colors[index];

        // 开始画内容
        // ---------基本的背景颜色----------
        ctx.beginPath();
        /*
         * 画圆弧，和IOS的Quartz2D类似
         * context.arc(x,y,r,sAngle,eAngle,counterclockwise);
         * x :圆的中心点x
         * y :圆的中心点x
         * sAngle,eAngle :起始角度、结束角度
         * counterclockwise : 绘制方向,可选，False = 顺时针，true = 逆时针
         * */
        ctx.arc(canvasW * 0.5, canvasH * 0.5, turnWheel.outsideRadius, angle, angle + baseAngle, false);
        ctx.arc(canvasW * 0.5, canvasH * 0.5, turnWheel.insideRadius, angle + baseAngle, angle, true);
        ctx.stroke();
        ctx.fill();
        //保存画布的状态，和图形上下文栈类似，后面可以Restore还原状态（坐标还原为当前的0，0），
        ctx.save();

        /*----绘制奖品内容----重点----*/
        // 红色字体
        ctx.fillStyle = "#fff";
        var rewardName = turnWheel.rewardNames[index];
        var line_height = 26;
        // translate方法重新映射画布上的 (0,0) 位置
        // context.translate(x,y);
        // 见PPT图片，
        var translateX =  canvasW * 0.5 + Math.cos(angle + baseAngle / 2) * turnWheel.textRadius;
        var translateY =  canvasH * 0.5 + Math.sin(angle + baseAngle / 2) * turnWheel.textRadius;
        ctx.translate(translateX,translateY);

        // rotate方法旋转当前的绘图，因为文字适合当前扇形中心线垂直的！
        // angle，当前扇形自身旋转的角度 +  baseAngle / 2 中心线多旋转的角度  + 垂直的角度90°
        ctx.rotate(angle + baseAngle / 2 + Math.PI / 2);

        /** 下面代码根据奖品类型、奖品名称长度渲染不同效果，如字体、颜色、图片效果。(具体根据实际情况改变) **/
        // canvas 的 measureText() 方法返回包含一个对象，该对象包含以像素计的指定字体宽度。
        // fillText() 方法在画布上绘制填色的文本。文本的默认颜色是黑色. fillStyle 属性以另一种颜色/渐变来渲染文本
        /*
         * context.fillText(text,x,y,maxWidth);
         * 注意！！！y是文字的最底部的值，并不是top的值！！！
         * */
		 
		 //这里获取轮盘图片
		if(rewardName.indexOf("http")>=0){
			imgQb.src = rewardName;
            imgQb.onload=function(){
                ctx.drawImage(imgQb,-45,-25,70,70);
            };
			ctx.drawImage(imgQb,-45,-25,70,70);
        }

        //添加对应图标
        // if(rewardName.indexOf("Q币")>0){
        //     // 注意，这里要等到img加载完成才能绘制
        //     imgQb.onload=function(){
        //         ctx.drawImage(imgQb,-15,10);
        //     };
        //     ctx.drawImage(imgQb,-15,10);
        //
        // }else if(rewardName.indexOf("谢谢参与")>=0){
        //     imgSorry.onload=function(){
        //         ctx.drawImage(imgSorry,-15,10);
        //     };
        //     ctx.drawImage(imgSorry,-15,10);
        // }
        //还原画板的状态到上一个save()状态之前
        ctx.restore();

        /*----绘制奖品结束----*/

    }
}
var roatebg_i = 0;
function roatebg() {
    var colors = [
        "#2CC7C5","#58DDD8",
        "#2CC7C5","#58DDD8"];
    drawWheelCanvas();
    roatebg_i++;
    turnWheel.colors = colors;
    turnWheel.colors[roatebg_i%colors.length-1] = '#18A2DD';
     // setTimeout(roatebg,50);
}
</script>