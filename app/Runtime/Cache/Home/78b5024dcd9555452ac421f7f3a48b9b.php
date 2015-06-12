<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($goods["goods_name"]); ?> - Powered by ECShop</title>
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
		  <?php if($_SESSION['user_id']!= ''): ?>您好, <a style="color: rgb(51, 51, 51);" class="top track" href="{：U('member/index')}"><?php echo (session('user_name')); ?></a> <span style="color: #a10000"><a target="_parent" href="<?php echo U('member/logout');?>" style="color: #a10000" class="top track">退出登录</a></span>
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

<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/action.js"></script>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/mzp-packed-me.js"></script>

<script type="text/javascript">

function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("h2");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"h2bg");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}

</script>
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
当前位置: <a href="../index.php">首页</a> <code>&gt;</code> <a href="<?php echo U('/category',array('cid'=>$goods['cat_id']));?>"><?php echo ($goods["cat_name"]); ?></a> <code>&gt;</code> <?php echo ($goods["goods_name"]); ?> 
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
   
   <div id="goodsInfo" class="clearfix">
    
     
     <div class="imgInfo">
     <a href="../<?php echo ($goods["goods_img"]); ?>" id="zoom1" class="MagicZoom MagicThumb" title="KD876">
      <img src="../<?php echo ($goods["goods_img"]); ?>" alt="KD876" width="360px;" height="360px"/>
     </a>
     <div class="blank5"></div>
    <div style="text-align:center; position:relative; width:100%;">
               
            </div>
      
 
         <div class="blank"></div>
           
      <div class="picture" id="imglist">
		<?php if(is_array($gallery)): foreach($gallery as $key=>$v1): ?><a  href="../<?php echo ($v1["img_url"]); ?>"
    	rel="zoom1" 
        rev="../<?php echo ($v1["img_url"]); ?>"
        title="">
        <img src="../<?php echo ($v1["thumb_url"]); ?>" alt="<?php echo ($goods['goods_name']); ?>" class="onbg" /></a><?php endforeach; endif; ?>
</div>
 
<script type="text/javascript">
	mypicBg();
</script>     
         
     </div>
     
     <div class="textInfo">
     <form action="javascript:addToCart(<?php echo ($goods["goods_id"]); ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
	  <h1 class="clearfix" id="goods_name">
      <?php echo ($goods["goods_name"]); ?>      </h1> 
 
        
	   
	  
	  <ul class="ul2 clearfix">
        <li class="clearfix" style="width:100%">
       <dd>
 
       
       <strong>本店售价：</strong><font class="shop" id="ECS_SHOPPRICE">￥<?php echo ($goods["shop_price"]); ?>元</font> 
   
	   
	          <font class="market">￥<?php echo ($goods["market_price"]); ?>元</font> 
            </dd>
       </li>
      
      
      
      
             <li class="clearfix">
       <dd>
       <strong>商品货号：</strong><?php echo ($goods["goods_sn"]); ?>      
       </dd>
       </li> 
                      <li class="clearfix">
       <dd>
      
                  <strong>商品库存：</strong>
          <?php echo ($goods["goods_number"]); ?>             
       </dd>
       </li>  
                    <li class="clearfix">
       <dd>
      
       <strong>商品品牌：</strong><a href="brand.php?id=8" ><?php echo ($goods["brand_name"]); ?></a>
    
       </dd>
       </li>  
                       <li class="clearfix">
       <dd>
       
       <strong>商品重量：</strong><?php echo ($goods["goods_weight"]); echo L('weight_unit_'.$goods['weight_num']);?>     
       </dd>
      </li>
        
             <li class="clearfix">
       <dd>
    
      <strong>上架时间：</strong><?php echo (date("Y-m-d",$goods["add_time"])); ?>      
       </dd>
       </li>
              <li class="clearfix">
       <dd>
       
       <strong>商品点击数：</strong><?php echo ($goods["click_count"]); ?>       </dd>
      </li>
	  </ul>
      <ul>
      </ul>
         <ul class="bnt_ul">
      <!-- {* 开始循环所有可选属性 *} -->
      <?php if(is_array($specification)): foreach($specification as $spec_key=>$spec): ?><li class="padd loop">
      <strong><?php echo ($spec["name"]); ?>：</strong>
        <!-- {* 判断属性是复选还是单选 *} -->
                   <?php if($spec["attr_type"] == 1): if(C(GOODSATTR_STYLE) == 1): if(is_array($spec["values"])): foreach($spec["values"] as $key=>$value): ?><label for="spec_value_<?php echo ($value["id"]); ?>">
                        <input type="radio" name="spec_<?php echo ($spec_key); ?>" value="<?php echo ($value["id"]); ?>" id="spec_value_<?php echo ($value["id"]); ?>" <?php if($key == 0): ?>checked<?php endif; ?> onclick="changePrice()" />
                        <?php echo ($value["label"]); ?> [<?php if($value["price"] > 0): echo L('plus'); else: echo L('minus'); endif; ?> <?php echo ($value["format_price"]); ?>] </label><?php endforeach; endif; ?>
                        <input type="hidden" name="spec_list" value="<?php echo ($key); ?>" />
                        	<?php else: ?>
                        <select name="spec_<?php echo ($spec_key); ?>" onchange="changePrice()" >
                          		<?php if(is_array($spec["values"])): foreach($spec["values"] as $key=>$value): ?><option label="<?php echo ($value["label"]); ?>" value="<?php echo ($value["id"]); ?>"><?php echo ($value["label"]); ?> <?php if($value["price"] > 0): echo L('plus'); else: echo L('minus'); endif; if($value["price"] != 0): echo ($value["format_price"]); endif; ?></option><?php endforeach; endif; ?>
                        </select>
                        <input type="hidden" name="spec_list" value="<?php echo ($key); ?>" /><?php endif; ?>
                    <?php else: ?>
                      	<?php if(is_array($spec["values"])): foreach($spec["values"] as $key=>$value): ?><label for="spec_value_<?php echo ($value["id"]); ?>">
                      <input type="checkbox" name="spec_<?php echo ($spec_key); ?>" value="<?php echo ($value["id"]); ?>" id="spec_value_<?php echo ($value["id"]); ?>" onclick="changePrice()" />
                      <?php echo ($value["label"]); ?> [<?php if($value["price"] > 0): echo L('plus'); else: echo L('minus'); endif; ?> <?php echo ($value["format_price"]); ?>] </label><?php endforeach; endif; ?>
                      <input type="hidden" name="spec_list" value="<?php echo ($key); ?>" /><?php endif; ?>
      </li><?php endforeach; endif; ?>
      <!-- {* 结束循环可选属性 *} -->
      
      
           <li class="clearfix">
       <dd>
       <strong>购买数量：</strong>
        <input name="number" type="text" id="number" value="1" size="4" onblur="changePrice()" style="border:1px solid #ccc; "/> <strong>商品总价：</strong><font id="ECS_GOODS_AMOUNT" class="f1"></font>
       </dd>
       </li>
      
      <li class="padd">
      <?php if($goods['goods_number'] < $goods['warn_number']): ?><img src="<?php echo (RESOURCE); ?>/images/goumai3.gif" />
      <?php else: ?>
      <a href="javascript:addToCart(<?php echo ($goods["goods_id"]); ?>)"><img src="<?php echo (RESOURCE); ?>/images/goumai2.gif" /></a><?php endif; ?>
      </li>
     
      </ul>
      </form>
     </div>
   </div>
   <div class="blank"></div>
   
   
     <div class="box">
 
      <div style="padding:0 0px;">
        <div id="com_b" class="history clearfix">
        <h2>商品描述</h2>
        <h2 class="h2bg">商品属性</h2>
        </div>
      </div>    <div class="box_1">
      <div id="com_v" class="  " style="padding:6px;"></div>
      <div id="com_h">
       <blockquote>
      <?php echo ($goods["goods_desc"]); ?>
      </blockquote> 
       
       <blockquote>
      <table class="table" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
           <?php if(is_array($properties)): foreach($properties as $key=>$property_group): ?><tr>
          <th colspan="2" bgcolor="#FFFFFF"><?php echo (htmlspecialchars($key)); ?></th>
        </tr>
        	<?php if(is_array($property_group)): foreach($property_group as $key=>$property): ?><tr>
          <td bgcolor="#FFFFFF" align="left" width="30%" class="f1">[<?php echo (htmlspecialchars($property["name"])); ?>]</td>
          <td bgcolor="#FFFFFF" align="left" width="70%"><?php echo ($property["value"]); ?></td>
        </tr><?php endforeach; endif; endforeach; endif; ?>
          </table>
     </blockquote>
     <blockquote>
       <div class="blank5"></div>
     </blockquote>
     <blockquote>
     </blockquote>
      </div>
     </div>
    </div>
    <script type="text/javascript">
    <!--
    reg("com");
    //-->
    </script>
  <div class="blank"></div>
  
   
     <div class="box"></div>
    <div class="blank5"></div>
    <div id="ECS_COMMENT"> <div class="box">
     <div class="box_1">
      <h3><span class="text">用户评论</span>(共<font class="f1"><?php echo ($count_comment); ?></font>条评论)</h3>
      <div class="boxCenterLists clearfix" style="height:1%;">
       <ul class="comments">
       <?php if($comment == ''): ?><li>暂时还没有任何用户评论</li>
         <?php else: ?>
          <?php if(is_array($comment)): foreach($comment as $key=>$comm): ?><li class="word">
            <font class="f2"><?php echo ($comm["user_name"]); ?></font> <font class="f3">(<?php echo (date("Y-m-d H:i:s",$comm["add_time"])); ?> )</font><br>
            <img src="<?php echo (RESOURCE); ?>/images/stars<?php echo ($comm["comment_rank"]); ?>.gif" alt="">
            <p><?php echo ($comm["content"]); ?></p>
          </li><?php endforeach; endif; endif; ?>
          </ul>
       
       <div id="pagebar" class="f_r">
        <form name="selectPageForm" action="/goods.php" method="get">
                <div id="pager">
            <ul id="pagination-1" class="pagination-sm"></ul>
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
      
      <div class="blank5"></div>
      
      <div class="commentsList">
      <form action="javascript:;" onsubmit="submitComment(this)" method="post" name="commentForm" id="commentForm">
       <table width="710" border="0" cellspacing="5" cellpadding="0">
        <tr>
          <td width="64" align="right">用户名：</td>
          <td width="631"><?php if($_SESSION['user_name']!= ''): echo (session('user_name')); else: ?>匿名用户<?php endif; ?></td>
        </tr>
        <tr>
          <td align="right">E-mail：</td>
          <td>
          <input type="text" name="email" id="email"  maxlength="100" value="" class="inputBorder"/>
          </td>
        </tr>
        <tr>
          <td align="right">评价等级：</td>
          <td>
          <input name="comment_rank" type="radio" value="1" id="comment_rank1" /> <img src="<?php echo (RESOURCE); ?>/images/stars1.gif" />
          <input name="comment_rank" type="radio" value="2" id="comment_rank2" /> <img src="<?php echo (RESOURCE); ?>/images/stars2.gif" />
          <input name="comment_rank" type="radio" value="3" id="comment_rank3" /> <img src="<?php echo (RESOURCE); ?>/images/stars3.gif" />
          <input name="comment_rank" type="radio" value="4" id="comment_rank4" /> <img src="<?php echo (RESOURCE); ?>/images/stars4.gif" />
          <input name="comment_rank" type="radio" value="5" id="comment_rank5" /> <img src="<?php echo (RESOURCE); ?>/images/stars5.gif" />
          </td>
        </tr>
        <tr>
          <td align="right" valign="top">评论内容：</td>
          <td>
          <textarea name="content" class="inputBorder" style="height:50px; width:620px;"></textarea>
          <input type="hidden" name="cmt_type" value="0" />
          <input type="hidden" name="goods_id" value="<?php echo ($goods["goods_id"]); ?>" />
          <input type="hidden" name="ip_address" value="<?php echo get_client_ip();?>" />
          <input type="hidden" name="add_time" value="<?php echo time();?>" />
          <input type="hidden" name="user_id" value="<?php echo (session('user_id')); ?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2">
                    <div style="padding-left:15px; text-align:left; float:left;">
          验证码：<input type="text" name="captcha"  class="inputBorder" style="width:50px; margin-left:5px;"/>
          <img src="<?php echo U('public/Captcha');?>" alt="captcha" onClick="this.src='<?php echo U('public/Captcha');?>#'+Math.random()" class="captcha">
          </div>
                         <input name="" type="submit"  value="评论咨询" class="f_r bnt_blue_1" style=" margin-right:8px;">
                         <input type="hidden" name="cart_act" value="<?php echo U('/cart');?>" />
          </td>
        </tr>
      </table>
      </form>
      </div>
      
      </div>
     </div>
    </div>
    <div class="blank5"></div>

  <script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/toastr/toastr.min.js"></script>
  <script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/toastr/core.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/js/toastr/toastr.min.css" />

  <script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo (RESOURCE); ?>/js/jquery.twbsPagination.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo (RESOURCE); ?>/css/bootstrap.css" />
<script type="text/javascript">
//<![CDATA[
var cmt_empty_username = "请输入您的用户名称";
var cmt_empty_email = "请输入您的电子邮件地址";
var cmt_error_email = "电子邮件地址格式不正确";
var cmt_empty_content = "您没有输入评论的内容";
var captcha_not_null = "验证码不能为空!";
var cmt_invalid_comments = "无效的评论内容!";
onload = function(){
  changePrice();
}

$(document).ready(function () {
    $('#pagination-1').twbsPagination({
        totalPages: <?php echo ($totlapage); ?>,
        visiblePages: <?php echo ($visiblePage); ?>,
    first:"首页",
    prev:"上一页",
    next:"下一页",
    last:"末页",
    version: '1.1',
    tagName:'AAA',
        onPageClick: function (event, page) {
          
          $(document).ready(function(){
                  if(page=='0')page=1;
                 $.post("<?php echo U('comment/getcomment');?>",{page:page,goods_id:<?php echo ($goods["goods_id"]); ?>},function(data){
                   $('.comments').html(data.content);
                 
        });
          });
      
        
        }
    });
});


/**
 * 提交评论信息
*/
function submitComment(frm)
{
  var cmt = new Object;

  //cmt.username        = frm.elements['username'].value;
  cmt.email           = frm.elements['email'].value;
  cmt.content         = frm.elements['content'].value;
  cmt.type            = frm.elements['cmt_type'].value;
  cmt.goods_id        = frm.elements['goods_id'].value;
 /* cmt.enabled_captcha = frm.elements['enabled_captcha'] ? frm.elements['enabled_captcha'].value : '0';*/
  cmt.captcha         = frm.elements['captcha'] ? frm.elements['captcha'].value : '';
  cmt.comment_rank            = 0;
  cmt.ip_address      = frm.elements['ip_address'].value;
  cmt.add_time        = frm.elements['add_time'].value;
  cmt.user_id        = frm.elements['user_id'].value ? frm.elements['user_id'].value : '0';

  for (i = 0; i < frm.elements['comment_rank'].length; i++)
  {
    if (frm.elements['comment_rank'][i].checked)
    {
       cmt.comment_rank = frm.elements['comment_rank'][i].value;
     }
  }

//  if (cmt.username.length == 0)
//  {
//     alert(cmt_empty_username);
//     return false;
//  }

  if (cmt.email.length > 0)
  {
     if (!(Utils.isEmail(cmt.email)))
     {
        alert(cmt_error_email);
        return false;
      }
   }
   else
   {
        alert(cmt_empty_email);
        return false;
   }

   if (cmt.content.length == 0)
   {
      alert(cmt_empty_content);
      return false;
   }

   if (cmt.enabled_captcha > 0 && cmt.captcha.length == 0 )
   {
      alert(captcha_not_null);
      return false;
   }

   /*Ajax.call('comment.php', 'cmt=' + cmt.toJSONString(), commentResponse, 'POST', 'JSON');*/
   $.post("<?php echo U('comment/add_comment');?>",cmt,function(data){
      if(data.status){
        alert(data.info);
      }else{
        alert(data.info);
      }
   });
   return false;
}

/**
 * 处理提交评论的反馈信息
*/
  function commentResponse(result)
  {
    if (result.message)
    {
      alert(result.message);
    }

    if (result.error == 0)
    {
      var layer = document.getElementById('ECS_COMMENT');

      if (layer)
      {
        layer.innerHTML = result.content;
      }
    }
  }

//]]>
/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;
  if(qty <=0 ){
    qty = 1;
    $('#number').val('1');
  }
  var goodsId = <?php echo ($goods["goods_id"]); ?>;
  // Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
  $.post("<?php echo U('goods/price');?>",{goods_id:goodsId,attrs:attr,number:qty},function(data){
      $("#ECS_GOODS_AMOUNT").html("￥"+data.price+"元");
  })
  
}
</script></div>
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