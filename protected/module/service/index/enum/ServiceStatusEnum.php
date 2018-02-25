<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 16:04
 */

namespace module\service\index\enum;


use CC\util\db\Enum;

class ServiceStatusEnum extends Enum
{
    const STATUS_WAIT_CHECK = 0;
    const STATUS_WAIT_SERVICE = 1;
    const STATUS_NO_PASS = 2;
    const STATUS_WAIT_COMMONT = 3;
    const STATUS_WAIT_SUBSIDY = 4; //待补贴
    const STATUS_SUBSIDY_NO_PADD = 5;//补贴未通过
    const STATUS_FINISH = 6;

    protected function initAddDatas()
    {
        $this->addForArray(array(
            '待审核',
            '待服务',
            '未通过',
            '待评价',
            '待补贴',
            '补贴申请未通过',
            '已完成',
        ));
    }
}