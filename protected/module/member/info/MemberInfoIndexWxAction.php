<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 15:48
 */

namespace module\member\info;

use biz\action\SaveAction;
use biz\input\AddrInput;
use biz\input\CaptchaInput;
use biz\input\DateInput;
use biz\Session;
use CC\util\common\widget\form\creator\CheckCreator;
use CC\util\common\widget\form\creator\PostNamesCreator;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\RadioButtonListInput;
use CC\util\common\widget\form\SubmitInput;
use CC\util\common\widget\form\TextInput;
use CC\util\db\SexEnum;
use CErrorException;
use CRequest;
use module\basic\phone\server\PhoneServer;


class MemberInfoIndexWxAction extends SaveAction implements IFormViewBuilder
{

    /**
     * @return  IInput[]
     */
    public function createFormInputs()
    {
        return array(
            (new TextInput('name','姓名',['must']))->setPlaceHolder('请输入姓名'),
            (new TextInput('mobile','手机号',['must']))->setPlaceHolder('请输入手机号'),
            (new CaptchaInput('code','验证码',['must']))->setPhoneId('form_mobile'),
            new RadioButtonListInput('sex','性别',SexEnum::getValues()),
            (new TextInput('id_card','身份证号',['must']))->setPlaceHolder('请输入身份证号'),
            (new TextInput('email','邮箱',['must']))->setPlaceHolder('请输入邮箱'),
            new DateInput('birthday','出生日期'),
            (new TextInput('occupation','职业',['must']))->setPlaceHolder('请输入职业'),
            (new AddrInput('addr','地址')),
            (new TextInput('addr_info','详细地址',['must']))->setPlaceHolder('请输入详细地址'),
            new SubmitInput(),
        );
    }

    protected function onBeforeSave(&$data)
    {
        PhoneServer::checkCode($data['mobile'],$data['code']);

        if(!$data['birthday_year'] || !$data['birthday_month'] || !$data['birthday_day']){
            throw new CErrorException('出生日期不能为空');
        }
        $birthday = $data['birthday_year'].'-'.$data['birthday_month'].'-'.$data['birthday_day'];
        $data['birthday'] = strtotime($birthday);
        unset($data['birthday_year']);
        unset($data['birthday_month']);
        unset($data['birthday_day']);
        if(!$data['birthday']){
            throw new CErrorException('出生日期格式不正确');
        }
        if(!$data['province'] || !$data['city'] || !$data['district']){
            throw new CErrorException('出生地不能为空');
        }
        unset($data['code']);

    }
    protected function getTable()
    {
        return 'users';
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
    protected function getId()
    {
        return Session::getUserID();
    }

    protected function getIdField()
    {
        return 'user_id';
    }
}