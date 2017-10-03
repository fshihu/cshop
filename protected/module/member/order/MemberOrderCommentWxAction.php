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
use CRequest;
use module\cart\index\server\OrderStatusServer;

class MemberOrderCommentWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        if($this->request->hasPost()){
            $order = ItemModel::make('order')->addColumnsCondition(array(
                'order_id' => $request->getParams('order_id'),
            ))->execute();
            InsertModel::make('comment')->addData(array(
                'goods_id' => $order['goods_id'],
                'content' => $request->getParams('content'),
                'user_id' => Session::getUserID(),
                'add_time' => time(),
            ))->execute();
            OrderStatusServer::instance($order['order_id'])->changeStatus(OrderStatusServer::TO_FINISH);
        }
        return new \CRenderData(

        );
    }

}