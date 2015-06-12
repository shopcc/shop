<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 分类控制器
 */
class CategoryController extends Controller {

	public function __construct(){
		parent::__construct();
		$this->Cate = D('Category');
		$this->Goods = D('Goods');
		$this->Attr = D('Attribute');

	}
	public function _empty($cid=0){
		$cid = intval($cid);//分类ID取整数
		$this->_showlist($cid);
	}
	public function _showlist($cid=0){
		$brand = I('request.brand');
		$filter_attr = I('request.filter_attr');
		$filter_attr_str = isset($filter_attr) ? $filter_attr : '0';
		$filter_attr_str = preg_match('/^[\d\.]+$/',$filter_attr_str) ? $filter_attr_str : '';
		$filter_attr = empty($filter_attr_str) ? '' : explode('.', $filter_attr_str);
		$page =I('request.page');
		$page = isset($page) ? $page : '1';
		$pagesize = 12;
		
		//获取分类相关信息
		$cat = $this->get_cat_info($cid);


		//根据传入分类ID判断该分类下是否存在子分类,存在则全部输出

		$ids = $this->Cate->goodsSubClassTree($cid);

		//指定分类ID的所有子分类ID
		$children = implode(",", $ids);

		//品牌筛选
		$brand_model = M('Brand');
		// $map['g.goods_id'] = array('in',get_extension_goods($ids));
        $map['g.is_onsale'] = array('eq',1);
        $map['_string'] ="(g.cat_id in (".$children.") or gc.cat_id in (".$children.")) and b.brand_id = g.brand_id";
		$brand_model->field('b.brand_id,b.brand_name,count(*) as goods_num');

        $brand_model->table('__BRAND__ as b, __GOODS__ as g');
        $brand_model->join('left join __GOODS_CAT__ as gc on  g.goods_id = gc.goods_id');
        
        
        $brand_model->group('b.brand_id')->having('goods_num>0');
        $brand_model->order('b.sort_order,b.brand_id asc');

        $brand_model->where($map);
        $brands = $brand_model->select();
      
      
        foreach ($brands AS $key => $val){
        $temp_key = $key + 1;
        $brands[$temp_key]['brand_name'] = $val['brand_name'];
        $brands[$temp_key]['url'] = U('/category',"&cid={$cid}&brand={$val['brand_id']}");

        /* 判断品牌是否被选中 */
        if ($brand == $brands[$key]['brand_id'])
        {
            $brands[$temp_key]['selected'] = 1;
        }
        else
        {
            $brands[$temp_key]['selected'] = 0;
        }
    }

    $brands[0]['brand_name'] = L('all_attribute');
    $brands[0]['url'] = U('/category/',array('cid'=>$cid));
    $brands[0]['selected'] = empty($brand) ? 1 : 0;


    /* 属性筛选 */
    $ext = ''; //商品查询条件扩展
    if ($cat['filter_attr'] > 0)
    {

        $cat_filter_attr = explode(',', $cat['filter_attr']);       //提取出此分类的筛选属性
        $all_attr_list = array();
		
        foreach ($cat_filter_attr AS $key => $value)
        {
        	$where['g.cat_id']  = array('in', $children);
			$where['g.goods_id']  = array('in', get_extension_goods($children));
			$where['_logic'] = 'or';
			$maps['_complex'] = $where;
			$this->Attr->field('a.attr_name');
            $this->Attr->table('cz_attribute as a,cz_goods_attr as ga,cz_goods as g');
            $this->Attr->where($maps);
            $this->Attr->where("a.attr_id =ga.attr_id and g.goods_id = ga.goods_id and g.is_onsale = 1 AND a.attr_id=$value");

            if($temp_name = $this->Attr->find())
            {
            	
                $all_attr_list[$key]['filter_attr_name'] = $temp_name['attr_name'];

                $wheres['g.cat_id']  = array('in', $children);
				$wheres['g.goods_id']  = array('in', get_extension_goods($children));
				$wheres['_logic'] = 'or';
				$map_s['_complex'] = $wheres;
				$this->Attr->field('a.attr_id,min(a.goods_attr_id) as goods_id,a.attr_value as attr_value');
                $this->Attr->table('cz_goods_attr as a,cz_goods as g');
                $this->Attr->where($map_s);
                $this->Attr->where("g.goods_id = a.goods_id and g.is_onsale =1 and a.attr_id ='$value'");
                $this->Attr->group('a.attr_value');
                $attr_list = $this->Attr->select();
                
                $temp_arrt_url_arr = array();

                for ($i = 0; $i < count($cat_filter_attr); $i++)        //获取当前url中已选择属性的值，并保留在数组中
                {
                    $temp_arrt_url_arr[$i] = !empty($filter_attr[$i]) ? $filter_attr[$i] : 0;
                }

                $temp_arrt_url_arr[$key] = 0;                           //“全部”的信息生成
                $temp_arrt_url = implode('.', $temp_arrt_url_arr);
                $all_attr_list[$key]['attr_list'][0]['attr_value'] = L('all_attribute');
                $all_attr_list[$key]['attr_list'][0]['url'] = U('/category',
array('cid'=>$cid, 'brand'=>$brand, 'filter_attr'=>$temp_arrt_url));
                $all_attr_list[$key]['attr_list'][0]['selected'] = empty($filter_attr[$key]) ? 1 : 0;

                foreach ($attr_list as $k => $v)
                {
                    $temp_key = $k + 1;
                    $temp_arrt_url_arr[$key] = $v['goods_id'];       //为url中代表当前筛选属性的位置变量赋值,并生成以‘.’分隔的筛选属性字符串
                    $temp_arrt_url = implode('.', $temp_arrt_url_arr);

                    $all_attr_list[$key]['attr_list'][$temp_key]['attr_value'] = $v['attr_value'];
                    $all_attr_list[$key]['attr_list'][$temp_key]['url'] = U('/category',
array('cid'=>$cid, 'brand'=>$brand, 'filter_attr'=>$temp_arrt_url));
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

        /* 扩展商品查询条件 */
        if (!empty($filter_attr))
        {
        	
        
            $ext_group_goods = array();

            foreach ($filter_attr AS $k => $v)                      // 查出符合所有筛选属性条件的商品id */
            {
                if (is_numeric($v) && $v !=0 &&isset($cat_filter_attr[$k]))
                {
                	$this->Attr->field("DISTINCT(b.goods_id)");
        			$this->Attr->table("cz_goods_attr as a,cz_goods_attr as b");
                	// $at[''] = '';
                	$this->Attr->where('b.attr_value = a.attr_value');
                	$at['b.attr_id'] = $cat_filter_attr[$k];
                	// $this->Attr->where(" = ");
                	$at['a.goods_attr_id'] = $v;
                	$this->Attr->where($at);
                    
                    $ext_group_goods = $this->Attr->select();
				   
                }
            }
            foreach ($ext_group_goods as $key => $value) {
            	# code...
            	$ext .=$value['goods_id'].",";
            }
            $ext = substr($ext, 0,-1);
        }
    }	


		//商品列表
		$goods = $this->Goods->get_goods_list($children,$brand,$page,$pagesize,$ext);

		//获取商品总数
		
		$total = $this->Goods->get_cagtegory_goods_count($children,$brand,$ext);
		$totals = ceil($total/12);
		if($totals <=1) {$visiblePages =1;}else{$visiblePages=2;}
		//面包屑导航
		$t_nav = $this->Cate->get_cat_by_id($cid);
      
       //重组属性值
       
       if(is_array($filter_attr)){
            $filter_attrs = '';
            foreach($filter_attr as $v){
                if($v > 0)
                {
                    $filter_attrs .= $v.",";
                }
                
           }
            $filter_attrs = substr($filter_attrs, 0,-1);
       }
       
		//获取左侧分类信息
		$this->assign('cate',getclass($cid));
		$this->assign('goods_history',history_log());
		$this->assign('total',$totals);
        $this->assign('visiblePages',$visiblePages);
		$this->assign('cid',$cid);
        $this->assign('brand',$brand);
        $this->assign('filter_attrs',$filter_attrs);
		$this->assign('goods',$goods);//商品列表
		$this->assign('brands',$brands);//品牌筛选列表
		$this->assign('filter_attr_list',$all_attr_list);
		$this->assign('t_nav',$t_nav);//面包屑
		$this->display("category");//模板输出
	}

	/**
	 * 获得分类的信息
	 *
	 * @param   integer $cat_id
	 * @return  void
	 */
public function get_cat_info($cat_id)
{
    $this->Cate->field('cat_name,cat_desc,filter_attr,parent_id');
    return $this->Cate->where("cat_id = $cat_id")->find();

}

public function pages(){
        $cid = I('post.cid');
        $brand = I('request.brand');
        $filter_attr = I('request.filter_attr');
        $filter_attr_str = isset($filter_attr) ? $filter_attr : '0';
        $filter_attr = empty($filter_attr_str) ? '' : explode(',', $filter_attr_str);
        $page =I('request.page');
        $page = isset($page) ? $page : '1';
        $pagesize = 12;
        
        //获取分类相关信息
        $cat = $this->get_cat_info($cid);


        //根据传入分类ID判断该分类下是否存在子分类,存在则全部输出

        $ids = $this->Cate->goodsSubClassTree($cid);
        //指定分类ID的所有子分类ID
        $children = implode(",", $ids);
        

        //品牌筛选
        $brand_model = M('Brand');
        $map['g.cat_id'] = array('in',$ids);
        // $map['g.goods_id'] = array('in',get_extension_goods($ids));
        $map['g.is_onsale'] =array('eq','1');
        $brand_model->field('b.brand_id,b.brand_name,count(*) as goods_num');
        $brand_model->table('cz_brand as b,cz_goods as g');
        $brand_model->where($map);
        $brand_model->where('g.brand_id=b.brand_id');
        $brand_model->group('b.brand_id')->having('goods_num>0');
        $brand_model->order('b.sort_order,b.brand_id asc');
        $brands = $brand_model->select();

        foreach ($brands AS $key => $val){
        $temp_key = $key + 1;
        $brands[$temp_key]['brand_name'] = $val['brand_name'];
        $brands[$temp_key]['url'] = U('/category',"&cid={$cid}&brand={$val['brand_id']}");

        /* 判断品牌是否被选中 */
        if ($brand == $brands[$key]['brand_id'])
        {
            $brands[$temp_key]['selected'] = 1;
        }
        else
        {
            $brands[$temp_key]['selected'] = 0;
        }
    }

    $brands[0]['brand_name'] = L('all_attribute');
    $brands[0]['url'] = U('/category/',array('cid'=>$cid));
    $brands[0]['selected'] = empty($brand) ? 1 : 0;


    /* 属性筛选 */
    $ext = ''; //商品查询条件扩展
    if ($cat['filter_attr'] > 0)
    {

        $cat_filter_attr = explode(',', $cat['filter_attr']);       //提取出此分类的筛选属性
        $all_attr_list = array();
        
        foreach ($cat_filter_attr AS $key => $value)
        {
            $where['g.cat_id']  = array('in', $children);
            $where['g.goods_id']  = array('in', get_extension_goods($children));
            $where['_logic'] = 'or';
            $maps['_complex'] = $where;
            $this->Attr->field('a.attr_name');
            $this->Attr->table('cz_attribute as a,cz_goods_attr as ga,cz_goods as g');
            $this->Attr->where($maps);
            $this->Attr->where("a.attr_id =ga.attr_id and g.goods_id = ga.goods_id and g.is_onsale = 1 AND a.attr_id=$value");

            if($temp_name = $this->Attr->find())
            {
                
                $all_attr_list[$key]['filter_attr_name'] = $temp_name['attr_name'];

                $wheres['g.cat_id']  = array('in', $children);
                $wheres['g.goods_id']  = array('in', get_extension_goods($children));
                $wheres['_logic'] = 'or';
                $map_s['_complex'] = $wheres;
                $this->Attr->field('a.attr_id,min(a.goods_attr_id) as goods_id,a.attr_value as attr_value');
                $this->Attr->table('cz_goods_attr as a,cz_goods as g');
                $this->Attr->where($map_s);
                $this->Attr->where("g.goods_id = a.goods_id and g.is_onsale =1 and a.attr_id ='$value'");
                $this->Attr->group('a.attr_value');
                $attr_list = $this->Attr->select();

                $temp_arrt_url_arr = array();

                for ($i = 0; $i < count($cat_filter_attr); $i++)        //获取当前url中已选择属性的值，并保留在数组中
                {
                    $temp_arrt_url_arr[$i] = !empty($filter_attr[$i]) ? $filter_attr[$i] : 0;
                }

                $temp_arrt_url_arr[$key] = 0;                           //“全部”的信息生成
                $temp_arrt_url = implode('.', $temp_arrt_url_arr);
                $all_attr_list[$key]['attr_list'][0]['attr_value'] = L('all_attribute');
                $all_attr_list[$key]['attr_list'][0]['url'] = U('/category',
array('cid'=>$cid, 'brand'=>$brand, 'filter_attr'=>$temp_arrt_url));
                $all_attr_list[$key]['attr_list'][0]['selected'] = empty($filter_attr[$key]) ? 1 : 0;

                foreach ($attr_list as $k => $v)
                {
                    $temp_key = $k + 1;
                    $temp_arrt_url_arr[$key] = $v['goods_id'];       //为url中代表当前筛选属性的位置变量赋值,并生成以‘.’分隔的筛选属性字符串
                    $temp_arrt_url = implode('.', $temp_arrt_url_arr);

                    $all_attr_list[$key]['attr_list'][$temp_key]['attr_value'] = $v['attr_value'];
                    $all_attr_list[$key]['attr_list'][$temp_key]['url'] = U('/category',
array('cid'=>$cid, 'brand'=>$brand, 'filter_attr'=>$temp_arrt_url));
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

        /* 扩展商品查询条件 */
        if (!empty($filter_attr))
        {
            
        
            $ext_group_goods = array();

            foreach ($filter_attr AS $k => $v)                      // 查出符合所有筛选属性条件的商品id */
            {
              
                if (is_numeric($v) && $v !=0 &&isset($cat_filter_attr[$k]))
                {
                    $this->Attr->field("DISTINCT(b.goods_id)");
                    $this->Attr->table("cz_goods_attr as a,cz_goods_attr as b");
                    // $at[''] = '';
                    $this->Attr->where('b.attr_value = a.attr_value');
               
                    $this->Attr->where(array(
                        'b.attr_id'=>array('eq',$cat_filter_attr[$k]),
                        'a.goods_attr_id'=>array('eq',$v),
                        ));
                    
                    $ext_group_goods[] = $this->Attr->select();
                 
                }
                
            }

            foreach ($ext_group_goods as $key => $value) {
                foreach($value as $k1=>$v1){
                     $ext .=$v1['goods_id'].",";
                }
                # code...
               
            }

            $ext = substr($ext, 0,-1);

        }

    }   


        //商品列表
        $goods = $this->Goods->get_goods_list($children,$brand,$page,$pagesize,$ext);

        //获取商品总数
        
        $total = $this->Goods->get_cagtegory_goods_count($children,$brand,$ext);
        $totals = ceil($total/12);
        if($totals <=1) {$visiblePages =1;}else{$visiblePages=2;}
        //面包屑导航
        $t_nav = $this->Cate->get_cat_by_id($cid);
        $html = '';
        foreach($goods as $v){
            $html .= "<div class='goodsItem'>";
            $html .= "<a href='".U('goods/detail',array('id'=>$v['goods_id']))."'><img class='goodsimg' alt='".$v['goods_name']."' src='../".$v['goods_thumb']."'></a><br>";
            $html .= "<p><a title='".$v['goods_name']."' href='".U('goods/detail',array('id'=>$v['goods_id']))."'>".$v['goods_name']."</a></p>";
            $html .= "市场价：<font class='market_s'>".$v['shop_price']."</font><br>";
            $html .="</div>";
            }

         $this->ajaxReturn($html);
                                    
                                                                        
                                     
        
}

}