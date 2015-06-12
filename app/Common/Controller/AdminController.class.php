<?php
namespace Common\Controller;
use Think\Controller;

class AdminController extends Controller {

    public function __construct(){
        parent::__construct();
        $this->_checklogin();
        $this->access_check();
    }

    public function access_check(){
        //当前访问路径
        $nowpath = CONTROLLER_NAME.'-'.ACTION_NAME;

        //获取数据库用户组访问路径
        $admin_info = D('Admin')->find(session('admin_id'));
        $role_id = $admin_info['role_id'];

        //获取角色信息
        $role_info = D('Role')->find($role_id);
        $role_auth_ac = $role_info['role_auth_ac'];

        //允许访问路径
        $allow_path = "Index-index,Index-top,Index-menu,Index-drag,Index-main,Goods-getattrlist";
        $admin_name = session('admin_name');
        if(strpos($role_auth_ac,$nowpath) === false && strpos($allow_path, $nowpath) ===false && $admin_name !== 'admin' ){
            $this->error('无访问权限');
            //exit('无权限');
        }

    }

    public function _checklogin(){
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
        if(!isset($admin_id) && !isset($admin_name)){
            $this->error('请登录后再进行相关操作',U('Public/login'),1);
        }
    }
}