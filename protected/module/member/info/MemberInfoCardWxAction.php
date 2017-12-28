<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:00
 */

namespace module\member\info;


use CRequest;
use CC\db\base\select\ListModel;
use module\member\index\UserServer;

class MemberInfoCardWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        if($_GET['user_id']){
			
			$info = ListModel::make('users')->addColumnsCondition(array('user_id' => $_GET['user_id']))->execute(); 
			$user=$info[0];
		}else{
			$user = UserServer::getUser();
		}

        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}