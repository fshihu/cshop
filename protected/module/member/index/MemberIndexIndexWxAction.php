<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 17:25
 */

namespace module\member\index;


use CRequest;

class MemberIndexIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}