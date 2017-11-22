<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/25
 * Time: 16:11
 */

namespace module\service\my;


use biz\Session;
use CC\action\ListAction;
use CC\db\base\select\ListModel;
use CC\util\arr\ArrayUtil;
use CRequest;
use module\service\index\enum\ServiceStatusEnum;

class ServiceMyIndexWxAction extends ListAction
{
    public $status = '_all';
    protected function getTable()
    {
        return 'service_reserve';
    }
    protected function onExecute()
    {
        $stats = ListModel::make('service_reserve')->addColumnsCondition(array(
            'user_id' => Session::getUserID(),
        ))->select('count(*) count_num,status')->group('status')->execute();
        $stat = ArrayUtil::arrayColumn($stats,'count_num','status');
        return array(
            'status' => $this->status,
            'stat' => $stat,
            'status_desc' => ServiceStatusEnum::getValueByIndex($this->status),
        );
    }

    protected function getSearchCondition()
    {
        if($this->status != '_all'){
            $this->dbCondition->addColumnsCondition(array(
                'status' => $this->status,
            ));
        }
        $this->dbCondition->addColumnsCondition(array(
            'user_id' => Session::getUserID(),

        ))->order('t.id desc')->select('t.*,s.name,s.image')->leftJoin('service','s','t.service_id = s.id');
    }
}