<?php
namespace Admin\Controller;
use Common\Controller\AdminController;

class AuthController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->Auth = D('Auth');
    }
    /**
     *  显示所有权限
     */
    public function showlist(){
        $auth = $this->Auth->getAuthList();

        $this->assign('auth',$auth);
        $this->display('auth_list');
    }
    /**
     * 添加权限
     */
    public function add(){
        if(!empty($_POST)){
        $this->Auth->create();
        if($this->Auth->add()){
            $this->success('权限添加成功',U('Auth/showlist'),2);
        }else{
            $this->error('权限添加失败');
        }
        }else{
        //获取所有权限
        $auth = $this->Auth->getAuthList();

        $this->assign('auth',$auth);
        $this->display('auth_add');
        }
    }

    public function edit($authid){
        if(!empty($_POST) && isset($_POST['auth_id'])){
            $auth_id = I('post.auth_id');
            $this->Auth->create();
            $info = $this->Auth->where("auth_id = $auth_id")->save();
            if($info || $info ==0){
                $this->success('权限信息更新成功',U('Auth/showlist'),2);
            }else{
                $this->error('权限更新失败');
            }
        }else{
        //获取所有权限
        $auth = $this->Auth->getAuthList();
        //获取单个权限信息
        $info = $this->Auth->getOne($authid);

        $this->assign('info',$info);
        $this->assign('auth',$auth);
        $this->display('auth_edit');
        }
    }

    public function del(){
        if(!empty($_POST) && !empty($_POST['auth_id'])){
            $auth_id = I('post.auth_id',0,'intval');
            if($this->Auth->delete($auth_id)){
                $data['status'] =1;
                $this->ajaxReturn($data);
            }
        }
    }
}