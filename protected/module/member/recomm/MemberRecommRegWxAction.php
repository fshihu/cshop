<?php
/**
 * User: fu
 * Date: 2017/10/1
 * Time: 15:33
 */

namespace module\member\recomm;


use CC\db\base\update\UpdateModel;
use CRequest;
use module\member\index\UserServer;

class MemberRecommRegWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $pid = $request->getParams('pid');
        $user = UserServer::getUser();
        if(!$user['first_leader'] && $user['user_id'] != $pid){
            UpdateModel::make('users')->addData(array(
                'first_leader' => $pid,
            ))->addColumnsCondition(array(
                'user_id' => $user['user_id'],
            ))->execute();
        }
        return new \CRedirectData('home/index/index');
    }
}