<?php
namespace Home\Controller;
use Common\Controller\HomeController;
/**
 * 用户收货地址控制器
 */
class AddressController extends HomeController {
	
	public function __construct(){
		parent::__construct();
		$this->Addr = D('Address');
	}

	/* 用户收货地址列表 */
	public function address_list(){
		$user_id = session('user_id');
		$list = $this->Addr->getAttrList($user_id);

		$this->assign('list',$list);
		$this->display('address_list');
	}

	/* 添加用户收货地址*/
	public function add(){
		if(!empty($_POST) && $_POST['act'] =='act_add_address'){
			$data['user_id'] = session('user_id');
			$data['address_info'] = I('post.s_province').'&nbsp;'.I('post.s_city').'&nbsp;'.I('post.s_county');
			$data['consignee'] = I('post.consignee');
			$data['email'] = I('post.email');
			$data['street'] = I('post.address');
			$data['zipcode'] = I('post.zipcode');
			$data['telephone'] = I('post.tel');
			$data['mobile'] = I('post.mobile');
			$data['sign_building'] = I('post.sign_building');
			$data['best_time'] = I('post.best_time');
			$data = $this->Addr->create($data,2);

			if(($this->Addr->getCount($data['user_id'])) > 12){
				$this->error('最多允许创建12个收货地址');
			}else{
			if($this->Addr->add($data)){
				$url = U('address/address_list');
				header("location:$url");
				}
			}
		}else{
		$this->display("address_add");
		}
	}


	/**
	 * 删除收货地址
	 * @param 收货地址ID
	 * @return mix
	 *
	 */
	public function del(){
		if(!empty($_POST)){
			$address_id = I('post.address_id',0,'intval');
			if($this->Addr->delete($address_id)){
				$data['status'] = 1;
				$this->ajaxReturn($data);
			}
			return false;
		}
		return false;
	}

}