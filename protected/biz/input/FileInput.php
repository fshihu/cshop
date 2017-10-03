<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 17:41
 */
namespace biz\input;

use CC\util\common\widget\form\BaseInput;

class FileInput extends BaseInput
{

    protected function onCreateInputInternal()
    {
        $input =  sprintf('<input type="file" class="captcha_input" name="%s" id="%s" value="%s"   placeholder="验证码" %s />',
                    $this->getName(),
                    $this->getId(),
                    $this->getValue(),
                    $this->buildAttributes()
            );
        return $input;
    }
}