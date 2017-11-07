<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 16:06
 */

namespace biz\input;


use CC\util\common\widget\form\BaseInput;

class CaptchaInput extends BaseInput
{
    protected $phone_id;

    /**
     * @param mixed $phone_id
     * @return CaptchaInput
     */
    public function setPhoneId($phone_id)
    {
        $this->phone_id = $phone_id;
        return $this;
    }

    protected function onCreateInputInternal()
    {
        $input =  sprintf('<input type="text" style="width: 100px;" class="captcha_input" name="%s" id="%s" value="%s"   placeholder="验证码" %s />',
                    $this->getName(),
                    $this->getId(),
                    $this->getValue(),
                    $this->buildAttributes()
            );
    $phone_id = $this->phone_id;
        return $input.'  <a class="btn btn-primary get_code_btn " >获取验证码</a>
<script type="text/javascript">
var wait=60;  
function time(o) { 

        if (wait == 0) {  
            o.removeAttribute("disabled");            
            o.innerHTML="获取验证码";  
            wait = 60;  
        } else {  
            o.setAttribute("disabled", true);  
            o.innerHTML="重新发送(" + wait + ")";  
            wait--;  
            setTimeout(function() {  
                time(o)  
            },  
            1000)  
        }  
    }  
    $(".get_code_btn").click(function() {
        if (wait != 60){
        return;
    }
    var val = $("#'.$phone_id.'").val();
        if (!val){
            return;
        }
    ajax_request(baseUrlGroup+"/basic/phone/index",{phone:val},function() {
      Tip("发送成功");
    })
    time(this);
    })
</script>';
    }
}