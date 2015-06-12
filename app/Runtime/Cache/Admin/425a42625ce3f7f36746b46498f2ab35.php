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
	<span class="action-span"><a href="<?php echo U('Goods/add');?>">添加新商品</a></span>
	<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="<?php echo U('Goods/showlist');?>" name="searchForm" method="get">
    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
        <!-- 分类 -->
    <select name="cat_id" data-am-selected="{maxHeight: 100,btnSize:'xs',btnStyle:'secondary'}">
		<option value="0">所有分类</option>
		<?php if(is_array($cat)): foreach($cat as $key=>$v_cat): ?><option value="<?php echo ($v_cat["cat_id"]); ?>"><?php echo str_repeat("&nbsp;&nbsp;",$v_cat['level']); echo ($v_cat["cat_name"]); ?></option><?php endforeach; endif; ?>
	</select>
    <!-- 品牌 -->
    <select name="brand_id" data-am-selected="{maxHeight: 100,btnSize:'xs',btnStyle:'secondary'}">
		<option value="0">所有品牌</option>
		<?php if(is_array($brand)): foreach($brand as $key=>$v_t): ?><option value="<?php echo ($v_t["brand_id"]); ?>"><?php echo ($v_t["brand_name"]); ?></option><?php endforeach; endif; ?>
	</select>
    <!-- 推荐 -->
    <select name="intro_type" data-am-selected="{maxHeight: 100,btnSize:'xs',btnStyle:'secondary'}">
		<option value="0">全部</option>
		<option value="1">精品</option>
		<option value="2">新品</option>
		<option value="3">热销</option>
		<option value="4">特价</option>
	</select>
         
    <!-- 上架 -->
     <select name="is_onsale" data-am-selected="{maxHeight: 100,btnSize:'xs',btnStyle:'secondary'}">
		<option value="">全部</option>
		<option value="1">上架</option>
		<option value="0">下架</option>
	</select>
	<!-- 关键字 -->
		关键字 <input type="text" class="am-input-sm" name="keyword" size="15">
		<input type="submit" value=" 搜索 "  class="am-btn am-btn-secondary am-radius am-btn-xs">
  </form>
</div>

<form method="post" action="<?php echo U('Goods/up');?>" name="listForm">
  <!-- start goods list -->
	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
				<tr>
					<th width="2%" style="text-align:center;"><input type="checkbox" id="allselect">全选</th>
					<th style="text-align:center;">编号</th>
					<th style="text-align:center;">商品名称</th>
					<th style="text-align:center;">货号</th>
					<th style="text-align:center;">价格</th>
					<th style="text-align:center;">上架</th>
					<th style="text-align:center;">精品</th>
					<th style="text-align:center;">新品</th>
					<th style="text-align:center;">热销</th>
					<th style="text-align:center;">推荐排序</th>
					<th style="text-align:center;">库存</th>
					<th style="text-align:center;">操作</th>
				</tr>
				<tr></tr>
				<?php if(is_array($good)): foreach($good as $key=>$v_g): ?><tr id="goods_tr_<?php echo ($v_g["goods_id"]); ?>">
					<td align="center"><input type="checkbox" name="checkboxes[]" value="<?php echo ($v_g["goods_id"]); ?>"></td>
					<td align="center"><?php echo ($v_g["goods_id"]); ?></td>
					<td class="first-cell"><span><?php echo ($v_g["goods_name"]); ?></span></td>
					<td style="text-align:center;"><span><?php echo ($v_g["goods_sn"]); ?></span></td>
					<td align="center"><span><?php echo ($v_g["shop_price"]); ?></span></td>
					<td align="center"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/<?php if($v_g["is_onsale"] == 1): ?>yes<?php else: ?>no<?php endif; ?>.gif"></td>
					<td align="center"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/<?php if($v_g["is_best"] == 1): ?>yes<?php else: ?>no<?php endif; ?>.gif" ></td>
					<td align="center"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/<?php if($v_g["is_new"] == 1): ?>yes<?php else: ?>no<?php endif; ?>.gif" ></td>
					<td align="center"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/<?php if($v_g["is_hot"] == 1): ?>yes<?php else: ?>no<?php endif; ?>.gif" ></td>
					<td align="center"><span onclick=""><?php echo ($v_g["sort_order"]); ?></span></td>
					<td align="center"><span onclick=""><?php echo ($v_g["goods_number"]); ?></span></td>
					<td align="center">
						<a href="/index.php?m=home&c=goods&a=detail&id=<?php echo ($v_g['goods_id']); ?>" target="_blank" title="查看"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_view.gif" width="16" height="16" border="0"></a>
						<a href="<?php echo U('goods/edit',array('goods_id'=>$v_g['goods_id']));?>" title="编辑"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_edit.gif" width="16" height="16" border="0"></a>
						<a href="javascript:;" onclick="delgoods(<?php echo ($v_g["goods_id"]); ?>)" title="回收站"><img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_trash.gif" width="16" height="16" border="0"></a>    
					</td>
				</tr><?php endforeach; endif; ?>
	<!-- start 这段代码没有格式化，只是暂时显示数据用 开发的时候将会删除-->
    
  <!-- end 这段代码没有格式化，只是暂时显示数据用 开发的时候将会删除-->
 </table>
<!-- end goods list -->

	<!-- 分页 -->
	<table id="page-table" cellspacing="0">
		<tbody>
			<tr>
				<td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
					<!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
					<div id="turn-page">
						<?php echo ($page); ?>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div>
	<input type="hidden" name="act" value="batch">
	<select name="type" id="selAction" onchange="changeAction()">
		<option value="">请选择...</option>
		<option value="trash">回收站</option>
		<option value="on_sale">上架</option>
		<option value="not_on_sale">下架</option>
		<option value="best">精品</option>
		<option value="not_best">取消精品</option>
		<option value="new">新品</option>
		<option value="not_new">取消新品</option>
		<option value="hot">热销</option>
		<option value="not_hot">取消热销</option>
	</select>

    <input type="hidden" name="extension_code" value="">
    <input type="submit" value=" 确定 " id="btnSubmit" name="btnSubmit" class="button" disabled="true">
</div>
</form>

<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - 
</div>
<script>
$(document).ready(function(){
	$("#allselect").click(function(){
		$("input[name='checkboxes[]']").prop("checked",this.checked);
		$("#btnSubmit").prop("disabled",this.disabled);
	});
	$("input[name='checkboxes[]']").click(function(){
		if($("input[name='checkboxes[]']:checked").length >=1){
			$("#btnSubmit").prop("disabled",this.disabled);
		}else{
			alert('最少选一项');
		}
	});
	
});
function delgoods(goodId){
	if(confirm('确定要删除该商品')){
		$.post("<?php echo U('Goods/del');?>",{goods_id:goodId},function(data){
			  if(data.status){
				  $("#goods_tr_"+data.goods_id).css('display','none');
			  }
		});
	}
}
</script>
</body>
</html>