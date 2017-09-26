/**
 * Created by onwer on 2017/9/18.
 */
//轮播
$(function(){
    $('#slideTpshop').swipeSlide({
        continuousScroll:true,
        speed : 3000,
        transitionType : 'cubic-bezier(0.22, 0.69, 0.72, 0.88)',
        firstCallback : function(i,sum,me){
            me.find('.dot').children().first().addClass('cur');
        },
        callback : function(i,sum,me){
            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
        }
    });
    //圆点
    var ed = $('.mslide ul li').length - 2;
	$('.mslide').append("<div class=" + "dot" + "></div>");
	for(var i = 0; i<ed ;i++){
		$('.mslide .dot').append("<span></span>");
	};
	$('.mslide .dot span:first').addClass('cur');
	var wid = - ($('.mslide .dot').width() / 2);
	$('.mslide .dot').css('position','absolute').css('left','50%').css('margin-left',wid);


    $(".buy_num_w").each(function () {
   	    var $num_w = $(this);
        $num_w.find('.jia').click(function () {
               $num_w.find('.text').val($num_w.find('.text').val()*1+1);
            $num_w.find('.jian').removeClass('no_ac');
           });
        $num_w.find('.text').keyup(function (e) {
            if(isNaN($(this).val()) || $(this).val() <= 0 ){
                $(this).val(1);
            }
        });
        $num_w.find('.jian').click(function () {
            var number = $num_w.find('.text').val()*1-1;
            if($(this).hasClass('no_ac')){
                return;
            }
            if(number==1){
                $num_w.find('.jian').addClass('no_ac');
            }
            $num_w.find('.text').val(number);
            $num_w.find('.jian').remove('no_ac');
           });
       });

    $('.nav_click').each(function () {
        var $nav_click = $(this);
        $nav_click.find('.weui-navbar__item').click(function () {
            $nav_click.find('.weui-navbar__item').removeClass('weui-bar__item_on');
            $(this).addClass('weui-bar__item_on');
            var index = $nav_click.find('.weui-navbar__item').index($(this));
            $nav_click.next().find('.nav_click_cont_item').hide().eq(index).show();
        });
        return false;
    });


});
/**
 * 获取省份
 */
function get_province(){
    var url = baseUrlGroup+'/basic/region/index?level=1&parent_id=0';
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option value="0">-省-</option>'+ v;
            $('#province').empty().html(v);
        }
    });
}


/**
 * 获取城市
 * @param t  省份select对象
 */
function get_city(t){
    var parent_id = $(t).val();
    if(!parent_id > 0){
        return;
    }
    $('#district').empty().html('<option>-区-</option>');
    var url = baseUrlGroup+'/basic/region/index?level=2&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option value="0">-市-</option>'+ v;
            $('#city').empty().html(v);
        }
    });
}

/**
 * 获取地区
 * @param t  城市select对象
 */
function get_area(t){
    var parent_id = $(t).val();
    if(!parent_id > 0){
        return;
    }
    $('#district').empty().css('display','inline');
    $('#twon').empty().css('display','none');
    var url = baseUrlGroup+'/basic/region/index?level=3&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option>-区-</option>'+ v;
            $('#district').empty().html(v);
        }
    });
}