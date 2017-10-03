<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 17:12
 */

namespace module\service\my;

use biz\Session;
use CC\db\base\insert\InsertModel;
use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CC\db\base\update\UpdateModel;
use CRequest;
use module\cart\index\server\OrderStatusServer;
use module\service\index\enum\ServiceStatusEnum;

class ServiceMyCommentWxAction extends \CAction
{
    protected function getIsOpenTransaction()
    {
        return true;
    }

    public function execute(CRequest $request)
    {
        if($this->request->hasPost()){
            $id = $request->getParams('id');
            $service_reserve = ItemModel::make('service_reserve')->addColumnsCondition(array(
                'id' => $id,
            ))->execute();

            InsertModel::make('service_comment')->addData(array(
                'service_id' =>  $service_reserve['service_id'],
                'content' => $request->getParams('content'),
                'user_id' => Session::getUserID(),
                'username' => Session::getName(),
                'add_time' => time(),
            ))->execute();
            UpdateModel::make('service_reserve')->addData(array(
                'status' => ServiceStatusEnum::STATUS_WAIT_SUBSIDY
            ))->addId($id)->execute();
            return new \CJsonData();
        }
        return new \CRenderData(

        );
    }

}