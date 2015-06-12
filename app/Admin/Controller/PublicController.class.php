<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class PublicController extends Controller {
    //验证码配置
    protected  $config = array(
        'fontSize'    =>  18,    // 验证码字体大小
        'imageH'      =>  "45",    //验证码图片高度
        'length'      =>  4,     // 验证码位数
        'useNoise'   =>  false, // 关闭验证码杂点);
        'useImgBg'   =>  true,    //开启随机图片
        'fontttf'    =>  'arial.ttf',
    );

    //构造函数
    public function __construct(){
        parent::__construct();

        $this->Verify =     new Verify($this->config);
    }

    //登陆
    public function index(){
        $this->login();
    }

    //登陆
    public function login(){

        $this->display('login');
    }

    //退出
    public function logout(){
        session('admin_info',null);
        $this->redirect('Public/login');
    }

    //生成验证码
    public function Captcha(){


             $this->Verify->entry();
    }

    //登陆检测
    public function checklogin(){
        //实例化 Admin模型
        $login = D('Admin');

        //接收POST表单提交的数据，并过滤
        $username = I('post.username','','strip_tags');
        $password = md5(I('post.password','','strip_tags'));

        if($username == '' || $password== ''){
            $this->error('用户名或密码为空,请重新输入!',U('Public/login'),2);
        }

        if(!$this->Verify->check(I('post.captcha'))){
               $this->error('验证码有误',U('Public/login'),3);
        }
        //查询数据库是否含有该用户
//         $admin = $login->where($data)->find()
        if($admin = $login->checkuser($username,$password)){
            session('admin_name',$admin['username']);
            session('admin_id',$admin['admin_id']);

            $this->success('登陆成功',U('Index/index'),2);
        }else{
            $this->error('登陆失败,请重新输入!',U('Public/login'));
        }
    }
}