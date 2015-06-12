<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Library\Page;

class RoleController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->Role = D('Role');
        $this->Auth = D('Auth');
    }

    /**
     * 显示角色列表
     */
    public function showlist(){

        $curr_page = empty($_GET['page']) ? 1 :$_GET['page'];
        $pagesize = 6;
        $offset = ($curr_page -1)*$pagesize;
        $limit = array($offset,$pagesize);
        $total = $this->Role->getCount();

        $Page = new Page($total,$pagesize);
        $page = $Page->fpage();
        $list = $this->Role->getRoleList($limit);

        $this->assign('page',$page);
        $this->assign('list',$list);
        $this->display('role');
    }

    /**
     * 添加角色
     */
    public function add(){
        if(!empty($_POST)){
            $this->Role->create();
            if($this->Role->add()){
                $this->success('角色添加成功',U('Role/showlist'),2);
            }else{
                $this->error('角色添加失败');
            }
        }else{
        $this->display('role_add');
        }
    }

    /**
     * 编辑角色
     * @param string $role_id 角色ID
     */
    public function edit($role_id){
        if(!empty($_POST) && isset($_POST['role_name'])){
            $role_id = I('post.role_id',0,'intval');
            $this->Role->create();
            $info = $this->Role->where("role_id = $role_id")->save();
            if($info || $info ==0){
                $this->success('角色信息更新成功',U('Role/showlist'),2);
            }else{
                $this->error('角色信息更新失败');
            }
        }else{
        $role = $this->Role->getOne($role_id);
        $this->assign('role',$role);
        $this->display('role_edit');
        }
    }

    /**
     * 删除角色
     * @param string $role_id 角色ID
      */
    public function del($role_id){
        $role_id = I('post.role_id',0,'intval');
        if(!empty($role_id)){
            if($this->Role->delete($role_id)){
                $data['status'] = 1;
                $this->ajaxReturn($data);
            }
        }
    }

    /**
     * 分配权限
     */
    public function auth($role_id){
        //获取角色信息
        $info = $this->Role->getOne($role_id);
        //获取所有权限
        $auth0 = $this->Auth->where('auth_level =0')->select();
        $auth1 = $this->Auth->where('auth_level =1')->select();
        $auth2 = $this->Auth->where('auth_level >1')->select();
        $auth1_ids = array();
        foreach($auth1 as $v){
//             if($v)
        }

        $this->assign('auth0',$auth0);
        $this->assign('auth1',$auth1);
        $this->assign('auth2',$auth2);
        $this->assign('info',$info);
//         echo "<pre>";
//         print_r($auth1);
        $this->display('auth_role');
    }

    public function auth_save(){
        $role_auth_ac = I('post.action_code');
        $role_id = I('post.role_id');
        $role_ids = I('post.auth_ids');
//         print_r($role_ids);
        $data['role_auth_ac'] = implode(",",$role_auth_ac);
        $data['role_auth_ids'] = implode(",",$role_ids);
        $data = $this->Role->create($data);
        $save = $this->Role->where("role_id = $role_id")->save($data);

        if($save || $save ==0){
            $this->success('分配权限成功',U('Role/showlist'),2);
        }else{
            $this->error('分配权限失败');
        }

    }

}