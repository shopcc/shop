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
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/editor.js"></script>
<h1>
	<span class="action-span"><a href="<?php echo U('Goods/showlist');?>">商品列表</a></span>
	<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 添加商品信息 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab">通用信息</span>
		<span class="tab-back" id="detail-tab">详细描述</span>
		<span class="tab-back" id="mix-tab">其他信息</span>
		<span class="tab-back" id="properties-tab">商品属性</span>
		<span class="tab-back" id="gallery-tab">商品相册</span>
      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="/Admin/Goods/save" method="post" name="theForm"> 
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
		 
		 <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center" style="display: table;">
			<tbody>
				<tr>
					<td class="label">商品名称：</td>
					<td><input type="text" name="goods_name" value="<?php echo ((isset($goods["goods_name"]) && ($goods["goods_name"] !== ""))?($goods["goods_name"]):''); ?>" size="30"><span class="require-field">*</span></td>
				</tr>
				<tr>
					<td class="label">商品货号： </td>
					<td><input name="goods_sn" type="text" value="<?php echo ((isset($goods["goods_sn"]) && ($goods["goods_sn"] !== ""))?($goods["goods_sn"]):''); ?>" size="20"><span id="goods_sn_notice"></span><br>
					<span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
			</tr>
			<tr>
				<td class="label">商品分类：</td>
				<td>
					<select name="cat_id">
						<option value="0">请选择...</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$category): ?><option value="<?php echo ($category["cat_id"]); ?>" <?php if($category['cat_id'] == $goods['cat_id']): ?>selected<?php endif; ?>><?php echo str_repeat('--',$category['level']);?>|<?php echo ($category["cat_name"]); ?></option><?php endforeach; endif; ?>
					</select>
                 </td>
			</tr>
			<tr>
				<td class="label">扩展分类：</td>
				<td><input type="button" class="button" id="add_goods_cat" value="添加">
				<?php if(isset($goods_cat)): if(is_array($goods_cat)): foreach($goods_cat as $key=>$v1): ?><select name="ext_goods_cat[]">
						<option value="0">请选择...</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$category): ?><option value="<?php echo ($category["cat_id"]); ?>" <?php if($category['cat_id'] == $v1['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo str_repeat('--',$category['level']);?>|<?php echo ($category["cat_name"]); ?></option><?php endforeach; endif; ?>
					</select><?php endforeach; endif; ?>
				<?php else: ?>
				<select name="ext_goods_cat[]">
						<option value="0">请选择...</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$category): ?><option value="<?php echo ($category["cat_id"]); ?>"><?php echo str_repeat('--',$category['level']);?>|<?php echo ($category["cat_name"]); ?></option><?php endforeach; endif; ?>
					</select><?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="label">商品品牌：</td>
				<td>
					<select name="brand_id">
						<option value="0">请选择...</option>
						<?php if(is_array($brand)): foreach($brand as $key=>$brands): ?><option value="<?php echo ($brands["brand_id"]); ?>" <?php if($brands["brand_id"] == $goods['brand_id']): ?>selected<?php endif; ?>><?php echo ($brands["brand_name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
            <tr>
				<td class="label">本店售价：</td>
				<td><input type="text" name="shop_price" value="<?php echo ((isset($goods["shop_price"]) && ($goods["shop_price"] !== ""))?($goods["shop_price"]):'0.00'); ?>" size="20">
				<span class="require-field">*</span></td>
			</tr>
          <tr>
            <td class="label">市场售价：</td>
            <td><input type="text" name="market_price" value="<?php echo ((isset($goods["market_price"]) && ($goods["market_price"] !== ""))?($goods["market_price"]):'0.00'); ?>" size="20">

            </td>
          </tr>
    
          <tr>
            <td class="label"><label for="is_promote"> 促销价：</label></td>
            <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="<?php echo ((isset($goods["promote_price"]) && ($goods["promote_price"] !== ""))?($goods["promote_price"]):'0.00'); ?>" size="20"></td>
          </tr>
          <tr id="promote_4">
            <td class="label" id="promote_5">促销日期：</td>
            <td id="promote_6">
              <input name="promote_start_time" type="text" size="12" value="<?php echo date('Y-m-d',$goods['promote_start_time']);?>" readonly data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'days'}"> - <input name="promote_end_time" type="text" id="promote_end_date" size="12" value="<?php echo date('Y-m-d',$goods['promote_end_time']);?>" readonly data-am-datepicker="{format: 'yyyy-mm-dd', minviewMode: 'days'}">
            </td>
          </tr>
          <tr>
            <td class="label">上传商品图片：</td>
            <td>
           
            <input type="text" name="old_goods_img" value="<?php echo ($goods["goods_img"]); ?>" readonly/>
            <input style="display：none;" name="del_img" id="del_img" type="button" value="删除图片">
              <input type="file" name="goods_img" size="35" style="display:none">
             
            </td>
          </tr>
          <tr id="auto_thumb_1">
            <td class="label"> 上传商品缩略图：</td>
            <td id="auto_thumb_3">
              <input type="file" name="goods_thumb" size="35" disabled="">
              <br><input type="text" size="40" value="商品缩略图外部URL" style="color:#aaa;" onfocus="if (this.value == '商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url" disabled="">
                            <br><label for="auto_thumb"><input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)">自动生成商品缩略图</label>            </td>
          </tr>
        </tbody></table>

        <!-- 详细描述 -->
        <table width="90%" id="detail-table" style="display: none;">
          <tbody><tr>
            <td><textarea name="goods_desc" id="goods_desc"  style="width:800px;height:380px;visibility:hidden;"></textarea></td>
          </tr>
        </tbody></table>

        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display: none;" align="center">
            <tr>
            <td class="label">商品重量：</td>
            <td><input type="text" name="goods_weight" value="<?php echo ($goods["goods_weight_by_unit"]); ?>" size="20"> <select name="weight_unit" id="weight_unit"><option value="1" <?php if($goods["goods_weight"] >= 1): ?>selected="selected"<?php endif; ?>>千克</option><option value="0.001" <?php if($goods["goods_weight"] < 1): ?>selected="selected"<?php endif; ?>">克</option></select></td>
          </tr>
                              <tr>
            <td class="label"> 商品库存数量：</td>

            <td><input type="text" name="goods_number" value="<?php echo ((isset($goods["goods_number"]) && ($goods["goods_number"] !== ""))?($goods["goods_number"]):''); ?>" size="20"><br>
            <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
          </tr>
          <tr>
            <td class="label">库存警告数量：</td>
            <td><input type="text" name="warn_number" value="<?php echo ((isset($goods["warn_number"]) && ($goods["warn_number"] !== ""))?($goods["warn_number"]):''); ?>" size="20"></td>
          </tr>
                    <tr>
            <td class="label">加入推荐：</td>
            <td><input type="checkbox" name="is_best" value="1" <?php if($goods["is_best"] == 1): ?>checked="true"<?php endif; ?>>精品 <input type="checkbox" name="is_new" value="1" <?php if($goods["is_new"] == 1): ?>checked="true"<?php endif; ?>>新品 <input type="checkbox" name="is_hot" value="1" <?php if($goods["is_hot"] == 1): ?>checked="true"<?php endif; ?>>热销</td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2">上架：</td>
            <td id="alone_sale_3"><input type="checkbox" name="is_onsale" value="1" <?php if($goods["is_onsale"] == 1): ?>checked="true"<?php endif; ?>> 打勾表示允许销售，否则不允许销售。</td>
          </tr>
          <tr>
            <td class="label">是否为免运费商品</td>
            <td><input type="checkbox" name="is_shipping" value="1" <?php if($goods["is_shipping"] == 1): ?>checked="true"<?php endif; ?>> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。</td>
          </tr>
          <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="goods_brief" cols="40" rows="3"><?php echo ((isset($goods["goods_brief"]) && ($goods["goods_brief"] !== ""))?($goods["goods_brief"]):''); ?></textarea></td>
          </tr>
  	</table>

        <!-- 商品属性 -->
         <table width="90%" id="properties-table" style="display: none;" align="center">
			
				<tr>
					<td class="label">商品类型：</td>
					<td>
						<select id="goods_type" name="type_id" onchange="getAttrList(<?php echo ($goods["goods_id"]); ?>)">
							<option value="0">请选择商品类型</option>
							<?php if(is_array($type)): foreach($type as $key=>$types): ?><option value="<?php echo ($types["type_id"]); ?>" <?php if($types["type_id"] == $type_id): ?>selected="true"<?php endif; ?>><?php echo ($types["type_name"]); ?></option><?php endforeach; endif; ?>
						</select><br>
						<span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
					</td>
				</tr>
				<tr>
				<td id="tbody-goodsAttr" colspan="2" style="padding:0">
					<?php echo ($build_attr_html); ?>
					</td>
			 </tr>
       
	</table>
        
        <!-- 商品相册 -->
        <table width="90%" id="gallery-table" style="display: none;" align="center">
          <tbody><tr>
            <td>
            <?php if(is_array($gallery)): foreach($gallery as $key=>$vo): ?><div id="gallery_<?php echo ($vo["img_id"]); ?>" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                <a href="javascript:;" onclick="if (confirm('您确实要删除该图片吗？')) dropImg('<?php echo ($vo["img_id"]); ?>')">[-]</a><br>
                <a href="goods.php?act=show_image&amp;img_url='data/uploads/goods/20150427/1_G_1240902890755.jpg'" target="_blank">
                <img src="/<?php echo ($vo["img_url"]); ?>" width="100" height="100" border="0">
                </a><br>
                <input type="text" value="<?php echo ($vo["img_desc"]); ?>" size="15" name="old_img_desc[<?php echo ($vo["img_id"]); ?>]">
              </div><?php endforeach; endif; ?>
                          </td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td>
              <a href="javascript:;" onclick="addImg(this)">[+]</a>
              图片描述 <input type="text" name="img_desc[]" size="20">
              上传文件 <input type="file" name="img_url[]">
              <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]">
            </td>
          </tr>
        </tbody></table>

        <div class="button-div">
          <input type="hidden" name="goods_id" value="<?php echo ($goods["goods_id"]); ?>">
                    <input type="submit" id="btnSubmit" value=" 确定 " class="button">
          <input type="reset" value=" 重置 " class="button">
        </div>
        <input type="hidden" name="act" value="update">
      </form>
    </div>
</div>


<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - 
</div>

<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/tab.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/Utils.js"></script>
<script type="text/javascript">
$('#add_goods_cat').on('click',function(){
	$('#add_goods_cat').parent().append($('#add_goods_cat').next('select').clone());
	   
});
onload = function()
  {

      if (document.forms['theForm'].elements['auto_thumb'])
      {
          handleAutoThumb(document.forms['theForm'].elements['auto_thumb'].checked);
      }

      document.forms['theForm'].reset();
  }
   function handlePromote(checked)
  {
      document.forms['theForm'].elements['promote_price'].disabled = !checked;
      document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      document.forms['theForm'].elements['selbtn2'].disabled = !checked;
  }

  function handleAutoThumb(checked)
  {
      document.forms['theForm'].elements['goods_thumb'].disabled = checked;
      document.forms['theForm'].elements['goods_thumb_url'].disabled = checked;
  }
  
  function integral_market_price()
  {
    document.forms['theForm'].elements['market_price'].value = parseInt(document.forms['theForm'].elements['market_price'].value);
  }

  /**
   * 根据商品类型ID获取商品属性列表
   */

  function getAttrList(goodsId)
  {
      var goodsType = $("#goods_type option:selected").val();
	  $.post("<?php echo U('Admin/Goods/getattrlist');?>",{goods_id:goodsId,goods_type:goodsType},function(data){
		 $('#tbody-goodsAttr').html(data.content);
		  });
	  
	  $.post("<?php echo U('Admin/Goods/delattr');?>",{goods_id:goodsId},function(data){
		
		
	  });
  }

  function setAttrList(result, text_result)
  {
    document.getElementById('tbody-goodsAttr').innerHTML = result.content;
  }
  
	function addImg(obj){
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  	}

    function removeImg(obj){
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');
      tbl.deleteRow(row);
  	}

   	function dropImg(imgId){
   		$.post("<?php echo U("Goods/drop_image");?>",{img_id:imgId},function(data){
   			if(data.status){
   				$("#gallery_"+data.img_id).css('display','none');
   			}
   		});
    	//Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  	} 

  	function dropImgResponse(result){
      if (result.error == 0){
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  	}
	
	 function addSpec(obj)
  {
      var src   = obj.parentNode.parentNode;
      var idx   = rowindex(src);
      var tbl   = document.getElementById('attrTable');
      var row   = tbl.insertRow(idx + 1);
      var cell1 = row.insertCell(-1);
      var cell2 = row.insertCell(-1);
      var regx  = /<a([^>]+)<\/a>/i;

      cell1.className = 'label';
      cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
      cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
  }

function removeSpec(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('attrTable');

      tbl.deleteRow(row);
  }

	
</script>
<script>
$(document).ready(function(){
	
	$("input[name='del_img']").click(function(){
		$.post("<?php echo U('Goods/dropimg');?>",{goods_id:<?php echo ($goods["goods_id"]); ?>},function(data){
			if(data.status){
				$("input[name='old_goods_img']").css('display','none');
				$("input[name='del_img']").css('display','none');
				$("input[name='goods_img']").css('display','block');
				alert('图片删除成功');
			}else{
				alert('图片删除失败');
				$("input[name='old_goods_img']").css('display','none');
				$("input[name='del_img']").css('display','none');
				$("input[name='goods_img']").css('display','block');
			}
		});
	});
	
		$("input[name='goods_weight']").blur(function(){
			if($("#weight_unit option:selected").val() < 1){
				if($("input[name='goods_weight']").val() >1000){
					alert('当前输入值不允许超过1000,请重新输入');
					$('#btnSubmit').attr('disabled',true);
				}else{
					$('#btnSubmit').attr('disabled',false);
				}
			}
		});
		
		$("#weight_unit").change(function(){
			if($("#weight_unit option:selected").val() < 1){
				if($("input[name='goods_weight']").val() >1000){
					alert('当前输入值不允许超过1000,请重新输入');
					$('#btnSubmit').attr('disabled',true);
				}else{
					$('#btnSubmit').attr('disabled',false);
				}
			}
		});
		
});
</script>
</body>
</html>