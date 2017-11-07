<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/25
 * Time: 16:29
 */

namespace module\member\gold;


use biz\action\ListAction;
use biz\Session;
use CRequest;
use module\member\index\UserServer;

class MemberGoldIndexWxAction   extends ListAction
{
    protected function getTable()
    {
        return 'user_gold_record';
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