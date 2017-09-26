<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:27
 */

namespace module\member\bank\enum;


use CC\util\db\Enum;

class BankEnum extends Enum
{

    protected function initAddDatas()
    {
        $this->addForArray(array(
            '工行',
        ));
    }
}