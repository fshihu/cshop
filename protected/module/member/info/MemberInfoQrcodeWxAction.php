<?php
/**
 * Created by PhpStorm.
 * User: onwer
 * Date: 2017/9/20
 * Time: 18:12
 */

namespace module\member\info;

use CC\db\base\select\ListModel;
use CC\util\external\grafika\GrafikaMaster;
use CC\util\external\phpqrcode\QrCodeMaster;
use CRequest;
use Grafika\Color;
use module\member\index\UserServer;

class MemberInfoQrcodeWxAction extends \CAction
{
    public function execute(CRequest $request)
    {
		if($_GET['user_id']){
			
			$info = ListModel::make('users')->addColumnsCondition(array('user_id' => $_GET['user_id']))->execute(); 
			$user=$info[0];
		}else{
			$user = UserServer::getUser();
		}
        
        $dir = \CC::app()->getBasePath() . '/../files/qr_code/';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $qr_code_path = $dir .$user['user_id'].'_s.png';
        $user['recomm_url'] = $request->url->genurl('member/recomm/reg',['pid'=>$user['user_id']],true);
        if(!is_file($qr_code_path)){

            $qr_png = $dir . $user['user_id'] . '.png';
            if(!is_file($qr_png)){
                QrCodeMaster::png($user['recomm_url'], $qr_png,QR_ECLEVEL_L,16,0);
            }
            $this->createImage($qr_code_path,$qr_png,$user['recomm_url']);
        }
        $qr_code_url = \CC::app()->baseUrl.'/files/qr_code/'.$user['user_id'].'_s.png';
        $user['qr_code_url'] = $qr_code_url;

        return new \CRenderData(array(
            'user' => $user,
        ));
    }

    protected function createImage($qr_code_path,$qr_png,$recomm_url)
    {
		$recomm_url='http://lianpoju.com/wx/home/index/index';
        $blank_image = GrafikaMaster::createBlankImage(500 , 750);

        $fonts_dir = GrafikaMaster::fontsDir();
        $draw = GrafikaMaster::createDrawingObject('Line',[0,0],[100,100]);
        $normal_fonts = $fonts_dir . '/msyh.ttf';
        $bold_fonts = $fonts_dir . '/SourceHanSansCN-Bold.otf';
        $medium_fonts = $fonts_dir . '/SourceHanSansCN-Medium.otf';

        $fileter = GrafikaMaster::createFilter('Colorize', 100, 100, 100);
        $editor =  GrafikaMaster::createEditor();
        $editor->apply($blank_image, $fileter);


        $scale = 1;
//        $($blank_image, $data);
//        $addLine($blank_image);
        $editor->text($blank_image,'有机商城',24,130,550, new Color("#000000"),$normal_fonts);
        $editor->text($blank_image,'推广链接',16,130,590, new Color("#000000"),$normal_fonts);
        $editor->text($blank_image,substr($recomm_url,0,29),16,130,620, new Color("#000000"),$normal_fonts);
        $editor->text($blank_image,substr($recomm_url,29),16,130,650, new Color("#000000"),$normal_fonts);
        $editor->text($blank_image,'请扫描二维码或长按保存图片',16,130,680, new Color("#000000"),$normal_fonts);

        $logo_png = \CC::app()->basePath.'/../public/biz/wx/common/images/recolog.png';

        $editor->open($logo_image, $logo_png);
        $editor->resizeExact($logo_image, 115 , 115);
        $editor->blend($blank_image, $logo_image, 'normal', 1, 'top-left', 10, 570);

        $editor->open($qrcode_img, $qr_png);
        $editor->resizeExact($qrcode_img, 464, 464);
        $editor->blend($blank_image, $qrcode_img, 'normal', 1, 'top-center', 0, 20);

        $editor->draw($blank_image, GrafikaMaster::createDrawingObject('Line', array(0, 530), array(500, 530), 1, new Color('#dbdbdb')));

        $editor->draw($blank_image, GrafikaMaster::createDrawingObject('Line', array(0, 0), array(0, 800), 1, new Color('#dbdbdb')));
        $editor->draw($blank_image, GrafikaMaster::createDrawingObject('Line', array(0, 0), array(500, 0), 1, new Color('#dbdbdb')));
        $editor->draw($blank_image, GrafikaMaster::createDrawingObject('Line', array(0, 749), array(500, 749), 1, new Color('#dbdbdb')));
        $editor->draw($blank_image, GrafikaMaster::createDrawingObject('Line', array(499, 0), array(499, 850), 1, new Color('#dbdbdb')));

        $editor->save($blank_image, $qr_code_path);
    }
}