<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ECSHOP演示站 - Powered by ECShop</title>
<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/css/style.css" />
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/index.js"></script>

</head>
<body class="index_page">
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



	<div style="clear: both"></div>
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
 
	<div class="block clearfix">
		<div class="AreaL">
			<script type="text/javascript">
          //初始化主菜单
            function sw_nav2(obj,tag)
            {
            var DisSub2 = document.getElementById("DisSub2_"+obj);
            var HandleLI2= document.getElementById("HandleLI2_"+obj);
                if(tag==1)
                {
                    DisSub2.style.display = "block";
					HandleLI2.className="current";
                }
                else
                {
                    DisSub2.style.display = "none";
					HandleLI2.className="";
                }
            }
</script>



			<div id="category_tree">
				<div class="tit">所有商品分类</div>
				<dl class="clearfix">
					<?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><div class="dt" onMouseOver="sw_nav2(<?php echo ($vo["cat_id"]); ?>,1);"
						onMouseOut="sw_nav2(<?php echo ($vo["cat_id"]); ?>,0);">

						<div id="HandleLI2_<?php echo ($vo["cat_id"]); ?>">
							<a class="a" href="<?php echo U('/category',array('cid'=>$vo['cat_id']));?>"> <?php echo ($vo["cat_name"]); ?> <img
								src="<?php echo (RESOURCE); ?>/images/biao8.gif">
							</a>
						</div>

						<dd id=DisSub2_<?php echo ($vo["cat_id"]); ?> style="display: none">
							<?php if(is_array($vo['child'])): foreach($vo['child'] as $key=>$v1): ?><a
								class="over_2" href="<?php echo U('/category',array('cid'=>$v1['cat_id']));?>"><?php echo ($v1["cat_name"]); ?></a>
							<div class="clearfix"></div><?php endforeach; endif; ?>
						</dd>
					</div><?php endforeach; endif; ?>
				</dl>
			</div>
			<div class="blank"></div>

		</div>
		<div style="float: right; width: 994px;">

			<style type="text/css">

.container, .container * {
	margin: 0;
	padding: 0;
}

.container {
	width: 994px;
	height: 410px;
	overflow: hidden;
	position: relative;
}

.slider {
	position: absolute;
}

.slider li {
	list-style: none;
	display: inline;
}

.slider img {
	width: 994px;
	height: 410px;
	display: block;
}

.slider2 {
	width: 2000px;
}

.slider2 li {
	float: left;
}

.num {
	position: absolute;
	right: 5px;
	bottom: 5px;
}

.num li {
	float: left;
	color: #d71437;
	text-align: center;
	line-height: 16px;
	width: 16px;
	height: 16px;
	font-family: Arial;
	font-size: 12px;
	cursor: pointer;
	overflow: hidden;
	margin: 3px 1px;
	border: 1px solid #d71437;
	background-color: #fff;
}

.num li.on {
	color: #fff;
	line-height: 21px;
	width: 21px;
	height: 21px;
	font-size: 16px;
	margin: 0 1px;
	border: 0;
	background-color: #E4393C;
	font-weight: bold;
}

</style>
			<div class="container" id="idTransformView">
				<ul class="slider" id="idSlider">
					<li><a href="#" target="_blank"><img
							src="data/resource/afficheimg/20140923jaygzo.gif" /></a></li>
					<li><a href="http://ectouch.cn/" target="_blank"><img
							src="data/resource/afficheimg/20140923gibgaz.jpg" /></a></li>
					<li><a href="http://www.ecmoban.com/djd/" target="_blank"><img
							src="data/resource/afficheimg/20140923akyfgt.jpg" /></a></li>
					<li><a href="http://www.ecmoban.com/shangchuang/"
						target="_blank"><img
							src="data/resource/afficheimg/20140923megixd.jpg" /></a></li>
					<li><a href="http://www.ecmoban.com/weixin/" target="_blank"><img
							src="data/resource/afficheimg/20140923tdmnvr.jpg" /></a></li>

				</ul>
				<ul class="num" id="idNum">


					<li>1</li>
					<li>2</li>
					<li>3</li>
					<li>4</li>
					<li>5</li>

				</ul>
			</div>
			<script type="text/javascript">

var $ = function (id) {
	return "string" == typeof id ? document.getElementById(id) : id;
};
var Class = {
  create: function() {
	return function() {
	  this.initialize.apply(this, arguments);
	}
  }
}
Object.extend = function(destination, source) {
	for (var property in source) {
		destination[property] = source[property];
	}
	return destination;
}
var TransformView = Class.create();
TransformView.prototype = {
  //容器对象,滑动对象,切换参数,切换数量
  initialize: function(container, slider, parameter, count, options) {
	if(parameter <= 0 || count <= 0) return;
	var oContainer = $(container), oSlider = $(slider), oThis = this;
	this.Index = 0;//当前索引
	
	this._timer = null;//定时器
	this._slider = oSlider;//滑动对象
	this._parameter = parameter;//切换参数
	this._count = count || 0;//切换数量
	this._target = 0;//目标参数
	
	this.SetOptions(options);
	
	this.Up = !!this.options.Up;
	this.Step = Math.abs(this.options.Step);
	this.Time = Math.abs(this.options.Time);
	this.Auto = !!this.options.Auto;
	this.Pause = Math.abs(this.options.Pause);
	this.onStart = this.options.onStart;
	this.onFinish = this.options.onFinish;
	
	oContainer.style.overflow = "hidden";
	oContainer.style.position = "relative";
	
	oSlider.style.position = "absolute";
	oSlider.style.top = oSlider.style.left = 0;
  },
  //设置默认属性
  SetOptions: function(options) {
	this.options = {//默认值
		Up:			true,//是否向上(否则向左)
		Step:		5,//滑动变化率
		Time:		10,//滑动延时
		Auto:		true,//是否自动转换
		Pause:		2000,//停顿时间(Auto为true时有效)
		onStart:	function(){},//开始转换时执行
		onFinish:	function(){}//完成转换时执行
	};
	Object.extend(this.options, options || {});
  },
  //开始切换设置
  Start: function() {
	if(this.Index < 0){
		this.Index = this._count - 1;
	} else if (this.Index >= this._count){this.Index = 0;}
	
	this._target = -1 * this._parameter * this.Index;
	this.onStart();
	this.Move();
  },
  //移动
  Move: function() {
	clearTimeout(this._timer);
	var oThis = this, style = this.Up ? "top" : "left", iNow = parseInt(this._slider.style[style]) || 0, iStep = this.GetStep(this._target, iNow);
	
	if (iStep != 0) {
		this._slider.style[style] = (iNow + iStep) + "px";
		this._timer = setTimeout(function(){oThis.Move();}, this.Time);
	} else {
		this._slider.style[style] = this._target + "px";
		this.onFinish();
		if (this.Auto) { this._timer = setTimeout(function(){oThis.Index++; oThis.Start();}, this.Pause); }
	}
  },
  //获取步长
  GetStep: function(iTarget, iNow) {
	var iStep = (iTarget - iNow) / this.Step;
	if (iStep == 0) return 0;
	if (Math.abs(iStep) < 1) return (iStep > 0 ? 1 : -1);
	return iStep;
  },
  //停止
  Stop: function(iTarget, iNow) {
	clearTimeout(this._timer);
	this._slider.style[this.Up ? "top" : "left"] = this._target + "px";
  }
};
window.onload=function(){
	function Each(list, fun){
		for (var i = 0, len = list.length; i < len; i++) {fun(list[i], i);}
	};
	
	var objs = $("idNum").getElementsByTagName("li");
	
	var tv = new TransformView("idTransformView", "idSlider", 410, 5, {
		onStart : function(){ Each(objs, function(o, i){o.className = tv.Index == i ? "on" : "";}) }//按钮样式
	});
	
	tv.Start();
	
	Each(objs, function(o, i){
		o.onmouseover = function(){
			o.className = "on";
			tv.Auto = false;
			tv.Index = i;
			tv.Start();
		}
		o.onmouseout = function(){
			o.className = "";
			tv.Auto = true;
			tv.Start();
		}
	})
	
	////////////////////////test2
}

</script>





			<div class="blank5"></div>
			<div class="blank"></div>


		</div>


		<div class="blank"></div>


		<div class="goodsBox_1">



			<div class="xm-box">
				<h4 class="title">
					<span>新品上架</span> <a class="more" href="#">更多</a>
				</h4>
				<div class="blank"></div>
				<div id="show_new_area" class="clearfix">
					<?php if(is_array($new)): foreach($new as $key=>$v0): ?><div class="goodsItem">

						<a href="<?php echo U('goods/detail',array('id'=>$v0['goods_id']));?>"><img src="<?php echo ($v0["goods_thumb"]); ?>"
							alt="<?php echo ($v0["goods_name"]); ?>" class="goodsimg" /></a><br />
						<p class="f1">
							<a href="<?php echo U('goods/detail',array('id'=>$v0['goods_id']));?>" title="<?php echo ($v0["goods_name"]); ?>"><?php echo ($v0["goods_name"]); ?></a>
						</p>


						市场价：<font class="market">￥<?php echo ($v0["market_price"]); ?>元</font> <br /> 本店价：<font
							class="f1"> ￥<?php echo ($v0["shop_price"]); ?>元 </font>

					</div><?php endforeach; endif; ?>
				</div>
			</div>
			<div class="blank"></div>
			<div class="xm-box">
				<h4 class="title">
					<span>热卖商品</span> <a class="more" href="#">更多</a>
				</h4>
				<div class="blank"></div>
				<div id="show_hot_area" class="clearfix">
					<?php if(is_array($hot)): foreach($hot as $key=>$v1): ?><div class="goodsItem">

						<a href="<?php echo U('goods/detail',array('id'=>$v1['goods_id']));?>"><img src="<?php echo ($v1["goods_thumb"]); ?>"
							alt="<?php echo ($v1["goods_name"]); ?>" class="goodsimg" /></a><br />
						<p class="f1">
							<a href="<?php echo U('goods/detail',array('id'=>$v1['goods_id']));?>" title="<?php echo ($v1["goods_name"]); ?>"><?php echo ($v1["goods_name"]); ?></a>
						</p>


						市场价：<font class="market">￥<?php echo ($v1["market_price"]); ?>元</font> <br /> 本店价：<font
							class="f1"> ￥<?php echo ($v1["shop_price"]); ?>元 </font>

					</div><?php endforeach; endif; ?>
				</div>
			</div>
			<div class="blank"></div>
			<div class="xm-box">
				<h4 class="title">
					<span>精品推荐</span> <a class="more" href="#">更多</a>
				</h4>
				<div class="blank"></div>
				<div id="show_best_area" class="clearfix">
                <?php if(is_array($best)): foreach($best as $key=>$v2): ?><div class="goodsItem">

						<a href="<?php echo U('goods/detail',array('id'=>$v2['goods_id']));?>"><img
							src="<?php echo ($v2["goods_thumb"]); ?>"
							alt="<?php echo ($v2["goods_name"]); ?>" class="goodsimg" /></a><br />
						<p class="f1">
							<a href="<?php echo U('goods/detail',array('id'=>$v2['goods_id']));?>" title="<?php echo ($v2["goods_name"]); ?>"><?php echo ($v2["goods_name"]); ?></a>
						</p>


						市场价：<font class="market">￥<?php echo ($v2["market_price"]); ?>元</font> <br /> 本店价：<font
							class="f1"> ￥2<?php echo ($v2["shop_price"]); ?>元 </font>

					</div><?php endforeach; endif; ?>
                    </div>
				</div>
			</div>
			<div class="blank"></div>

		</div>

	</div>


	<div class="blank10"></div>
	<div class="blank"></div>

	<div class="w">
		<div id="footer-2013">
			<div class="links">

				<a href="#">免责条款</a> | <a href="#">隐私保护</a>
				| <a href="#">咨询热点</a> | <a href="#">联系我们</a>
				| <a href="#">公司简介</a> | <a href="#">批发方案</a>
				| <a href="#">配送方式</a>


			</div>

			<div class="copyright">
				&copy; 2005-2015 ECSHOP 版权所有，并保留所有权利。<br /> <br />



			</div>
		
			<br />


		</div>
	</div>

	<div class="QQbox" id="divQQbox" style="width: 170px;">
		<div class="Qlist" id="divOnline" onmouseout="hideMsgBox(event);"
			style="display: none;" onmouseover="OnlineOver();">
			<div class="t"></div>
			<div class="infobox">
				我们营业的时间<br>9:00-18:00
			</div>
			<div class="con">
				<ul>
				</ul>
			</div>
			<div class="b"></div>
		</div>
		<div id="divMenu" onmouseover="OnlineOver();" style="display: block;">
			<img src="<?php echo (RESOURCE); ?>/qq/images/qq_1.gif" class="press" alt="在线咨询">
		</div>
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
</body>
</html>