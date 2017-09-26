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
        return '<div class="addr_input"><select id="province" name="province" onChange="get_city(this,0)" class="addr_input_province"><option>-省-</option>
</select>
<select id="city" name="city" onChange="get_area(this)" class="addr_input_city"><option>-市-</option></select>
<select id="district" name="district" class="addr_input_district"><option>-区-</option></select></div><script>get_province()</script>';
    }
    public function getPostNames()
    {
        return ['province','city','district'];
    }
}