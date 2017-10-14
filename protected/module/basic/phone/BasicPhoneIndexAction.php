<?php
/**
 * User: fu
 * Date: 2017/10/13
 * Time: 1:51
 */

namespace module\basic\phone;


use CC\db\base\insert\InsertModel;
use CRequest;
use module\basic\phone\server\PhoneServer;

class BasicPhoneIndexAction extends \CAction
{
    public $phone;
    public $code;
    public function execute(CRequest $request)
    {
        $code = mt_rand(100000,999999);
        InsertModel::make('phone_code')->addData(array(
            'phone' => $this->phone,
            'code' => $code,
            'c_time' => time(),
        ))->execute();
        PhoneServer::sendMsg();
        return new \CJsonData();
    }
    protected function getIsOpenTransaction()
    {
        return true;
    }
}