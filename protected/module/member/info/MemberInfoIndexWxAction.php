<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:48
 */

namespace module\member\info;

use biz\input\AddrInput;
use biz\input\CaptchaInput;
use biz\input\DateInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\RadioButtonListInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextInput;
use CC\util\db\SexEnum;
use CRequest;


class MemberInfoIndexWxAction extends \CAction implements IFormViewBuilder
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
        return array(
            (new TextInput('name','姓名'))->setPlaceHolder('请输入姓名'),
            (new TextInput('name','手机号'))->setPlaceHolder('请输入手机号'),
            new CaptchaInput('name','验证码'),
            new RadioButtonListInput('name','性别',SexEnum::getValues()),
            (new TextInput('name','身份证号'))->setPlaceHolder('请输入身份证号'),
            (new TextInput('name','邮箱'))->setPlaceHolder('请输入邮箱'),
            new DateInput('briday','出生日期'),
            (new TextInput('name','职业'))->setPlaceHolder('请输入职业'),
            (new AddrInput('name','地址')),
            (new TextInput('name','详细地址'))->setPlaceHolder('请输入详细地址'),
            new SubmitInput(),
        );
    }
}