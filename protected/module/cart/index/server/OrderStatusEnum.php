<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 0:54
 */

namespace module\cart\index\server;


use CC\util\db\Enum;

class OrderStatusEnum extends Enum
{
    const WAIT_PAY = 0; //待支付
    const PAYED = 1; //已支付，待收货
    const RECIVED = 2; //已收货，待评价
    const CANCELED = 3;//已取消
    const FINISH = 4;//已完成
    const WASTE = 5;//废弃的

    protected function initAddDatas()
    {

    }
}