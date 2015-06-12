<?php
namespace Common\Model;
use Think\Model;

/**
 * 管理员模型
 */

class AdminModel extends Model {

    protected $_auto = array(
      array('add_time','time',1,'function'),
      array('password','md5',1,'function'),
    );

    /**
     * 检测用户名和密码是否在数据库中存在
     * @param string $user 用户名
     * @param string $pass 密码
     * @return bool
     */
    public function checkuser($user,$pass){
        $info = $this->where("username ='$user'")->find();
        if($info){
            if($pass === $info['password']){
                return $info;
            }else{
                return false;
            }
        }
        return false;
    }
    /**
     * 获得管理员列表
     * @return array() 管理员列表
     */
    public function getAdminList(){
        return $this->select();
    }

    /**
     * 获得指定ID的管理员详细信息
     * @param string $admin_id 管理员ID
     * @return \Think\mixed
     */
    public function getOne($admin_id){
        return $this->find($admin_id);
    }
}