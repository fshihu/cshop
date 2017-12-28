<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 11:42
 */

namespace module\groupon\server\enum;


use CC\util\db\Enum;

class GroupOneStatusEnum extends Enum
{
    const WAIT_GROUP = 0;
    const WAIT_RAFFLE = 1;
    const FINISH = 2;
    const INVALID = 3;
    protected function initAddDatas()
    {
        $this->add(self::WAIT_GROUP,'待成团');
        $this->add(self::WAIT_RAFFLE,'待抽取');
        $this->add(self::FINISH,'已完成');
        $this->add(self::INVALID,'已失效');
    }
}