<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:58
 */

namespace module\member\msg;


use CRequest;

class MemberMsgIndexWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}