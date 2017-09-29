<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 22:32
 */

namespace module\cart\index\server;


use CC\util\db\Enum;

class OrderShippingStatusEnum extends Enum
{
    CONST NO_SHIPPING = 0;
    CONST SHIPPINGED = 1;
    protected function initAddDatas()
    {
        // TODO: Implement initAddDatas() method.
    }
}