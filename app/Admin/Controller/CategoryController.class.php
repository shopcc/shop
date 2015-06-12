<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
/**
 * 商品分类控制器
 */
class CategoryController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->Category = D('Category');
        $this->Type     = D('Type');
        $this->Attr     = D('Attribute');
    }
    //获取商品所有分类列表
    public function allList(){
        //商品列表信息
        $info = $this->Category->getList();

        //给模板赋值
        $this->assign('list',$info);
        $this->display('cat_list');
    }

    /**
     * 添加分类
     * @access public
     */
    public function add(){
        if(IS_POST && !empty($_POST)){
            if(I('post.cat_name') == ''){
                $this->error('请填写分类名称',U('Category/add'),2);
            }
            $this->Category->create();
            $this->Category->filter_attr = implode(",",I('post.filter_attr'));

            if($this->Category->add()){
                $this->success('添加分类成功',U('Category/alllist'),2);
            }else{
                $this->error('添加分类失败',U('Category/add'),2);
            }

        }else{
            //获取所有商品分类
            $info = $this->Category->getList();
            //获取商品类型列表
            $type = $this->Type->getList();
            //获取商品筛选属性
            $types = $this->Attr->get_goods_attr();

            $this->assign('type',$type);
            $this->assign('list',$info);
            $this->assign('types',$types);
            $this->display('cat_add');
        }
    }

    /**
     * 编辑分类
     * @access public
     * @param string $cat_id 商品分类ID
     */
    public function edit($cat_id){
        if(IS_POST){
            $parent_id = I('post.parent_id');
            $cat_name = I('post.cat_name');
            $cat_id = I('post.cat_id');
            $ids = $this->Category->goodsSubClassTree($cat_id);

            if($cat_name == ''){
                $this->error('分类名称不能为空,请重新填写',U('Category/edit',array('cat_id'=>$cat_id)),3);
            }
            if(in_array($parent_id, $ids)){
                $this->error('上级分类不能设置成自身或者下级分类,请重新设置',U('Category/edit',array('cat_id'=>$cat_id)),3);
            }
            $this->Category->create();
            $this->Category->filter_attr = implode(",",I('post.filter_attr'));
            if($this->Category->save()>=0){
                $this->success('分类信息更新成功',U('Category/alllist'),2);
            }else{
                $this->error('分类信息更新失败',U('Category/edit',array('cat_id'=>$cat_id)),2);
            }
        }else{
        //GET方式获取分类ID
            $condition['cat_id'] = $cat_id;
            //根据分类ID查询分类详细信息
            $info = $this->Category->where($condition)->find();

            //获取分类绑定的属性ID的相关信息
            $type_attr = $this->Attr->get_attr_id($info['filter_attr']);

            //所有分类信息列表
            $list = $this->Category->getList();

             //获取商品类型列表
            $type = $this->Type->getList();
            //获取商品筛选属性
            $types = $this->Attr->get_goods_attr();

            $this->assign('info',$info);
            $this->assign('type',$type);
            $this->assign('list',$list);
            $this->assign('types',$types);
            $this->assign('type_attr',$type_attr);
            $this->display('cat_edit');
        }

    }
    /**
     * 转义商品分类
     * @param string $cat_id 分类ID
     */
    public function move($cat_id){

        if(IS_POST && I('post.act') == 'move_cat'){
            //接收POST表单传递过来的当前分类ID和转移数据后的分类ID
            $condition['cat_id'] = I('post.cat_id','','intval');
            $cat_id = I('post.target_cat_id','','intval');

            //实例化商品模型
            $goods = M('Goods');

            //更新指定商品所属分类
            $info = $goods->where($condition)->setField('cat_id',$cat_id);

            //获取更新商品后的分类中商品的数量
            $goodscount = $goods->where("cat_id = $cat_id")->count('goods_id');

            //满足条件则跳转，不满足条件则返回
            if($goodscount > '0' || $info){
                $this->success('商品数据转移成功',U('Category/alllist'),3);
            }else{
                $this->error('商品数据转移失败',U('Category/move',array('cat_id'=>I('post.cat_id'))),3);
            }
        }else{
            //所有分类信息列表
            $list = $this->Category->getList();

            $this->assign('cat_id',$cat_id);
            $this->assign('list',$list);
            $this->display('cat_move');
        }
    }

    public function del($cat_id){
        $goods = M('Goods');//实例化商品模型
        //检测是否存在子分类
        $ids = $this->Category->goodsSubClassTree($cat_id);
        //获取当前分类下的商品数量
        $count = '';
        foreach($ids as $v){
            $count += $goods->where("cat_id = $v")->count('goods_id');
        }
        if(count($ids) > 1 || $count >=1 ){
            $this->error('该分类存在子分类或商品,请删除子分类及相关商品后再删除该分类!',U('Category/alllist'),2);
            exit;
        }
        if($this->Category->where("cat_id = $cat_id")->delete()){
            $this->success('商品分类删除成功',U('Category/alllist'),2);
        }else{
            $this->error('商品分类删除失败',U('Category/alllist'),2);
        }
    }
}