<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:55
 */

namespace module\member\level;


use CRequest;
use module\member\index\UserServer;

class MemberLevelIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = UserServer::getUser();
        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}