<?php
/**
 * User: fu
 * Date: 2017/8/9
 * Time: 22:52
 */

namespace app\admin\controller;


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
                $brandList = $model->where($where)->order("t.`id` asc")->limit($Page->firstRow.','.$Page->listRows)->select();
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
        $service['birthday'] =date('Y年m月d日',$service['birthday']);
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
        $service['status_desc'] = $s[$service['status']];
                $this->assign('service',$service);
                return $this->fetch();
    }

    public function confirm()
    {
        $User = M("ServiceReserve"); // 实例化User对象
        // 要修改的数据对象属性赋值
        if($_GET['p'] == 1){
            $data['status'] = 1;
        }else if($_GET['p'] == 2){
            $data['status'] = 2;
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
             * 例子：管理员后台设置市场部人员佣金比例为10%，市场部人员a，推荐金卡用户b，
             * 有足够的积分用于抵扣（抵扣10%），预约服务g，成功到医院消费2000，
             * 医院补贴公司1000，用户补贴比例20%，市场部人员返现比例10%，则：
             * 用户抵扣金额：2000*10%=200
             市场部人员获得佣金：（1000-200）*10%=80
             用户返补贴金额：（1000-200）*20+200=360
             */
            $service_reserve = M('service_reserve')->where(array('id' => $_GET['id']))->find();
            $max_ratio = self::getUseGoldMaxRatio($service_reserve['user_id']);
            $user =    M('users')->where(array(
                        'user_id' => $service_reserve['user_id'],
                    ))->find();
            $user_gold = min($user['gold'],$max_ratio * $yiyuan_xiaofei);
            if($user['first_leader'] && $user['is_sale']){
                $first_leader = M('users')->where(array(
                                        'user_id' => $user['first_leader'],
                                    ))->find();
                $shic_price = ($yiyuan_butie -  $user_gold ) *  $first_leader['sale_ratio']/100;
                if($shic_price > 0){
                    self::addRecord($first_leader['user_id'],4,$shic_price,'服务预约佣金',$service_reserve['id']);
                }
            }
            if($user_gold > 0){
                self::addGold($user['user_id'],6,-$user_gold,'服务补贴扣除',$service_reserve['id']);
            }
            $butie_price = ($yiyuan_butie - $user_gold) * $user_bili / 100 + $user_gold;
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