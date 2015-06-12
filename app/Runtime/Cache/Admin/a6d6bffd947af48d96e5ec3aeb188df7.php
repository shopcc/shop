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
<span class="action-span"><a href="/Admin/Manager/add">添加管理员</a></span>
<span class="action-span1"><a href="/Admin/Index/index">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 管理员列表 </span>
<div style="clear:both"></div>
</h1>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<div class="list-div" id="listDiv">

<table cellspacing='1' cellpadding='3' id='list-table'>
  <tr>
    <th>用户名</th>
    <th>Email地址</th>
    <th>加入时间</th>
    <th>最后登录时间</th>
    <th>操作</th>
  </tr>
  <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
    <td class="first-cell" ><?php echo ($vo["username"]); ?></td>
    <td align="left"><?php echo ($vo["email"]); ?></td>
    <td align="center"><?php echo (date('Y-m-d H:i:s',$vo["add_time"])); ?></td>
    <td align="center"><?php echo ($vo["last_time"]); ?></td>
    <td align="center">
      <a href="admin_logs.php?act=list&id=1" title="查看日志"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_view.gif" border="0" height="21" width="21"></a>&nbsp;&nbsp;
      <a href="<?php echo U('Manager/edit',array('admin_id'=>$vo['admin_id']));?>" title="编辑"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_edit.gif" border="0" height="21" width="21"></a>&nbsp;&nbsp;
      <a href="#" onclick="del(this,<?php echo ($vo["admin_id"]); ?>)" title="移除"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_drop.gif" border="0" height="21" width="21"></a></td>
  </tr><?php endforeach; endif; ?>
  </table>

</div>

<div id="footer">
共执行 2 个查询，用时 0.026001 秒，Gzip 已禁用，内存占用 2.157 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script>
function del(tmp,adminid){
	if(confirm('您确认要删除这条记录吗?')){
		$.post("<?php echo U('Manager/del');?>",{admin_id:adminid},function(data){
			if(data.status){
				$(tmp).parent().parent().remove();
			}
		});
	}
}
</script>
</body>
</html>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tables.js"></script>