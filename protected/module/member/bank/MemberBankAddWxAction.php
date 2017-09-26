<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:25
 */

namespace module\member\bank;


use CRequest;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\SelectInput;
use CC\util\common\widget\form\TextInput;
use module\member\bank\enum\BankEnum;

class MemberBankAddWxAction extends \CAction implements IFormViewBuilder
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
            (new TextInput('name','身份证号'))->setPlaceHolder('请输入身份证号'),
            (new TextInput('开户名','手机号'))->setPlaceHolder('请输入开户名'),
            (new SelectInput('开户行','开户行',BankEnum::getValues())),
            (new TextInput('银行卡号','银行卡号'))->setPlaceHolder('请输入银行卡号'),
            (new TextInput('name','联系方式'))->setPlaceHolder('请输入联系方式'),
        );
    }
}