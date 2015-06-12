<?php
namespace Common\Model;
use Think\Model;

/**
 * 商品属性模型
 */
class AttributeModel extends Model{
    /**
     * 获取指定品牌下的商品属性的数量
     * @param unknown $type_id
     */
    public function getCountById($type_id){
       return $this->where('type_id = '.$type_id)->count('attr_id');
    }
    /**
     * 根据商品类型ID 获取商品的相关属性
     * @param string $type_id 商品类型ID
     * @param string $limit 约束
     * @return \Think\mixed
     */
    public function getListById($type_id,$limit =''){
        if(!empty($limit)){
            $this->limit($limit[0],$limit[1]);
        }
        $this->field('a.attr_id,a.type_id,a.attr_name,a.attr_input_type,a.attr_type,a.sort_order,a.attr_values,t.type_name');
        $this->join("left join cz_goods_type as t on a.type_id = t.type_id ");
        $this->order('a.attr_id asc');
        return $this->table(array('cz_attribute'=>'a'))->where('a.type_id ='.$type_id)->select();
    }
    /**
     * 获取单条属性信息
     * @param string $attr_id 属性ID
     * @return \Think\mixed
     */
    public function getOne($attr_id){
        return $this->find($attr_id);
    }

    /**
     * 根据attr_id获取相关的商品属性列表
     * @param string $attr_id
     * @return array
     */

    public function get_attr_id($attr_id){
        $map['attr_id']  = array('in',$attr_id);
        $this->field('attr_id,attr_name,type_id');
        return $this->where($map)->select();
    }

    /**
     * 获取商品属性列表
     * @param string $cat_id 商品类型ID
     * @param string $goods_id 商品ID
     * @return multitype:|\Think\mixed
     */
    public function get_attr_list($cat_id, $goods_id)
    {
        if(empty($cat_id)){
            return array();
        }
        $this->field("a.attr_id,a.attr_name,a.attr_input_type,a.attr_type,a.attr_values,v.attr_value,v.attr_price");
        $this->join("left join cz_goods_attr as v on v.attr_id = a.attr_id and v.goods_id={$goods_id}");
        $this->table("cz_attribute as a")->where("a.type_id =".intval($cat_id)." or a.type_id=0");
        $this->order('a.sort_order , a.attr_type, a.attr_id, v.attr_price,v.goods_attr_id');
       return $this->select();

    }

    /**
     * 根据商品ID,属性ID,属性值获取主键ID
     * @param string $goods_id
     * @param string $attr_id
     * @param string $attr_value
     * @return bool
     */
    public function getAttrId($goods_id,$attr_id,$attr_name){
        $condition['goods_id'] = $goods_id;
        $condition['attr_id'] = $attr_id;
        $condition['attr_value'] = $attr_value;
        return (bool) $this->table("cz_goods_attr")->where($condition)->find();
    }

    public function get_goods_attr(){
        $this->field("a.attr_id,a.attr_name,a.type_id");
        $this->table("cz_attribute as a,cz_goods_type as t");
        $this->where("a.type_id = t.type_id");
        $this->order("a.type_id asc,a.attr_id asc");
       $attr_list = $this->select();
       $list = array();
       foreach($attr_list as $val){
           $list[$val['type_id']][] = array($val['attr_id']=>$val['attr_name']);
       }
       return $list;
    }

    public function get_attribute($cat_filter_attr,$arr='',$filter_attr=''){
       
        foreach ($cat_filter_attr AS $key => $value)
        {
            $this->field('a.attr_name');
            $this->table('cz_attribute as a,cz_goods_attr as ga,cz_goods as g');
            $this->where("a.attr_id =ga.attr_id and g.goods_id = ga.goods_id and g.is_onsale = 1 AND a.attr_id=$value");

            if($temp_name = $this->find())
            {

                $all_attr_list[$key]['filter_attr_name'] = $temp_name['attr_name'];

                $this->field('a.attr_id,min(a.goods_attr_id) as goods_id,a.attr_value as attr_value');
                $this->table('cz_goods_attr as a,cz_goods as g');
                $this->where("g.goods_id = a.goods_id and g.is_onsale =1 and a.attr_id ='$value'");
                $this->group('a.attr_value');
                $attr_list = $this->select();

                $temp_arrt_url_arr = array();

                for ($i = 0; $i < count($cat_filter_attr); $i++)        //获取当前url中已选择属性的值，并保留在数组中
                {
                    $temp_arrt_url_arr[$i] = !empty($filter_attr[$i]) ? $filter_attr[$i] : 0;
                }

                $temp_arrt_url_arr[$key] = 0;                           //“全部”的信息生成
                $arr['filter_attr'] = implode('.', $temp_arrt_url_arr);
                $all_attr_list[$key]['attr_list'][0]['attr_value'] = L('all_attribute');
                $all_attr_list[$key]['attr_list'][0]['url'] =U('/category',$arr);
                $all_attr_list[$key]['attr_list'][0]['selected'] = empty($filter_attr[$key]) ? 1 : 0;

                foreach ($attr_list as $k => $v)
                {
                    $temp_key = $k + 1;
                    $temp_arrt_url_arr[$key] = $v['goods_id'];       //为url中代表当前筛选属性的位置变量赋值,并生成以‘.’分隔的筛选属性字符串
                    $arr['filter_attr'] = implode('.', $temp_arrt_url_arr);

                    $all_attr_list[$key]['attr_list'][$temp_key]['attr_value'] = $v['attr_value'];
                    $all_attr_list[$key]['attr_list'][$temp_key]['url'] = U('/category',$arr);

                    if (!empty($filter_attr[$key]) AND $filter_attr[$key] == $v['goods_id'])
                    {
                        $all_attr_list[$key]['attr_list'][$temp_key]['selected'] = 1;
                    }
                    else
                    {
                        $all_attr_list[$key]['attr_list'][$temp_key]['selected'] = 0;
                    }
                }
            }

        }     
        return $all_attr_list;
    }

}