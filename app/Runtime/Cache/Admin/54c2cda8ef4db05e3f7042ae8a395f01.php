<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 品牌管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/main.css" />


</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Brand/add');?>">添加品牌</a></span>
<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品品牌 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="" name="searchForm">
    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
     <input type="text" name="brand_name" size="15">
    <input type="submit" value=" 搜索 " class="button">
  </form>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tbody>
		<tr>
			<th>品牌名称</th>
			<th>品牌Logo</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>排序</th>
			<th>是否显示</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
			<td class="first-cell"><span style="float:right">	<span title="点击修改内容" style=""><?php echo ($vo["brand_name"]); ?></span>
			</td>
			<td align="center"><a href="<?php echo "http://"; echo ($_SERVER['SERVER_NAME']); echo ($vo["brand_logo"]); ?>" target="_brank"><img src="<?php echo "http://"; echo ($_SERVER['SERVER_NAME']); echo ($vo["brand_logo"]); ?>" width="80" height="40" border="0" alt="品牌LOGO"></a></span>
		</td>
			<td><a href="<?php echo ($vo["site_url"]); ?>" target="_brank"><?php echo ($vo["site_url"]); ?></a></td>
			<td align="left" ><?php echo ($vo["brand_desc"]); ?></td>
			<td align="right"><span><?php echo ($vo["sort_order"]); ?></span></td>
			<td align="center"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/<?php if($vo["is_show"] == 1): ?>yes<?php else: ?>no<?php endif; ?>.gif"></td>
			<td align="center">
				<a href="<?php echo U('Brand/edit',array('brand_id'=>$vo['brand_id']));?>" title="编辑">编辑</a> |
				<a href="<?php echo U('Brand/del',array('brand_id'=>$vo['brand_id']));?>" onclick="return confirm('你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
			</td>
		</tr><?php endforeach; endif; ?>
		<!--start，这些都是显示代码，没有格式化，开发时会删除 -->
	<!--end，这些都是显示代码，没有格式化，开发时会删除 -->
    <tr>
		<td align="right" nowrap="true" colspan="6">
		
           <div id="turn-page">
			<?php echo ($bar); ?>
      </div>
      </td>
    </tr>
  </tbody></table>

<!-- end brand list -->
</div>
</form>


<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>

</body>
</html>