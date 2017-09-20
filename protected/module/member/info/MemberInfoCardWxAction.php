<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:00
 */

namespace module\member\info;


use CRequest;

class MemberInfoCardWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}