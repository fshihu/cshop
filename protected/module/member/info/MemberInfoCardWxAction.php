<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:00
 */

namespace module\member\info;


use CRequest;
use module\member\index\UserServer;

class MemberInfoCardWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = UserServer::getUser();

        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}