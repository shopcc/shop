<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Library\Page;


/**
 * 商品属性控制器
 */
class AttributeController extends AdminController {

    public function  __construct(){
        parent::__construct();
        $this->Attr = D('Attribute');
        $this->Type = D('Type');
    }
    /**
     * 显示商品属性列表
     * @param string $goods_type 商品类型ID
     */
    public function showlist($goods_type){
        //获取当前页面页数
        $curr_page = empty($_GET['page']) ? 1 : $_GET['page'];
        //每页显示数据量
        $pagesize = 6;
        //获取商品属性总记录
        $total = $this->Attr->getCountById($goods_type);
        //实例化分页类
        $Page = new Page($total,$pagesize);

        //构建limit
        $offset = ($curr_page -1)*$pagesize;
        $limit = array($offset,$pagesize);
        $list = $this->Attr->getListById($goods_type,$limit);

        //获取所有商品类型信息
        $type = $this->Type->getList();
        //模板赋值
        $this->assign('page',$Page->fpage());
        $this->assign('list',$list);
        $this->assign('goods_type',$goods_type);
        $this->assign('type',$type);
        $this->display('attribute_list');
    }

    public function add($goods_type){

        if(!empty($_POST)){
            if($_POST['attr_name']==''){
                $this->error('属性名称不能为空',U('Attribute/add',array('goods_type'=>$goods_type)),1);
            }
            $this->Attr->create();
            if($this->Attr->add()){
                $this->success('商品属性添加成功',U('Attribute/showlist',array('goods_type'=>$goods_type)),2);
            }else{
                $this->succes('商品属性添加失败',U('Attribute/add',array('goods_type'=>$goods_type)),2);
            }

        }else{
        //获取所有商品类型信息
        $type = $this->Type->getList();

        //模板赋值
        $this->assign('type',$type);
        $this->assign('goods_type',$goods_type);
        $this->display('attribute_add');
        }
    }
    /**
     * 删除商品属性
     * @param string $attr_id 商品属性ID
     */
    public function del($attr_id){
        if($this->Attr->delete($attr_id)){
            $this->success('商品属性删除成功',U('Attribute/showlist',array('goods_type'=>$_GET['goods_type'])));
        }else {
            $this->error('商品属性删除失败',U('Attribute/showlist',array('goods_type'=>$_GET['goods_type'])));
        }
    }
    /**
     * 编辑商品属性值
     * @param string $attr_id 商品属性ID
     */
    public function edit($attr_id){
        if(!empty($_POST)){
            $this->Attr->create();
            if($this->Attr->save()){
                $this->success('商品属性修改成功',U('Attribute/showlist',array('goods_type'=>$_REQUEST['goods_type'])),2);
            }else{
                $this->error('商品属性未修改',U('Attribute/showlist',array('goods_type'=>$_REQUEST['goods_type'])),2);
            }
        }else{
        //获取所有商品类型信息
        $type = $this->Type->getList();

        //获取商品属性信息
        $info = $this->Attr->getOne($attr_id);
        //模板赋值
        $this->assign('type',$type);
        $this->assign('attr_info',$info);
        $this->assign('goods_type',$_GET['goods_type']);
        $this->display('attribute_edit');
        }
    }

    /**
     * 批量删除商品属性
     */
    public function batch(){
        $ids = implode(",", $_POST['checkboxes']);

        if($this->Attr->delete($ids)){
            $this->success('商品属性删除成功',U('Type/showlist'),2);
        }else{
            $this->error('删除商品属性失败');
        }
    }

    


}