<?php
/**
 * User: fu
 * Date: 2017/9/30
 * Time: 0:20
 */

namespace module\cart\index\server;


use CC\util\db\Enum;

class PromTypeEnum extends Enum
{
    const NORMAL = 0;
    const GROUP_OPNE = 1;
    const GROUP_JOIN = 2;
    const USER_LEVEL_UPGRADE_TRUN_MONEY = 3;
    protected function initAddDatas()
    {

    }
}