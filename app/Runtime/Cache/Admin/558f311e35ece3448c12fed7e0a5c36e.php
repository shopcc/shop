<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 类型管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/main.css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Type/add');?>">新建商品类型</a></span>
<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品类型 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start goods type list -->
<div class="list-div" id="listDiv">

	<table width="100%" cellpadding="3" cellspacing="1" id="listTable">
		<tbody>
			<tr>
				<th>商品类型名称</th>
				<th>属性数</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
				<td class="first-cell"><span><?php echo ($vo["type_name"]); ?></span></td>
				<td align="right"><?php echo ($vo["num"]); ?></td>
				<td align="center">
				  <a href="<?php echo U('Attribute/showlist',array('goods_type'=>$vo['type_id']));?>" title="属性列表">属性列表</a> |
				  <a href="<?php echo U('Type/edit',array('type_id/'=>$vo['type_id']));?>" title="编辑">编辑</a> |
				  <a href="<?php echo U('Type/del',array('type_id'=>$vo['type_id']));?>" onclick="return confirm('删除商品类型将会清除该类型下的所有属性。\n您确定要删除选定的商品类型吗？')" title="移除">移除</a>
				</td>
			</tr><?php endforeach; endif; ?>

   

      <tr>
      <td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);">
            <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        <?php echo ($page); ?>
      </div>
      </td>
    </tr>
  </tbody></table>

</div>
<!-- end goods type list -->
</form>

<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>

</body>
</html>