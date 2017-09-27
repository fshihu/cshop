<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/19
 * Time: 15:47
 */

namespace module\service\reserve;


use biz\action\SaveAction;
use biz\input\AddrInput;
use biz\input\CaptchaInput;
use biz\input\DateInput;
use CC\util\common\widget\form\CheckBoxListInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\RadioButtonListInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextAreaInput;
use CC\util\common\widget\form\TextInput;
use CC\util\common\widget\form\TimeInput;
use CC\util\db\SexEnum;
use CRequest;
use module\service\reserve\enum\MarriageEnum;
use module\service\reserve\enum\ReserveReasonEnum;

class ServiceReserveIndexWxAction extends SaveAction implements IFormViewBuilder
{
    protected function getTable()
    {
        return 'service_reserve';
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return [
            (new TextInput('consignee','预约人姓名'))->setPlaceHolder('请输入姓名'),
            (new TextInput('mobile','预约手机号'))->setPlaceHolder('请输入手机号'),
            new CaptchaInput('code','验证码'),
            new RadioButtonListInput('sex','性别',SexEnum::getValues()),
            new DateInput('briday','出生日期'),
            (new TextInput('occupation','职业'))->setPlaceHolder('请输入职业'),
            (new AddrInput('name','出生地')),
            new RadioButtonListInput('marriage','婚姻状况',MarriageEnum::getValues()),
            (new TextAreaInput('hobby','性格爱好')),
            new CheckBoxListInput('reserve_reason','预约理由',ReserveReasonEnum::getValues()),
            (new TextInput('date','预约日期')),
            new SubmitInput(),
        ];
    }

    /**
     * @return string "name,pass"
     */
    protected function getPostNames()
    {
        // TODO: Implement getPostNames() method.
    }
}