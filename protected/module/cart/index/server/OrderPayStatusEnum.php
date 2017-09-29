<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 22:29
 */

namespace module\cart\index\server;


use CC\util\db\Enum;

class OrderPayStatusEnum extends Enum
{
    const NO_PAY = 0;
    const PAYED = 1;
    protected function initAddDatas()
    {

    }
}