<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:12
 */

namespace module\member\info;


use CC\util\external\phpqrcode\QrCodeMaster;
use CRequest;
use module\member\index\UserServer;

class MemberInfoQrcodeWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
        $user = UserServer::getUser();
        $dir = \CC::app()->getBasePath() . '/../files/qr_code/';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $qr_code_path = $dir .$user['user_id'].'.png';
        if(!is_file($qr_code_path)){
            QrCodeMaster::png('xx',$qr_code_path,QR_ECLEVEL_L,16,0);
        }
        $qr_code_url = \CC::app()->baseUrl.'/files/qr_code/'.$user['user_id'].'.png';
        $user['qr_code_url'] = $qr_code_url;
        $user['recomm_url'] = $request->url->genurl('member/recomm/reg',['pid'=>$user['user_id']]);
        return new \CRenderData(array(
            'user' => $user,
        ));
    }
}