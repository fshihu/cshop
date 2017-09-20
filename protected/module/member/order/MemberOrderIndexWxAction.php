<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 17:38
 */

namespace module\member\order;


use CRequest;

class MemberOrderIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}