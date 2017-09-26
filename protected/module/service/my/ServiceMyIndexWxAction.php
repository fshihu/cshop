<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/25
 * Time: 16:11
 */

namespace module\service\my;


use CRequest;

class ServiceMyIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}