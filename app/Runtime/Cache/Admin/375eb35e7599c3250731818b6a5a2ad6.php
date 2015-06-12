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
<span class="action-span1"><a href="index.php?act=main"> 管理中心</a> </span><span id="search_id" class="action-span1"> - 系统信息 </span>
<div style="clear:both"></div>
</h1><div class="list-div">
  <div style="background:#FFF; padding: 20px 50px; margin: 2px;">
    <table align="center" width="400">
      <tr>
        <td width="50" valign="top">
                    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/information.gif" width="32" height="32" border="0" alt="information" />
                  </td>
        <td style="font-size: 14px; font-weight: bold"><?php if(isset($message)): echo ($message); else: echo ($error); endif; ?></td>
      </tr>
      <tr>
        <td></td>
        <td id="redirectionMsg">
          如果您不做出选择，将在 <span id="spanSeconds"></span> 秒后跳转到第一个链接地址。        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <ul style="margin:0; padding:0 10px" class="msg-link">
                        <li><a href="<?php echo ($jumpUrl); ?>" >立即跳转</a></li>
                      </ul>

        </td>
      </tr>
    </table>
  </div>
</div>
<script language="JavaScript">
<!--
var seconds = <?php echo ($waitSecond); ?>;
var defaultUrl = '<?php echo ($jumpUrl); ?>';


onload = function()
{
  if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
  {
    document.getElementById('redirectionMsg').innerHTML = '';
    return;
  }

  window.setInterval(redirection, 1000);
}
function redirection()
{
  if (seconds <= 0)
  {
    window.clearInterval();
    return;
  }

  seconds --;
  document.getElementById('spanSeconds').innerHTML = seconds;

  if (seconds == 0)
  {
    window.clearInterval();
    location.href = defaultUrl;
  }
}
//-->
</script>

<div id="footer">
共执行 14 个查询，用时 0.028001 秒，Gzip 已禁用，内存占用 3.223 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>