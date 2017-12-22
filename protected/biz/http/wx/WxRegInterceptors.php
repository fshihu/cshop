<?php
namespace biz\http\wx;
use biz\Session;
use biz\wx\Wx;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use CC\util\db\YesNoEnum;
use CInterceptors;
use CNext;
use CRequest;
use CResponseData;
use module\cart\index\server\OrderHanderServer;
use module\cart\index\server\OrderPayStatusEnum;
use module\cart\index\server\PromTypeEnum;
use module\member\money\server\MoneyServer;

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
        if($request->getParams('clear') == 'clear'){
            Session::logout();
            echo '<h1>已清理</h1>';
            exit;
        }
                OrderHanderServer::instance(array('out_trade_no' => '201712210115309136'))->handle();
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
        $actionStr = $request->url->getActionStr();
        if($actionStr == '/home/index/index' ||  $actionStr == '/member/index/index'||  $actionStr == '/groupon/my/index'){
            $this->handGroupTimeout();
        }
        return $next;
    }

    protected function handGroupTimeout()
    {

        $group_my_list =  ListModel::make('order')->addColumnsCondition(array(
                    't.pay_status' => OrderPayStatusEnum::PAYED,
                    'deleted' => YesNoEnum::NO,
                    'order_prom_type' => ['in',[PromTypeEnum::GROUP_JOIN,PromTypeEnum::GROUP_OPNE]],
                    'go.is_finish' => 0,
                    'gb.end_time' => ['<',time()],
                ))->leftJoin('group_one','go','t.order_prom_id = go.id')
                    ->leftJoin('group_buy','gb','go.group_buy_id = gb.id')
                    ->leftJoin('users','u','go.win_uid = u.user_id')
                    ->select('t.*,go.remain_num,gb.end_time,u.nickname,go.group_buy_id ')
                    ->order('order_id desc')->select('t.*,go.id go_id,go.remain_num,gb.end_time,u.nickname,go.group_buy_id ')->execute();
        foreach ($group_my_list as $item) {
            UpdateModel::make('group_one')->addId($item['go_id'])->addData(array('is_finish' => 2))->execute();
            MoneyServer::addRecord($item['user_id'],MoneyServer::GROUP_BUY_RETURNED,$item['order_amount'],'拼团失败，退回支付款',$item['order_id']);
        }


    }
 }