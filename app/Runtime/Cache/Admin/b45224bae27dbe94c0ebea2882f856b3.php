<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/main.css" />
<style type="text/css">
body {
  color: white;
}
</style>

</head>
<body style="background: #278296">
<form method="post" action="<?php echo U('Public/checklogin');?>" name='theForm'>
  <table cellspacing="0" cellpadding="0" style="margin-top: 100px" align="center">
  <tr>
    <td><img src="<?php echo (ADMIN_RES_PATH); ?>/images/login.png" width="178" height="256" border="0" alt="ECSHOP" /></td>
    <td style="padding-left: 50px">
      <table>
      <tr>
        <td>管理员姓名：</td>
        <td><input type="text" name="username" value="" /></td>
      </tr>
      <tr>
        <td>管理员密码：</td>
        <td><input type="password" name="password" value="" /></td>
      </tr>
      <tr>
        <td>验证码：</td>
        <td><input type="text" name="captcha" class="capital" value="" /></td>
      </tr>
      <tr>
      <td colspan="2" align="right"><img src="<?php echo U('Public/Captcha');?>" width="145" height="40" alt="CAPTCHA" border="1" onclick= this.src="<?php echo U('Public/Captcha');?>#"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。" />
      </td>
      </tr>
      <tr><td colspan="2"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember">请保存我这次的登录信息</label></td></tr>
      <tr><td>&nbsp;</td><td><input type="submit" value="进入管理中心" class="button" /></td></tr>
      <tr>
        <td colspan="2" align="right">&raquo; <a href="../" style="color:white">返回首页</a> &raquo; <a href="get_password.php?act=forget_pwd" style="color:white">你忘记了密码吗？</a></td>
      </tr>
      </table>
    </td>
  </tr>
  </table>
</form>

</body>