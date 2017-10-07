<?php
namespace biz\http\wx;
use biz\Session;
use biz\wx\Wx;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
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
                $user_info = Wx::instance()->getUserInfo($openid);
                Session::setWxUser($user_info);
                $user = ItemModel::make('users')->addColumnsCondition(array(
                    'oauth' => 'wx',
                    'openid' => $openid
                ))->execute();
                if(!$user){
                    InsertModel::make('users')->addData(array(
                        'oauth' => 'wx',
                        'openid' => $openid,
                        'reg_time' => time(),
                        'nickname' => $user_info['nickname'],
                        'sex' => $user_info['sex'],
                        'head_pic' => $user_info['headimgurl'],
                    ))->execute();
                }
            }
        }
        return $next;
    }

 }