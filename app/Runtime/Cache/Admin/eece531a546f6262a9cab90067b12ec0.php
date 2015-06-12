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
<span class="action-span"><a href="<?php echo U('comment/comment_list');?>">用户评论</a></span>
<span class="action-span1"><a href="/Admin/index">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 评论详情 </span>
<div style="clear:both"></div>
</h1><!-- comment content list -->
<div class="main-div">
  <table width="100%">
    <tr>
      <td>
      <a href="mailto:<?php echo ($info["email"]); ?>"><b><?php echo ($info["user_name"]); ?></b></a>&nbsp;于      &nbsp;<?php echo (date($info["add_time"],"Y-m-d H:i:s")); ?>&nbsp;对&nbsp;<b><?php echo ($info["goods_name"]); ?></b>&nbsp;发表评论    </td>
    </tr>
    <tr>
      <td><hr color="#dadada" size="1"></td>
    </tr>
    <tr>
      <td>
        <div style="overflow:hidden; word-break:break-all;">sssss</div>
        <div align="right"><b>评论等级:</b> <?php echo ($info["comment_rank"]); ?>&nbsp;&nbsp;<b>IP地址</b>: <?php echo ($info["ip_address"]); ?></div>
      </td>
    </tr>
  </table>
</div>

<!-- reply content list -->

<div class="main-div">
<form method="post" action="<?php echo U('comment/replay');?>" name="theForm" onsubmit="return validate()">
<table border="0" align="center">
  <tr><th colspan="2">
  <strong>回复评论</strong>
  </th></tr>
  <tr>
    <td>用户名:</td>
    <td><input name="replay_name" type="text"  value="<?php echo (session('admin_name')); ?>" size="30" readonly="true" /></td>
  </tr>
  <tr>
    <td>回复内容:</td>
    <td><textarea name="replay" cols="50" rows="4" wrap="VIRTUAL"><?php echo ($info["replay"]); ?></textarea></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>提示: 此条评论已有回复, 如果继续回复将更新原来回复的内容!</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input name="submit" type="submit" value=" 确定 " class="button">
      <input type="reset" value=" 重置 " class="button">
      <input type="hidden" name="comment_id" value="<?php echo ($info["comment_id"]); ?>">
     
    </td>
  </tr>
</table>
</form>
</div>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/validator.js"></script>
<script language="JavaScript">

document.forms['theForm'].elements['content'].focus();

/**
 * 检查表单输入的数据
 */
function validate()
{
    validator = new Validator("theForm");
    validator.required("content",  no_content);
    return validator.passed();
}


</script>

<div id="footer">
共执行 6 个查询，用时 0.012000 秒，Gzip 已禁用，内存占用 2.093 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<!-- 新订单提示信息 -->


<script language="JavaScript">
if (document.getElementById("listDiv"))
{
  document.getElementById("listDiv").onmouseover = function(e)
  {
    obj = Utils.srcElement(e);

    if (obj)
    {
      if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
      else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
      else return;

      for (i = 0; i < row.cells.length; i++)
      {
        if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#F4FAFB';
      }
    }

  }

  document.getElementById("listDiv").onmouseout = function(e)
  {
    obj = Utils.srcElement(e);

    if (obj)
    {
      if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
      else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
      else return;

      for (i = 0; i < row.cells.length; i++)
      {
          if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#FFF';
      }
    }
  }

  document.getElementById("listDiv").onclick = function(e)
  {
    var obj = Utils.srcElement(e);

    if (obj.tagName == "INPUT" && obj.type == "checkbox")
    {
      if (!document.forms['listForm'])
      {
        return;
      }
      var nodes = document.forms['listForm'].elements;
      var checked = false;

      for (i = 0; i < nodes.length; i++)
      {
        if (nodes[i].checked)
        {
           checked = true;
           break;
         }
      }

      if(document.getElementById("btnSubmit"))
      {
        document.getElementById("btnSubmit").disabled = !checked;
      }
      for (i = 1; i <= 10; i++)
      {
        if (document.getElementById("btnSubmit" + i))
        {
          document.getElementById("btnSubmit" + i).disabled = !checked;
        }
      }
    }
  }

}

//-->
</script>
</body>
</html>