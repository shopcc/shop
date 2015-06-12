<?php
namespace Common\Model;
use Think\Model;

class GoodsModel extends Model {
	
	
	public function _after_insert($data,$options){
		$ext_id = I('post.ext_goods_cat');
		if($ext_id)
		{
		$gcModel = D('goods_cat');
			foreach($ext_id as $k =>$v){
				if($v == 0)continue;
					$gcModel->add(array(
					'goods_id' => $data['goods_id'],
					'cat_id' => $v,
					));
	
			}
		}
		
		
	}
	
	public function _before_update(&$data,	$options){
		$gcModel = M('GoodsCat');
		$gcModel->where(array(
		'goods_id'=> I('post.goods_id')))->delete();
	}
	
	public function _after_update($data, $options){
		$ext_id = I('post.ext_goods_cat');
		if($ext_id){
			$gcModel = M('GoodsCat');
			foreach($ext_id as $k=>$v){
				if($v ==0)continue;
				$gcModel->add(array(
				'goods_id' => I('post.goods_id'),
				'cat_id' => $v,
				));
			}
		}
	}
	/**
	 * 根据相关条件查询商品列表
	 * @param array $condition 查询条件
	 * @return \Think\mixed
	 */
	public function getGoodlist($condition,$like=''){
		if(isset($condition['limit'])){
			$this->limit($condition['limit'][0],$condition['limit'][1]);
			unset($condition['limit']);
		}
		$this->order("goods_id asc");
		if(!empty($condition)){
			$this->where($condition);
		}
		if(!empty($like)){

		    $this->where("goods_name like '%".$like."%'");
		}
		return $this->select();
	}

  
  /**
 * 获得分类下的商品
 *
 * @access  public
 * @param   string  $children
 * @return  array
 */

 public function get_goods_list($cate,$brand,$page,$pagesize,$ext){
    $this->where("g.is_onsale =1");

    $where['g.cat_id']  = array('in', $cate);
    if(get_extension_goods($cate)){
    $where['g.goods_id']  = array('in',get_extension_goods($cate));
    }
    $where['_logic'] = 'or';
    $map['_complex'] = $where;
    if(!empty($ext)){
        $map['g.goods_id'] =array('in',$ext);
    }
    if(!empty($cat)){

    }
    $this->where($map);   
    //品牌
    if($brand > 0){
        $this->where("g.brand_id = $brand");
    }
    $this->field("g.goods_id,g.goods_name,g.market_price,g.market_price, g.is_new, g.is_best, g.is_hot, g.shop_price,g.promote_price, g.type_id,g.promote_start_time, g.promote_end_time, g.goods_brief, g.goods_thumb , g.goods_img");
    $this->table("cz_goods as g");
    $this->order("g.goods_id desc");
   $goods_list = $this->page($page,$pagesize)->select();
   $arr = array();
   foreach($goods_list as $v){
        $arr[$v['goods_id']]['goods_id'] = $v['goods_id'];
        $arr[$v['goods_id']]['goods_name'] = $v['goods_name'];
        $arr[$v['goods_id']]['goods_brief']      = $v['goods_brief'];
        $arr[$v['goods_id']]['market_price']     = price_format($v['market_price']);
        $arr[$v['goods_id']]['shop_price']       = price_format($v['shop_price']);
        $arr[$v['goods_id']]['type_id']             = $v['type_id'];
        $arr[$v['goods_id']]['goods_thumb']      = $v['goods_thumb'];
        $arr[$v['goods_id']]['goods_img']        = $v['goods_img'];
        $arr[$v['goods_id']]['url']              = U('goods/detail',array('id'=>$v['goods_id']));
   }
   return $arr;
 }

 /**
 * 获得分类下的商品总数
 *
 * @access  public
 * @param   string     $cat_id
 * @return  integer
 */
public function get_cagtegory_goods_count($children, $brand , $ext='')
{
     $this->where("g.is_onsale =1");

    $where['g.cat_id']  = array('in', $children);
    if(get_extension_goods($children)){
    $where['g.goods_id']  = array('in',get_extension_goods($children));
    }
    $where['_logic'] = 'or';
    $map['_complex'] = $where;
    if(!empty($ext)){
        $map['g.goods_id'] =array('in',$ext);
    }
    
    $this->where($map);   
    //品牌
    if($brand > 0){
        $this->where("g.brand_id = $brand");
    }

    $count = $this->table('cz_goods as g')->count('*');
    /* 返回商品总数 */
    return $count;
}
    /**
     * 商品总记录数
     * @param array $condition 查询条件获取商品的总记录
     */
	public function getCount($condition=''){
		if(!empty($condition) && $condition['brand_id'] !=0){
			$this->where($condition);

		}
    
		return $this->count('*');
	}

	/**
	 * 根据商品ID获取商品信息
	 * @param string $goods_id 商品ID
	 */
	public function getOne($goods_id){
        return $this->find($goods_id);
	}

	/**
	 * 根据商品ID获取商品的详细信息
	 * @param string $goods_id 商品ID
	 */
	public function getDetailOne($goods_id)
	{
        $this->field('g.*,b.brand_name,c.cat_name');
        $this->join('left join cz_brand as b on b.brand_id = g.brand_id');
        $this->join('left join cz_category as c on c.cat_id = g.cat_id');
        return $this->table('cz_goods as g')->find($goods_id);
	}
	/**
	 * 根据给定条件获取前5条商品记录
	 * @param array $condition
	 * @return \Think\mixed
	 */
	public function getGoods($condition){
	    $this->limit(0,5);
	    $this->order('goods_id desc');
	    $this->where($condition);
	    return $this->select();
	}
	/**
	 * 获取商品的属性和规格
	 * @access pubic
	 * @param integer $goods_id 商品ID
	 * @return array
	 */
    public function get_goods_properties($goods_id){
        /* 对属性进行重新排序和分组 */
        $this->field('attr_group');
        $this->where("g.goods_id = ".$goods_id);
        $this->where('gt.type_id = g.type_id');
        $this->table('cz_goods_type as gt,cz_goods as g');
        $grp = $this->find();
        $grp = $grp['attr_group'];
        if (!empty($grp))
        {
            $groups = explode("\n", strtr($grp, "\r", ''));
        }

        /* 获得商品的规格 */

        $this->field('a.attr_id, a.attr_name, a.attr_group, a.is_linked, a.attr_type,g.goods_attr_id, g.attr_value, g.attr_price');
        $this->join("left join cz_attribute as a on a.attr_id = g.attr_id");
        $this->where("g.goods_id =". $goods_id);
        $this->order("a.sort_order,g.attr_price,g.goods_attr_id");
        $res = $this->table('cz_goods_attr as g')->select();

        $arr['pro'] = array();     // 属性
        $arr['spe'] = array();     // 规格
        $arr['lnk'] = array();     // 关联的属性

        foreach ($res AS $row)
        {
            $row['attr_value'] = str_replace("\n", '<br />', $row['attr_value']);


            if ($row['attr_type'] == 0)
            {
                $group = (isset($groups[$row['attr_group']]) && !empty($groups[$row['attr_group']])) ? $groups[$row['attr_group']] : '商品属性';

                $arr['pro'][$group][$row['attr_id']]['name']  = $row['attr_name'];
                $arr['pro'][$group][$row['attr_id']]['value'] = $row['attr_value'];
            }
            else
            {
                $arr['spe'][$row['attr_id']]['attr_type'] = $row['attr_type'];
                $arr['spe'][$row['attr_id']]['name']     = $row['attr_name'];
                $arr['spe'][$row['attr_id']]['values'][] = array(
                    'label'        => $row['attr_value'],
                    'price'        => $row['attr_price'],
                    'format_price' => price_format(abs($row['attr_price']), false),
                    'id'           => $row['goods_attr_id']);
            }

            if ($row['is_linked'] == 1)
            {
                /* 如果该属性需要关联，先保存下来 */
                $arr['lnk'][$row['attr_id']]['name']  = $row['attr_name'];
                $arr['lnk'][$row['attr_id']]['value'] = $row['attr_value'];
            }

        }
        return $arr;
    }
    /**
     * 获取单个商品总价
     */
    public function get_price($goods_id,$num,$attr){
        //获取商品单价
        $price = $this->field('shop_price')->find($goods_id);
        //获取商品的配件等属性价格attr_price
        foreach($attr as $attr_id){
                $attr_price =$this->field('attr_price')->table('cz_goods_attr')->where("goods_id = $goods_id and goods_attr_id = $attr_id")->find();
                $attr_prices +=$attr_price['attr_price'];
        }   

        return ($price['shop_price']+$attr_prices)*$num;
    }
    /**
     * 获取商品库存
     */
    public function kucun($goods_id){
        $cun = $this->field('goods_number')->find($goods_id);
        return $cun['goods_number'];
    }

    /**
     * 获取商品属性
     */
    public function get_attrs($attr,$goods_id){
            
            $this->table('cz_goods_attr as ga');
            $this->join('left join cz_attribute as a on a.attr_id = ga.attr_id');
            $this->field('ga.attr_value,ga.attr_price,a.attr_name');
          
            $map['ga.goods_id'] = $goods_id;

            $ids = implode(",",$attr);
            $map['ga.goods_attr_id'] = array('in',$ids);
           $info = $this->where($map)->select(); 
            
            foreach($info as $v){
                $infos[] = array('goods_attr'=>$v['attr_name'].":".$v['attr_value']."[".$v['attr_price']."]");
            }
            foreach($infos as $v1){
                $goods_attrs .= $v1['goods_attr']."<br/>";
            }
             $goods_attrs = substr($goods_attrs, 0,-5);

        return $goods_attrs ;
    }


}