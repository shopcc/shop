<?php
namespace Home\Controller;
use Common\Controller\HomeController;
use Home\Library\Page;
class CommentController extends HomeController {
	
	public function __construct(){
		parent::__construct();
		$this->Comment = D('Comment');
	}
	/**
	 * 添加评论
	 */
	public function add_comment(){
		if(!empty($_POST)){
			//验证码验证
			$code = new \Think\Verify();
			if(!$code->check(I('post.captcha'))){
				$this->error('验证码错误');
				exit;
			}
			//收集post信息
			$user_name = session('user_name');
			if(!isset($user_name) || empty($user_name)){
				$data['user_name'] = "匿名用户";
			}else{
				$data['user_name'] = $user_name;
			}
		    $data['email'] = I('post.email');
		    $data['content'] = I('post.content');
		    $data['type'] = I('post.type');
		    $data['id_value'] = I('post.goods_id');
		    $data['comment_rank'] = I('post.conment_rank');
		    $data['ip_address'] = I('post.ip_address'); 
		    $data['add_time'] = I('post.add_time');
		    $data['user_id'] = I('post.user_id');
		    $data['status'] = 0;
		    //处理post信息
		    $data = $this->Comment->create($data);
		    if($this->Comment->add($data)){
		    	$this->success('评论成功,等待审核');
		    }else{
		    	$this->error('评论失败');
		    }
		}
	}
	/* 商品详情评论列表 */
	public function getcomment(){
		$page = I('post.page');
		$goods_id = I('post.goods_id');

		 $data['content'] = $this->_build_html($page,$goods_id);
		
		$this->ajaxReturn($data);
		
	}
	/* 构建评论列表html代码 */
	public function _build_html($page,$goods_id){
		$comment = D('Comment')->getcomment($goods_id,$page);
			$html = '';
		foreach($comment as $v){
			$html  = "<li class='word'>";
			$html .= "<font class='f2'>".$v['user_name']."</font>";
			$html .= "<font class='f3'>(".date("Y-m-d H:i:s",$v['add_time'])." )</font><br>";
            $html .= " <img src='/data/resource/images/stars".$v['comment_rank'].".gif' alt=''>";
           	$html .= " <p>".$v['content']."</p>";
           	if($v['replay'] !=''){
           		$html .= "<p><font class='f1'>客服".$v['repay_name']."回复：</font>".$v['replay']."</p>";
           	}
           	$html .= "</li>";
   			$htmls[] =$html;
		}
			
		return $htmls;
	}

	/* 获取个人评论列表*/
	public function get_user_comment(){
		
		if(!empty($_REQUEST) && !empty($_REQUEST['page'])){
			$user_id = session('user_id');
			$comment = D('Comment');
			$page = isset($_REQUEST['page']) ? I('request.page') : 1;
			$pagesize = 5;

			//评论总数
			$count = $comment->get_user_count($user_id);

			$Page = new Page($count,$pagesize);

			$pagebar = $Page->fpage();
			$comment->field("c.comment_id,c.content,c.add_time,g.goods_name,g.goods_id");
			$info = $comment->table('cz_comment as c')->join('left join cz_goods as g on g.goods_id=c.id_value')->where("c.user_id=$user_id")->page($page,$pagesize)->select();


			$html = '<h5><span>我的评论</span></h5>';
			$html .= "<div class='blank'></div>";
			foreach($info as $v){
				$html .= "<div class='f_l'>";
				$html .= " <b>商品评论: </b><font class='f4'><a href='".U('goods/detail',array('id'=>$v['goods_id']))."'>".$v['goods_name']."</a></font>&nbsp;&nbsp;(2015-04-23 16:15:30)";
				$html .= "</div>";
	          	$html .= "<div class='f_r'>";
	          	$html .= "<a class='f6' onclick='del(".$v['comment_id'].")'>删除</a>";
	          	$html .= "</div>";
	          	$html .= "<div class='msgBottomBorder'>";
	          	$html .=$v['content']."<br></div>";
	
			}
				// $html .= "<div id='pager' class='pagebar'>";
				$html .= "<table style='height:30px;width:500px;float:left'><tr><td>";
				$html .= $pagebar."</td></tr></table>";
				$html .= "<div class='blank5'></div>";

			$this->ajaxReturn($html);
	}else{
		//评论列表

		
		$this->display('my_comment');
	}
}

public function del(){
	if(!empty($_POST)){
		$comment_id = I('post.comment_id');
		$comment = D('Comment');
		if($comment->delete($comment_id)){
			$this->success('删除成功');
		}
	}
}


}