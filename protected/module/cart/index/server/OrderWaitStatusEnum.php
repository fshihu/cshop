<?php
/**
 * User: fu
 * Date: 2017/9/29
 * Time: 22:57
 */

namespace module\cart\index\server;


use CC\util\db\Enum;

class OrderWaitStatusEnum extends Enum
{
    const WAIT_PAY = 0;
    const WAIT_SEND = 1;
    const WAIT_RECIVE = 2;
    const WAIT_COMMENT = 3;
    const FINISH = 4;
    protected function initAddDatas()
    {
        $this->add(self::WAIT_PAY,'待支付');
        $this->add(self::WAIT_SEND,'待发货');
        $this->add(self::WAIT_RECIVE,'待收货');
        $this->add(self::WAIT_COMMENT,'待评论');
        $this->add(self::FINISH,'已完成');
    }
}