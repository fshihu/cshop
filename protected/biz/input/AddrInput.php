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
        $province = $this->mModel['province'];
        $province = $province?$province:'null';
        $city = $this->mModel['city'];
        $city = $city?$city:'null';
        $district = $this->mModel['district'];
        $district = $district?$district:'null';
        $str = '<script>get_province('. $province .');get_city($("#city"),'. $province .','. $city .');get_area($("#district"),'. $city .','. $district .')</script>';
        return '<div class="addr_input"><select id="province" name="province" onChange="get_city(this,0)" class="addr_input_province"><option>-省-</option>
</select>
<select id="city" name="city" onChange="get_area(this)" class="addr_input_city"><option>-市-</option></select>
<select id="district" name="district" class="addr_input_district"><option>-区-</option></select></div>
'.$str;
    }
    public function getPostNames()
    {
        return ['province','city','district'];
    }
}