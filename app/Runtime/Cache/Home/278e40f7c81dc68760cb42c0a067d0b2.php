<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ECSHOP演示站 - Powered by ECShop</title>
<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/css/style.css" />
  <script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/jquery.js"></script>
 
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
		  <?php if($_SESSION['user_id']!= ''): ?>您好, <a style="color: rgb(51, 51, 51);" class="top track" href="user.php"><?php echo (session('user_name')); ?></a> <span style="color: #a10000"><a target="_parent" href="<?php echo U('member/logout');?>" style="color: #a10000" class="top track">退出登录</a></span>
        <?php else: ?>
欢迎光临本店<span><a href="<?php echo U('member/login');?>" class="track">[&nbsp;登录&nbsp;</a>|<a href="<?php echo U('member/reg');?>" class="track">&nbsp;免费注册&nbsp;]</a></span><?php endif; ?>
</div>
          <div class="recommendArea"><a class="track" href="<?php echo U('order/order_list');?>">我的订单</a><a href="javascript:bookmark();" id="vanclFavorite">收藏本站</a></div>
        </div>
        <div class="headerTopRight">
          <div id="vanclMap" ><a href="<?php echo U('member/index');?>" target="_blank">我的京东</a>
            
          </div>
          
           
                    <div id="vanclMap"><a href="<?php echo U('/cart');?>" class="mapDropTitle track mapTitle" >查看购物车</a></div>
                    
           
                    
          
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
            <form id="searchForm" name="searchForm" method="post" action="<?php echo U('/search/');?>" onSubmit="return checkSearchForm()">
              <input name="keywords" type="text" id="keyword" value="" class="searchText ac_input" />
              <input type="submit" value="搜索" name="imageField" class="searchBtn" style="cursor:pointer;">
            </form>
          </div>
           </div>
        <div class="menuTopRight">
          <div id="shoppingCarNone" class="active"> <p><a class="shopborder track" href="<?php echo U('/cart');?>" id="shoppingcar_link">购物车(<span car_product_total="shoppingCar_product_totalcount"><?php echo getnum();?></span>)件</a><s></s></p>
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
 
  <div class="block box">
<div class="blank"></div>
 <div id="ur_here">
 <?php if($t_nav['parent_id'] == 0): ?>当前位置: <a href=".">首页</a> <code>&gt;</code><a href="<?php echo U('/category/',array('cid'=>$t_nav['cat_id']));?>"><?php echo ($t_nav["cat_name"]); ?></a>
 <?php else: ?>
当前位置: <a href=".">首页</a> <code>&gt;</code> <a href="<?php echo U('/category/',array('cid'=>$t_nav['parent_id']));?>"><?php echo ($t_nav["parent_name"]); ?></a> <code>&gt;</code> <a href="<?php echo U('/category/',array('cid'=>$t_nav['cat_id']));?>"><?php echo ($t_nav["cat_name"]); ?></a><?php endif; ?>
</div>
</div>

 
 
<div class="blank"></div>
<div class="block clearfix">
  
  <div class="AreaL">
    
  <div id="category_tree">
  <div class="tit">所有商品分类</div>
  <dl class="clearfix" >
   <div class="box1 cate" id="cate">
   <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h1 onclick="tab(<?php echo ($i-1); ?>)" <?php if($i == 0): ?>style="border-top:none"<?php endif; ?>>
		<span class="f_l"><img src="<?php echo (RESOURCE); ?>/images/btn_fold.gif" style="padding-top:10px;padding-right:6px;cursor:pointer;"></span>
		<a href="<?php echo ($vo["url"]); ?>" class="  f_l"><?php echo ($vo["cat_name"]); ?></a>
		</h1>
		<ul style="display:none" >
		<?php if(is_array($vo["cat_id"])): foreach($vo["cat_id"] as $key=>$v1): ?><a class="over_2" href="<?php echo ($v1["url"]); ?>"><?php echo ($v1["cat_name"]); ?></a>  
		 		<div class="clearfix"></div><?php endforeach; endif; ?>
		</ul>
		<div style="clear:both"></div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div style="clear:both"></div>  
</div>   
<div class="blank"></div>
<script type="text/javascript">
obj_h4 = document.getElementById("cate").getElementsByTagName("h4")
obj_ul = document.getElementById("cate").getElementsByTagName("ul")
obj_img = document.getElementById("cate").getElementsByTagName("img")
function tab(id)
{ 
    console.log(obj_ul);
    if(obj_ul.item(id).style.display == "block")
    {
      obj_ul.item(id).style.display = "none"
      obj_img.item(id).src = "<?php echo (RESOURCE); ?>/images/btn_fold.gif"
      return false;
    }
    else(obj_ul.item(id).style.display == "none")
    {
      obj_ul.item(id).style.display = "block"
      obj_img.item(id).src = "<?php echo (RESOURCE); ?>/images/btn_unfold.gif"
    }
}
</script>

  <div class="box" id='history_div'> <div class="box_1">
 <h3><span>浏览历史</span></h3>
 
  <div class="boxCenterList clearfix" id='history_list'>
  <?php if(is_array($goods_history)): foreach($goods_history as $key=>$vo): ?><ul class="clearfix">
    <li class="goodsimg">
    <a href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>" target="_blank">
    <img src="../<?php echo ($vo["goods_thumb"]); ?>" alt="KD876" class="B_blue" /></a></li><li>
    <a href="goods.php?id=1" target="_blank" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></a>
    <br />
    本店售价：<font class="f1">￥<?php echo ($vo["shop_price"]); ?>元</font><br /></li></ul><?php endforeach; endif; ?>
    <ul id="clear_history"><a onclick="clear_history()">[清空]</a></ul>  </div>
 </div>
</div>
<div class="blank5"></div>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/jquery.js"></script>
<script type="text/javascript">
if (document.getElementById('history_list').innerHTML.replace(/\s/g,'').length<1)
{
    document.getElementById('history_div').style.display='none';
}
else
{
    document.getElementById('history_div').style.display='block';
}
function clear_history()
{
	var clear ='clear';
	$.post("<?php echo U('goods/clear_history');?>",{act:clear},function(data){
		if(data.status){
			$("#history_list").html('您已清空最近浏览过的商品');
		}
});
}
</script>  </div>
  <div class="AreaR">
	   <?php if($brands["1"] == true): ?><div class="box">
		 <div class="box_1">
			<h3><span><?php echo L('goods_filter');?></span></h3>
       <?php if($brands["1"] == true): ?><div class="screeBox">
			  <strong><?php echo L('brand');?>：</strong>
					<?php if(is_array($brands)): foreach($brands as $key=>$brand2): if($brand2["selected"] == 1): ?><span><?php echo ($brand2["brand_name"]); ?></span>
          <?php else: ?>
          <a href="<?php echo ($brand2["url"]); ?>"><?php echo ($brand2["brand_name"]); ?></a>&nbsp;<?php endif; endforeach; endif; ?>
												</div><?php endif; ?>
      <?php if(is_array($filter_attr_list)): foreach($filter_attr_list as $key=>$filter_attr): ?><div class="screeBox">
      <strong><?php echo ($filter_attr["filter_attr_name"]); ?> :</strong>
      <?php if(is_array($filter_attr["attr_list"])): foreach($filter_attr["attr_list"] as $key=>$attr): if($attr["selected"] == 1): ?><span><?php echo ($attr["attr_value"]); ?></span>
            <?php else: ?>
        <a href="<?php echo ($attr["url"]); ?>"><?php echo ($attr["attr_value"]); ?></a>&nbsp;<?php endif; endforeach; endif; ?>
      </div><?php endforeach; endif; ?>
					</div>
		</div>
		<div class="blank"></div><?php endif; ?>
   
<div class="box">
 <div class="box_1">
  <h3>
  <span>商品列表</span>
  <form method="GET" class="sort" name="listform">
  <!-- 显示方式：
  <a href="javascript:;" onClick="javascript:display_mode('list')"><img src="<?php echo (RESOURCE); ?>/images/display_mode_list.gif" alt=""></a>
  <a href="javascript:;" onClick="javascript:display_mode('grid')"><img src="<?php echo (RESOURCE); ?>/images/display_mode_grid_act.gif" alt=""></a>
  <a href="javascript:;" onClick="javascript:display_mode('text')"><img src="<?php echo (RESOURCE); ?>/images/display_mode_text.gif" alt=""></a>&nbsp;&nbsp;
     
  <a href="category.php?category=2&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=goods_id&order=ASC#goods_list"><img src="<?php echo (RESOURCE); ?>/images/goods_id_DESC.gif" alt="按上架时间排序"></a>
  <a href="category.php?category=2&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=shop_price&order=ASC#goods_list"><img src="<?php echo (RESOURCE); ?>/images/shop_price_default.gif" alt="按价格排序"></a>
  <a href="category.php?category=2&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=last_update&order=DESC#goods_list"><img src="<?php echo (RESOURCE); ?>/images/last_update_default.gif" alt="按更新时间排序"></a> -->
  <input type="hidden" name="category" value="2" />
  <input type="hidden" name="display" value="grid" id="display" />
  <input type="hidden" name="brand" value="0" />
  <input type="hidden" name="price_min" value="0" />
  <input type="hidden" name="price_max" value="0" />
  <input type="hidden" name="filter_attr" value="0" />
  <input type="hidden" name="page" value="1" />
  <input type="hidden" name="sort" value="goods_id" />
  <input type="hidden" name="order" value="DESC" />
    </form>
  </h3>
      <form name="compareForm" action="compare.php" method="post" onSubmit="return compareGoods(this);">
            <div class="clearfix goodsBox" style="border:none; padding:11px 0 10px 0px;">
            <?php if(is_array($goods)): foreach($goods as $key=>$vo): ?><div class="goodsItem" >
           <a href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>"><img src="../<?php echo ($vo["goods_thumb"]); ?>" alt="<?php echo ($vo["goods_name"]); ?>" class="goodsimg" /></a><br />
           <p><a href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>" title="<?php echo ($vo["goods_name"]); ?>"><?php echo ($vo["goods_name"]); ?></a></p>
                                    市场价：<font class="market_s"><?php echo ($vo["market_price"]); ?></font><br />
                                                                        本店价：<font class="shop_s">￥<?php echo ($vo["shop_price"]); ?>元</font><br />
                        			 
        </div><?php endforeach; endif; ?>
                    </div>
        </form>
  
 </div>
 <div id="pagebar" style="float:right;"></div>
</div>

<div class="blank5"></div>

 <script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/jquery.twbsPagination.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/css/bootstrap.css" />
<script type="text/javascript">
$(document).ready(function () {
    $('#pagebar').twbsPagination({
        totalPages: <?php echo ($total); ?>,
        visiblePages:<?php echo ($visiblePages); ?>,
    first:"首页",
    prev:"上一页",
    next:"下一页",
    last:"末页",
    version: '1.1',
    tagName:'AAA',
        onPageClick: function (event, page) {
          if(page < 1) page =1;
        $.post('<?php echo U('/category/pages');?>',{page:page,cid:'<?php echo ($cid); ?>',brand:'<?php echo ((isset($brand) && ($brand !== ""))?($brand):'0'); ?>',filter_attr:'<?php echo ((isset($filter_attrs) && ($filter_attrs !== ""))?($filter_attrs):'0'); ?>'},function(data){
          $('.clearfix .goodsBox').html(data);
        });
      
        
        }
    });
});
</script>
<script type="Text/Javascript" language="JavaScript">

var button_compare = '';
var exist = "您已经选择了%s";
var count_limit = "最多只能选择4个商品进行对比";
var goods_type_different = "\"%s\"和已选择商品类型不同无法进行对比";
var compare_no_goods = "您没有选定任何需要比较的商品或者比较的商品数少于 2 个。";
var btn_buy = "购买";
var is_cancel = "取消";
var select_spe = "请选择商品属性";
</script>
<form name="selectPageForm" action="/category.php" method="get">
 <div id="pager" class="pagebar">
      
      </div>
</form>
<script type="Text/Javascript" language="JavaScript">
<!--
function selectPage(sel)
{
  sel.form.submit();
}
//-->
</script>

  </div>  
  
</div>
<div class="blank10"></div>
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