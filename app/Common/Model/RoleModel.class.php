<?php
namespace Common\Model;
use Think\Model;

/**
 * 角色管理模型
 */
class RoleModel extends Model{

    /**
     * 获取角色列表
     */
    public function getRoleList($limit=''){
        if(is_array($limit) && !empty($limit)){
            $this->limit($limit[0],$limit[1]);
        }
        return $this->select();
    }
    /**
     * 获取角色总记录
     */
    public function getCount(){
       return $this->Count('role_id');
    }
    public function getOne($role_id){
        return $this->find($role_id);
    }

}