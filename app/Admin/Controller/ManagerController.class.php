<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
/**
 * 管理员控制器
 * @author 霏凡
 *
 */
class ManagerController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->Admin = D('Admin');
        $this->Role = D('Role');
    }
    //显示管理员列表
    public function showlist(){

        //所有管理信息列表
        $list = $this->Admin->getAdminList();

        $this->assign('list',$list);
        $this->display('manager');
    }
    /**
     * 添加管理员
     */
    public function add(){

        if(IS_POST && !empty($_POST)){
            $this->Admin->create();
            if($this->Admin->add()){
                $this->success('管理员添加成功',U('Manager/showlist'),2);
            }else{
                $this->error('管理员添加失败');
            }
        }else{
        /*返回角色列表*/
        $role = $this->Role->getRoleList();

        $this->assign('role',$role);
        $this->display('manager_add');
        }
    }

    /**
     * 编辑管理员信息
     * @param string $admin_id 管理员ID
     */
    public function edit($admin_id){
        if(!empty($_POST)){
            //收集POST信息
            $data['username'] = I('post.username');
            $data['email']    = I('post.email');
            $data['role_id']  = I('post.role_id');
            $condition['admin_id'] = I('post.id');
            $old_password  = $_POST['old_password'];
            //判断原密码是否为空
        if(!empty($old_password)){
            $data['password'] = md5(I('post.new_password'));
        }
            //批量处理数据


            $info = $this->Admin->where($condition)->save($data);
        if($info || $info =='0'){
            $this->success('管理员信息更新成功',U('Manager/showlist'),2);
        }else{
            $this->error('管理员信息更新失败');
        }
        }else{
        //获取管理员信息
            $info = $this->Admin->getOne($admin_id);
        //获取管理员角色信息
            $role = $this->Role->getRoleList();

            $this->assign('role',$role);
            $this->assign('info',$info);
            $this->display('manager_edit');
        }
    }

    /**
     * 检查原密码是否输入正确
     */
    public function checkpass(){
        if(!empty($_POST['password'])){
        $condition['password'] = md5(I('post.password'));
        $condition['admin_id'] = I('post.admin_id');
        $pass = $this->Admin->where($condition)->find();
        if($pass){
            $data['status'] =1;

        }else{
            $data['status'] =2;

        }
        }else{
            $data['status'] =3;

        }
        $this->ajaxReturn($data);
    }

    /**
     * 删除管理员
     * @param string $admin_id
     */
    public function del(){
        if(isset($_POST['admin_id']) && !empty($_POST['admin_id'])){
            if($this->Admin->delete($_POST['admin_id'])){
                $data['status'] =1;

            }else{
                $data['status'] =0;

            }
            $this->ajaxReturn($data);
        }

    }




}