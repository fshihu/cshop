<?php
/**
 * User: fu
 * Date: 2017/12/10
 * Time: 17:53
 */

namespace biz\wx;


use CC\util\external\wx\jssdk\JSSDK;

class WxJs
{
    public static function getSignPackage()
    {
        $js_sdk = new JSSDK(WxConf::getAppid(),WxConf::getAppSecret());
        return $js_sdk->getSignPackage();
    }
}