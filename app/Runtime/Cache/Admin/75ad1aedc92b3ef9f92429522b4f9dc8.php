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
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Admin/Order/');?>order_query">订单查询</a></span>
<span class="action-span1"><a href="/Admin/Index/index">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单列表 </span>
<div style="clear:both"></div>
</h1>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="<?php echo U('Order/showlist');?>" name="searchForm">
    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    订单号<input name="order_sn" type="text" id="order_sn" size="15">
    收货人<input name="user_name" type="text" id="consignee" size="15">
    订单状态    <select name="order_status" id="status">
      <option value="-1">请选择...</option>
      <option value="4" selected>待确认</option><option value="1">待付款</option><option value="2">待发货</option><option value="4">已完成</option><option value="0">取消</option></select>
    <input type="submit" value=" 搜索 " class="button" />
    <a href="<?php echo U('Order/showlist',array('order_status'=>3));?>">待确认</a>
    <a href="<?php echo U('Order/showlist',array('order_status'=>1));?>">待付款</a>
    <a href="<?php echo U('Order/showlist',array('order_status'=>2));?>">待发货</a>
  </form>
</div>

<!-- 订单列表 -->
<form method="post" action="<?php echo U('Order/delall');?>" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv">

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input type="checkbox" id="selectAll" />订单号  </th>
    <th>下单时间<img src="<?php echo (ADMIN_RES_PATH); ?>/images/sort_desc.gif"></th>
    <th>收货人</th>
    <th style="text-align:center">总金额</th>
    <th style="text-align:center">应付金额</th>
    <th style="text-align:center">订单状态</th>
    <th>操作</th>
    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
    <tr>
    <td valign="top" nowrap="nowrap"><input type="checkbox" name="checkboxes[]" value="<?php echo ($v["order_id"]); ?>" /><a href="<?php echo U('Admin/Order/detail/order_id/'.$v['order_id']);?>" id="order_0"><?php echo ($v["order_sn"]); ?></a></td>
    <td><?php echo ($v["user_name"]); ?></td>
    <td align="left" valign="top"><?php echo (date("Y-m-d H:i:s",$v["order_time"])); ?></td>
    <td align="center" valign="top" nowrap="nowrap">￥<?php echo ($v["goods_amount"]); ?>元</td>
    <td align="center" valign="top" nowrap="nowrap">￥<?php echo ($v["order_amount"]); ?>元</td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo L('order_status_'.$v['order_status']);?></td>
    <td align="center" valign="top"  nowrap="nowrap">
     <a href="<?php echo U('Order/detail',array('order_id'=>$v['order_id']));?>">查看</a>
         </td>
  </tr><?php endforeach; endif; ?>
  </table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
          <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        <?php echo ($bar); ?>
      </div>
    </td>
  </tr>
</table>

  </div>
  <div>
    <input name="remove" type="submit" id="btnSubmit3" value="移除" class="button" disabled="true" onclick="this.form.target = '_self'" />

  </div>
</form>

<div id="footer">
共执行 4 个查询，用时 0.040002 秒，Gzip 已禁用，内存占用 4.660 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tables.js"></script>
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
var remove_confirm = "删除订单将清除该订单的所有信息。您确定要这么做吗？";
var confirm_merge = "您确实要合并这两个订单吗？";
var input_price = "自定义价格";
var pls_search_user = "请搜索并选择会员";
var confirm_drop = "确认要删除该商品吗？";
var invalid_goods_number = "商品数量不正确";
var pls_search_goods = "请搜索并选择商品";
var pls_select_area = "请完整选择所在地区";
var pls_select_shipping = "请选择配送方式";
var pls_select_payment = "请选择支付方式";
var pls_select_pack = "请选择包装";
var pls_select_card = "请选择贺卡";
var pls_input_note = "请您填写备注！";
var pls_input_cancel = "请您填写取消原因！";
var pls_select_refund = "请选择退款方式！";
var pls_select_agency = "请选择办事处！";
var pls_select_other_agency = "该订单现在就属于这个办事处，请选择其他办事处！";
var loading = "加载中...";
//-->

$(document).ready(function(){
	$('#selectAll').click(function(){
		$("input[name='checkboxes[]']").prop('checked',this.checked);
	});
});
</script>
</body>
</html>