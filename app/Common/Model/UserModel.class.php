<?php
namespace Common\Model;
use Think\Model;

class UserModel extends Model {
    protected $_auto = array(
        array('password',md5,1,'function'),
    );

    /**
     * 获取用户列表
     * @param array $condition 查询条件，包含Limit ,user_name,eamil等字段查询
     * @return array 所有用户信息的二维数组
     */
    public function getUserList($condition =''){
        if(isset($condition['limit'])){
            $this->limit($condition['limit'][0],$condition['limit'][1]);
            unset($condition['limit']);
        }
        if(!empty($condition)){
            $this->where("user_name like '%".$condition['user_name']."%'");
        }
        return $this->field("user_id,user_name,email,reg_time,last_time,balance,last_ip")->select();
    }
    /**
     * 获取单条用户信息
     * @param string $user_id 用户ID
     * @return array 二维数组
     */
    public function getOne($user_id){
        return $this->field('user_id,user_name,email')->find($user_id);
    }

    /**
     * 获取指定ID的所有用户信息
     * @param string $user_id 用户ID
     * @return array 二维数组
     */
    public function getInfoById($user_id){
        $this->field('user_id,user_name,birthday,sex,email,msn,qq,mobile_phone,passwd_question,passwd_answer');
        return $this->find($user_id);
    }

    /**
     * 获取用户总记录
     * @param array $condition 查询条件
     */
    public function getCount($condition){
        return $this->where($condition)->count('user_id');
    }
    /**
     * 检查用户是否存在
     * @param string $username 用户名
     * @return boolean
     */
    public function check_reg($username){
        $info = $this->where("user_name = '".$username."'")->find();
        if($info){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 检测邮箱是否已被使用,如果已被使用则查询出使用者信息
     * @param unknown $email
     * @return \Think\mixed|boolean
     */
    public function check_email($email){
        $info = $this->field('user_name,email')->where("email ='".$email."'")->find();
        if($info){
            return $info;
        }else{
            return false;
        }
    }

    /**
     * 检测用户名和密码是否正确
     * @param string $username
     * @param string $password
     */
    public function checkuser($username,$password){
        $info = $this->field('user_id,password')->where("user_name='".$username."'")->find();
        if($info){
            if($info['password'] === $password){
                return $info['user_id'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


}