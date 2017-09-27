<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:17
 */

namespace module\service\index;


use CC\db\base\select\ItemModel;
use CC\db\base\select\ListModel;
use CRequest;

class ServiceIndexDetWxAction extends \CAction
{
    public $id;
    public function execute(CRequest $request)
    {
        $data = ItemModel::make('service')->addId($this->id)->execute();
        $service_images = ListModel::make('service_images')->addColumnsCondition(array('service_id' => $this->id))->execute();
        return new \CRenderData(array(
            'data' => $data,
            'service_images' => $service_images,
            'comment_list' => [],
        ));
    }
}