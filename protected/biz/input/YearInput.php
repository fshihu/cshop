<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/11/15
 * Time: 10:17
 */

namespace biz\input;


use CC\util\common\widget\form\BaseInput;

class YearInput extends BaseInput
{

    protected function onCreateInputInternal()
    {
        $input =  sprintf('<input type="text" style="width: 100px;" class="year_input" name="%s" id="%s" value="%s"   placeholder="出生日期" %s />',
                    $this->getName(),
                    $this->getId(),
                    $this->getValue(),
                    $this->buildAttributes()
            );
        return $input.'   ';
    }
}