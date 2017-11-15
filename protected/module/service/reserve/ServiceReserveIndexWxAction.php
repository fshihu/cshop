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
use biz\input\YearInput;
use biz\Session;
use CC\util\common\widget\form\CheckBoxListInput;
use CC\util\common\widget\form\creator\CheckCreator;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\RadioButtonListInput;
use CC\util\common\widget\form\SelectInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextAreaInput;
use CC\util\common\widget\form\TextInput;
use CC\util\common\widget\form\TimeInput;
use CC\util\db\SexEnum;
use CErrorException;
use CRequest;
use module\basic\phone\server\PhoneServer;
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
            (new TextInput('consignee','预约人姓名',['must']))->setPlaceHolder('请输入姓名'),
            (new TextInput('mobile','预约手机号',['must']))->setPlaceHolder('请输入手机号'),
            (new CaptchaInput('code','验证码',['must']))->setPhoneId('form_mobile'),
            new RadioButtonListInput('sex','性别',SexEnum::getValues()),
            new YearInput('briday','出生日期',['must']),
            (new TextInput('occupation','职业',['must']))->setPlaceHolder('请输入职业'),
            (new AddrInput('name','出生地'))->setIsShowDistirct(false),
            new RadioButtonListInput('marriage','婚姻状况',MarriageEnum::getValues()),
            (new SelectInput('hobby','月收入',['5000以内'=>'5000以内','5000~15000'=>'5000~15000','15000~30000'=>'15000~30000','30000以上'=>'30000以上'])),
            new CheckBoxListInput('reserve_reason','预约理由',ReserveReasonEnum::getValues(),['must']),
            (new TextInput('reserve_reason_other','其他理由'))->setPlaceHolder('请输入其他理由'),
            (new TextInput('date','预约日期',['must'])),
            new SubmitInput(),
        ];
    }

    /**
     * @return string "name,pass"
     */
    protected function getPostNames()
    {
        return PostNamesCreator::create($this);
    }
    protected function getCheckers()
    {
        return CheckCreator::create($this);
    }

    protected function onBeforeSave(&$data)
    {
        PhoneServer::checkCode($data['mobile'],$data['code']);
        $data['service_id'] = $this->request->getParams('service_id');
        $data['part'] = $this->request->getParams('part');
        $birthday = $data['briday'].'-01-01';
        $data['birthday'] = strtotime($birthday);
        unset($data['briday_year']);
        unset($data['briday_month']);
        unset($data['briday_day']);
        unset($data['briday']);
        if(!$data['birthday'] || $data['birthday'] > time()){
            throw new CErrorException('出生日期格式不正确');
        }
        if(!$data['province'] || !$data['city']){
            throw new CErrorException('出生地不能为空');
        }
        unset($data['code']);

        $data['user_id'] = Session::getUserID();
        $data['date'] = strtotime($data['date']);
    }

}