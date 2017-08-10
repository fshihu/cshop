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
                	M("Service")->insert($data);
                }
                $this->ajaxReturn(['status'=>1,'msg'=>'操作成功','result'=>'']);
            }
           $cat_list = M('goods_category')->where("parent_id = 0")->select(); // 已经改成联动菜单
           $this->assign('cat_list',$cat_list);
           $brand = M("Service")->find($id);
           $this->assign('brand',$brand);
        $this->initEditor(); // 编辑器
           return $this->fetch('_service');
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