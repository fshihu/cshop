<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:12
 */

namespace module\member\info;


use CRequest;

class MemberInfoQrcodeWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}