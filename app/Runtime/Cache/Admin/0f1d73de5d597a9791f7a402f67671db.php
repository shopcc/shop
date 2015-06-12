<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/general.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/main.css" />
	  <link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/assets/css/amazeui.min.css" />
	<script type="text/javascript" src="<?php echo (RESOURCE); ?>/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (RESOURCE); ?>/assets/js/amazeui.min.js"></script>
</head>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
var process_request = "正在处理您的请求...";
var todolist_caption = "记事本";
var todolist_autosave = "自动保存";
var todolist_save = "保存";
var todolist_clear = "清除";
var todolist_confirm_save = "是否将更改保存到记事本？";
var todolist_confirm_clear = "是否清空内容？";
var user_name_empty = "管理员用户名不能为空!";
var password_invaild = "密码必须同时包含字母及数字且长度不能小于6!";
var email_empty = "Email地址不能为空!";
var email_error = "Email地址格式不正确!";
var password_error = "两次输入的密码不一致!";
var captcha_empty = "您没有输入验证码!";
//-->
</script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Auth/showlist');?>">权限列表</a></span>
<span class="action-span1"><a href="/Admin/Index/index">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加权限 </span>
<div style="clear:both"></div>
</h1>
<form method="POST" action="<?php echo U('Auth/add');?>" name="theFrom" id="theFrom">
<div class="list-div">
<table width="100%">
  <tr>
    <td class="label">权限名称</td>
    <td>
      <input type="text" name="auth_name" class="in" id="auth_name" maxlength="20" value="" size="34"/><span class="require-field" id="check_name">*</span></td>
  </tr>
  <tr>
    <td class="label">行为名称</td>
    <td>
      <input type="text" name="auth_c" class="in" id="auth_c" maxlength="20" value="" size="34"/><span class="require-field" id="check_name">*</span></td>
  </tr>
  <tr>
    <td class="label">方法名称</td>
    <td>
      <input type="text" name="auth_a" class="in" id="auth_a" maxlength="20" value="" size="34"/><span class="require-field" id="check_name">*</span></td>
  </tr>
  <tr>
    <td class="label">上级权限</td>
    <td>
      <select name="auth_pid">
			<option value="0">顶级权限</option>
			<?php if(is_array($auth)): foreach($auth as $key=>$vo): ?><option value="<?php echo ($vo["auth_id"]); ?>"><?php echo str_repeat("--",$vo['level']);?>|<?php echo ($vo["auth_name"]); ?></option><?php endforeach; endif; ?>
	  <span class="require-field" id="check_name">*</span></td>
  </tr>
  <tr>
    <td class="label">权限级别</td>
    <td>
      <input type="text" name="auth_level" class="in" id="auth_level" maxlength="4" value="" size="4"/><span class="require-field" id="check_name">0[顶级菜单]1[子菜单] 2[其他操作]</span></td>
  </tr>
  <tr>
    <td align="center" colspan="2" >
      <input type="submit" id="btnSubmit" name="Submit" class="button" / value="保存">&nbsp;&nbsp;&nbsp;
      <input type="reset" value=" 重置 " class="button" />
    </td>
  </tr>
  </table>
</div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.088005 秒，Gzip 已禁用，内存占用 2.139 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>

<script language="JavaScript">
	$(document).ready(function(){
		 $("#btnSubmit").click(function(){
			var issubmit = true;
			var i_index =0;
			$('#theFrom').find('.in').each(function(i){
				if($.trim($(this).val()).length == 0){
					$(this).parent().children('span').html('请填写内容');
					issubmit =false;
					
					if(i_index ==0)i_index =i;
				}
			});
			
			if(!issubmit){
				$('#theFrom').find('.in').eq(i_index).focus();
				return false;
			}
			
		});
		
	});
</script>
</body>
</html>