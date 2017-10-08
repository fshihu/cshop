<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/8/31
 * Time: 17:51
 */

namespace biz\wx;


use CC;
use CC\util\external\wx\WxAbs;
use CSession;

class Wx extends WxAbs
{

    protected function getAppid()
    {
        //spddr_center@sina.cn,daduhe@spddr
        return WxConf::getAppid();
    }

    protected function getAppSecret()
    {
        return WxConf::getAppSecret();
    }

    /**
     * @return array(
     * 'button' => array(
     * array(
     * 'type' => 'view',
     * 'name' => '领红包',
     * 'key' => 'ywzx',
     * 'url' => 'http://qwwx.xbwq.com.cn/qinwuwx/wx/event/report/type',
     * ),
     * array(
     * 'name' => '游戏规则',
     * 'sub_button' => array(
     * array(
     * 'type' => 'view',
     * 'name' => '游戏参与规则',
     * 'url' => 'http://qwwx.xbwq.com.cn/qinwuwx/wx/setting/gamerule/join',
     * )
     * ),
     * )
     * );
     */
    protected function getMenu()
    {
        return [];
    }

}