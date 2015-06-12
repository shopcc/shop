<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Home\Library\Page;
/**
 * 用户评论管理
 */
class CommentController extends AdminController {
	
	public function __construct(){
		parent::__construct();
		$this->comment = D('Comment');
	}

	public function comment_list(){
		if((!empty($_REQUEST) && !empty($_REQUEST['page'])) || !empty($_REQUEST['content'])){
			//接收当前页面ID
			$page = I('request.page');
			$pagesize = 5;
			$keyword = I('request.content');
			if(!empty($keyword)){
				$map['c.content']=array('like',"%$keyword%");
			}else{
				$map ='';
			}
			
			//获取评论总数
			$count = $this->comment->getcount(0,$map);
			//实例化分页类
			$Page = new Page($count,$pagesize);
			$pagebar = $Page->fpage();

			//获取评论列表
			$comments = $this->comment->getcomments($page,$pagesize,$map);
			$comments .= "<table cellspacing='0' cellpadding='4'>";
			$comments .= "<tr><td><div><select id='select_act' name='sel_action'>";
			$comments .= "<option value='remove'>删除评论</option>";
			$comments .= "<option value='allow'>允许显示</option>";
			$comments .= "<option value='deny'>禁止显示</option></select>";
			$comments .= "<input name='act' value='batch' type='hidden'>";
			$comments .= "<input name='drop' id='btnSubmit' value=' 确定 ' onclick='sub()' class='button' disabled='true' type='submit'></div></td>";
			$comments .= "<td align='right'>";
			$comments .= "<div id='turn-page'>";
			$comments .= $pagebar;
			$comments .= "</div></td></tr></table>";
			$this->ajaxReturn($comments);

		}else{

			$this->display();	
		}
		
	}
	/* jQuery 无刷新删除评论*/
	public function del(){
		if(!empty($_POST['comment_id'])){
			$comment_id = I('post.comment_id');
			if($this->comment->delete($comment_id)){
				$this->success('删除成功');
			}
		}
	}

	public function batch(){
		if(!empty($_POST)){
			$act = I('post.act');
			$id  = I('post.comment_id');
			switch ($act) {
				case 'remove':
					# 删除
					$this->comment->delete($id);
					$this->success('ok');
					break;
				case 'allow':
					# 显示
					$map['comment_id'] = array('in',$id);
					$data['status'] =1;
					$this->comment->where($map)->save($data);
					$this->success('ok');
					break;
				case 'deny':
					#隐藏
					$map['comment_id'] = array('in',$id);
					$data['status'] =0;
					$this->comment->where($map)->save($data);
					$this->success('ok');
					break;
				default:
					# code...
					$this->error('deny');
					break;
			}
		}
	}

	/**
	 * 评论回复
	 *
	 */
	public function replay($comment_id){
		if(!empty($_POST)){
			$this->comment->create();
			if($this->comment->save()){
				$this->success('管理员回复成功',U('comment/comment_list'),1);
			}else{
				$this->error('回复失败');
			}
		}else{
			$info = $this->comment->get_comment_info($comment_id);

			$this->assign('info',$info);
			$this->display();
		}
		
	}
}