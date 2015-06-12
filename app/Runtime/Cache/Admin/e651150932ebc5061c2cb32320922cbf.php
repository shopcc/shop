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
<span class="action-span"><a href="order.php?act=list&uselastfilter=1">订单列表</a></span>
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单信息 </span>
<div style="clear:both"></div>
</h1>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/topbar.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>

<form action="<?php echo U('order/operate');?>" method="post" name="theForm">
<div class="list-div" style="margin-bottom: 5px">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <td colspan="4">
      <div align="center">
      <!--   <input name="prev" type="button" class="button" onClick="location.href='order.php?act=info&order_id=19';" value="前一个订单"  />
        <input name="next" type="button" class="button" onClick="location.href='order.php?act=info&order_id=';" value="后一个订单" disabled />
        <input type="button" onclick="window.open('order.php?act=info&order_id=20&print=1')" class="button" value="打印订单" /> -->
    </div></td>
  </tr>
  <tr>
    <th colspan="4" style="text-align:center">基本信息</th>
  </tr>
  <tr>
    <td width="18%"><div align="right"><strong>订单号：</strong></div></td>
    <td width="34%"><?php echo ($info["order_sn"]); ?></td>
    <td width="15%"><div align="right"><strong>订单状态：</strong></div></td>
    <td><?php echo L('order_status_'.$info['order_status']);?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>购货人：</strong></div></td>
    <td><?php echo ($info["user_name"]); ?> </td>
    <td><div align="right"><strong>下单时间：</strong></div></td>
    <td><?php echo (date("Y-m-d H:i:s",$info["order_time"])); ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>支付方式：</strong></div></td>
    <td><?php echo ($info["pay_name"]); ?></td>
    <td><div align="right"><strong>配送方式：</strong></div></td>
    <td><?php echo ($info["shipping_name"]); ?></td>
  </tr>
  
  <tr>
    <th colspan="4" style="text-align:center">收货人信息</th>
    </tr>
  <tr>
    <td><div align="right"><strong>收货人：</strong></div></td>
    <td><?php echo ($address["consignee"]); ?></td>
    <td><div align="right"><strong>电子邮件：</strong></div></td>
    <td><?php echo ($address["email"]); ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>地址：</strong></div></td>
    <td>[<?php echo ($address["address_info"]); ?>] <?php echo ($address["consignee"]); ?></td>
    <td><div align="right"><strong>邮编：</strong></div></td>
    <td><?php echo ($address["zipcode"]); ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>电话：</strong></div></td>
    <td><?php echo ($address["telephone"]); ?></td>
    <td><div align="right"><strong>手机：</strong></div></td>
    <td><?php echo ($address["mobile"]); ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>标志性建筑：</strong></div></td>
    <td><?php echo ($address["sign_building"]); ?></td>
    <td><div align="right"><strong>最佳送货时间：</strong></div></td>
    <td><?php echo ($address["best_time"]); ?></td>
  </tr>
</table>
</div>

<div class="list-div" style="margin-bottom: 5px">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="8" scope="col" style="text-align:center">商品信息</th>
    </tr>
  <tr>
    <td scope="col"><div align="center"><strong>商品名称 </strong></div></td>
    <td scope="col"><div align="center"><strong>价格</strong></div></td>
    <td scope="col"><div align="center"><strong>数量</strong></div></td>
    <td scope="col"><div align="center"><strong>属性</strong></div></td>
    <td scope="col"><div align="center"><strong>库存</strong></div></td>
    <td scope="col"><div align="center"><strong>小计</strong></div></td>
  </tr>
  <?php if(is_array($goods)): foreach($goods as $key=>$vo): ?><tr>
    <td align="center">
        <a href="../goods.php?id=8" target="_blank"><?php echo ($vo["goods_name"]); ?></a>
        </td>
    <td align="center"><div align="center">￥<?php echo ($vo["goods_price"]); ?>元</div></td>
    <td align="center"><div align="center"><?php echo ($vo["goods_number"]); ?></div></td>
    <td align="center"><?php echo ($vo["goods_attr"]); ?> <br />
</td>
    <td><div align="center"><?php echo ($vo["kucun"]); ?></div></td>
    <td><div align="center">￥<?php echo ($vo['goods_price']*$vo['goods_number']); ?>元</div></td>
  </tr><?php endforeach; endif; ?>
    <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>合计：</strong></div></td>
    <td><div align="right">￥<?php echo ($prices); ?>元</div></td>
  </tr>
  
</table>
</div>

<div class="list-div" style="margin-bottom: 5px">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th style="text-align:center">费用信息</th>
  </tr>
  <tr>
    <td><div align="right">商品总金额：<strong>￥<?php echo ($prices); ?>元</strong>
      + 配送费用：<strong>￥<?php echo ($info["shipping_fee"]); ?>元</strong>
     </div></td>
  <tr>
    <td><div align="right"> = 订单总金额：<strong>￥<?php echo ($prices+$info["shipping_fee"]); ?>元</strong></div></td>
  </tr>
    <td><div align="right"> = 应付款金额：<strong>￥<?php echo ($prices+$info["shipping_fee"]); ?>元</strong>
      </div></td>
  </tr>
</table>
</div>

<div class="list-div" style="margin-bottom: 5px">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th colspan="6">操作信息</th>
  </tr>

  <tr>
    <td><div align="right"></div>
      <div align="right"><strong>当前可执行操作：</strong> </div></td>
    <td colspan="5">      <input name="confirm" type="submit" value="确认" class="button" />
                 <input name="pay" type="submit" value="付款" class="button" />
                      <input name="send" type="submit" value="发货" class="button" />
                      <input name="cancel" type="submit" value="取消" class="button" />
                            <input name="order_id" type="hidden" value="<?php echo ($info["order_id"]); ?>"></td>
    </tr>
  </table>
</div>
</form>


<div id="footer">
共执行 17 个查询，用时 0.042002 秒，Gzip 已禁用，内存占用 4.643 MB<br />
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
</script>
</body>
</html>