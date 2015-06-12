<?php
namespace Admin\Controller;
use Common\Controller\AdminController;

class IndexController extends AdminController {
    public function index(){
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }

    public function top(){
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }

    public function menu(){
        C('SHOW_PAGE_TRACE',true);
        //获取管理信息
        $admin_info = D('Admin')->find(session('admin_id'));
        $role_id = $admin_info['role_id'];
        //获取管理角色信息
        $role_info = D('Role')->find($role_id);
        $auth_ids = $role_info['role_auth_ids'];

        $auth = D('Auth');
        //
        if(session('admin_name') === 'admin'){
            $auth0 = $auth->where('auth_level=0')->select();
            $auth1 = $auth->where('auth_level=1')->select();
        }else{
            $auth0 = $auth->where("auth_level=0 and auth_id in ($auth_ids)")->select();
            $auth1 = $auth->where("auth_level=1 and auth_id in ($auth_ids)")->select();
        }

        $this->assign('auth0',$auth0);
        $this->assign('auth1',$auth1);
        $this->display();
    }

    public function main(){
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }

}