<?php
namespace Common\Model;
use Think\Model;

class AuthModel extends Model {

    /**
     * 获取所有权限的二维数组
     * @return multitype:array
     */
    public function getAuthList(){
        $info = $this->order('auth_id asc')->select();
        return $this->AuthTree($info);
    }

    /**
     *
     * @param array $arr 权限二维数组
     * @param string $pid 权限父ID
     * @param string $leve 权限等级
     * @return multitype:array 返回数组
     */
    public function AuthTree($arr,$pid='0',$leve='0'){
        static $tree = array();
        foreach($arr as $val){
            if($val['auth_pid'] == $pid){
                $val['level'] =$leve;
                $tree[] =$val;
                $this->AuthTree($arr,$val['auth_id'],$leve+1);
            }
        }
        return $tree;
    }
    /**
     * 获得指定权限ID的相关信息
     * @param string $authid
     * @return \Think\mixed
     */
    public function getOne($authid){
        return $this->find($authid);
    }

}