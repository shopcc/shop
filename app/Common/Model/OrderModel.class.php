<?php
namespace Common\Model;
use Think\Model;

class OrderModel extends Model {

    /**
     * 订单列表
     * @param array $condition 订单列表查询条件
     * @return \Think\mixed
     */
    public function getOrderList($condition=''){
        if(isset($condition['limit'])){
            $this->limit($condition['limit'][0],$condition['limit'][1]);
            unset($condition['limit']);
        }
        if(!empty($condition)){
            $this->where($condition);

        }
        $this->field("o.order_id,o.order_sn,o.order_time,o.user_id,o.goods_amount,o.order_amount,o.order_status,u.user_name");
        $this->join('left join cz_user as u on u.user_id = o.user_id');
        return $this->table('cz_order as o')->select();
    }

    public function get_order_list($page,$pagesize){
        $user_id = session('user_id');
        return $this->page($page,$pagesize)->where("user_id=$user_id")->select();
    }
    
    /**
     * 获取订单总记录
     * @param array $condition 查询条件
     */
    public function getCount($condition){
        if(isset($condition['limit'])){
        unset($condition['limit']);
        }
        if(!empty($condition)){
            $this->where($condition);
        }
        return $this->count('order_id');
    }
    /**
     * 获取订单信息
     * @param string $order_id
     * @return \Think\mixed
     */
    public function getOne($order_id){
        $this->field("o.pay_id,o.address_id,o.shipping_id,o.order_id,o.order_sn,o.order_time,o.user_id,o.goods_amount,o.order_amount,o.order_status,u.user_name,p.pay_name,p.pay_desc,s.shipping_fee,s.shipping_name,s.shipping_desc");
        $this->join('left join cz_user as u on u.user_id = o.user_id');
        $this->join('left join cz_payment as p on p.pay_id = o.pay_id');
        $this->join('left join cz_shipping as s on s.shipping_id = o.shipping_id');
        return $this->table('cz_order as o')->find($order_id);
    }

    /**
     * 获取订单商品信息
     * @param string $order_id
     * @return \Think\mixed
     */
    public function getOrderGoods($order_id){
        $this->table('cz_order_goods as o');
        $this->field('o.*,g.goods_number as kucun');
        $this->join('left join cz_goods as g on g.goods_id = o.goods_id');
        return $this->select($order_id);
    }
    /**
     * 获取订单商品总价
     */
    public function totalprice($order_id){
         $this->table('cz_order_goods as o');
        $this->field('o.goods_number,o.goods_price');
        $this->join('left join cz_goods as g on g.goods_id = o.goods_id');
        $this->where("order_id=$order_id");
        $goods = $this->select();
        foreach($goods as $v){
            $total += $v['goods_number']*$v['goods_price'];
        }
        return $total;
    }
   


}