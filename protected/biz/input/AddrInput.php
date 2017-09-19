<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 16:37
 */

namespace biz\input;


use CC\util\common\widget\form\BaseInput;

class AddrInput extends BaseInput
{

    protected function onCreateInputInternal()
    {
        return '<select class="addr_input_province"><option>-省-</option>
</select>
<select class="addr_input_city"><option>-市-</option></select>
<select class="addr_input_district"><option>-区-</option></select>';
    }
}