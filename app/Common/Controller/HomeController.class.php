<?php
namespace Common\Controller;
use Think\Controller;

class HomeController extends Controller {

    public function __construct(){
        parent::__construct();
        $this->layout();
        $this->checklogin();
    }
    /**
     * 布局
     */
    public function layout(){
        $layout = D('Category');
        $category = $layout->HomeCategory();
        $this->assign('cate',$category);
    }
    /**
     * 检测登陆状态
     */
    public function checklogin(){
        $user_id = session('user_id');
        $user_name = session('user_name');
        $now = CONTROLLER_NAME.'-'.ACTION_NAME;
        $allow_list = 'Index-index,Member-login,Member-reg,Member-is_registered,Member-check_email,Member-logincheck,Goods-detail,Goods-clear_history,Comment-getcomment,Comment-add_comment';
        if(!isset($user_id) && !isset($user_name) && empty($user_id) && empty($user_name) && strpos($allow_list, $now) ===false){
            $this->error('请登录后再操作',U('member/login'),2);
        }
    }

}