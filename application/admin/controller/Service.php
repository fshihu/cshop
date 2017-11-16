<?php
/**
 * User: fu
 * Date: 2017/8/9
 * Time: 22:52
 */

namespace app\admin\controller;


use Exception;
use think\Loader;
use think\Page;

class Service  extends Base
{
    public function index()
    {
        $model = M("Service");
                $where = "";
                $keyword = I('keyword');
                $where = $keyword ? " name like '%$keyword%' " : "";
                $count = $model->where($where)->count();
                $Page = $pager = new Page($count,10);
                $brandList = $model->where($where)->order("`sort` asc")->limit($Page->firstRow.','.$Page->listRows)->select();
                $show  = $Page->show();
                $cat_list = M('goods_category')->where("parent_id = 0")->getField('id,name'); // 已经改成联动菜单
                $this->assign('cat_list',$cat_list);
                $this->assign('pager',$pager);
                $this->assign('show',$show);
                $this->assign('brandList',$brandList);
                return $this->fetch();
    }

    public function reserve()
    {
        $model = M("ServiceReserve");
                $where = "";
                $keyword = I('keyword');
                $where = $keyword ? " name like '%$keyword%' " : "";
                $count = $model->where($where)->count();
                $Page = $pager = new Page($count,10);
//        $model->join('left join t_service s on t.');
        $model->alias('t')->join('t_service s','s.id = t.service_id','left ');
        $model->field('t.*,s.name service_name');
                $brandList = $model->where($where)->order("t.`id` desc")->limit($Page->firstRow.','.$Page->listRows)->select();
                $show  = $Page->show();
        foreach ($brandList as $i => $item) {
            $brandList[$i]['sex'] = $item['sex'] == 1?'男':'女';
            $brandList[$i]['birthday'] = date('Y年m月d日',$item['birthday']);
                }

        $cat_list = M('goods_category')->where("parent_id = 0")->getField('id,name'); // 已经改成联动菜单
                $this->assign('cat_list',$cat_list);
                $this->assign('pager',$pager);
                $this->assign('show',$show);
                $this->assign('brandList',$brandList);
                return $this->fetch();
    }
    public function detail()
    {
        $model = M("ServiceReserve");
                $where = "";

                $count = $model->where(array('id' => $_GET['id']))->count();
                $Page = $pager = new Page($count,10);
//        $model->join('left join t_service s on t.');
        $model->where(array('t.id' => $_GET['id']))->alias('t')->join('t_service s','s.id = t.service_id','left ');
        $model   ->join('t_region p','t.province = p.id','left');
        $model ->join('t_region c','t.city = c.id','left');
        $model ->join('t_region d','t.district = d.id','left');
        $model->field('t.*,s.name service_name,p.name p_name,c.name c_name,d.name d_name');
                $service = $model->where($where)->order("t.`id` asc")->limit($Page->firstRow.','.$Page->listRows)->find();
        $service['birthday'] =date('Y年',$service['birthday']);
        $service['sex'] =  $service['sex'] == 1?'男':'女';
        $service['addrs'] =  $service['p_name']. $service['c_name']. $service['d_name'];
        $m = array(
                    1 => '未婚',
                    2 => '已婚',
                    3 => '离异',
                );
        $r = array(
                    1 => '美颜',
                    2 => '嫩肤',
                    3 => '年轻化',
                    4 => '其他理由',
                );
        $s = array(
                    '待审核',
                    '待服务',
                    '未通过',
                    '待评价',
                    '待补贴',
                    '补贴申请未通过',
                    '已完成',
                );
        $service['reserve_reason'] = $r[$service['reserve_reason']].$service['reserve_reason_other'];
        $service['marriage'] = $m[$service['marriage']];
        $service['date'] = date('Y-m-d',$service['date']);
        $service['cost_date'] = $service['cost_date']?date('Y-m-d',$service['cost_date']):'';
        $service['status_desc'] = $s[$service['status']];
                $this->assign('service',$service);
                return $this->fetch();
    }
    public function changetime()
    {
        $time = strtotime($_POST['date']);
        if(!$time){
            echo 'err';exit;
        }
        M("ServiceReserve")->where(array('id' => $_POST['id']))->save(array(
            'date' => $time
        )); // 根据条件更新记录
        echo 'ok';
    }

    public function sendMsg($mobile,$text)
    {
        $url = 'https://sms.yunpian.com/v2/sms/single_send.json';
        $apikey = 'c55b480e75f882cccabb385dc6fc8998';
        $text = "【灏维网络】".$text;
        $r = Curl::instance()->post($url,array(
            'apikey' => $apikey,
            'mobile' => $mobile,
            'text' => $text,
        ));
        $r = json_decode($r,true);

        if($r['code']!= 0){
            $this->error('短信发送失败!');exit;
        }
        return true;
    }

    public function confirm()
    {
        $User = M("ServiceReserve"); // 实例化User对象
        // 要修改的数据对象属性赋值
        $s = M("ServiceReserve")->where(array('id' => $_GET['id']))->find(); // 根据条件更新记录
        if($_GET['p'] == 1){
            $data['status'] = 1;
            $this->sendMsg($s['mobile'],'您预约的服务已通过。');
        }else if($_GET['p'] == 2){
            $data['status'] = 2;
            $this->sendMsg($s['mobile'],'您预约的服务未通过。');
        }else if($_GET['p'] == 3){
            $data['status'] = 3;
        }else if($_GET['p'] == 4){
            $yiyuan_xiaofei = $_GET['yiyuan_xiaofei'];
            $yiyuan_butie = $_GET['yiyuan_butie'];
            $user_bili = $_GET['user_bili'];
            if($yiyuan_xiaofei <=0 || $yiyuan_butie <= 0 || $user_bili <= 0){
                $this->error('请填写完整信息!');exit;
            }
            $data['yiyuan_xiaofei'] = $yiyuan_xiaofei;
            $data['yiyuan_butie'] = $yiyuan_butie;
            $data['user_bili'] = $user_bili;
            /**
             * 例子：
             * 例子：销售人员a，推荐金卡用户b，有足够的积分用于抵扣（抵扣10%），预约服务g，
             * 成功到医院消费2000，
             * 医院补贴公司1000，
             * 用户补贴比例20%，
             * 销售人员返现比例30%，则：
             用户抵扣金额：（2000-2000*20%）*10=160
             返还用户补贴金额：2000*20%+160=560
             销售人员获得佣金：（1000-2000*20%）*30%=180

             */
            $service_reserve = M('service_reserve')->where(array('id' => $_GET['id']))->find();
            $max_ratio = self::getUseGoldMaxRatio($service_reserve['user_id']);
            $user =    M('users')->where(array(
                        'user_id' => $service_reserve['user_id'],
                    ))->find();
            $user_bili = $user_bili / 100;


            if($user['first_leader']){
                $first_leader = M('users')->where(array(
                                        'user_id' => $user['first_leader'],
                                    ))->find();
                if($first_leader['is_sale']){
                    $first_leader['sale_ratio'] =  $first_leader['sale_ratio']/100;

                    $xiaoshou_price = ($yiyuan_butie -  $yiyuan_xiaofei*$user_bili ) *  $first_leader['sale_ratio'];
                    if($xiaoshou_price > 0){
                        self::addRecord($first_leader['user_id'],4,$xiaoshou_price,'服务预约佣金',$service_reserve['id']);
                    }
                }

            }

            $user_gold = min($user['gold'],(int)(($yiyuan_xiaofei - $user_bili * $yiyuan_xiaofei)*$max_ratio));
            if($user_gold > 0){
                self::addGold($user['user_id'],6,-$user_gold,'服务补贴扣除',$service_reserve['id']);
            }

            $butie_price = $yiyuan_xiaofei * $user_bili  + $user_gold;
            if($butie_price > 0){
                self::addRecord($user['user_id'],3,$butie_price,'服务补贴',$service_reserve['id']);
            }
            $data['status'] = 6;
        }else if($_GET['p'] == 5){
            $data['status'] = 5;
        }
        M("ServiceReserve")->where(array('id' => $_GET['id']))->save($data); // 根据条件更新记录
        $this->success('操作成功!',U('reserve'));

    }

    public static function addGold($uid,$type,$gold,$content,$data_id)
     {
         $user =    M('users')->where(array(
                     'user_id' => $uid,
                 ))->find();

         M('user_gold_record')->insert(array(
             'uid' => $uid,
             'money' => $gold,
             'cur_money' => $user['gold'] + $gold,
             'content' => $content,
             'data_id' => $data_id,
             'type' => $type,//转增
             'crate_time' => time(),
         ));
         M('users')->where(array(
             'user_id' => $uid
         ))->save(array(
                     'gold' => $user['gold'] + $gold
                 ));
     }

     public static function addRecord($uid, $type, $money, $content, $data_id)
    {
        $user =    M('users')->where(array(
                    'user_id' => $uid,
                ))->find();

       M('user_money_record')->insert(array(
            'uid' => $uid,
            'money' => $money,
            'cur_money' => $user['user_money'] + $money,
            'content' => $content,
            'data_id' => $data_id,
            'type' => $type,
            'crate_time' => time(),
        ));
        M('users')->where(array(
            'user_id' => $uid
        ))->save(array(
                    'user_money' => $user['user_money'] + $money
                ));
    }

    public static function getUseGoldMaxRatio($uid)
    {
        $user = M('users')->where(array('user_id' => $uid))->find();
        $ration = 0.05;
        /*普通会员购买产品最多抵扣产品价格5%，金卡会员购买产品最多抵扣产品价格10%，黑卡/黑卡附属卡会员购买产品最多抵扣产品价格20%。*/
         if($user['level'] == 3||$user['level'] ==4){
             $ration = 0.2;
         }
         if($user['level'] == 2){
             $ration = 0.1;
         }
        return $ration;
    }

    /**
     * 添加修改编辑  商品品牌
     */
    public  function addEditService(){
            $id = I('id');
            if(IS_POST)
            {
               	$data = I('post.');
                $brandVilidate = Loader::validate('Service');
                if(!$brandVilidate->batch()->check($data)){
                    $return = ['status'=>0,'msg'=>'操作失败','result'=>$brandVilidate->getError()];
                    $this->ajaxReturn($return);
                }
                if($id){
                	M("Service")->update($data);
                }else{
                    $id = M("Service")->insert($data);
                }

                // 商品图片相册  图册
                $goods_images = I('goods_images/a');
                if(count($goods_images) > 1)
                {
                    array_pop($goods_images); // 弹出最后一个
                    $goodsImagesArr = M('ServiceImages')->where("service_id = $id")->getField('img_id,image_url'); // 查出所有已经存在的图片

                    // 删除图片
                    foreach($goodsImagesArr as $key => $val)
                    {
                        if(!in_array($val, $goods_images))
                            M('ServiceImages')->where("img_id = {$key}")->delete(); //
                    }
                    // 添加图片
                    foreach($goods_images as $key => $val)
                    {
                        if($val == null)  continue;
                        if(!in_array($val, $goodsImagesArr))
                        {
                               $data = array(
                                   'service_id' => $id,
                                   'image_url' => $val,
                               );
                               M("ServiceImages")->insert($data); // 实例化User对象
                        }
                    }
                }
                $this->ajaxReturn(['status'=>1,'msg'=>'操作成功','result'=>'']);
            }
           $cat_list = M('goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
           $this->assign('cat_list',$cat_list);
        $goodsImages = M("ServiceImages")->where('service_id =' . I('GET.id', 0))->select();
        $this->assign('goodsImages', $goodsImages);  // 商品相册
           $brand = M("Service")->find($id);
           $this->assign('brand',$brand);
        $this->initEditor(); // 编辑器
           return $this->fetch('_service');
    }

    /**
     * 删除商品相册图
     */
    public function del_goods_images()
    {
        $path = I('filename','');
        M('service_images')->where("image_url = '$path'")->delete();
    }
    /**
       * 删除品牌
       */
      public function delService()
      {
          // 判断此品牌是否有商品在使用
          $goods_count = M('Goods')->where("brand_id = {$_GET['id']}")->count('1');
          if($goods_count)
          {
              $return_arr = array('status' => -1,'msg' => '此品牌有商品在用不得删除!','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
              $this->ajaxReturn($return_arr);
          }

          $model = M("Service");
          $model->where('id ='.$_GET['id'])->delete();
          $return_arr = array('status' => 1,'msg' => '操作成功','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
          $this->ajaxReturn($return_arr);
      }
    /**
     * 初始化编辑器链接
     * 本编辑器参考 地址 http://fex.baidu.com/ueditor/
     */
    private function initEditor()
    {
        $this->assign("URL_upload", U('admin/Ueditor/imageUp',array('savepath'=>'goods'))); // 图片上传目录
        $this->assign("URL_imageUp", U('admin/Ueditor/imageUp',array('savepath'=>'article'))); //  不知道啥图片
        $this->assign("URL_fileUp", U('admin/Ueditor/fileUp',array('savepath'=>'article'))); // 文件上传s
        $this->assign("URL_scrawlUp", U('admin/Ueditor/scrawlUp',array('savepath'=>'article')));  //  图片流
        $this->assign("URL_getRemoteImage", U('admin/Ueditor/getRemoteImage',array('savepath'=>'article'))); // 远程图片管理
        $this->assign("URL_imageManager", U('admin/Ueditor/imageManager',array('savepath'=>'article'))); // 图片管理
        $this->assign("URL_getMovie", U('admin/Ueditor/getMovie',array('savepath'=>'article'))); // 视频上传
        $this->assign("URL_Home", "");
    }
}

class Curl {

    private $_ch;
    public $options;
    private $_cookieFile;
    public $url;
    private $_config = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_AUTOREFERER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
    );
    private static $request_record = array();
    private $request_info = array();
    public function setCookieFile($filename,$dir = null)
    {
        if($dir === null){
            $dir = dirname(__FILE__).'/tmp';
        }
        $this->_cookieFile = $dir.'/'.$filename;
    }
    public function getCookieFile()
    {
        if($this->_cookieFile == null){
            $this->_cookieFile = tempnam(dirname(__FILE__).'/tmp','COOKIE_');
        }
        return $this->_cookieFile;
    }
    private function _exec($url,$params = '') {
        $this->url = $url;
        $this->setOption(CURLOPT_URL, $url);
        $start_time = microtime(true);
        $this->request_info = array(
            'url' => $url,
            'params' => $params,
            'exec_time' => 0,
            'result' => '',
        );
        $c = curl_exec($this->_ch);
        $this->request_info['exec_time'] = number_format(microtime(true) - $start_time,6);
        $this->request_info['result'] = $c;
        self::$request_record[] = $this->request_info;
        $curl_errno = curl_errno($this->_ch);
        if (!$curl_errno)
            return $c;
        else
        {
            $err = curl_error($this->_ch);
            throw new Exception($err.'('.$curl_errno.')',$this->getRequestInfo());
        }
    }

    public static function getAllRequestRecord($is_string = false)
    {
        if($is_string){
            $msg = '';
            foreach (self::$request_record as $data) {
                $msg .= "\n\n" . 'url:     ' . $data['url'] . "\n";
                $msg .= 'params:  ' . $data['params'] . "\n";
                $msg .= 'line:  ' . $data['line'] . "\n";
                $msg .= 'exec_time:  ' . $data['exec_time'] . "\n\n";
            }
            return $msg;
        }
        return self::$request_record;
    }
    public function get($url, $params = array()) {
        $this->setOption(CURLOPT_HTTPGET, true);
        $r =  $this->_exec($this->buildUrl($url, $params));
        return $r;
    }

    public function post($url, $params = array()) {
        if(is_array($params)){
            $has_file = false;
            foreach ($params as $name => $value) {
                if(is_object($value)){
                    $has_file = true;
                    break;
                }
            }
            if(!$has_file){
                $params = http_build_query($params);
            }
        }
        $this->setOption(CURLOPT_POST, true);
        $this->setOption(CURLOPT_POSTFIELDS, $params);
        $r =  $this->_exec($url,$params);
        return $r;
    }
    public function postMulti($urls,$fn)
    {
        $mh = curl_multi_init();
        $curl_handles = array();
        foreach ($urls as $data) {
            $ch = $this->_init_multi();
            if(isset($data['params'])){
                if(is_array($data['params'])){
                    $data['params'] = http_build_query($data['params']);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data['params']);
            }
            curl_setopt($ch, CURLOPT_URL, $data['url']);
            curl_setopt($ch, CURLOPT_POST, true);
            $curl_handles[] = array('url' => $data['url'],'ch' => $ch);
            curl_multi_add_handle($mh, $ch);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        }
        while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                }
                while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($curl_handles as $val) {
            $html = curl_multi_getcontent($val['ch']);
            call_user_func($fn,$html,$val['url']);
            curl_multi_remove_handle($mh, $val['ch']);
        }
        curl_multi_close($mh);
    }
    public function getMulti($urls,$fn)
    {
        $mh = curl_multi_init();
        $curl_handles = array();
        foreach ($urls as $data) {
            $ch = $this->_init_multi();
            $url = $data['url'];
            if(isset($data['params'])){
                $url = $this->buildUrl($data['url'], $data['params']);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            $curl_handles[] = array('url' => $url,'ch' => $ch);
            curl_multi_add_handle($mh, $ch);
        }
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        }
        while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                }
                while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($curl_handles as $val) {
            $html = curl_multi_getcontent($val['ch']);
            call_user_func($fn,$html,$val['url']);
            curl_multi_remove_handle($mh, $val['ch']);
        }
        curl_multi_close($mh);
    }
    private function _init_multi()
    {
        $ch = curl_init();
        $options = is_array($this->options) ? ($this->options + $this->_config) : $this->_config;
        curl_setopt_array($ch, $options);
        return $ch;
    }
    private static $_curl ;
    public static function instance($options=array())
    {
        self::$_curl = new Curl();
        self::$_curl->options=$options;
        self::$_curl->init();
        return self::$_curl;

    }

    public function put($url, $data, $params = array()) {

        $f = fopen('php://temp', 'rw+');
        fwrite($f, $data);
        rewind($f);

        $this->setOption(CURLOPT_PUT, true);
        $this->setOption(CURLOPT_INFILE, $f);
        $this->setOption(CURLOPT_INFILESIZE, strlen($data));

        return $this->_exec($this->buildUrl($url, $params));
    }

    public function buildUrl($url, $data = array()) {
        $parsed = parse_url($url);
        isset($parsed['query']) ? parse_str($parsed['query'], $parsed['query']) : $parsed['query'] = array();
        $params = isset($parsed['query']) ? array_merge($parsed['query'], $data) : $data;
        $parsed['query'] = ($params) ? '?' . http_build_query($params) : '';
        if (!isset($parsed['path']))
            $parsed['path'] = '/';

        $port = '';
        if(isset($parsed['port'])){
            $port = ':' . $parsed['port'];
        }

        return $parsed['scheme'] . '://' . $parsed['host'] .$port. $parsed['path'] . $parsed['query'];
    }

    public function setOptions($options = array()) {
        curl_setopt_array($this->_ch, $options);
        return $this;
    }

    public function setOption($option, $value) {
        curl_setopt($this->_ch, $option, $value);
        return $this;
    }

    // sets header for current request
    public function setHeaders($header)
    {
        $out = array();
         foreach($header as $k => $v){
             $out[] = $k .': '.$v;
         }
        $header = $out;
        $this->setOption(CURLOPT_HTTPHEADER, $header);
        return $this;
    }


    // initialize curl
    public function init() {
        try {
            $this->_ch = curl_init();
            $options = is_array($this->options) ? ($this->options + $this->_config) : $this->_config;
            $this->setOptions($options);
        } catch (Exception $e) {
            throw new CurlException($e->getMessage(),$this->getRequestInfo());
        }
    }

    public function close()
    {
        $ch = $this->_ch;
        curl_close($ch);
    }

    /**
     * @return string
     */
    public function getRequestInfo()
    {
        return var_export($this->request_info,true);
    }

}
