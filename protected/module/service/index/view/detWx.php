
    <!--搜索栏-s-->
<div class="page  weui-tab__panel  " style="height: 100%;">
    <div class="page__bd"  style="min-height: 100%;">
        <div class="weui-cells weui-title-title">

                     <div class="weui-cell weui-cell_access" href="javascript:;">
                         <a href="javascript:history.back();">
                             <div class="weui-cell__ft">
                             </div>
                         </a>
                        <div class="weui-cell__bd">
                            <p class="title">服务详情</p>
                        </div>
                    </div>

                </div>
        <div class="  weui-panel_access  " style="height: 100%;background: #f3f7f8">
 <div class="goods_list">
      <div class="banner ban1">
         <div class="mslide" id="slideTpshop_noauto">
             <ul>
                 <!--广告表-->
                     <?php foreach($service_images as $service_image):?>
                     <li>
                             <img src="<?php echo $service_image['image_url'] ?>" title="{$v[title]}" style="{$v[style]}" alt=""  onclick="changeImg(this)">
                     </li>
                     <?php endforeach?>

             </ul>
         </div>
     </div>
     <div class="good_info">
         <div class="good_title"><?php echo $data['name'] ?></div>
         <div class="buwei" style="padding:10px 0;">
             部位：
         </div>
         <div class="buwei_item_w btn_group_sel">
             <?php foreach(explode('|',$data['part']) as $i => $part):?>
             <a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_default"><?php echo $part ?></a>
             <?php endforeach?>
         </div>
         </div>


     <div class="weui-navbar navbar-sm nav_click">
         <a href="" class="weui-navbar__item weui-bar__item_on">
             商品详情
         </a>
         <a href="" class="weui-navbar__item  ">
             用户评价
         </a>
      </div>
     <div class="nav_click_cont">
         <div class="nav_click_cont_item gooods_content">
    <?php echo html_entity_decode($data['desc']) ?>
         </div>                        <style type="text/css">
                                     .starability-fade>label{ width:10px; height:10px;background-size: 100%;}
                                 </style>

            <div class="nav_click_cont_item commont_list" style="display: none;">
                <?php foreach($comment_list as $comment_item):?>
                <div class="comm_item" style="padding:20px 10px;">
                    <div class="t1">
                        <img class="img" src="<?php echo \module\member\index\UserServer::getAvatar($comment_item) ?>" alt="">
                        <span class="t1_s" style="margin-left:5px; font-size:14px; color:#2CC7C5; font-size:14px;"><?php echo $comment_item['uname'] ?></span>
                    </div>
                    <div class="t2" style="margin-left:40px; padding:0 0 10px 0;"><?php echo $comment_item['comment_content'] ?></div>
                    <?php if($comment_item['comment_reply']):?>
                   <div class="t2" style="margin-left:40px; font-size:12px; background:#F8F8F8; padding:10px 0 10px 5px; margin-bottom:10px;">商家回复：<?php echo $comment_item['comment_reply'] ?></div>
                    <?php endif;?>
                    <div class="t3" style="margin-left:40px;">
                        <?php for($i =0; $i< $comment_item['rating'];$i++):?>
                        <span style="background: url(<?php echo $baseUrl ?>/public/biz/starability/starability-images/icons-checkmark@2x.png);
                                width: 10px;
                                height: 10px;
                                display: inline-block;
                                background-size: 10px;
                                background-position: 0px -10px;"></span>
                        <?php endfor;?>
                        <?php for($i =0; $i< 5-$comment_item['rating'];$i++):?>
                        <span style="background: url(<?php echo $baseUrl ?>/public/biz/starability/starability-images/icons-checkmark@2x.png);
                                width: 10px;
                                height: 10px;
                                display: inline-block;
                                background-size: 10px;
                                background-position: 0px 0;"></span>
                        <?php endfor;?>

                        <?php echo date('Y-m-d h:i:s',$comment_item['comment_time']) ?>
                    </div>
                </div>
                <?php endforeach?>

             </div>
     </div>

 </div>
                    </div>

     </div>

</div>

    <a class="buy_btn_now"  href="<?php echo $this->genurl('reserve/index',['service_id'=>$data['id']]) ?>">
        立即预约
    </a>
    
    
<!--图片放大-->
<div id="bigImg">
	<img src="images/a.jpg" />
</div>
<!--图片放大-->
<script type="text/javascript">
	$(function () {
		$('.btn_group_sel .weui-btn').click(function () {
			var link = '<?php echo $this->genurl('reserve/index',['service_id'=>$data['id']]) ?>';
			$('.buy_btn_now').attr('href',link+'&part='+$(this).text());
		}).eq(0).click();
		$("#bigImg").click(function(){
			$("#bigImg").hide();
		});
	});
	function changeImg(obj){
		$("#bigImg").find("img").css({
			"height":"",
			"margin-top":""
		});
		var imgSrc=$(obj).attr("src");
		$("#bigImg").find("img").attr("src",imgSrc);
		setTimeout(function(){
			$("#bigImg").find("img").css({
				"height":$("#bigImg").find("img").height(),
				"margin-top":($(document).height()-$("#bigImg").find("img").height())/2
			});
		});
		$("#bigImg").show();
	}
</script>