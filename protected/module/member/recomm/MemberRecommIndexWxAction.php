<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 17:06
 */

namespace module\member\recomm;


use biz\action\ListAction;
use biz\Session;
use CC\db\base\select\ItemModel;
use CRequest;
use module\member\index\UserServer;
use module\member\level\enum\UserLevelEnum;

class MemberRecommIndexWxAction  extends ListAction
{
    public $level = 1;
    protected function onExecute()
    {
        return [
            'level' => $this->level,
            'user' => UserServer::getUser(),
        ];
    }
    protected function getTable()
    {
        return 'users';
    }

    protected function getSearchCondition()
    {
        $this->dbCondition->addColumnsCondition(array(
            'level' => $this->request->getParams('level',1),
            'first_leader' => Session::getUserID(),
        ))->order('reg_time desc');
    }
}