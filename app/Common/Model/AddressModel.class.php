<?php
namespace Common\Model;
use Think\Model;

/**
 * 收货地址模型类
 */	
class AddressModel extends Model {
	/**
	 * 获取所有的收货地址
	 */
	public function getAttrList($user_id){
		$this->field("d.consignee,d.address_id,d.address_info,d.email,d.best_time,d.zipcode,d.street,d.telephone,d.sign_building,d.mobile,u.user_name");
		$this->join("left join cz_user as u on u.user_id = d.user_id");
		return $this->table('cz_address as d')->where("d.user_id = $user_id")->order('address_id asc')->select();
	}

	public function getCount($user_id=''){
		if($user_id != ''){
			$this->where("user_id = $user_id");
		}
		return $this->count();
	}

	/**
	 * 获取一条收货地址信息
	 * @param string $address_id 收货地址ID
	 */
	public function getOne($address_id){
		return $this->find($address_id);
	}

	public function get_user_address($user_id){
		$map['user_id'] = $user_id;
		$map['is_default'] =1;
		return $this->where($map)->find();
	}
}