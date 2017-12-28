<?php
/**
 * User: fu
 * Date: 2017/10/8
 * Time: 23:52
 */

namespace app\admin\controller;
use think\Loader;
use think\Page;

class Bank  extends Base
{
    public function index()
    {
        $model = M("Bank");
                $where = "";
                $keyword = I('keyword');
                $where = $keyword ? " name like '%$keyword%' " : "";
                $count = $model->where($where)->count();
                $Page = $pager = new Page($count,10);
                $brandList = $model->where($where)->order("`id` desc")->limit($Page->firstRow.','.$Page->listRows)->select();
                $show  = $Page->show();
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
        $model->alias('t')->join('t_service s','s.id = t.service_id','left ');
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
            $data['status'] = 6;
        }else if($_GET['p'] == 5){
            $data['status'] = 5;
        }
        $User->where(array('id' => $_GET['id']))->save($data); // 根据条件更新记录
        $this->success('操作成功!',U('index'));

    }
    /**
     * 添加修改编辑  商品品牌
     */
    public  function addEditService(){
            $id = I('id');
            if(IS_POST)
            {
               	$data = I('post.');

                if($id){
                	M("Bank")->update($data);
                }else{
                     $id = M("Bank")->insert($data);
                }


                 $this->ajaxReturn(['status'=>1,'msg'=>'操作成功','result'=>'']);
            }
           $cat_list = M('goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
           $this->assign('cat_list',$cat_list);
        $goodsImages = M("ServiceImages")->where('service_id =' . I('GET.id', 0))->select();
        $this->assign('goodsImages', $goodsImages);  // 商品相册
           $brand = M("Bank")->find($id);
           $this->assign('info',$brand);
        $this->initEditor(); // 编辑器
           return $this->fetch('_service');
    }
    public function delBrand()
    {


        $model = M("Bank");
        $model->where('id ='.$_GET['id'])->delete();
        $return_arr = array('status' => 1,'msg' => '操作成功','data'  =>'',);   //$return_arr = array('status' => -1,'msg' => '删除失败','data'  =>'',);
        $this->ajaxReturn($return_arr);
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