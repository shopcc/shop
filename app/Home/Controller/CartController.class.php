<?php
namespace Home\Controller;
use Think\Controller;
 use Home\Library\Cart;

/**
 * 购物车控制器
 */
class CartController extends Controller {
	private $cart;
	//构造函数
	public function __construct(){
		parent::__construct();
		$this->cart = new Cart();
		$this->goods = D('Goods');
		$this->Addr = D('Address');
		$this->order = D('Order');
		$this->user_id =session('user_id');

	}

	public function _empty(){
		$this->_showlist();
	}

	public function add_to_cart(){
		if(!empty($_POST) && !empty($_POST['goods'])){
			$goods_info = I('post.goods');
			$goods_id = $goods_info['goods_id'];
			$goods_num = $goods_info['number'];
			$goods_attr = $goods_info['spec'];
			//获取商品信息
			$info = $this->goods->find($goods_id);
			$goods_info['goods_name'] = $info['goods_name'];
			$goods_info['goods_img'] = $info['goods_thumb'];

			//获取商品属性
			if(!empty($goods_attr)){
			$goods_info['goods_attr'] = $this->goods->get_attrs($goods_attr,$goods_id);
			}
	
			$goods_info['goods_attr_id'] = implode(",", $goods_attr);
			
			//获取商品库存
			$ku = $this->goods->kucun($goods_id);
			if($goods_num > $ku){
				$this->error('库存不足,请重新选择商品数量');
			}
			if($this->cart->addCart($goods_info)){
				$this->success('商品已添加到购物车');
			}
		}
	}
		
	
	public function _showlist(){
		
		//购物车列表
		$cart_list = $this->cart->get_cart_list();

		//获取商品总价和市场价总价
		$price = $this->cart->total_price();
	
		$this->assign('cart_list',$cart_list);
		$this->assign('price',$price);
		$this->display('flow');
	}	
	/* 删除商品*/
	public function drop(){
		
			$goods_id = I('request.gid');
			
			if($this->cart->drop_goods($goods_id)){
				$this->success('删除成功',U('/cart'),2);
			}
		
	}
	/*更新购物车*/
	public function update(){
		$id = I('post.goods_number');
		$goods_id = implode(",", I('post.goods_id'));
		$map['goods_id'] = array('in',$goods_id);
		$num = M('Goods')->where($map)->select();
		foreach($num as $k=>$v){
			if($v['goods_number'] < $id[$k]){
				$this->error($v['goods_name']."购买量已超过库存,请重新输入数量",U('/cart'),1);
			}
		}
		// echo array_sum($id);
		$this->cart->update_cart($id,$goods_id);
	    $this->success('更新成功',U('/cart'),1);
	}

	public function ajaxcheck(){
		if(IS_POST){
		$id = I('post.goods_number');
		$goods_id =I('post.goods_id');
		$map['goods_id'] = array('eq',$goods_id);
		$num = M('Goods')->where($map)->find();
		
			if($num['goods_number'] < $id){
				$this->error($num['goods_name']."购买量已超过库存,请重新输入数量");
				
			}
		}
		
	}

	/* 清空购物车*/
	public function clear(){
		$this->cart->clear_cart();
		$this->success('购物车已清空,您可以继续购物',U('/cart'),1);
	}
	/*购物结算*/
	public function checkout(){
		$user_id = session('user_id');
		if(empty($user_id)){
			$this->cart_login();
			exit();
		}
		//购物车列表
		$cart_list = $this->cart->get_cart_list();

		//获取商品总价和市场价总价
		$price = $this->cart->total_price();
		//获取收货默认地址
		 $address = $this->Addr->get_user_address($user_id);
		// //获取配送方式
		$shipping = M('shipping')->where('enabled=1')->select();
		// //获取支付方式
		$payment = M('payment')->select();

		$this->assign('cart_list',$cart_list);
		$this->assign('price',$price);
		$this->assign('address',$address);
		$this->assign('shipping',$shipping);
		$this->assign('payment',$payment);
		$this->display('flow_2');
	}
	public function cart_login()
	{
		if(!empty($_POST)){
            $user_name = I('post.username');
            $password = md5(I('post.password'));
            if($user_id = D('User')->checkuser($user_name,$password)){
                session('user_id',$user_id);
                session('user_name',$user_name);
                $this->success('登陆成功',U('/cart/checkout'),1);         
            }else{
                $this->error('用户名或密码错误');
            }
        }else{
		$this->display('Public/login_cart');
		}
	}

	/*运费统计*/
	public function shipping_price(){
		if(!empty($_POST['shipping_id'])){
			$shipping_id = I('post.shipping_id');
			$pri = D('Shipping')->getprice($shipping_id);
			$this->ajaxReturn($pri);
		}
	}
	/*生成订单*/
	public function done(){
		if(!empty($_POST) && !empty($this->user_id)){
			$data['order_sn'] = date("Ymdhis").mt_rand(00,99);
			$data['user_id'] = $this->user_id;
			$data['address_id'] = I('post.address_id');
			$data['order_status'] =1;
			$data['shipping_id'] = I('post.shipping');
			$data['pay_id']	= I('post.payment');
			$data['goods_amount'] = sprintf("%.2f",I('post.goods_price'));
			$data['order_amount'] = sprintf("%.2f",I('post.order_price'));
			$data['order_time'] = time();
			$data['postscripts'] = I('post.postscript');
			$order = $this->order->create($data);
			if($orders = $this->order->add($order)){
				$carts = M('Cart');
				$cd['user_id'] = $this->user_id; 
				$m['goods_number'] ='';
				$carts_info = $carts->field("goods_id,goods_name,goods_img ,goods_price,market_price,goods_number,goods_attr")->where($cd)->select();
				foreach($carts_info as $k=>$v){

					$goodsModel = M('Goods');
					
					$goodsnum = $goodsModel->where('goods_id='.$v['goods_id'])->field('goods_number')->find();
					$m['goods_number'] = $goodsnum['goods_number'] -$v['goods_number'];
					$goodsModel->where('goods_id='.$v['goods_id'])->setField('goods_number',$m['goods_number']);
					
					$v['order_id'] = $orders;
					$v['goods_price'] = $v['goods_price']/$v['goods_number'];
					$v['market_price'] = $v['market_price']/$v['goods_number'];
					$order_goods[] = $v; 
					//商品库存减少
					
				
				}
				D('Order_goods')->addAll($order_goods);
				if($carts->where($cd)->delete()){
					$this->order->field('o.order_amount,o.order_sn,s.shipping_name,p.pay_name,pay_desc');
					$this->order->join("LEFT JOIN cz_shipping AS s ON s.shipping_id  = o.shipping_id");
					$this->order->join("LEFT JOIN cz_payment AS p ON p.pay_id = o.pay_id ");
					$this->order->where("o.user_id =1");
					$this->order->where("order_id =$orders");
					$info =$this->order->table("cz_order AS o")->find();
					$this->assign('info',$info);
					$this->display("flow_3");
				}
			}


		}else{
			$this->redirect('/cart');
		}
		
	}

	public function consignee(){
		$user_id = session('user_id');
		if(!empty($user_id)){
			$address_id = I('post.address_id');
			if(!empty($address_id)){
				$info = $this->Addr->where("user_id=$user_id and is_default=1")->find();
				$this->Addr->where("user_id=$user_id and address_id={$info['address_id']}")->setField('is_default','0');
				$this->Addr->where("user_id=$user_id and address_id=$address_id")->setField('is_default','1');
				$url='/cart/checkout';
				$this->redirect($url);
			}else{
				//获取收货地址
				$addr = $this->Addr->getAttrList($user_id);
				$this->assign('address',$addr);
				$this->display('flow_1');
			}
			
		}else{
			$this->cart_login();
		}
		
	}

	
}