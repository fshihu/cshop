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
	$('.mslide .dot').css('position','absolute').css('margin-left',wid);


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
            return false;
        });
    });
    $('.btn_group_sel').each(function () {
        var $btn_group_sel = $(this);
        $btn_group_sel.find('.weui-btn').click(function () {
            $btn_group_sel.find('.weui-btn').removeClass('weui-btn_warn').addClass('weui-btn_default');
            $(this).removeClass('weui-btn_default').addClass('weui-btn_warn');
        });
    });


});
function leftTimer(year,month,day,hour,minute,second,sel,style){
    var leftTime = (new Date(year,month-1,day,hour,minute,second)) - (new Date()); //计算剩余的毫秒数
    var days = parseInt(leftTime / 1000 / 60 / 60 / 24 , 10); //计算剩余的天数
    var hours = parseInt(leftTime / 1000 / 60 / 60 % 24 , 10); //计算剩余的小时
    var minutes = parseInt(leftTime / 1000 / 60 % 60, 10);//计算剩余的分钟
    var seconds = parseInt(leftTime / 1000 % 60, 10);//计算剩余的秒数
    days = checkTime(days);
    hours = checkTime(hours);
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);
    if (style == 2){
        var str = '';
        str += days > 0 ? '<span class="time h"> <span class="t1">'+days+'</span> <span class="t2">天</span></span>':'';
        str += hours > 0 ? '<span class="time h"> <span class="t1">'+hours+'</span> <span class="t2">时</span></span>':'';
        str += minutes > 0 ? '<span class="time h"> <span class="t1">'+minutes+'</span> <span class="t2">分</span></span>':'';
        str += seconds > 0 ? '<span class="time h"> <span class="t1">'+seconds+'</span> <span class="t2">秒</span></span>':'';
        $(sel).html(str);
    }else{
        $(sel).html((days>0?(days+"天"):'') + hours+"小时" + minutes+"分"+seconds+"秒");
    }
    setTimeout(function () {
        leftTimer(year,month,day,hour,minute,second,sel,style);
    },1000);
   }
   function checkTime(i){ //将0-9的数字前面加上0，例1变为01
    if(i<10)
    {
     i = "0" + i;
    }
    return i;
   }
/**
 * 获取省份
 */
function get_province(selected){
    selected = selected||0;
    var url = baseUrlGroup+'/basic/region/index?level=1&parent_id=0&selected='+selected;
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
function get_city(t,parent_id,selected){
    selected = selected||0;
    var parent_id = parent_id||$(t).val();
    if(!parent_id > 0){
        return;
    }
    $('#district').empty().html('<option>-区-</option>');
    var url = baseUrlGroup+'/basic/region/index?level=2&parent_id='+ parent_id+'&selected='+ selected;
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
function get_area(t,parent_id,selected){
    selected = selected||0;
  var parent_id = parent_id||$(t).val();
    if(!parent_id > 0){
        return;
    }
    $('#district').empty().css('display','inline');
    $('#twon').empty().css('display','none');
    var url = baseUrlGroup+'/basic/region/index?level=3&parent_id='+ parent_id+'&selected='+ selected;
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

function ajax_request(url, post_data, fn, datatype, hide_loading, err_fn,options) {
    if (!datatype) {
        datatype = 'json';
    }
    var loading;
    if (!hide_loading) {
        var tip;
        if (options){
            tip = options.start_load_tip;
        }
        loading = weui.loading('请求中...', {
            className: 'custom-classname'
        });
    }
    $.ajax({
        url: url,
        type: 'post',
        dataType: datatype,
        data: post_data,
        success: function (data) {
            if (!hide_loading) {
                if (loading){
                    loading.hide(function() {
                        });
                }
            }
            if (datatype == 'json') {
                if (data.ok) {
                    if (fn) fn(data);
                } else {
                    console.error(data.error, url);
                    if (err_fn) err_fn();
                    if (!hide_loading) {
                        Tip(data.error, 'error');
                    }
                }
            } else {
                if (fn) fn(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            if(XMLHttpRequest.readyState == 0){
                console.error('未初始化', url);
                return;
            }
            console.error(XMLHttpRequest.responseText, url);
            if (err_fn) err_fn();
            if (!hide_loading) {
                Tip(t('tips_err_server'), 'error');
                if (loading){
                    loading.hide(function() {
                        });
                }
            }
        }
    });
}
