<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:15
 */

namespace module\member\bank;



use biz\action\ListAction;
use biz\Session;
use CRequest;

class MemberBankIndexWxAction extends ListAction
{
    protected function getTable()
    {
        return 'users_bank';
    }
    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ));
    }

}