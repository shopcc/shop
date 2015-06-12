<?php
namespace Home\Controller;
use Common\Controller\HomeController;

class IndexController extends HomeController {

    public function __construct(){
        parent::__construct();
        $this->Goods = D('Goods');
    }

    public function index(){
        $best = $this->tuijian();
        $new = $this->news();
        $hot = $this->hot();

        $this->assign('best',$best);
        $this->assign('new',$new);
        $this->assign('hot',$hot);
        $this->display();
    }

    /**
     * 推荐商品列表
     */
    private function tuijian(){
        $condition['is_best'] = 1;
        return $this->Goods->getGoods($condition);
    }

    /**
     * 新品上架
     */
    private function news(){
        $condition['is_new'] =1;
        return $this->Goods->getGoods($condition);
    }

    /**
     * 热销商品
     */
    private function hot(){
       $condition['is_hot'] = 1;
       return $this->Goods->getGoods($condition);
    }
}