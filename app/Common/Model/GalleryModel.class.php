<?php
namespace Common\Model;
use Think\Model;

class GalleryModel extends Model {

    public function getGalleryById($goods_id){
        $condition['goods_id'] = $goods_id;
        return $this->where($condition)->select();
    }
}