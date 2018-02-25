<?php
/**
 * User: fu
 * Date: 2017/10/2
 * Time: 16:39
 */

namespace module\service\my;


use CC\db\base\select\ItemModel;
use CRequest;

class ServiceMyInfoWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $service_reserve = ItemModel::make('service_reserve')
            ->leftJoin('region','p','t.province = p.id')
            ->leftJoin('region','c','t.city = c.id')
            ->leftJoin('region','d','t.district = d.id')
            ->select('t.*,p.name p_name,c.name c_name,d.name d_name')
            ->addId($request->getParams('id'),'t.id')->execute();
        return new \CRenderData(array(
            'service_reserve' => $service_reserve,
        ));
    }
}