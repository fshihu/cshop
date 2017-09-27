<?php
/**
 * User: fu
 * Date: 2017/9/27
 * Time: 22:44
 */

namespace module\pay\index;


use biz\pay\weixin\WxPay;
use CRequest;

class PayIndexIndexWxAction  extends \CAction
{
    public function execute(CRequest $request)
    {
        return new \CRenderData(array(
            'jsApiParameters' => WxPay::instance()->getJsApiParameters(),
        ));
    }
}