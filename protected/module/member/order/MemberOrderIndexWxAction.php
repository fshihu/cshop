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
use CRequest;

class MemberOrderIndexWxAction  extends ListAction
{
    protected function getTable()
    {
        return 'order';
    }
    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ));
    }
}