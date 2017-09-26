<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 11:33
 */

namespace module\member\gold;


use biz\input\CaptchaInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CRequest;

class MemberGoldGiveWxAction extends \CAction implements IFormViewBuilder
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
            (new TextInput('name','转赠好友账号'))->setPlaceHolder('请输入转赠好友账号'),
            (new TextInput('name','转赠积分数'))->setPlaceHolder('请输入转赠积分数'),
            new CaptchaInput('name','验证码'),
        );
    }
}