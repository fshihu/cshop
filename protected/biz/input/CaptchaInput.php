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

    protected function onCreateInputInternal()
    {
        $input =  sprintf('<input type="text" name="%s" id="%s" value="%s"   placeholder="验证码" %s />',
                    $this->getName(),
                    $this->getId(),
                    $this->getValue(),
                    $this->buildAttributes()
            );

        return $input.'  <a class="btn btn-primary get_code_btn " >获取验证码</a>';
    }
}