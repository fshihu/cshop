<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:23
 */

namespace module\member\money;


use CRequest;

class MemberMoneyExtractWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }
}