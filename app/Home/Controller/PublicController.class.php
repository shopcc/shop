<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class PublicController extends Controller {

	//验证码配置
    protected  $config = array(
        'fontSize'    =>  12,    // 验证码字体大小
        'imageH'      =>  22,    //验证码图片高度
        'imageW'      =>  121,    //验证码图片高度
        'length'      =>  4,     // 验证码位数
        'useNoise'   =>  false, // 关闭验证码杂点);
        'useImgBg'   =>  true,    //开启随机图片
        'fontttf'    =>  'ariblk.ttf',
    );

	public function __construct(){
		parent::__construct();
		$this->Verify =     new Verify($this->config);
	}
	 //生成验证码
    public function Captcha(){
             $this->Verify->entry();
    }

}