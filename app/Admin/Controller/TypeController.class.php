<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Library\Page;

class TypeController extends AdminController {

    public function __construct(){
        parent::__construct();
            $this->Type = D('Type');

    }

    public function showlist(){

        $count = $this->Type->getcount();
        $Page = new Page($count,9);

        $sql =  "select t.* ,count(a.attr_id) as num ";
        $sql .= "from cz_goods_type as t left join cz_attribute as a ";
        $sql .= "on t.type_id = a.type_id group by a.type_id order by t.type_id asc ";
        $sql .= $Page->limit;
        $rs = $this->Type->query($sql);

        $bar = $Page->fpage();
        $this->assign('list',$rs);
        $this->assign('page',$bar);
        $this->display('goods_type_list');
    }

    /**
     * 添加商品类型
     */
    public function add(){
        if(!empty($_POST)){
            //检测商品类型名称是否为空
            if($_POST['type_name'] == ''){
                $this->error('商品类型名称不能为空',U('Type/add'),2);
            }

            //对POST提交的数据进行处理
            $this->Type->create();
            //添加状态返回指定页面
            if($this->Type->add()){
                $this->success('商品类型添加成功',U('Type/showlist'),2);
            }else{
                $this->error('商品类型添加失败',U('Type/add'),2);
            }
        }else{
        $this->display('goods_type_add');
        }
    }
    /**
     * 编辑商品类型信息
     * @param string $type_id 商品类型ID
     * @return void
     */
    public function edit($type_id){
        if(!empty($_POST)){
            if($_POST['type_name'] == ''){
                $this->error('商品类型名称不能为空',U('Type/edit',array('type_id'=>$_POST['type_id'])),2);
            }
            $this->Type->create();
            if($this->Type->save()){
                $this->success('商品类型更新成功',U('Type/showlist'),2);
            }else{
                $this->error('商品类型更新失败',U('Type/edit',array('type_id'=>$_POST['type_id'])),2);
            }
        }else{
            $info = $this->Type->getOne($type_id);
            $this->assign('info',$info);
            $this->display('goods_type_edit');
        }
    }

    public function del($type_id){
        $attr = D('Attribute');
        if($attr->getCountById($type_id) > 0){
            $this->error('该商品类型下存在多个商品属性,请先删除相关商品属性',U('Type/showlist'),2);
            exit;
        }
        if($this->Type->delete($type_id)){
            $this->success('删除商品类型成功',U('Type/showlist'),2);
        }else{
            $this->error('删除商品类型失败',U('Type/showlist'),2);
        }
    }

}