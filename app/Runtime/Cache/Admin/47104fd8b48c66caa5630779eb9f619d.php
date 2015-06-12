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
<span class="action-span"><a href="<?php echo U('Auth/add');?>">添加权限</a></span>
<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限管理 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm" id="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>

					<th style="text-align:center;">权限名称</th>
					<th style="text-align:center;">行为名称</th>
					<th style="text-align:center;">方法名称</th>
					<th  style="text-align:center;">权限ID</th>
					<th style="text-align:center;">操作</th>
				</tr>
				<?php if(is_array($auth)): foreach($auth as $key=>$vo): ?><tr align="center" class="<?php echo ($vo["level"]); ?>" id="<?php echo ($vo["level"]); ?>_<?php echo ($vo["auth_id"]); ?>">
					<td align="left" class="first-cell">
					
					<?php echo str_repeat("------",$vo['level']);?>|
						<img src="<?php echo (ADMIN_RES_PATH); ?>/images/menu_minus.gif" id="icon_<?php echo ($vo["level"]); ?>_<?php echo ($vo["auth_id"]); ?>" width="12" height="12" border="0" style="margin-left:0em" onclick="rowClicked(this)">
						<span><a href="goods.php?act=list&amp;cat_id=1"><?php echo ($vo["auth_name"]); ?></a></span>
					 </td>
					<td width="25%"><?php echo ($vo["auth_c"]); ?></td>
					
					<td width="20%" align="center"><?php echo ($vo["auth_a"]); ?></td>
					<td width="20%"><?php echo ($vo["auth_id"]); ?></td>
					<td width="20%" align="center">
						<a href="<?php echo U('Auth/edit',array('authid'=>$vo['auth_id']));?>">编辑</a> |
						<a href="#" onclick="del(this,<?php echo ($vo['auth_id']); ?>)" title="移除">移除</a>
					</td>
				</tr><?php endforeach; endif; ?>
	<!--  start 这些代码是显示使用，没有格式化 开发时可删除-->
  	<!--  end这些代码是显示使用，没有格式化 开发时可删除-->
	</tbody>
  </table>
</div>
</form>

  </table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>
 <script>
	/**
 * 折叠分类列表
 */
var imgPlus = new Image();
imgPlus.src = "<?php echo (ADMIN_RES_PATH); ?>/images/menu_plus.gif";

function rowClicked(obj)
{
  // 当前图像
  img = obj;
  // 取得上二级tr>td>img对象
  obj = obj.parentNode.parentNode;
  // 整个分类列表表格
  var tbl = document.getElementById("list-table");
  // 当前分类级别
  var lvl = parseInt(obj.className);
  // 是否找到元素
  var fnd = false;
  var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : 'table-row' ;
  // 遍历所有的分类
  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];
      if (row == obj)
      {
          // 找到当前行
          fnd = true;
          //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              var icon = 'icon_' + row.id;
              if (cur > lvl)
              {
                  row.style.display = sub_display;
                  if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                  }
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG" && imgObj.src != '<?php echo (ADMIN_RES_PATH); ?>/images/menu_arrow.gif')
      {
          imgObj.src = (imgObj.src == imgPlus.src) ? '<?php echo (ADMIN_RES_PATH); ?>/images/menu_minus.gif' : imgPlus.src;
      }
  }
}
</script>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tables.js"></script>
<script>
function del(tmp,authid){
	if(confirm('确定要删除该权限')){
	$.post("<?php echo U('Auth/del');?>",{auth_id:authid},function(data){
		if(data.status){
			$(tmp).parent().parent().remove();
		}
	});
	}
}
</script>
</body>
</html>