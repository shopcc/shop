<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Library\Page;

class UserController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->User = D('User');
    }
    //显示用户列表
    public function showlist(){

        $curr_page = empty($_GET['page']) ? 1 : $_GET['page'];
        $pagesize = 8;
        $offset = ($curr_page -1)*$pagesize;

        $condition[limit] = array($offset,$pagesize);
        if($_GET['keyword'] !=''){
    	 	$condition['user_name'] = $_GET['keyword'];
        }

        //获取所有用户
        $user = $this->User->getUserList($condition);
        //获取用户总记录
        unset($condition['limit']);
        $total = $this->User->getCount($condition);

        $Page = new Page($total,$pagesize);
        $Bar = $Page->fpage();

        $this->assign('bar',$Bar);
        $this->assign('user',$user);
        $this->display('userlist');
    }

    //添加用户
    public function add(){
        if(!empty($_POST) && isset($_POST['act'])){
            $this->User->create();
            if($this->User->add()){
                $this->success('添加用户成功',U('User/showlist'),2);
            }else{
                $this->error('添加用户失败');
            }
        }else{
        $this->display('user_add');
        }
    }

    //编辑用户
    public function edit($user_id){
        if(!empty($_POST) && isset($_POST['act'])){
            $user_id = I('post.user_id');
            $data['user_name'] = I('post.user_name');
            $data['email'] = I('post.email');
			$data['last_ip'] = I('post.last_ip');
			$data['last_time'] = I('post.last_time');
            if(!empty($_POST['new_password'])){
                $data['password'] = I('post.new_password');
            }
			 
            $save = $this->User->where("user_id = $user_id")->save($data);
            if($save || $save ==0){
                $this->success('更新用户信息成功',U('User/showlist'),2);
            }else{
                $this->error('更新用户信息失败');
            }


        }else{
        //获得会员信息
        $info = $this->User->getOne($user_id);
        $this->assign('info',$info);
        $this->display('user_edit');
        }
    }

    //批量删除用户
    public function del_all(){
        if(!empty($_POST)){
        $userid = I('post.checkboxes');
        if(is_array($userid)){
            $userid = implode(',',$userid);
        }
        if($this->User->delete($userid))
           $this->success('删除用户成功',U('User/showlist'),2);
        }else{
            $this->error('删除用户失败');
        }

    }
    //删除用户
    public function del(){
        if(!empty($_POST)){
            $userid = I('post.user_id');
            if($this->User->delete($userid)){
                $data['status'] = 1;
                $this->ajaxReturn($data);
            }
        }
    }

    //收货地址列表
    public function address_list(){

    }
}