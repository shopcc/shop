<?php
namespace Common\Model;
use Think\Model;

class CommentModel extends Model {
	/**
	 *  获取指定商品ID的所有评论
	 * @param number $goods_id 商品ID
	 */
	public function getcomment($goods_id,$page=''){
		
		if(!empty($page)){
			$this->page($page,3);
		}else{
			$this->page('1','3');
		}
		
		if(!empty($goods_id)){
			$map['id_value'] = $goods_id;	
		}	
		$map['status'] =1;
			$info = $this->where($map)->order("comment_id asc")->select();
		return $info;
	}
    /**
     * 商品评论总数
     */
	public function getcount($goods_id=0,$where=''){
		if($goods_id >0){
			$map['c.id_value'] = $goods_id;
		}
		if(!empty($where)){
			$map['c.content'] = $where['c.content'];
		}
		$map['c.status'] =1;
	    return $this->table('cz_comment as c')->where($map)->count('*');
	}

	/* 根据用户ID获取评论数量*/
	public function get_user_count($user_id){
		$this->where("user_id = $user_id and status=1");
		return $this->count();
	}

	/**
	 * 后台关联查询，获取所有评论信息
	 * @param inter $page 当前页数
	 * @param inter $pagesize 每页显示评论数量
	 */
	public function getcomments($page,$pagesize,$where=''){
		$this->field('c.comment_id,c.comment_type,c.user_name,c.ip_address,c.add_time,c.status,g.goods_id,g.goods_name');
		$this->join('left join cz_goods as g on g.goods_id = c.id_value');
		if($page >0 && $pagesize > 0){
			$this->page($page,$pagesize);
		}
		if(!empty($where)){
			$this->where($where);
		}
		return $this->build_html($this->table('cz_comment as c')->select());
	}

	/* 拼凑 html代码*/
	public function build_html($arr){
		$html  = "<table cellspacing='1' cellpadding='3'>";
		$html .= "<th style='text-align:center'><input onclick='selectAll()' type='checkbox'/></th>";
		$html .= "<th style='text-align:center'>编号 </th>";
		$html .= "<th style='text-align:center'>用户名</th>";
		$html .= "<th style='text-align:center'>类型</th>";
		$html .= "<th style='text-align:center'>评论对象</th>";
		$html .= "<th style='text-align:center'>IP地址</th>";
		$html .= "<th style='text-align:center'>评论时间<img src='/app/Admin/View/images/sort_desc.gif'></th>";
		$html .= "<th style='text-align:center'>状态</th>";
		$html .= "<th style='text-align:center'>操作</th>";

		foreach($arr as $v){
			$html .="<tr>";
			$html .= "<td style='text-align: center;'><input value='".$v['comment_id']."' name='checkboxes[]' onclick='selectOne()' class='ck' type='checkbox'></td>";
			$html .= "<td style='text-align: center;'>".$v['comment_id']."</td>";
 			$html .= "<td style='text-align: center;'>".$v['user_name']."</td>";
 			if($v['comment_type'] == 0){
    			$html .= "<td style='text-align: center;'>商品</td>";
    		}
    		if($v['comment_type'] == 1){
    			$html .= "<td style='text-align: center;'>文章</td>";
    		}
    		$html .= "<td style='text-align: center;'><a href='../../index.php?m=home&c=goods&a=detail&id=".$v['goods_id']."' target='_blank'>".$v['goods_name']."</a></td>";
    		$html .= "<td style='text-align: center;'>".$v['ip_address']."</td>";
    		$html .= "<td style='text-align: center;'>".date("Y-m-d H:i:s",$v['add_time'])."</td>";
    		if($v['status'] == 1){
    			$html .= "<td style='text-align: center;'>显示</td>";
    		}else{
    			$html .= "<td style='text-align: center;'>隐藏</td>";
    		}
    		
    		$html .= "<td style='text-align: center;'>";
      		$html .= "<a href='".U('comment/replay',array('comment_id'=>$v['comment_id']))."'>查看详情</a>";
      		$html .= " | ";
      		$html .= "<a href='javascript:;' onclick='del(".$v['comment_id'].",this)'>移除</a></td></tr>";
    	}
    		$html .= "</table>";
    	return $html;
	}

	/**
	 * 获取指定评论ID的相关信息
	 * @param $comment_id inter 评论ID
	 * @return array 
	 */

	public function get_comment_info($comment_id){
				$this->field('c.*,g.goods_name');
				$this->table('cz_comment as c');
				$this->join('left join cz_goods as g on g.goods_id = c.id_value');
		return $this->where("comment_id=$comment_id")->find();
	}
}