<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="Keywords" content="LG 3g 876 支持 双模 2008年04月 灰色 GSM,850,900,1800,1900" />
<meta name="Description" content="" />
<title>跳转提示</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/css/style.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/assets/css/amazeui.min.css" /> -->

<!-- <load href="<?php echo (RESOURCE); ?>/assets/js/amazeui.min.js" -->
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/jquery.js"></script>
 <script type="text/javascript">
  $(document).ready(function(){
    $.post('<?php echo U('cart/getnum');?>',{},function(data){
      console.log(data);
    });
  });
  </script>
</head>
<body>

<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/qq/images/qq.css" />
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/utils.js"></script> 
  <div id="Head">
  <div id="headerTopArea" class="headerTopAreaBox">
    <div class="headerTopArea">
      <div class="headerTop">
        <div class="headerTopLeft">
          <div id="ECS_MEMBERZONE" class="loginArea"><div id="append_parent"></div>
		  <?php if($_SESSION['user_id']!= ''): ?>您好, <a style="color: rgb(51, 51, 51);" class="top track" href="user.php">hao123</a> <span style="color: #a10000"><a target="_parent" href="user.php?act=logout" style="color: #a10000" class="top track">退出登录</a></span>
        <?php else: ?>
欢迎光临本店<span><a href="<?php echo U('member/login');?>" class="track">[&nbsp;登录&nbsp;</a>|<a href="user.php?act=register" class="track">&nbsp;免费注册&nbsp;]</a></span><?php endif; ?>
</div>
          <div class="recommendArea"><a class="track" href="user.php?act=order_list">我的订单</a><a href="javascript:bookmark();" id="vanclFavorite">收藏本站</a></div>
        </div>
        <div class="headerTopRight">
          <div id="vanclMap" ><a href="user.php" target="_blank">我的京东</a>
            
          </div>
          
           
                    <div id="vanclMap"><a href="flow.php" class="mapDropTitle track mapTitle" >查看购物车</a></div>
                    <div id="vanclMap"><a href="pick_out.php" class="mapDropTitle track mapTitle" >选购中心</a></div>
                    <div id="vanclMap"><a href="tag_cloud.php" class="mapDropTitle track mapTitle" >标签云</a></div>
                    <div id="vanclMap"><a href="quotation.php" class="mapDropTitle track mapTitle" >报价单</a></div>
           
                    
          
        </div>
      </div>
    </div>
  </div>
  <div class="LogoSearchBar" id="logoArea">
    <div class="logoSearchSubnavArea">
      <h1 class="logoArea"><a href="index.php" class="track"><img src="<?php echo (RESOURCE); ?>/images/logo.gif" /></a></h1>
      <div class="searchAreaBlock">
        <div class="searchLeft">
          <ul id="searchBar" class="searchBar">
          </ul>
          <div class="searchInt">
            <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
              <input name="keywords" type="text" id="keyword" value="" class="searchText ac_input" />
              <input type="submit" value="搜索" name="imageField" class="searchBtn" style="cursor:pointer;">
            </form>
          </div>
           </div>
        <div class="menuTopRight">
          <div id="shoppingCarNone" class="active"> <p><a class="shopborder track" href="flow.php" id="shoppingcar_link">购物车(<span car_product_total="shoppingCar_product_totalcount">0</span>)件</a><s></s></p>
<div class="shopDropList"> 
    <div class="shopnopru">
    <div class="SCtotalpageno">您的购物车中没有任何商品</div>
    <div class="SCtotalpageBottom"></div>
  </div>
   </div>
 </div>
        </div>
      </div>
    </div>
  </div>
  
  </div>
</div>

<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/common.js"></script>
<body>
<style type="text/css">
p a{color:#006acd; text-decoration:underline;}
</style>

<div style="clear:both"></div>
 <div class="menu_box clearfix"> 
<div class="block"> 
<div class="menu">
  <a href="../index.php" class="cur">首页<span></span></a>

<?php if(is_array($cate)): foreach($cate as $key=>$v1): if(isset($cate[1]['url'])): ?><a href="<?php echo ($v1["url"]); ?>"  >
<?php echo ($v1["cat_name"]); ?><span></span>
</a>
  <?php else: ?>
   <a href="<?php echo U('/category',array(cid=>$v1['cat_id']));?>"  >
<?php echo ($v1["cat_name"]); ?><span></span>
</a><?php endif; endforeach; endif; ?>
 </div> 
</div>
</div>
<script type="text/javascript">
/*收藏夹功能*/
function bookmark() {
	var httpUrl="http://"+location.hostname;
    var c;
    var a = /^http{1}s{0,1}:\/\/([a-z0-9_\\-]+\.)+(yihaodian|1mall|111|yhd){1}\.(com|com\.cn){1}\?(.+)+$/;
    if (a.test(httpUrl)) {
        c = "&ref=favorite"
    } else {
        c = "?ref=favorite"
    }
    var d = httpUrl + c;
    if ('undefined' == typeof (document.body.style.maxHeight)) {
        d = httpUrl
    }
    try {
        if (document.all) {
            window.external.AddFavorite(d, favorite)
        } else {
            try {
                window.sidebar.addPanel(favorite, d, "")
            } catch(b) {
                alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加")
            }
        }
    } catch(b) {
        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加")
    }
}
function deleteCartGoods(rec_id)
{
	Ajax.call('delete_cart_goods.php', 'id='+rec_id, deleteCartGoodsResponse, 'POST', 'JSON');
}
/**
 * 接收返回的信息
 */
function deleteCartGoodsResponse(res)
{
  if (res.error)
  {
    alert(res.err_msg);
  }
  else
  {
	  $("#shoppingCarNone").html(res.content);
  }
}
</script> 
 
<div class="blank"></div>
<div class="block">
  <div class="box">
   <div class="box_1">
    <h3><span>系统信息</span></h3>
    <div class="boxCenterList RelaArticle" align="center">
      <div style="margin:20px auto;">
      <p style="font-size: 14px; font-weight:bold; color: red;"><?php if(isset($message)): echo ($message); else: echo ($error); endif; ?>,<span id="wait"><?php echo ($waitSecond); ?></span>秒后跳转
	  <input type="hidden" id="href" value="<?php echo ($jumpUrl); ?>"/></p>
        <div class="blank"></div>
                            <p><a href="javascript:history.go(-1);">返回上一页</a></p>
                    <p><a href="<?php echo U('member/index');?>">查看我的个人信息</a></p>
                        </div>
    </div>
   </div>
  </div>
</div>
<div class="blank10"></div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').value;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
<div id="footerArea">
  <div class="blank"></div>
 <!--  <div class="w">
    <div id="service-2013">

      <dl class="fore1">
        <dt> <b></b> <strong>新手上路</strong>
        </dt>
        <dd>
          <div>
            <a href="article.php?id=9" target="_blank" title="售后流程">售后流程</a>
          </div>
          <div>
            <a href="article.php?id=10" target="_blank" title="购物流程">购物流程</a>
          </div>
          <div>
            <a href="article.php?id=11" target="_blank" title="订购方式">订购方式</a>
          </div>

        </dd>
      </dl>

      <dl class="fore2">
        <dt> <b></b> <strong>手机常识</strong>
        </dt>
        <dd>
          <div>
            <a href="article.php?id=12" target="_blank" title="如何分辨原装电池">如何分辨原装电池</a>
          </div>
          <div>
            <a href="article.php?id=13" target="_blank" title="如何分辨水货手机 ">如何分辨水货手机</a>
          </div>
          <div>
            <a href="article.php?id=14" target="_blank" title="如何享受全国联保">如何享受全国联保</a>
          </div>

        </dd>
      </dl>

      <dl class="fore3">
        <dt>
          <b></b>
          <strong>配送与支付</strong>
        </dt>
        <dd>
          <div>
            <a href="article.php?id=15" target="_blank" title="货到付款区域">货到付款区域</a>
          </div>
          <div>
            <a href="article.php?id=16" target="_blank" title="配送支付智能查询 ">配送支付智能查询</a>
          </div>
          <div>
            <a href="article.php?id=17" target="_blank" title="支付方式说明">支付方式说明</a>
          </div>

        </dd>
      </dl>

      <dl class="fore4">
        <dt>
          <b></b>
          <strong>会员中心</strong>
        </dt>
        <dd>
          <div>
            <a href="article.php?id=18" target="_blank" title="资金管理">资金管理</a>
          </div>
          <div>
            <a href="article.php?id=19" target="_blank" title="我的收藏">我的收藏</a>
          </div>
          <div>
            <a href="article.php?id=20" target="_blank" title="我的订单">我的订单</a>
          </div>

        </dd>
      </dl>

      <dl class="fore5">
        <dt>
          <b></b>
          <strong>服务保证</strong>
        </dt>
        <dd>
          <div>
            <a href="article.php?id=21" target="_blank" title="退换货原则">退换货原则</a>
          </div>
          <div>
            <a href="article.php?id=22" target="_blank" title="售后服务保证 ">售后服务保证</a>
          </div>
          <div>
            <a href="article.php?id=23" target="_blank" title="产品质量保证 ">产品质量保证</a>
          </div>

        </dd>
      </dl>

      <span class="clr"></span>
    </div>
  </div> -->
  <span class="blank15"></span>
  <div class="w">
    <div id="footer-2013">
      <div class="links">

        <a href="#" >免责条款</a>
        |
        <a href="#" >隐私保护</a>
        |
        <a href="#" >咨询热点</a>
        |
        <a href="#" >联系我们</a>
        |
        <a href="#" >公司简介</a>
        |
        <a href="#" >批发方案</a>
        |
        <a href="#" >配送方式</a>

      </div>

      <div class="copyright">
        &copy; 2005-2015 ECSHOP 版权所有，并保留所有权利。
        <br />

        <br />

      </div>
      <!-- <div align="center">
        <a href=" http://www.ecmoban.com" target="_blank">
          <img src="<?php echo (RESOURCE); ?>/images/ecmoban.gif" alt="ECShop模板" />
        </a>
      </div> -->
      <br />

    </div>
  </div>

  <div class="QQbox" id="divQQbox" style="width: 170px; ">
    <div class="Qlist" id="divOnline" onmouseout="hideMsgBox(event);" style="display: none; " onmouseover="OnlineOver();">
      <div class="t"></div>
      <div class="infobox">
        我们营业的时间
        <br>9:00-18:00</div>
      <div class="con">
        <ul></ul>
      </div>
      <div class="b"></div>
    </div>
    <div id="divMenu" onmouseover="OnlineOver();" style="display: block; ">
      <img src="<?php echo (RESOURCE); ?>/qq/images/qq_1.gif" class="press" alt="在线咨询"></div>
  </div>
  <script type="text/javascript">
//<![CDATA[
var tips; var theTop = 120/*这是默认高度,越大越往下*/; var old = theTop;
function initFloatTips() {
tips = document.getElementById('divQQbox');
moveTips();
};
function moveTips() {
var tt=50;
if (window.innerHeight) {
pos = window.pageYOffset
}
else if (document.documentElement && document.documentElement.scrollTop) {
pos = document.documentElement.scrollTop
}
else if (document.body) {
pos = document.body.scrollTop;
}
pos=pos-tips.offsetTop+theTop;
pos=tips.offsetTop+pos/10;
if (pos < theTop) pos = theTop;
if (pos != old) {
tips.style.top = pos+"px";
tt=10;
//alert(tips.style.top);
}
old = pos;
setTimeout(moveTips,tt);
}
//!]]>
initFloatTips();
function OnlineOver(){
document.getElementById("divMenu").style.display = "none";
document.getElementById("divOnline").style.display = "block";
document.getElementById("divQQbox").style.width = "170px";
}
function OnlineOut(){
document.getElementById("divMenu").style.display = "block";
document.getElementById("divOnline").style.display = "none";
}
if(typeof(HTMLElement)!="undefined")    //给firefox定义contains()方法，ie下不起作用
{   
      HTMLElement.prototype.contains=function(obj)   
      {   
          while(obj!=null&&typeof(obj.tagName)!="undefind"){ //通过循环对比来判断是不是obj的父元素
   　　　　if(obj==this) return true;   
   　　　　obj=obj.parentNode;
   　　}   
          return false;   
      };   
}  
function hideMsgBox(theEvent){ //theEvent用来传入事件，Firefox的方式
　 if (theEvent){
　 var browser=navigator.userAgent; //取得浏览器属性
　 if (browser.indexOf("Firefox")>0){ //如果是Firefox
　　 if (document.getElementById('divOnline').contains(theEvent.relatedTarget)) { //如果是子元素
　　 return; //结束函式
} 
} 
if (browser.indexOf("MSIE")>0){ //如果是IE
if (document.getElementById('divOnline').contains(event.toElement)) { //如果是子元素
return; //结束函式
}
}
}
/*要执行的操作*/
document.getElementById("divMenu").style.display = "block";
document.getElementById("divOnline").style.display = "none";
}
</script>
</div>
</body>
<script type="text/javascript">
var process_request = "正在处理您的请求...";
var username_empty = "- 用户名不能为空。";
var username_shorter = "- 用户名长度不能少于 3 个字符。";
var username_invalid = "- 用户名只能是由字母数字以及下划线组成。";
var password_empty = "- 登录密码不能为空。";
var password_shorter = "- 登录密码不能少于 6 个字符。";
var confirm_password_invalid = "- 两次输入密码不一致";
var email_empty = "- Email 为空";
var email_invalid = "- Email 不是合法的地址";
var agreement = "- 您没有接受协议";
var msn_invalid = "- msn地址不是一个有效的邮件地址";
var qq_invalid = "- QQ号码不是一个有效的号码";
var home_phone_invalid = "- 家庭电话不是一个有效号码";
var office_phone_invalid = "- 办公电话不是一个有效号码";
var mobile_phone_invalid = "- 手机号码不是一个有效号码";
var msg_un_blank = "* 用户名不能为空";
var msg_un_length = "* 用户名最长不得超过7个汉字";
var msg_un_format = "* 用户名含有非法字符";
var msg_un_registered = "* 用户名已经存在,请重新输入";
var msg_can_rg = "* 可以注册";
var msg_email_blank = "* 邮件地址不能为空";
var msg_email_registered = "* 邮箱已存在,请重新输入";
var msg_email_format = "* 邮件地址不合法";
var msg_blank = "不能为空";
var no_select_question = "- 您没有完成密码提示问题的操作";
var passwd_balnk = "- 密码中不能包含空格";
var user_name_exist = "用户名 %s 已经存在";
</script>
</html>