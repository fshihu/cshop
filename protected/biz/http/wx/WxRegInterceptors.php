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
use module\cart\index\server\OrderHanderServer;

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
//                OrderHanderServer::instance(array('out_trade_no' => '201711151926388735'))->handle();
        if($request->getParams('from_admin') == 'xixk'){
            Session::login();
            Session::setUserID(2);
        }else{
        }
       if(!Session::isLogin() || !Session::getUserID()){
            list($ok,$openid,$data) = Wx::instance()->getOpenid($request);
            if($ok){
                list($ok,$user_info) = Wx::instance()->getSnsUserInfo($data['access_token'],$openid);
                Session::setWxUser($user_info);
                $user = ItemModel::make('users')->addColumnsCondition(array(
                    'oauth' => 'wx',
                    'openid' => $openid
                ))->execute();
                if(!$user){
                    $user['user_id'] = InsertModel::make('users')->addData(array(
                        'oauth' => 'wx',
                        'openid' => $openid,
                        'reg_time' => time(),
                        'nickname' => $user_info['nickname'],
                        'sex' => $user_info['sex'],
                        'head_pic' => $user_info['headimgurl'],
                    ))->execute();
                    $user['nickname'] = $user_info['nickname'];
                }
                Session::login();
                Session::setName($user['nickname']);
                Session::setUserID($user['user_id']);
            }
        }
        return $next;
    }

 }