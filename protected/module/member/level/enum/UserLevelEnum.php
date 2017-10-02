<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 17:32
 */

namespace module\member\level\enum;


use CC\util\db\Enum;

class UserLevelEnum extends Enum
{
    const NORMAL = 1;
    const GOLD_CARD = 2;
    const BLACK_CARD = 3;
    protected function initAddDatas()
    {
        // TODO: Implement initAddDatas() method.
    }
}