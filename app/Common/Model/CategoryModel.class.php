<?php
namespace Common\Model;
use Think\Model;

class CategoryModel extends Model {

    /**
     * 获取商品所有分类
     * @return array 分类二维数组
     */
    public function getList(){
        $this->field('cz_category.*,count(cz_goods.goods_id) as count');
        $this->join('left join cz_goods on cz_category.cat_id = cz_goods.cat_id ');
        $this->group('cz_category.cat_id');
       $list = $this->order('cz_category.cat_id asc')->select();
       return $this->goodsClassTree($list);
    }

    /**
     * 获取当前分类的同级分类列表
     * @param string $cat_id 分类ID
     */
    public function get_categories_tree($cat_id = 0){
        if($cat_id > 0){
            $parent = $this->field('parent_id')->where("cat_id = $cat_id")->find();
            $parent_id = $parent['parent_id']; 
        }else{
            $parent_id = 0;
        }

    /**
     *  判断当前分类中全是是否是底级分类，
     *  如果是取出底级分类上级分类，
     *  如果不是取当前分类及其下的子分类
     */
        $count = $this->where("parent_id = $parent_id and is_show =1")->count('*');
        if($count || $parent_id ==0){
                $this->field('cat_id,cat_name,parent_id,is_show');
                $this->where("parent_id = $parent_id and is_show=1");
                $res = $this->order("sort_order ASC, cat_id ASC")->select();
                
        foreach($res as $row){
            if ($row['is_show']){
                $cat_arr[$row['cat_id']]['show_in_nav'] = $row['show_in_nav'];
                $cat_arr[$row['cat_id']]['id']   = $row['cat_id'];
                $cat_arr[$row['cat_id']]['cat_name'] = $row['cat_name'];
                $cat_arr[$row['cat_id']]['url']  = U('/category/', array('cid' => $row['cat_id']));

                if (isset($row['cat_id']) != NULL)
                {
                    $cat_arr[$row['cat_id']]['cat_id'] = $this->get_child_tree($row['cat_id']);
                }
            }
            }
          
        }
        if(isset($cat_arr)){
            return $cat_arr;
        }

    }

    public function get_child_tree($tree_id = 0){
    $three_arr = array();
    $count = $this->where("parent_id = '$tree_id' and is_show=1")->count('*');
    
    if ($count || $tree_id == 0)
    {
        $this->field('cat_id,cat_name,parent_id,is_show');
        $this->where("parent_id ='$tree_id' and is_show =1");
        $child = $this->order("sort_order ASC, cat_id ASC")->select();
       
        foreach ($child AS $row)
        {
            if ($row['is_show'])

               $three_arr[$row['cat_id']]['id']   = $row['cat_id'];
               $three_arr[$row['cat_id']]['cat_name'] = $row['cat_name'];
               $three_arr[$row['cat_id']]['url']  = U('/category/', array('cid' => $row['cat_id']));

               if (isset($row['cat_id']) != NULL)
                   {
                       $three_arr[$row['cat_id']]['cat_id'] = $this->get_child_tree($row['cat_id']);

            }
        }
    }
    return $three_arr;
    }


    /**
     * 商品分类树
     * @param array $arr 商品分类列表数组
     * @param string $pid 商品父ID
     * @param string $level 分类级别
     * @return array() $tree 整理后的分类列表
     */
    public function goodsClassTree($arr ,$pid='0', $level='0'){
        static $tree = array();
        foreach($arr as $v){
            if($v['parent_id'] == $pid){
                $v['level'] = $level;
                $tree[] = $v;
                $this->goodsClassTree($arr, $v['cat_id'],$level+1);
            }
        }
        return $tree;
    }

    /**
     * 获取当前分类下是否存子分类，存在就加入的新数组
     * @param string $cat_id
     * @return array $list 分类ID数组
     */
    public function goodsSubClassTree($cat_id){
        //定义一个新数组
        $ids = array();
        //查询所有的商品分类
        $category = $this->select();
        //查询父ID，按ID级别生成新商品分类数组
        $list = $this->goodsClassTree($category,$cat_id);

        foreach($list as $v){
            $ids[] = $v['cat_id'];
        }
            $ids[] = $cat_id;
           
        return $ids;
    }

    /**
     *  递归分类，嵌套多层分类
     * @param $arr  array()分类列表的二维数组
     * @param  $pid string 分类ID
     * @return void();
     */
    public function getSubTreeList($arr,$pid=0){
        $tree = array();
        foreach($arr as $v){
            if($v['parent_id'] == $pid){
                $v['child'] = $this->getSubTreeList($arr,$v['cat_id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }
    /**
     * 首页分类
     */
    public function HomeCategory(){
        $cate = $this->select();
        return $this->getSubTreeList($cate);
    }

    public function get_cat_by_id($cid){
        //SELECT c1.cat_id,c1.cat_name,c1.`parent_id`,c2.cat_name AS parent_name FROM cz_category AS c1 LEFT JOIN cz_category AS c2 ON c1.parent_id = c2.cat_id WHERE c1.`cat_id`=2;
        $this->field('c1.cat_id,c1.cat_name,c1.parent_id,c2.cat_name as parent_name');
        $this->join('left join cz_category as c2 on c1.parent_id = c2.cat_id');
       return $this->alias('c1')->where("c1.cat_id = $cid")->find();
    }

}