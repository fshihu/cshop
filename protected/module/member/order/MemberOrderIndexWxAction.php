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
use module\cart\index\server\PromTypeEnum;

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
            'wait_status' => $this->wait_status,
        );
    }

    protected function getSearchCondition()
    {
        if($this->wait_status != '_all'){
            $this->dbCondition->addColumnsCondition(array(
                'wait_status' => $this->wait_status,
            ));
        }
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
            'deleted' => YesNoEnum::NO,
            'is_show' => 1,
        ))->order('order_id desc');
    }
}