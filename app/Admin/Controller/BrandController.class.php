<?php
namespace Admin\Controller;

use Common\Controller\AdminController;
use Think\Upload;
use Common\Library\Page;

/**
 * 商品品牌控制器
 */
class BrandController extends AdminController
{

    // 构造函数，并实例化品牌模型
    public function __construct()
    {
        parent::__construct();
        $this->Brand = D('Brand');
    }
    // 获取品牌列表
    public function showlist()
    {
        $brand = D();
        if($_REQUEST['brand_name'] == ''){
            $condition = '';
        }else{
            $condition['brand_name'] = I('get.brand_name');
        }
        $count = $this->Brand->getcount($condition);

        $Page = new Page($count,5);
        if(isset($condition['brand_name'])){
            $sql = "select * from cz_brand where brand_name = '{$condition["brand_name"]}'";
        }else{
        $sql = "select * from cz_brand ".$Page->limit;
        }
        $Bar = $Page->fpage();
        // 获取所有品牌信息列表
//         $list = $this->Brand->getBrandList();

        $res = $brand->query($sql);

        $this->assign('bar',$Bar);
        $this->assign('list', $res);
        $this->display('brand_list');
    }

    /**
     * 添加品牌
     */
    public function add()
    {
        // 如果是POST方式提交
        if (IS_POST) {
            // 接收POST信息
            $data['brand_name'] = $_POST['brand_name'];
            $data['site_url'] = $_POST['site_url'];
            $data['brand_desc'] = $_POST['brand_desc'];
            $data['sort_order'] = $_POST['sort_order'];
            $data['is_show'] = $_POST['is_show'];

            // 判断品牌名称是否为空
            if (empty($data['brand_name']))
                $this->error('品牌名称不为空', U('Brand/add'), 2);

                // 判断是否上传品牌Logo
            if (! empty($_FILES['brand_logo']['tmp_name'])) {
                // 如果有上传，则上传Logo文件到指定目录，并获取信息
                $data['brand_logo'] = $this->upload();
            }

            // 整理数据，过滤数据信息
            $this->Brand->create($data);
            if ($this->Brand->add()) {
                $this->success('品牌添加成功', U('Brand/showlist'), 2);
            } else {
                $this->error('品牌添加失败', U('Brand/add'), 3);
            }
        } else {
            $this->display('brand_add');
        }
    }

    /**
     * 商品品牌编辑
     * @param string $brand_id 品牌ID
     * @return array 商品品牌信息一维数组
     */
    public function edit($brand_id){
        if(IS_POST && !empty($_POST)){
            // 接收POST信息
            $data['brand_name'] = $_POST['brand_name'];
            $data['site_url'] = $_POST['site_url'];
            $data['brand_desc'] = $_POST['brand_desc'];
            $data['sort_order'] = $_POST['sort_order'];
            $data['is_show'] = $_POST['is_show'];
            $data['brand_id'] = $_POST['brand_id'];

            // 判断品牌名称是否为空
            if (empty($data['brand_name']))
                $this->error('品牌名称不为空', U('Brand/add'), 2);

            // 判断是否上传品牌Logo
            if (! empty($_FILES['brand_logo']['tmp_name'])) {
                // 如果有上传，则上传Logo文件到指定目录，并获取信息
                $data['brand_logo'] = $this->upload();
            }

            // 整理数据，过滤数据信息
            $this->Brand->create($data);
            if ($this->Brand->save()) {
                $this->success('品牌更新成功', U('Brand/showlist'), 2);
            } else {
                $this->error('品牌更新失败', U('Brand/add'), 3);
            }

        }else{
        $info = $this->Brand->getOne($brand_id);
        $this->assign('info',$info);
        $this->display('brand_edit');
        }
    }
    /**
     * 删除商品品牌
     * @param string $brand_id 品牌ID
     * @return void
     */
    public function del($brand_id){
        //根据品牌ID查找品牌logo
        $brand_info = $this->Brand->where('brand_id ='.$brand_id)->find();
        //删除已上传的品牌Logo
        @unlink($_SERVER['DOCUMENT_ROOT']."/".$brand_info['brand_logo']);
        //删除品牌信息
            if($this->Brand->delete($brand_id)){
                $this->success('商品品牌删除成功',U('Brand/showlist'),2);
            }else{
                $this->error('商品品牌删除失败',U('Brand/showlist'),2);
            }

    }
    /**
     * 删除品牌Logo
     * @param string $brand_id 品牌ID
     */
    public function droplogo($brand_id){
    $data['brand_logo'] = '';
    //获取品牌信息
    $brand_info = $this->Brand->where('brand_id ='.$brand_id)->find();
    //删除已上传的品牌logo
    @unlink($_SERVER['DOCUMENT_ROOT']."/".$brand_info['brand_logo']);
    //删除数据库中的品牌Logo链接
    if($this->Brand->where('brand_id ='.$brand_id)->save($data)){
        $this->success('删除品牌logo成功');
    }
    }

    private function upload()
    {
        $upload = new Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->exts = array(
            'jpg',
            'gif',
            'png',
            'jpeg'
        );
        $upload->savePath = './data/uploads/'; // 设置上传目录
        $upload->rootPath = dirname(APP_PATH) . "/";
        $upload->saveName = array(
            'uniqid',
            ''
        );
        $upload->autoSub = true;
        $upload->subName = array(
            'date',
            'Ymd'
        );
        // 上传单个文件

        $info = $upload->uploadOne($_FILES['brand_logo']);
        if (! $info) {
            $this->error($upload->getError());
        } else {
            return $info['savepath'] . $info['savename'];
        }
    }
}