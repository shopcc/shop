<?php
namespace Common\Model;
use Think\Model;

class ShippingModel extends Model {
	/**
	 * 获取固定运费
	 */
	public function getprice($shipping_id){
		$price = $this->field('shipping_fee')->where("shipping_id = $shipping_id")->find();
		return $price['shipping_fee'];
	}
}