<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:25
 */

namespace module\member\bank;


use biz\action\SaveAction;
use biz\Session;
use CC\util\common\widget\form\creator\CheckCreator;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CRequest;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\SelectInput;
use CC\util\common\widget\form\TextInput;
use module\member\bank\enum\BankEnum;

class MemberBankAddWxAction extends SaveAction implements IFormViewBuilder
{

    protected function getTable()
    {
        return 'users_bank';
    }

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('id_card','身份证号',['must']))->setPlaceHolder('请输入身份证号'),
            (new TextInput('name','开户名',['must']))->setPlaceHolder('请输入开户名'),
            (new SelectInput('bank_name','开户行',BankEnum::getValues(),['must'])),
            (new TextInput('bank_card','银行卡号',['must']))->setPlaceHolder('请输入银行卡号'),
            (new TextInput('contact','联系方式',['must']))->setPlaceHolder('请输入联系方式'),
        );
    }

    protected function onBeforeSave(&$data)
    {
        $data['user_id'] = Session::getUserID();
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
}