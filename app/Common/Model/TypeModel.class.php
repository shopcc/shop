<?php
namespace Common\Model;
use Think\Model;

/**
 * 商品类型模型
 */
class TypeModel extends Model {
    protected $tableName = 'goods_type';

    /**
     * 获取所有的商品属性
     * @return \Think\mixed
     */
    public function getList(){
        return $this->select();
    }
    /**
     * 获取商品类型总数量
     */
    public function getcount(){
        return $this->count('type_id');
    }

    /**
     * 获取单个商品属性信息
     */
    public function getOne($type_id){
        return $this->find($type_id);
    }

}