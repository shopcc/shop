<?php
namespace Home\Controller;
use Common\Controller\HomeController;
use Home\Library\Page;

/**
 * 订单操作控制器
 */

class OrderController extends HomeController {
	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
		$this->Order = D('Order');
		$this->Shipping = D('Shipping');
		$this->Addr = D('Address');
		$this->Pay = M('Payment');
	}
	//获取订单列表
	public function order_list(){
		//$this->assign('order',$order);
		$this->display();
	}
	/**
	 * 根据订单ID获取订单详情
	 */
	public function detail($order_id){
		//订单信息
		$info = $this->Order->getOne($order_id);
		//订单商品列表
		$goods = $this->Order->getOrderGoods($order_id);
		//商品总价
        $price = $this->Order->totalprice($order_id);
        //配送费用计算
        $sp = $this->Shipping->getprice($info['shipping_id']);

        //获取收货人信息
        $address_info = $this->Addr->getOne($info['address_id']);

		$this->assign('info',$info);
		$this->assign('goods',$goods);
		$this->assign('price',$price);
		$this->assign('sp',$sp);
		$this->assign('address',$address_info);
		$this->display('order_detail');
	}

	public function data_order(){
		//获取当前分页
		$curr_page = isset($_REQUEST['page']) ? I('request.page') : 1;
		$pagesize = 9;
		//总记录
		$count = $this->Order->getCount();

		//分页类实例化
		$Page = new Page($count,$pagesize);
		$pagebar = $Page->fpage();

		$order = $this->Order->get_order_list($curr_page,$pagesize);

		//拼凑html
		$html = "<tr align='center'><td bgcolor='#ffffff'>订单号</td>";
        $html.= "<td bgcolor='#ffffff'>下单时间</td><td bgcolor='#ffffff'>订单总金额</td>";
        $html.= "<td bgcolor='#ffffff'>订单状态</td><td bgcolor='#ffffff'>操作</td></tr>";
		foreach($order as $v){
			$html .= "<tr>";
			$html .= "<td align='center' bgcolor='#ffffff'><a href='".U('order/detail',array('order_id'=>$v['order_id']))."' class='f6'>".$v['order_sn']."</a></td>";
			$html .= "<td align='center' bgcolor='#ffffff'>".date("Y-m-d H:i:s",$v['order_time'])."</td>";
            $html .= "<td align='right' bgcolor='#ffffff'>￥".$v['goods_amount']."元</td>";
            $html .= "<td align='center' bgcolor='#ffffff'>".L('order_status_'.$v['order_status'])."</td>";
            $html .= "<td align='center' bgcolor='#ffffff'><font class='f6'>";
            if($v['order_status'] == 1){
            	$html .= "<a href='javascript:;' onclick='pay(".$v['order_id'].",2)'>[&nbsp;".L('pay')."&nbsp;]&nbsp;&nbsp;</a>";
            	$html .= "<a href='javascript:;' onclick='cancel(".$v['order_id'].",0)'>";
            	$html .= "[".L('order_cancel')."]</a>";
            }elseif ($v['order_status'] == 3) {
            	$html .= "<a href='javascript:;'>".L('confirm')."</a>";
            }elseif($v['order_status'] == 4){
            	$html .= "".L('finish')."";
            }
        
            $html .= "</font></td></tr>";
		}
		$html .="<tr><td>".$pagebar."</td></tr>";
		$this->ajaxReturn($html);
		
	}

	public function set_status(){
		if(!empty($_POST)){
			$order =I('post.orderid');
			$order_status = I('post.order_status');
			$status = $this->Order->where("order_id=$order")->setField('order_status',$order_status);
			if($status){
				$this->success('设置成功');
			}else{
				$this->error('设置失败');
			}
		}
	}
}