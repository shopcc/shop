<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 商品控制器
 * 显示商品列表,商品详情
 */
class GoodsController extends Controller {

    public function __construct(){
        parent::__construct();
        $this->Goods = D('Goods');
        $this->Gallery = D('Gallery');
        $this->Cate = D('Category');
    }
    public function detail($id=0){
        //统计点击次数
        $ip = cookie($id);
        if(!isset($ip) && $ip != get_client_ip()){
             cookie($id,get_client_ip());
            // $info = $this->Goods->where("goods_id=$id")->field('click_count')->find();
            // $click_count = $info['click_count'] +1;
            $this->Goods->where("goods_id=$id")->setInc('click_count');
           
        }
    
        //获取指定商品ID的所有基础信息
        $goods = $this->Goods->getDetailOne($id);
        
        //获取指定商品ID的属性信息
        $properties = $this->Goods->get_goods_properties($id);  // 获得商品的规格和属性
        //获取指定商品ID的相册信息
        $gallery = $this->Gallery->getGalleryById($id);

        //商品重量单位确定
        if($goods['goods_weight'] < 1){
            $goods['goods_weight'] = $goods['goods_weight'] * 1000;
            $goods['weight_num']  = 1;
        }elseif($goods['goods_weight'] >= 1){
            $goods['goods_weight'] = $goods['goods_weight'];
            $goods['weight_num'] = 2;
        }

        /* 获取当前商品分类的同级分类列表*/
        $cate = $this->Cate->get_categories_tree($goods['cat_id']);

        //记录浏览记录
        $this->_setlog($id);
        //获取评论列表
         $comment = D('Comment');

         $comments = $comment->getcomment($id);

        //获取评论总数
        $count_comment = $comment->getcount($id);

        $totlapage = ceil($count_comment /6);
        if(empty($totlapage) && $totlapage ==0) $totlapage =1;
        if($totlapage == 1){$visiblePage = 1;}else{$visiblePage=2;}
        
        $this->assign('goods',$goods);
        $this->assign('properties',$properties['pro']);// 商品属性
        $this->assign('specification',$properties['spe']);// 商品规格
        $this->assign('gallery',$gallery);
        $this->assign('count_comment',$count_comment);
        $this->assign('totlapage',$totlapage);
        $this->assign('visiblePage',$visiblePage);
        $this->assign('cate',$cate);
         $this->assign('comment',$comments);
        $this->assign('goods_history',history_log());
        $this->display('goods_detail');
    }

    public function _setlog($goods_id){
        /* 记录浏览历史 */
        $log = cookie('history');
    if (!empty($log)){

        $history = explode(',', $log);

        array_unshift($history, $goods_id);
        $history = array_unique($history);

        while (count($history) > 6)
        {
            array_pop($history);
        }

        cookie('history', implode(',', $history), time() + 3600 * 24 * 30);
    }
    else
    {
        cookie('history', $goods_id, time() + 3600 * 24 * 30);
    }

    }
    /**
     * 清除商品浏览记录
     */
    public function clear_history(){
        if(!empty($_POST) && $_POST['act']=='clear'){
            cookie('history',null);
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
        return false;
    }
    /**
     * 计算商品价格
     */
    public function price(){
        if(!empty($_POST) && $_POST['goods_id']){
            $goods_id = I('post.goods_id');
            $num = I('post.number');
            $attrs = I('post.attrs');
            $data['price'] = $this->Goods->get_price($goods_id,$num,$attrs);
            $this->ajaxReturn($data);    
        }
    }

    public function t(){
        echo cookie('cdc');
    }

}
