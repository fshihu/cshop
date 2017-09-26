<?php
namespace module\home\index;
use app\admin\biz\AdPosition;
use CRequest;
use module\ad\index\AdServer;

/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/18
 * Time: 17:20
 */
class HomeIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData(array(
            'ad_list' => AdServer::getList(AdPosition::HOME),
        ));
    }
}