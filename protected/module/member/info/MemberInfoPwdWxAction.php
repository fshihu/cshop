<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/26
 * Time: 12:03
 */

namespace module\member\info;


use biz\input\SimplePasswordInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\PasswordInput;
use CC\util\encrypt\Password;
use CRequest;

class MemberInfoPwdWxAction extends \CAction implements IFormViewBuilder
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
            (new PasswordInput('name','原始密码')),
            (new PasswordInput('name','新密码')),
            (new SimplePasswordInput('name','重复密码')),

        );
    }
}