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
    protected $input_style;

    /**
     * @param mixed $input_style
     * @return AddrInput
     */
    public function setInputStyle($input_style)
    {
        $this->input_style = $input_style;
        return $this;
    }

    protected function onCreateInputInternal()
    {
        $province = $this->mModel['province'];
        $province = $province?$province:'null';
        $city = $this->mModel['city'];
        $city = $city?$city:'null';
        $district = $this->mModel['district'];
        $district = $district?$district:'null';

        $str = '<script>get_province('. $province .');get_city($("#city"),'. $province .','. $city .');get_area($("#district"),'. $city .','. $district .')</script>';

        $sheng = '<select id="province" name="province" onChange="get_city(this,0)" class="addr_input_province"><option>-省-</option></select>';
        $shi = '<select id="city" name="city" onChange="get_area(this)" class="addr_input_city"><option>-市-</option></select>';
        $qu = '<select id="district" name="district" class="addr_input_district"><option>-区-</option></select>';
        if($this->input_style == 1){
            $sheng = '<select id="province" style="width:169px;" name="province" onChange="get_city(this,0)" class="addr_input_province"><option>-省-</option></select>';
            $sheng .= '<div><label style="   margin-left: -110px;   margin-top: 10px;             " class="data-label"><span>所在市：</span></label></div>';
            $shi = '<select id="city" name="city" style="margin-top:10px;width:70px;;;" onChange="get_area(this)" class="addr_input_city"><option>-市-</option></select>';
            $shi .= '<div><label style="   margin-left: -110px;   margin-top: 10px;             " class="data-label"><span>所在区：</span></label></div>';
            $qu = '<select id="district" style="width:70px;" name="district" class="addr_input_district"><option>-区-</option></select>';
        }
        return '<div class="addr_input">'.$sheng.$shi.$qu.'</div>'.$str;
    }
    public function getPostNames()
    {
        return ['province','city','district'];
    }
}