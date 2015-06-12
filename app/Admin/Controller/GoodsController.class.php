<?php
namespace Admin\Controller;
use Common\Controller\AdminController;
use Think\Upload;
use Think\Image;
use Common\Library\Page;

/**
 * 商品控制器
 */

class GoodsController extends AdminController {

	protected $config = array(
		'maxSize' => '3145728', //设置上传最大大小
		'exts'    => array('jpg','png','gif','jpeg'),//设置允许上传类型
		'savePath' => './data/uploads/goods/',//设置上传目录
		'rootPath' => "./",
		'saveName' => array('uniqid',''),
		'autoSub' => true,
		'subName' => array('date','Ymd'),
		);

    public function __construct(){
        parent::__construct();
        $this->Category = D('Category');
        $this->Brand    = D('Brand');
		$this->Type 	= D('Type');
		$this->Goods   = D('Goods');
		$this->Upload  = new Upload($this->config);
		$this->Image   = new Image();
		$this->Goods_attr = M('Goods_attr');
		$this->Gallery = D('Gallery');
		$this->Attr    = M('Attribute');
    }
    //显示所有商品
    public function showlist(){

        $condition ='';
        $like = '';
    	//接收
    	 if($_GET['cat_id'] !='' && $_GET['cat_id'] !=0)
    	 {
    	 	$condition['cat_id'] = I('get.cat_id','',intval);
    	 }elseif ($_GET['brand_id'] !='' && $_GET['brand_id'] !=0) {
    	 	$condition['brand_id'] = $_GET['brand_id'];

    	 }elseif($_GET['is_onsale'] !=''){
    	 	$condition['is_onsale'] = $_GET['is_onsale'];
    	 }elseif($_GET['keyword'] !=''){
    	 	 $like= $_GET['keyword'];
    	 }

    	 if($_GET['intro_type']==1){
    	     $condition['is_best'] = 1;
    	 }elseif($_GET['intro_type'] ==2){
    	     $condition['is_new'] =1;
    	 }elseif ($_GET['intro_type'] == 3){
    	     $condition['is_hot'] =1;
    	 }elseif($_GET['is_promote']){
    	     $condition['is_promote'] =1;
    	 }

    	//获取所有品牌
    	$cat = $this->Category->getList();
    	//获取所有品牌
    	$brand = $this->Brand->getBrandList();
    	//获取商品总数
    	$total = $this->Goods->getCount($condition);
    	$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
    	$pagesize = 9;
    	$condition['limit'] = array(($curr_page -1)*$pagesize ,$pagesize);
    	$Page = new Page($total,$pagesize);
    	$pageBar = $Page->fpage();
    	//获取所有商品
    	$goods = $this->Goods->getGoodlist($condition,$like);

    	$this->assign('cat',$cat);
    	$this->assign('brand',$brand);
    	$this->assign('good',$goods);
    	$this->assign('page',$pageBar);
    	$this->display('goods_list');
    }

    /**
   	 * 添加商品信息
   	 */

    public function add(){
		if(!empty($_POST)){

				//收集POST信息并处理
			$data['goods_name'] = I('post.goods_name');//商品名称
			$data['goods_sn'] = I('post.goods_sn');//商品货号
			$data['cat_id'] = I('post.cat_id');//商品分类ID
			$data['brand_id'] = I('post.brand_id');//商品品牌ID
			$data['shop_price'] = I('post.shop_price');//本店价格
			$data['market_price'] = I('post.market_price');//市场价格
			$data['promote_price'] = I('post.promote_price');//促销价
			$data['promote_start_time'] = strtotime(I('post.promote_start_time'));//促销开始时间
			$data['promote_end_time'] = strtotime(I('post.promote_end_time'));//促销结束时间
			$data['goods_desc'] = I('post.goods_desc');//商品描述
			$data['goods_number'] = I('post.goods_number');//商品库存
			$data['warn_number'] = I('post.warn_number');//商品库存警告数量
			$data['is_best']   = I('post.is_best');//是否推荐
			$data['is_new']	   = I('post.is_new');//是否最新
			$data['is_hot']	   = I('post.is_hot');//是否热门
			$data['is_onsale'] = I('post.is_onsale');//是否上架
			$data['is_shipping'] = I('post.is_shipping');//是否免运费
			$data['goods_brief'] = I('post.goods_brief');//商品简介
			$data['type_id'] = I('post.type_id');
			
			//商品重量计算
			if(I('post.weight_unit') < 1){
				$data['goods_weight'] = I('post.goods_weight') * I('post.weight_unit');
			}else{
				$data['goods_weight'] = I('post.goods_weight');
			}
			if($data['goods_name'] == '' ){
				$this->error('商品名称不为空',U('Goods/add'),2);
			}elseif ($data['shop_price'] == '') {
				$this->error('商品价格不能为空',U('Goods/add'),2);
			}

			//图片上传
			if(!empty($_FILES['goods_img']['tmp_name'])){
				$info = $this->Upload->uploadOne($_FILES['goods_img']);
				if(!$info){
					$this->error($this->Upload->getError());
				}else{
					$data['goods_img'] = $info['savepath'] . $info['savename'];
				}
				//是否自动生成略缩图
				if( isset($_POST['auto_thumb']) && $_POST['auto_thumb']  === '1')
				{
					$this->Image->open($data['goods_img']);
					$data['goods_thumb'] = $info['savepath'] . 'thumb_' . $info['savename'];
					$this->Image->thumb(232, 231)->save($data['goods_thumb']);

				}elseif(!empty($_FILES['goods_thumb']['tmp_name'])){
				    $thumb_info = $this->Upload->uploadOne($_FILES['goods_thumb']);
				    if(!$thumb_info){
				        $this->error($this->Upload->getError());
				    }else{
				        $data['goods_thumb'] = $thumb_info['savepath'] . $thumb_info['savename'];
				    }

				}else{
					$data['goods_thumb'] = I('post.goods_thumb_url');
				}

			}

			//商品相册
		if(!empty($_FILES['img_url']['tmp_name'][0])){
                $imgs = array();
    		    foreach($_FILES['img_url'] as $k=>$v){
    		        foreach($v as $k1=>$v1){
    		            $imgs[$k1][$k] =$v1;
    		        }
    		    }
    		    foreach($imgs as $file){
			    $img_info[] = $this->Upload->uploadOne($file);
    		    }
			    if(!$img_info){

			        //$this->error($this->Upload->getError());
			    }else{
			         foreach($img_info as $val){
			             $img_url[] = $val['savepath'] . $val['savename'];

			             $thumb_url[] = $val['savepath'] . 'thumb_' . $val['savename'];

			         }

			    }

			    //批量生成相册图片的略缩图
			    $arr = array();
			    foreach($img_url as $ki=>$vi){
			        $arr[$ki]['img_url'] = $vi;
			        $arr[$ki]['thumb_url'] = $thumb_url[$ki];
                    $this->Image->open($vi);
                    $this->Image->thumb(100, 100)->save($thumb_url[$ki]);
			    }
			}

			//过滤，处理数据
			$data = $this->Goods->create($data);
			//添加商品基本信息
			if($goods_id = $this->Goods->add($data)){
			 //批量添加商品属性
			 $attr_ids = I('post.attr_id_list');
			 $attr_values = I('post.attr_value_list');
			 $attr_price = I('post.attr_price_list');
			 $this->do_attr($attr_ids, $attr_values, $attr_price, $data['type_id'], $goods_id);
// 			 foreach($attr_ids as $k=>$v){

// 			  	$datas['goods_id'] = $goods_id;
// 			  	$datas['attr_id'] =$v;
// 			  	if(!empty($attr_values[$k])){
// 			  	$datas['attr_value'] = $attr_values[$k];
// 			  	}
// 			  	$datas['attr_price'] = $attr_price[$k];
// 			  	$this->Goods_attr->add($datas);
// 			 	}
			 	$datas = array();
                foreach($arr as $kii => $vii){
                    $datas = $vii;
                    $datas['goods_id'] =$goods_id;

                    $this->Gallery->add($datas);
                }

				$this->success('商品添加成功',U('Goods/showlist'),2);
			}else{
				$this->error('商品添加失败',U('Goods/showlist'),2);
			}



		}else{
        //获取所有分类列表
        $cate = $this->Category->getList();
        //获取品牌列表信息
        $brand = $this->Brand->getBrandList();
		//获取商品属性列表
		$type = $this->Type->getList();
        //获取商品相册


        $this->assign('cate',$cate);
        $this->assign('brand',$brand);
		$this->assign('type',$type);
        $this->display('goods_add');
		}
    }

    /**
     * 编辑商品信息
     * @param string $goods_id 商品ID
     */
    public function edit($goods_id){

        //获取指定ID的商品信息
        $goods_info = $this->Goods->getOne($goods_id);

        /* 根据商品重量的单位重新计算 */
        if ($goods_info['goods_weight'] > 0)
        {
            $goods_info['goods_weight_by_unit'] = ($goods_info['goods_weight'] >= 1) ? $goods_info['goods_weight'] : ($goods_info['goods_weight'] / 0.001);
        }
        //获取商品属性信息
        $attr_info = $this->build_attr_html($goods_info['type_id'],$goods_id);
        //获取商品分类列表
        $cate = $this->Category->getlist();
        //获取商品扩展分类
        $goods_cat = M('GoodsCat')->where(array('goods_id'=>$goods_id))->select();
        //获取商品品牌列表
        $brand = $this->Brand->getBrandList();
        //获取商品类型列表
        $type = $this->Type->getList();
        //获取商品相册列表
        $gallery = $this->Gallery->getGalleryById($goods_id);

        $this->assign('build_attr_html',$attr_info);
        $this->assign('goods',$goods_info);
        $this->assign('cate',$cate);
        $this->assign('goods_cat',$goods_cat);
        $this->assign('brand',$brand);
        $this->assign('type',$type);
        $this->assign('type_id',$goods_info['type_id']);
        $this->assign('gallery',$gallery);
        $this->display('goods_edit');
    }
    /**
     * 保存商品信息
     * @param string $goods_id 商品ID
     */
    public function save(){

        //收集POST信息并处理
        $goods_id = I('post.goods_id');
        $type_id = I('post.type_id');
        $data['type_id'] = I('post.type_id');
        $data['goods_name'] = I('post.goods_name');//商品名称
        $data['goods_sn'] = I('post.goods_sn');//商品货号
        $data['cat_id'] = I('post.cat_id');//商品分类ID
        $data['brand_id'] = I('post.brand_id');//商品品牌ID
        $data['shop_price'] = I('post.shop_price');//本店价格
        $data['market_price'] = I('post.market_price');//市场价格
        $data['promote_price'] = I('post.promote_price');//促销价
        $data['promote_start_time'] = strtotime(I('post.promote_start_time'));//促销开始时间
        $data['promote_end_time'] = strtotime(I('post.promote_end_time'));//促销结束时间
        $data['goods_desc'] = I('post.goods_desc');//商品描述
        $data['goods_number'] = I('post.goods_number');//商品库存
        $data['warn_number'] = I('post.warn_number');//商品库存警告数量
        $data['is_best']   = I('post.is_best');//是否推荐
        $data['is_new']	   = I('post.is_new');//是否最新
        $data['is_hot']	   = I('post.is_hot');//是否热门
        $data['is_onsale'] = I('post.is_onsale');//是否上架
        $data['is_shipping'] = I('post.is_shipping');//是否免运费
        $data['goods_brief'] = I('post.goods_brief');//商品简介

        //商品重量计算
        if(I('post.weight_unit') < 1){
            $data['goods_weight'] = I('post.goods_weight') * I('post.weight_unit');
        }else{
            $data['goods_weight'] = I('post.goods_weight');
        }
        if($data['goods_name'] == '' ){
            $this->error('商品名称不为空',U('Goods/add'),2);
        }elseif ($data['shop_price'] == '') {
            $this->error('商品价格不能为空',U('Goods/add'),2);
        }

        //图片上传
        if(!empty($_FILES['goods_img']['tmp_name'])){
            $info = $this->Upload->uploadOne($_FILES['goods_img']);
            if(!$info){
                $this->error($this->Upload->getError());
            }else{
                $data['goods_img'] = $info['savepath'] . $info['savename'];
            }
            //是否自动生成略缩图
            if( isset($_POST['auto_thumb']) && $_POST['auto_thumb']  === '1')
            {
                $this->Image->open($data['goods_img']);
                $data['goods_thumb'] = $info['savepath'] . 'thumb_' . $info['savename'];
                $this->Image->thumb(232, 231)->save($data['goods_thumb']);

            }elseif(!empty($_FILES['goods_thumb']['tmp_name'])){
                $thumb_info = $this->Upload->uploadOne($_FILES['goods_thumb']);
                if(!$thumb_info){
                    $this->error($this->Upload->getError());
                }else{
                    $data['goods_thumb'] = $thumb_info['savepath'] . $thumb_info['savename'];
                }

            }else{
                $data['goods_thumb'] = I('post.goods_thumb_url');
            }

        }

           //  商品相册
        if(!empty($_FILES['img_url']['tmp_name'][0])){
            $imgs = array();
            foreach($_FILES['img_url'] as $k=>$v){
                foreach($v as $k1=>$v1){
                    $imgs[$k1][$k] =$v1;
                }
            }
            foreach($imgs as $file){
                $img_info[] = $this->Upload->uploadOne($file);
            }
            if(!$img_info){

                //$this->error($this->Upload->getError());
            }else{
                foreach($img_info as $val){
                    $img_url[] = $val['savepath'] . $val['savename'];

                    $thumb_url[] = $val['savepath'] . 'thumb_' . $val['savename'];

                }

            }

            //批量生成相册图片的略缩图
            $arr = array();
            foreach($img_url as $ki=>$vi){
                $arr[$ki]['img_url'] = $vi;
                $arr[$ki]['thumb_url'] = $thumb_url[$ki];
                $this->Image->open($vi);
                $this->Image->thumb(100, 100)->save($thumb_url[$ki]);
            }
        }


        //过滤，处理数据
        $data = $this->Goods->create($data);
        //添加商品基本信息
        $state = $this->Goods->where("goods_id =$goods_id")->save($data);
        if($state || $state === 0){
            //批量添加商品属性
            $attr_ids = I('post.attr_id_list');
            $attr_values = I('post.attr_value_list');
            $attr_price = I('post.attr_price_list');

          $this->do_attr($attr_ids,$attr_values,$attr_price,$type_id,$goods_id);
//             foreach($attr_ids as $k=>$v){
//                 $datas['goods_id']= $condition['goods_id'] = $goods_id;
//                 $datas['attr_id']=$condition['attr_id'] =$v;
//                 $datas['attr_value'] = $attr_values[$k];
//                 $datas['attr_price'] = $attr_price[$k];
//                 if($attr = D("Attribute")->getAttrId($goods_id,$condition['attr_id'],$datas['attr_value'])){
//                     $this->Goods_attr->where($condition)->save($datas);
//                 }else{
//                     $this->Goods_attr->add($datas);
//                 }

//             }


            if(isset($arr) && !empty($arr)){
            $datas = array();
            foreach($arr as $kii => $vii){
                $datas = $vii;
                $datas['goods_id'] =$goods_id;

                $this->Gallery->add($datas);
            }
          }

            $this->success('商品更新成功',U('Goods/showlist'),2);
        }else{
            $this->error('商品更新失败',U('Goods/showlist'),2);
        }

    }

    /**
     *  无刷新删除商品
     * @return boolean
     */
    public function del(){
        $goods_id = I('post.goods_id',0,'intval');
        if(isset($goods_id) && !empty($goods_id)){
            if($this->Goods->delete($goods_id)){
                $this->Goods_attr->where("goods_id=$goods_id")->delete();
                $data['status'] =1;
                $data['goods_id'] =$goods_id;
                $this->ajaxReturn($data);
            }
        }else{
        return false;
        }
    }

    public function up(){
        if(!empty($_POST)){
            $goods_id = I('post.checkboxes');
            $goods_id= implode(",", $goods_id);

            switch ($_POST['type']) {
                case  'trash' :
                    $this->Goods->delete($goods_id);
                    break;
                case  'on_sale' :
                    $data['is_onsale']=1;
                    $this->Goods->where("goods_id in ($goods_id)")->save($data);
                    break;
                case  'not_on_sale' :
                    $data['is_onsale']=0;
                   $this->Goods->where("goods_id in ($goods_id)")->save($data);
                    break;
                case  'best' :
                    $data['is_best']=1;
                   $this->Goods->where("is_best=1 and goods_id in ($goods_id)")->save($data);
                    break;
                case  'not_best' :
                    $data['not_best']=0;
                   $this->Goods->where("goods_id in ($goods_id)")->save($data);
                    break;
                case  'hot' :
                    $data['is_hot'] =1;
                    $this->Goods->where("goods_id in ($goods_id)")->save($data);
                    break;
                case  'not_hot' :
                    $data['is_hot'] =0;
                    $this->Goods->where("goods_id in ($goods_id)")->save($data);
                    break;
            }
            $this->success('更新成功',U('Goods/showlist'),1);
        }
    }
    /**
     * 删除商品主图
     */
    public function dropimg(){
        $goods_id = I("post.goods_id",0,'intval');
        $info = $this->Goods->find($goods_id);
        $data['goods_img'] = '';
        $data['goods_thumb'] = '';
        if ($this->Goods->where("goods_id=$goods_id")->save($data)){
            @unlink($info['goods_img']);
            @unlink($info['goods_thumb']);
            $datas['status'] = 1;
            $this->ajaxReturn($datas);
        }else{
            $datas['status'] = 0;
            $this->ajaxReturn($datas);
        }

    }

    /**
     * 删除相册图片
     */
    public function drop_image(){
        if(isset($_POST['img_id']) && !empty($_POST['img_id'])){
            $img_id = I('post.img_id');
            $img_info = $this->Gallery->find($img_id);
            if($this->Gallery->delete($img_id)){
                @unlink($img_info['img_url']);
                @unlink($img_info['thumb_url']);
                $data['img_id'] = $img_id;
                $data['status'] = 1;

            }else{
                $data['status'] =0;
            }
            $this->ajaxReturn($data);
        }
    }

    /**
     *  ajax删除商品相关属性
     */
    public function delattr(){
        $goods_id = I('post.goods_id');
        if($goods_id !=''){
            $this->Goods_attr->where("goods_id =$goods_id")->delete();
        }
    }
   	/**
   	 * 获得商品属性列表
   	 * @access public
   	 * @return  mixed
   	 */
	public function getattrlist()
	{
			$cat_id = I('post.goods_type');
			$goods_id = I('post.goods_id');

			$data['content'] = $this->build_attr_html($cat_id,$goods_id);
			$this->ajaxReturn($data);
	}


	/**
	 * 生成商品属性相关html
	 * @param string $cat_id 商品类型ID
	 * @param string $goods_id 商品ID
	 */
	protected function build_attr_html($cat_id, $goods_id = 0) {
        //查询出指定商品属性，商品ID的所有商品属性
	    $attr = D('Attribute')->get_attr_list($cat_id,$goods_id);
	    //拼凑HTML代码
	    $html = "<table width='100%' id='attrTable'>";
	    $spec = 0;
	    //遍历属性数组
	    foreach($attr as $k=>$v){
	        $html .="<tr><td class='label'>";
	        if($v['attr_type'] == 1 || $v['attr_type'] == 2){
	            $html .= ($spec != $v['attr_id']) ?
	            "<a href='javascript:;' onclick='addSpec(this)'>[+]</a>":
	            "<a href='javascript:;' onclick='removeSpec(this)'>[-]</a>";
	            $spec = $v['attr_id'];
	        }

	        $html .= "$v[attr_name]</td><td><input type='hidden' name='attr_id_list[]' value='".$v['attr_id']."'/>";
	        if($v['attr_input_type'] == 0){
	            $html .= '<input name="attr_value_list[]" type="text" value="' .htmlspecialchars($v['attr_value']). '" size="40" /> ';
	        }elseif ($v['attr_input_type'] == 2)
	        {
	        	$html .= "<textarea name='attr_value_list[]' rows='3' cols='40' >".htmlspecialchars($v['attr_value'])."</textarea>";
	        }else{
	        	$html .= "<select name='attr_value_list[]'>";
	        	$html .= "<option value=''>请选择...</option>";

	        	$attr_values = explode("\n", $v['attr_values']);

	        	foreach($attr_values as $opt){
	        		$opt = trim(htmlspecialchars($opt));
	        		$html .= ($v['attr_value'] != $opt) ?
	        			"<option value='". $opt . "'".">" . $opt . "</option>" :
	        			"<option value='" . $opt ."'"." selected ='selected'>". $opt . "</option>";

	        	}

	        	$html .= "</select>";

	        }

	        $html .=($v['attr_type'] == 1 || $v['attr_type'] == 2) ?
	        	"属性价格" . "<input type='text' name='attr_price_list[]' value='" .$v['attr_price'] . "'" . " size ='5' maxlength='10' />" :
	        	" <input type='hidden' name='attr_price_list[]' value='0' />";
	        	$html .= "</td></tr>";
	    }
	           $html .= "</table>";
	    return $html;

	}

	public function do_attr($attr_ids,$attr_values,$attr_prices,$goods_type,$goods_id){
	    /* 处理属性 */
	    if ((isset($attr_ids) && isset($attr_values)) || (empty($attr_ids) && empty($attr_values)))
	    {
	        // 取得原有的属性值
	        $goods_attr_list = array();

	        $row = $this->Attr->field('attr_id,attr_index')->where("type_id =".$goods_type)->table('cz_attribute')->select();

	        $attr_list = array();
	        foreach($row as $v){
	            $attr_list[$v['attr_id']] = $v['attr_index'];
	        }
	        $row = $this->Goods_attr->field('g.*,a.attr_type')->where('g.goods_id='.$goods_id)->join('left join cz_attribute as a on a.attr_id = g.attr_id')->table('cz_goods_attr as g')->select();


	        foreach($row as $v1){
	            $goods_attr_list[$v1['attr_id']][$v1['attr_value']] = array('sign' => 'delete', 'goods_attr_id' => $v1['goods_attr_id']);
	        }

	        // 循环现有的，根据原有的做相应处理
	        if(isset($attr_ids))
	        {

	            foreach ($attr_ids AS $key => $attr_id)
	            {

	                $attr_value = $attr_values[$key];
	                $attr_price = $attr_prices[$key];

	                if (!empty($attr_value))
	                {

	                    if (isset($goods_attr_list[$attr_id][$attr_value]))
	                    {

	                        // 如果原来有，标记为更新
	                        $goods_attr_list[$attr_id][$attr_value]['sign'] = 'update';
	                        $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
	                    }
	                    else
	                    {

	                        // 如果原来没有，标记为新增
	                        $goods_attr_list[$attr_id][$attr_value]['sign'] = 'insert';
	                        $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
	                    }


	                }
	            }
	        }

	        /* 插入、更新、删除数据 */
	        foreach ($goods_attr_list as $attr_id => $attr_value_list)
	        {

	            foreach ($attr_value_list as $attr_value => $info)
	            {

	                if ($info['sign'] == 'insert')
	                {

	                    $data['attr_id'] = $attr_id;
	                    $data['goods_id'] = $goods_id;
	                    $data['attr_value'] = $attr_value;
	                    $data['attr_price'] = $info['attr_price'];

	                    $this->Goods_attr->table('cz_goods_attr')->data($data)->add();
	                    //                     $sql = "INSERT INTO " .$ecs->table('goods_attr'). " (attr_id, goods_id, attr_value, attr_price)".
	                    //                             "VALUES ('$attr_id', '$goods_id', '$attr_value', '$info[attr_price]')";
	                }
	                elseif ($info['sign'] == 'update')
	                {

	                    $data['attr_price'] = $info[attr_price];
	                    $this->Goods_attr->table('cz_goods_attr')->where('goods_attr_id ='.$info[goods_attr_id])->save($data);
	                    //                     $sql = "UPDATE " .$ecs->table('goods_attr'). " SET attr_price = '$info[attr_price]' WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
	                }
	                else
	                {

	                    //                     $sql = "DELETE FROM " .$ecs->table('goods_attr'). " WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
	                    $this->Goods_attr->table('cz_goods_attr')->where("goods_attr_id =".$info[goods_attr_id])->delete();
	                }
	                //                 $db->query($sql);
	            }
	        }
	    }

	}

}