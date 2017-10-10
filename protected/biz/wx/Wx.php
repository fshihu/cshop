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

    public function getSnsUserInfo($access_token,$openid)
    {
        return $this->excuteRequest("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN");
    }

    public function getOpenid(\CRequest $request)
    {
        $code = $request->getParams('code');
        $state = $request->getParams('state');
        $appid = $this->getAppid();
        if(!$code || $state != CSession::get('__wx_state')){
            $uri =  urlencode($request->getRequestUri(true));
            $state = uniqid();
            CSession::set('__wx_state', $state);
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";
            CC::app()->finish(new \CRedirectData($url));
        }
        $secretkey = $this->getAppSecret();
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secretkey&code=$code&grant_type=authorization_code";
        list($ok,$data) = $this->excuteRequest($url);
        return array($ok,$data['openid'],$data);
    }
}