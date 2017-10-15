<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 16:11
 */

namespace biz\input;


use CC\util\common\widget\form\BaseInput;

class DateInput extends BaseInput
{
    public function __construct($name, $label, array $checkers = [], $style = '')
    {
        parent::__construct($name, $label, $checkers, $style);
    }


    protected function onCreateInputInternal()
    {

        $id = $this->getId();
        $name = $this->getName();
        $attrs = $this->buildAttributes();
        $str = '';
        $val = $this->getValue();
        $str .=  sprintf('<input style="width: 50px;" type="text" name="%s" id="%s" value="%s" class="input_year"  placeholder="年" %s />',
            $name.'_year',
            $id.'_year',
            $val?date('Y',$val):'',
            $attrs
            );
        $str .= '<span class="date_input_tip date_input_tip_year">年</span>';
        $str .=  sprintf('<input  style="width: 40px;" type="text" name="%s" id="%s" value="%s" class="input_month"  placeholder="月" %s />',
            $name.'_month',
            $id.'_month',
            $val?date('n',$val):'',
            $attrs
            );
        $str .= '<span class="date_input_tip date_input_tip_month">月</span>';
        $str .=  sprintf('<input  style="width: 40px;" type="text" name="%s" id="%s" value="%s" class="input_day"  placeholder="日" %s />',
            $name.'_day',
            $id.'_day',
            $val?date('j',$val):'',
            $attrs
            );
        $str .= '<span class="date_input_tip date_input_tip_day">日</span>';
        return $str;
    }
    public function getPostNames()
    {
        $name = $this->getName();
        return [$name.'_year',$name.'_month',$name.'_day'];
    }
}