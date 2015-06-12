<?php
namespace Home\Controller;
use Think\Controller;

class SearchController extends Controller {

	public function _empty(){
		$this->_showlist();
	}

	public function _showlist(){
		
		if(!empty($_POST) && !empty($_POST['keywords'])){
			//接收POST
			$keyword = I('post.keywords');

			$search = M('Goods');
			$map['goods_name'] =array('like',"%$keyword%");
			$arr = $search->where($map)->select();
			$count = $search->where($map)->count();
			$total = ceil($count/12);
			if($total <= 1){
				$vpage = '1';
			}else{
				$vpage ='2';
			}
		$this->assign('list',$arr);
		$this->assign('keyword',$keyword);
		$this->assign('cate',getclass($cid));
		$this->assign('total',$total);
		$this->assign('vpage',$vpage);
		$this->assign('goods_history',history_log());
		$this->display('search');
		}
	}

	public function results(){
		if(!empty($_POST) && !empty($_POST['page'])){
			//接收POST
			$keyword = I('post.keyword');
			$page = I('post.page');

			$search = M('Goods');
			$map['goods_name'] =array('like',"%$keyword%");
 			if(!empty($page)){
 				$search->page($page,12);
 			}
 			
			$arr = $search->where($map)->select();
				
				$html = ''; 
			foreach($arr as $v){
				$html .= "<div class='goodsItem'>";

				$html .= "<a href='".U('goods/detail',array('id'=>$v['goods_id']))."'>";
				$html .= "<img class='goodsimg' alt='".$v['goods_name']."' src='".$v['goods_thumb']."'></a><br>";
				$html .= "<p><a title='' href='".U('goods/detail',array('id'=>$v['goods_id']))."'>".$v['goods_name']."</a></p>";
				$html .= "本店价：<font class='shop_s'>￥".$v['shop_price']."元</font><br>";
    			$html .= "</div>";
			}
			$this->ajaxReturn($html);
		}
		
	}
}