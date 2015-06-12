<?php
namespace Home\Controller;
use Common\Controller\HomeController;

/**
 * 用户控制器
 */
class MemberController extends HomeController {

    /**
     * 构造函数
     */
    public function __construct(){
        parent::__construct();
        $this->User = D("User");
        //加载生日配置
        $this->birthday = load_config(dirname(APP_PATH).'/data/config/birthday.php');
        //加载问答配置
        $this->question = load_config(dirname(APP_PATH).'/data/config/question.php');
    }
    /**
     * 会员中心
     */
    public function index(){
        $this->display('member_center');
    }

    /**
     * 根据用户ID获取用户信息
     */
    public function profile(){
        //获取用户ID
        $user_id = session('user_id');
        //获取该ID的全部用户信息
        $info = $this->User->getInfoById($user_id);
        //重新定义生日格式
        $info['birthday'] = explode("-",$info['birthday']);
        
        $this->assign('info',$info);
        $this->assign('birthday',$this->birthday);
        $this->assign('question',$this->question);
        $this->display('member_info');
    }

    /**
     *  保存用户编辑信息
     */
    public function saveinfo(){

        if(!empty($_POST) && $_POST['act']=='act_edit_profile'){
            //接收post方式传递的信息
            $data['birthday'] = I('post.birthdayYear').'-'.I('post.birthdayMonth').'-'.I('post.birthdayDay');
            $data['sex']      = I('post.sex');
            $data['email']    = I('post.email');
            $data['msn']      = I('post.msn');
            $data['qq']       = I('post.qq');
            $data['mobile_phone'] = I('post.mobile_phone');
            $data['passwd_question'] = I('post.passwd_question');
            $data['passwd_answer']   = I('post.passwd_answer');

            //当更新状态时，处理数据，过滤非法字符
            $data = $this->User->create($data,2);

            $user_id = session('user_id');
            
            $status = $this->User->where("user_id=$user_id")->save($data);
            if($status || $status ==0){
                $this->success('保存成功',U('member/profile'),1);
            }else{
                $this->error('保存失败');
            }    
         
        }

    } 

    public function edit_password(){
        if(!empty($_POST) && $_POST['act'] == 'act_edit_password'){
          $user_id = session('user_id');
          $pass = md5(I('post.old_password'));
          $data['password'] = md5(I('post.new_password'));
          $info = $this->User->find($user_id);

          if($pass != $info['password']){
                $this->error('请输入正确的原始密码');
          }
          $data = $this->User->create($data,2);
          $status = $this->User->where("user_id=$user_id")->save($data);
          if($status || $status ==0){
                $this->success('密码已修改',U('member/profile'),1);
            }else{
                $this->error('修改失败');
            }    
        }
    }
    /**
     * 登陆页面
     */
    public function login(){

        $this->display('Public/login');
    }

    public function logincheck(){
        if(!empty($_POST)){
            $user_name = I('post.username');
            $password = md5(I('post.password'));
            if($user_id = $this->User->checkuser($user_name,$password)){
                session('user_id',$user_id);
                session('user_name',$user_name);
                $this->success('登陆成功',U('member/index'),2);         
            }else{
                $this->error('用户名或密码错误');
            }
        }
    }

    /**
     * 会员注册
     */
    public function reg(){
        if(!empty($_POST) && ($_POST['act'] == 'act_register')){
            $user_name = I('post.user_name');
            $this->User->create();
            if($user_id= $this->User->add()){
                $this->success('注册成功',U('member/index'),2);
                session('user_id',$user_id);
                session('user_name',$user_name);
            }else{
                $this->error('注册失败');
            }
        }else{
        $this->display('Public/reg');

        }
    }

    /**
     * 退出登陆
     */

    public function logout(){
        session('user_id',null);
        session('user_name',null);
        $this->success('退出成功',U('member/login'),2);
    }
    /**
     * 检测用户米是否已被注册
     */
    public function is_registered(){
        if(isset($_POST['username']) && !empty($_POST['username'])){
            if($this->User->check_reg($_POST['username'])){
                $data['info'] = '用户名已经存在,请重新输入';
                $data['status'] = 1;
            }else{
                $data['info'] = '可以注册';
                $data['status'] =0;
            }

            $this->ajaxReturn($data);
        }else{
            return false;
        }
    }
    /**
     * 检测邮箱是否已被使用
     * @return boolean
     */
    public function check_email(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = I('post.email');
            if($info = $this->User->check_email($email)){
                $data['status'] = 1;
                $data['info'] = "邮箱".$info['email']."已使用";
            }else{
                $data['status'] = 0;
                $data['info'] = "可以注册";
            }
            $this->ajaxReturn($data);
        }else{
            return false;
        }
    }

    /**
     * 收货地址列表
     */
    public function address_list(){
        $this->display('address_list');
    }
}