<?php
/*
 * 公共函数
 */

function tbug($value){
    echo "<pre>";
    var_dump($value);
}

/**
 * 格式化商品价格
 *
 * @access  public
 * @param   float   $price  商品价格
 * @return  string
 */
function price_format($price, $change_price = true)
{
    if($price==='')
    {
        $price=0;
    }
    if ($change_price)
    {
        switch (C('price_format'))
        {
            case 0:
                $price = number_format($price, 2, '.', '');
                break;
            case 1: // 保留不为 0 的尾数
                $price = preg_replace('/(.*)(\\.)([0-9]*?)0+$/', '\1\2\3', number_format($price, 2, '.', ''));

                if (substr($price, -1) == '.')
                {
                    $price = substr($price, 0, -1);
                }
                break;
            case 2: // 不四舍五入，保留1位
                $price = substr(number_format($price, 2, '.', ''), 0, -1);
                break;
            case 3: // 直接取整
                $price = intval($price);
                break;
            case 4: // 四舍五入，保留 1 位
                $price = number_format($price, 1, '.', '');
                break;
            case 5: // 先四舍五入，不保留小数
                $price = round($price);
                break;
        }
    }
    else
    {
        $price = number_format($price, 2, '.', '');
    }

    return sprintf(C('CURRENCY_FORMAT'), $price);
}

/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}

/**
 * 读取商品浏览记录
 */
function history_log(){
    $goodsid = cookie('history');
    $goodsModel = new \Think\Model('Goods');
    if(!empty($goodsid)){
    $goods_history = $goodsModel->where("goods_id in ($goodsid)")->select();
    // $this->assign('goods_history',$goods);
    return $goods_history;
    }
}

/**
 *读取指定分类信息
 */
function getclass($cid){
    $cateModel = new \Common\Model\CategoryModel();
    $cate = $cateModel->get_categories_tree($cid);
   return $cate;
}

/**
 * 获得所有扩展分类属于指定分类的所有商品ID
 *
 * @access  public
 * @param   string $cat_id     分类查询字符串
 * @return  string
 */
function get_extension_goods($cats)
{
    $extension_goods_array = '';
    $goods = new \Think\Model();
     $datas['cat_id'] = array('in',$cats);
    $extension_goods_array = $goods->field('goods_id')->table('__GOODS_CAT__')->where($datas)->order('goods_id asc')->select();
    $goods_id_list ='';
    foreach($extension_goods_array as $v){
        $goods_id_list .= $v['goods_id'].",";
    }
       $goods_id_list =substr($goods_id_list, 0,-1);
       
    return $goods_id_list;
}

 /*购物车商品数量*/
     function getnum(){
            $user_id = session('user_id');
            if(!empty($user_id)){

                $carts = M('Cart');
                $map['user_id'] = $user_id;
                $count = $carts->where($map)->count();
            }else{
                $cart = session('cart');
                $count = count($cart);
            }
           
            return $count;
    }

/**
 * 获得指定分类下所有底层分类的ID
 *
 * @access  public
 * @param   integer     $cat        指定的分类ID
 * @return  string
 */
function get_children($cat = 0)
{
    return 'g.cat_id ' . db_create_in($cat);
}

/**
 * 创建像这样的查询: "IN('a','b')";
 *
 * @access   public
 * @param    mix      $item_list      列表数组或字符串
 * @param    string   $field_name     字段名称
 *
 * @return   void
 */
function db_create_in($item_list, $field_name = '')
{
    if (empty($item_list))
    {
        return $field_name . " IN ('') ";
    }
    else
    {
        if (!is_array($item_list))
        {
            $item_list = explode(',', $item_list);
        }
        $item_list = array_unique($item_list);
        $item_list_tmp = '';
        foreach ($item_list AS $item)
        {
            if ($item !== '')
            {
                $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
            }
        }
        if (empty($item_list_tmp))
        {
            return $field_name . " IN ('') ";
        }
        else
        {
            return $field_name . ' IN (' . $item_list_tmp . ') ';
        }
    }
}

