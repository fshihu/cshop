<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 17:21
 */

namespace module\service\my;


use biz\action\SaveAction;
use biz\input\FileInput;
use CC\db\base\select\ItemModel;
use CC\util\common\widget\form\creator\CheckCreator;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CC\util\common\widget\form\HiddenInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CErrorException;
use CRequest;

class ServiceMySubsidyWxAction extends SaveAction  implements IFormViewBuilder
{
    public function onExecute()
    {
        $request = $this->request;
        $service_reserve = ItemModel::make('service_reserve')->select('t.*,s.name,s.image')->leftJoin('service','s','t.service_id = s.id')->addId($request->getParams('id'),'t.id')->execute();
        return (array(
            'service_reserve' => $service_reserve
        ));
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return [
            new TextInput('money','金额',['must']),
            new TextInput('bills','消费单号',['must']),
            new TextInput('cost_date','消费日期',['must']),
            new HiddenInput('bills_file',''),
        ];
    }

    /**
     * @return string "name,pass"
     */
    protected function getPostNames()
    {
        return PostNamesCreator::create($this);
    }
    protected function getTable()
    {
        return 'service_reserve';
    }
    protected function getCheckers()
    {
        return CheckCreator::create($this);
    }
    protected function onBeforeSave(&$data)
    {
        $data['cost_date'] = strtotime($data['cost_date']);
        if (!$data['bills_file']){
            throw new CErrorException('上传单据 不能为空！');
        }
    }
}