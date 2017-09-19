<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 16:01
 */

namespace module\service\reserve\enum;


use CC\util\db\Enum;

class ReserveReasonEnum extends Enum
{

    protected function initAddDatas()
    {
        $this->addForArray(array(
            1 => '美颜',
            2 => '嫩肤',
            3 => '年轻化',
            4 => '其他理由',
        ));
    }
}