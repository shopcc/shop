<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Common\Library\Page;

class OrderController extends AdminController {

    //构造函数
    public function __construct(){
        parent::__construct();
        $this->Order = D('Order');
        $this->Addr =D('Address');
        $this->User = D('User');
    }

    /**
     * 订单列表
     */
    public function showlist(){
        $curr_page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $pagesize = 6;
        $offset = ($curr_page -1)*$curr_page;
        $condition['limit'] = array($offset,$pagesize);

        if(!empty($_GET['order_sn'])){
            $condition['order_sn'] = I('get.order_sn');
        }
        if(!empty($_GET['user_name'])){
            $condition['user_name'] = I('get.user_name');
        }
        if(!empty($_GET['order_status'])){
            $condition['order_status'] = $_GET['order_status'];
        }
        $total = $this->Order->getCount($condition);
        $Page = new Page($total,$pagesize);
        $bar = $Page->fpage();
        $list = $this->Order->getOrderList($condition);

        $this->assign('bar',$bar);
        $this->assign('list',$list);
        $this->display('order_list');
    }
    /**
     * 批量删除订单
     */
    public function delall(){
        if(!empty($_POST)){
            $order_id = implode(",", $_POST['checkboxes']);
            if($this->Order->delete($order_id)){
                $this->success('删除成功',U('Order/showlist'),2);
            }else{
               $this->error('删除失败');
            }
        }
    }
    /**
     * 订单详情
     * @param string $order_id 订单ID
     */
    public function detail($order_id){
        //订单信息
        $info = $this->Order->getOne($order_id);
        //收货地址信息
        $address = $this->Addr->getOne($info['address_id']);
        //收货人信息
     
        //订单商品信息
        $goods = $this->Order->getOrderGoods($order_id);
        //订单总价
        $price = $this->Order->totalprice($order_id);
        
        $this->assign('info',$info);
        $this->assign('address',$address);
        $this->assign('goods',$goods);
        $this->assign('prices',$price);
        $this->display('order_info');
    }
    /* 订单状态操作 */
    public function operate(){
        if(!empty($_POST)){
            $order_id = I('post.order_id');
            if(isset($_POST['confirm'])){
               $info = $this->Order->where("order_id=$order_id")->setField('order_status','4');
            }elseif(isset($_POST['pay'])){
               $info = $this->Order->where("order_id=$order_id")->setField('order_status','2');
            }elseif(isset($_POST['send'])){
               $info = $this->Order->where("order_id=$order_id")->setField('order_status','3');
            }elseif(isset($_POST['cancel'])){
               $info = $this->Order->where("order_id=$order_id")->setField('order_status','0');
            }
            if($info){
                $this->success('订单状态已改变',U('order/detail',array('order_id'=>$order_id)),1);
            }else{
                 $this->error('订单状态未改变',U('order/detail',array('order_id'=>$order_id)),1);
            }
        }
    }
}