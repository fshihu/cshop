<?php
namespace biz\http\wx;
use biz\Session;
use biz\wx\Wx;
use CInterceptors;
use CNext;
use CRequest;
use CResponseData;
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2016/7/9
 * Time: 19:03
 */
class WxRegInterceptors implements CInterceptors
{

    /**
     * @param CRequest $request
     * @return CResponseData | CNext
     */
    public function handle(CRequest $request, CNext $next)
    {
        if($request->getParams('from_admin') == 'xixk'){
        }else{
        }
        if(!Session::isLogin()){
            list($ok,$openid) = Wx::instance()->getOpenid($request);
            if($ok){
                Session::login();
                Session::setWxUser(Wx::instance()->getUserInfo($openid));
            }
        }

        return $next;
    }

 }