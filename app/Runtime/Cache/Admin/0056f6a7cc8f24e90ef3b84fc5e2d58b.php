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
<body>

<h1>
<span class="action-span"><a href="<?php echo U("Role/add");?>">添加角色</a></span>
<span class="action-span1"><a href="<?php echo U('Index/index');?>">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 角色管理 </span>
<div style="clear:both"></div>
</h1>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<div class="list-div" id="listDiv">

<table cellspacing='1' cellpadding='3' id='list-table'>
  <tr>
    <th>角色ID</th>
    <th>角色名</th>
    <th>操作</th>
  </tr>
  <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
    <td class="first-cell" ><?php echo ($vo["role_id"]); ?></td>
    <td class="first-cell" ><?php echo ($vo["role_name"]); ?></td>
    <td align="center">
    <a href="<?php echo U('Role/auth',array('role_id'=>$vo['role_id']));?>" title="分派权限"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_priv.gif" border="0" height="21" width="21"></a>&nbsp;&nbsp;
      <a href="<?php echo U('Role/edit',array('role_id'=>$vo['role_id']));?>" title="编辑"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_edit.gif" border="0" height="16" width="16"></a>&nbsp;&nbsp;
      <a href="#" onclick="del(this,<?php echo ($vo['role_id']); ?>)" title="移除"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_drop.gif" border="0" height="16" width="16"></a></td>
  </tr><?php endforeach; endif; ?>
 
  </table>
 <?php echo ($page); ?>
</div>

<div id="footer">
共执行 2 个查询，用时 0.020001 秒，Gzip 已禁用，内存占用 2.040 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

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
function del(tmp,roleid){
	if(confirm('您确认要删除这条记录吗?')){
		$.post("<?php echo U('Role/del');?>",{role_id:roleid},function(data){
			if(data.status){
				$(tmp).parent().parent().remove();
			}
		});
	}
}
</script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tables.js"></script>
</body>
</html>