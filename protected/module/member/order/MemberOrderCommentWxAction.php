<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 20:19
 */

namespace module\member\order;



use biz\Session;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CRequest;
use module\cart\index\server\OrderStatusServer;
use module\member\index\UserServer;

class MemberOrderCommentWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {
        if($this->request->hasPost()){
            $order = ItemModel::make('order')->addColumnsCondition(array(
                'order_id' => $request->getParams('order_id'),
            ))->execute();
            $list = ListModel::make('order_goods')->addColumnsCondition(array(
                'order_id' => $order['order_id'],
            ))->execute();
            $user = UserServer::getUser();
            foreach ($list as $item) {
                InsertModel::make('comment')->addData(array(
                    'goods_id' => $item['goods_id'],
                    'content' => $request->getParams('content'),
                    'user_id' =>  $user['user_id'],
                    'username' => $user['nickname'],
                    'add_time' => time(),
                ))->execute();
            }
            OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_FINISH);
            return new \CJsonData();
        }
        return new \CRenderData(

        );
    }



}