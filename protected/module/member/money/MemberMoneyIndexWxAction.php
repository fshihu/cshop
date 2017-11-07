<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 17:18
 */

namespace module\member\money;


use biz\action\ListAction;
use biz\Session;
use CRequest;
use module\member\index\UserServer;

class MemberMoneyIndexWxAction   extends ListAction
{
    protected function getTable()
    {
        return 'user_money_record';
    }
    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'uid' => Session::getUserID(),
        ))->order('id desc');
    }

    public function onExecute()
    {
        $user = UserServer::getUser();
        return array(
            'user' => $user,
        );
    }
}