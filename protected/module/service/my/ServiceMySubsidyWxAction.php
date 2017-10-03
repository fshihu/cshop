<?php
/**
 * User: fu
 * Date: 2017/10/3
 * Time: 17:21
 */

namespace module\service\my;


use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CRequest;

class ServiceMySubsidyWxAction extends \CAction  implements IFormViewBuilder
{
    public function execute(CRequest $request)
    {
        return new \CRenderData();
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return [
            new TextInput('money','金额'),
            new TextInput('bills','消费单据'),
            new TextInput('cost_date','消费日期'),
        ];
    }
}