<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 16:24
 */

namespace module\member\level;


use biz\input\CaptchaInput;
use CC\util\common\widget\form\IFormViewBuilder;
use CC\util\common\widget\form\IInput;
use CC\util\common\widget\form\TextInput;
use CRequest;

class MemberLevelGiveWxAction extends \CAction implements IFormViewBuilder
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
            new CaptchaInput('name','验证码'),
        );
    }
}