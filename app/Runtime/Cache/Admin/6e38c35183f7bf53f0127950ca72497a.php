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
<span class="action-span"><a href="<?php echo U('User/add');?>">添加会员</a></span>
<span class="action-span1"><a href="/Admin/Index/main">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 会员列表 </span>
<div style="clear:both"></div>
</h1>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>


<div class="form-div">
  <form action="<?php echo U('User/showlist');?>" name="searchForm" method="get">
    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    &nbsp;会员名称 &nbsp;<input type="text" name="keyword" /> <input type="submit" value=" 搜索 " />
  </form>
</div>

<form method="POST" action="<?php echo U('User/del_all');?>" name="listForm" onsubmit="return confirm_bath()">

<!-- start users list -->
<div class="list-div" id="listDiv">
<!--用户列表部分-->
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input name="selectAll" id="selectAll" type="checkbox">
      </th>
	 <th>编号<img src="<?php echo (ADMIN_RES_PATH); ?>/images/sort_desc.gif"></th>
    <th>会员名称</th>
    <th>邮件地址</th>
    <th>是否已验证</th>
    <th>可用资金</th>
    <th>注册日期</th>
	<th>最后登录日期</th>
	<th>最近登录IP</th>
    <th>操作</th>
  </tr>
<?php if(is_array($user)): foreach($user as $key=>$vo): ?><tr>
    <td><input type="checkbox" name="checkboxes[]" value="<?php echo ($vo["user_id"]); ?>" notice="0"/></td>
	<td><?php echo ($vo["user_id"]); ?></td>
    <td class="first-cell"><?php echo ($vo["user_name"]); ?></td>
    <td><?php echo ($vo["email"]); ?></td>
    <td align="center"> <img src="<?php echo (ADMIN_RES_PATH); ?>/images/no.gif"> </td>
    <td><?php echo ($vo["balance"]); ?></td>
    <td><?php echo (date("Y-m-d",$vo["reg_time"])); ?></td>
    <td><?php echo (date("Y-m-d",$vo["last_time"])); ?></td>
    <td><?php echo ($vo["last_ip"]); ?></td>
    <td align="center">
      <a href="<?php echo U('User/edit',array('user_id'=>$vo['user_id']));?>" title="编辑"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_edit.gif" border="0" height="21" width="21" /></a>
      <a href="users.php?act=address_list&id=6" title="收货地址"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/book_open.gif" border="0" height="21" width="21" /></a>
      <a href="order.php?act=list&user_id=6" title="查看订单"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_view.gif" border="0" height="21" width="21" /></a>
      <a href="#" title="移除" onclick="del(this,<?php echo ($vo["user_id"]); ?>)"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_drop.gif" border="0" height="21" width="21" /></a>
    </td>
  </tr><?php endforeach; endif; ?>
    <tr>
      <td colspan="2">
      <input type="hidden" name="act" value="batch_remove" />
      <input type="submit" id="btnSubmit" value="删除会员" disabled="true" class="button" /></td>
      <td align="right" nowrap="true" colspan="8">
            <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        <?php echo ($bar); ?>
      </div>
      </td>
  </tr>
</table>

</div>
<!-- end users list -->
</form>

<div id="footer">
共执行 4 个查询，用时 0.018001 秒，Gzip 已禁用，内存占用 2.234 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tables.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#selectAll').click(function(){
		$("input[name='checkboxes[]']").prop("checked",this.checked);
	});
});

function del(tmp,userid){
	if(confirm('您确定要删除该会员账号吗？')){
		$.post("<?php echo U('User/del');?>",{user_id:userid},function(data){
			if(data.status){
				$(tmp).parent().parent().remove();
			}
		});
	}
}

</script>
</body>
</html>