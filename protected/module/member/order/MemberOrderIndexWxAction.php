<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 17:38
 */

namespace module\member\order;


use biz\action\ListAction;
use biz\Session;
use CC\util\db\YesNoEnum;
use CRequest;
use module\cart\index\server\OrderWaitStatusEnum;

class MemberOrderIndexWxAction  extends ListAction
{
    public $wait_status;
    protected function getTable()
    {
        return 'order';
    }
    protected function onExecute()
    {
        return array(
            'wait_status_val' => OrderWaitStatusEnum::getValueByIndex($this->wait_status),
        );
    }

    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'wait_status' => $this->wait_status,
            'deleted' => YesNoEnum::NO,
        ));
    }
}