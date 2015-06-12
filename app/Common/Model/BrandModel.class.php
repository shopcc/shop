<?php
namespace Common\Model;
use Think\Model;

/**
 * 商品品牌模型
 */
class BrandModel extends Model{
    public function getBrandList(){
        $list = $this->order('brand_id asc')->select();
        return $list;
    }

    //获得当前品牌的总记录
    public function getcount($condition=''){
        if(empty($condition)){
            return $this->count('brand_id');
        }else {
            return $this->where($condition)->count('brand_id');
        }

    }
    /**
     * 获取单条品牌信息
     * @param string $brand_id 品牌ID
     * @return array 数组
     */
    public function getOne($brand_id){
       $condition['brand_id'] = $brand_id;
       return $this->where($condition)->find();
    }

  
}