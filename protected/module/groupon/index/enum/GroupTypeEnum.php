<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 23:40
 */

namespace module\groupon\index\enum;


use CC\util\db\Enum;

class GroupTypeEnum extends Enum
{
    const TYPE_LIMIT = 1;
    const TYPE_OWN = 2;
    protected function initAddDatas()
    {

    }
}