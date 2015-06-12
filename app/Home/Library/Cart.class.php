<?php
namespace Home\Library;
use Think\Model;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: ToniLiu <cniiliuqi@126.com>
// +----------------------------------------------------------------------
// $Id: Cart.class.php ToniLiu $

/**
 * +------------------------------------------------------------------------------
 * Cart实现类
 * +------------------------------------------------------------------------------
 *
 * @category Think
 * @package Think
 * @subpackage Util
 * @author ToniLiu <cniiliuqi@126.com>
 * @version $Id: Cart.class.php
 *          +------------------------------------------------------------------------------
 */
class Cart
{
    public function __construct(){
        $this->user_id = session('user_id');
        $this->carts = session('cart');
        $this->cart = M('cart');
        if(!empty($this->user_id) && !empty($this->carts)){
            foreach($this->carts as $v){
                $v['user_id'] = $this->user_id;
                $this->cart->add($v);
            }
            session('cart',null);
        }
    }
    public function addCart($goods){
            if(!empty($this->user_id)){
                $data['user_id'] = $user_id = $this->user_id;
                $data['goods_id'] = $goods['goods_id'];
                $goods_info = $this->cart->where($data)->find();
                if($goods_info){
                    $data['goods_number'] = $goods['number']+$goods_info['goods_number'];
                    $data['goods_id'] =  $goods['goods_id'];
                    $data['goods_price'] = $goods['shop_price_total']*($goods_info['goods_number']+$goods['goods_number']);
                    $data['market_price'] = $goods['market_price_total']*($goods_info['goods_number']+$goods['goods_number']);
                $update = $this->cart->where("user_id= $user_id")->save($data);
                return $update;
                }else{
                    $goods['user_id'] = $data['user_id'];
                    $goods['goods_number'] = $goods['number'];
                    $goods['goods_price'] = $goods['shop_price_total'];
                    $goods['market_price'] = $goods['market_price_total'];
                    $add = $this->cart->add($goods);
                    return $add;
                }
            }else{
            $cur_cart_array = session('cart');
            if(empty($cur_cart_array)){
            $cart_info[0]['goods_id'] = $goods['goods_id'];
            $cart_info[0]['goods_name'] = $goods['goods_name'];
            $cart_info[0]['goods_img'] = $goods['goods_img'];
            $cart_info[0]['goods_number'] = $goods['number'];
            $cart_info[0]['goods_price'] = $goods['shop_price_total'];
            $cart_info[0]['market_price'] = $goods['market_price_total'];
            $cart_info[0]['goods_attr'] = $goods['goods_attr'];
            $cart_info[0]['goods_attr_id'] = $goods['goods_attr_id'];
            session('cart',$cart_info);
            return true;
            }else{        
         //返回数组键名倒序取最大
         $ar_keys=array_keys($cur_cart_array);
         $len=count($ar_keys);
         $max_array_keyid=$ar_keys[$len-1]+1;
         //遍历当前的购物车数组
         //遍历每个商品信息数组的0值，如果键值为0且货号相同则购物车该商品已经添加
         $is_exist=$this->isexist($goods['goods_id'],$goods['number'],$cur_cart_array);
     
        if($is_exist==false){
            $cur_cart_array[$max_array_keyid]["goods_id"] = $goods['goods_id'];
            $cur_cart_array[$max_array_keyid]['goods_name'] = $goods['goods_name'];
            $cur_cart_array[$max_array_keyid]['goods_img'] = $goods['goods_img'];
            $cur_cart_array[$max_array_keyid]["goods_number"] = $goods['number'];
            $cur_cart_array[$max_array_keyid]["goods_price"] = $goods['shop_price_total'];
            $cur_cart_array[$max_array_keyid]["market_price"] = $goods['market_price_total'];
            $cur_cart_array[$max_array_keyid]['goods_attr'] = $goods['goods_attr'];
            $cur_cart_array[$max_array_keyid]['goods_attr_id'] = $goods['goods_attr_id'];
            session('cart',$cur_cart_array);
           return true;
        }else{

         $arr_exist=explode("/",$is_exist);

         $id=$arr_exist[0];
         $num=$arr_exist[1];
         $goods_price = $arr_exist[2];
         $market_price = $arr_exist[3];
         $cur_cart_array[$id]["goods_number"]=$num;
         $cur_cart_array[$id]["goods_price"]=$goods_price;
         $cur_cart_array[$id]["market_price"]=$market_price;
         session('cart',$cur_cart_array);
         return true;
        }
      }
      return false;
    }
}

    public function get_cart_list(){
        $cart = session('cart');
        $user_id = session('user_id');
        if(empty($user_id) || $user_id ==0 || !empty($cart)){
            return $cart;
        }else{
           $list = $this->cart->where("user_id = $user_id")->select();
           return $list;
        }
    }

    //判断购物车是否存在相同商品
    public function isexist($id,$num,$arr)
    {

     foreach($arr as $key1=>$value)
     {
      foreach($value as $k=>$v)
      {
       if($k=="goods_id" && $v==$id){
        $nums=$value["goods_number"]+$num;
        $goods_price = ($value['goods_price']/$value['goods_number'])*$nums;
        $market_price = ($value['market_price']/$value['goods_number'])*$nums;
         $isexist=$key1."/".$nums."/".$goods_price."/".$market_price;
       }
       
      }
     }
      
      return $isexist;
    }

    /**
     * 更新购物车
     * 收集表单传递过来的商品数量
     * 
     * @param inter $id  索引ID
     * @param inter $num 商品数量
     * @param inter $user_id 用户ID
     * 
     */
    public function update_cart($id,$goods_id=''){
        $cur_cart_array = session('cart');
        $user_id = session('user_id');
        if(empty($user_id)){
    foreach ($id as $key => $value) {
        # code...
        $cur_cart_array[$key]["goods_price"] = ($cur_cart_array[$key]['goods_price']/$cur_cart_array[$key]["goods_number"])*$value;
        $cur_cart_array[$key]["market_price"] = ($cur_cart_array[$key]['market_price']/$cur_cart_array[$key]["goods_number"])*$value;
        $cur_cart_array[$key]["goods_number"] = $value;
         session('cart',$cur_cart_array);
    }
    }else{
        $map['user_id'] = $user_id;
        $map['goods_id'] = array('in',$goods_id);
        $info = $this->cart->field('goods_id,goods_number,goods_price,market_price')->where($map)->select();
         foreach($info as $k=>$val){
            $data['goods_number'] = $id[$k];
            $data['goods_price'] = ($val['goods_price']/$val['goods_number'])*$id[$k];
            $data['market_price'] = ($val['market_price']/$val['goods_number'])*$id[$k];

            $this->cart->where("goods_id = {$val['goods_id']} and user_id = {$user_id}")->save($data);
         }
       
    }
    }

    /*清空购物车*/
    public function clear_cart(){
        if(isset($this->user_id) && !empty($this->user_id)){
            $this->cart->where("user_id = $this->user_id")->delete();
        }else{
         session('cart',null);
        }
    }

    /*统计商品总价*/
    public function total_price(){
        $cart = session('cart');
        $user_id = session('user_id');
        if(!empty($cart) && !isset($user_id)){
            foreach ($cart as $value) {
                # code...
                $price['total_goods'] += $value['goods_price'];
                $price['total_market'] += $value['market_price'];
                $price['per'] = sprintf("%.2f", (($price['total_market']-$price['total_goods'])/$price['total_market'])*100);
            }
            return $price;
        }else{
            $ct['user_id'] = $user_id;
            $cart = $this->cart->where($ct)->select();
             foreach ($cart as $value) {
                # code...
                $price['total_goods'] += $value['goods_price'];
                $price['total_market'] += $value['market_price'];
                $price['per'] = sprintf("%.2f", (($price['total_market']-$price['total_goods'])/$price['total_market'])*100);
            }
            return $price;

        }

    }

    public function drop_goods($goods_id){
        $user_id = session('user_id');
        $cart = session('cart');
        if(!isset($user_id) && !empty($goods_id)){
            foreach($cart as $k=>$v)
        {
            if($v['goods_id'] ==$goods_id){
                $ids = $k; 
                $_SESSION['cart'][$ids] =null;
                unset($_SESSION['cart'][$ids]);
                return true;
            }
        }

        }else{
            $del = $this->cart->where("goods_id = $goods_id and user_id =$user_id")->delete();
            return $del;
        }
    }
}
       
?>