<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:58
 */

namespace module\service\reserve\enum;


use CC\util\db\Enum;

class MarriageEnum extends Enum
{

    protected function initAddDatas()
    {
        $this->addForArray(array(
            1 => '未婚',
            2 => '已婚',
            3 => '离异',
        ));
    }
}