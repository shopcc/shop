<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 编辑分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_RES_PATH); ?>/styles/main.css" />
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U('Category/alllist');?>">商品分类</a></span>
<span class="action-span1"><a href="/Admin/Index/main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 编辑分类 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="/Admin/Category/edit/cat_id/1.html" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">分类名称:</td>
				<td><input type="text" name="cat_name" maxlength="20" value="<?php echo ((isset($info["cat_name"]) && ($info["cat_name"] !== ""))?($info["cat_name"]):''); ?>" size="27"> <font color="red">*</font></td>
			</tr>
			<tr>
				<td class="label">上级分类:</td>
				<td>
					<select name="parent_id">
						<option value="0">顶级分类</option>
						<?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo["cat_id"]); ?>" <?php if($vo["cat_id"] == $info['parent_id']): ?>selected="true"<?php else: endif; ?>><?php echo str_repeat("&nbsp;&nbsp;",$vo['level']*2); echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>        
					</select>
				</td>
			</tr>

			<tr id="measure_unit">
				<td class="label">数量单位:</td>
				<td><input type="text" name="measure_unit" value="<?php echo ((isset($info["measure_unit"]) && ($info["measure_unit"] !== ""))?($info["measure_unit"]):""); ?>" size="12"></td>
			</tr>
			<tr>
				<td class="label">排序:</td>
				<td><input type="text" name="sort_order" value="<?php echo ((isset($info["sort_order"]) && ($info["sort_order"] !== ""))?($info["sort_order"]):""); ?>" size="15"></td>
			</tr>

			<tr>
				<td class="label">是否显示:</td>
				<td><input type="radio" name="is_show" value="1" <?php if($info["is_show"] == 1): ?>checked="true"<?php else: endif; ?>> 是<input type="radio" name="is_show" value="0" <?php if($info["is_show"] == 0): ?>checked="true"<?php else: endif; ?>> 否  </td>
			</tr>
			<tr>
				<td class="label">是否显示在导航栏:</td>
				<td><input type="radio" name="show_in_nav" value="1" <?php if($info["show_in_nav"] == 1): ?>checked="true"<?php else: endif; ?>> 是  <input type="radio" name="show_in_nav" value="0" <?php if($info["show_in_nav"] == 0): ?>checked="true"<?php else: endif; ?>> 否    </td>
			</tr>
	  	<tr>
				<td class="label">筛选属性:</td>
				<td>
          <script type="text/javascript">
          var arr = new Array();
          var sel_filter_attr = "请选择筛选属性";

           <?php if(is_array($types)): foreach($types as $att_cat_id=>$val): ?>arr[<?php echo ($att_cat_id); ?>] = new Array();
            <?php if(is_array($val)): foreach($val as $i=>$item): if(is_array($item)): foreach($item as $attr_id=>$attr_val): ?>arr[<?php echo ($att_cat_id); ?>][<?php echo ($i); ?>] = ["<?php echo ($attr_val); ?>", <?php echo ($attr_id); ?>];<?php endforeach; endif; endforeach; endif; endforeach; endif; ?>

          function changeCat(obj)
          {
            var key = obj.value;
            var sel = window.ActiveXObject ? obj.parentNode.childNodes[4] : obj.parentNode.childNodes[5];
            sel.length = 0;
            sel.options[0] = new Option(sel_filter_attr, 0);
            if (arr[key] == undefined)
            {
              return;
            }
            for (var i= 0; i < arr[key].length ;i++ )
            {
              sel.options[i+1] = new Option(arr[key][i][0], arr[key][i][1]);
            }

          }

          </script>

         
          <table width="100%" id="tbody-attr" align="center">
                       
                        <tbody>
            <?php if($type_attr == 0): ?><tr>
              <td>   
                   <a href="javascript:;" onclick="addFilterAttr(this)">[+]</a> 
                   <select onChange="changeCat(this)"><option value="0">请选择商品类型</option>
                   <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>" <?php if($vo['type_id'] == $v1['type_id']): ?>selected="true"<?php endif; ?>><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>&nbsp;&nbsp;
                   <select name="filter_attr[]"><option value="0">请选择筛选属性</option></select><br />                   
              </td>
            </tr><?php endif; ?>  
                        <?php if(is_array($type_attr)): $i = 0; $__LIST__ = $type_attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><tr>
              <td>
                              <?php if($i-1 == 0): ?><a href="javascript:;" onclick="addFilterAttr(this)">[+]</a>
                               <?php else: ?>
                                	 <a href="javascript:;" onclick="removeFilterAttr(this)">[-]</a><?php endif; ?>
                                  <select onchange="changeCat(this)">
                                  <option value="0">请选择商品类型</option>
                                  <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>" <?php if($vo['type_id'] == $v1['type_id']): ?>selected="true"<?php endif; ?>><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select>&nbsp;&nbsp;
                 <select name="filter_attr[]"><option value="0">请选择筛选属性</option>
	<option value="<?php echo ($v1["attr_id"]); ?>" selected="selected"><?php echo ($v1["attr_name"]); ?></option>
                 </select><br>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                        
                      </tbody></table>

          <span class="notice-span" style="display:block" id="noticeFilterAttr">筛选属性可在前分类页面筛选商品</span>
        </td>
			</tr>
			
      <tr>
        <td class="label">分类描述:</td>
        <td>
          <textarea name="cat_desc" rows="6" cols="48"><?php echo ($info["cat_desc"]); ?></textarea>
        </td>
      </tr>
      </tbody></table>
      <div class="button-div">
        <input type="submit" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
    <input type="hidden" name="cat_id" value="<?php echo ($info["cat_id"]); ?>">
  </form>
</div>



<div id="footer">
	版权所有 &copy; 2012-2013 传智播客 - PHP培训 - 
</div>

</div>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/validator.js"></script>
<script language="javascript">
<!--
document.forms['theForm'].elements['cat_name'].focus();
/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("cat_name",      catname_empty);
  if (parseInt(document.forms['theForm'].elements['grade'].value) >10 || parseInt(document.forms['theForm'].elements['grade'].value) < 0)
  {
    validator.addErrorMsg('价格分级数量只能是0-10之内的整数');
  }
  return validator.passed();
}
/**
 * 新增一个筛选属性
 */
function addFilterAttr(obj)
{
  var src = obj.parentNode.parentNode;
  var tbl = document.getElementById('tbody-attr');

  var validator  = new Validator('theForm');
  var filterAttr = document.getElementsByName("filter_attr[]");

  if (filterAttr[filterAttr.length-1].selectedIndex == 0)
  {
    validator.addErrorMsg(filter_attr_not_selected);
  }
  
  for (i = 0; i < filterAttr.length; i++)
  {
    for (j = i + 1; j <filterAttr.length; j++)
    {
      if (filterAttr.item(i).value == filterAttr.item(j).value)
      {
        validator.addErrorMsg(filter_attr_not_repeated);
      } 
    } 
  }

  if (!validator.passed())
  {
    return false;
  }

  var row  = tbl.insertRow(tbl.rows.length);
  var cell = row.insertCell(-1);
  cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addFilterAttr)(.*)(\[)(\+)/i, "$1removeFilterAttr$3$4-");
  filterAttr[filterAttr.length-1].selectedIndex = 0;
}

/**
 * 删除一个筛选属性
 */
function removeFilterAttr(obj)
{
  var row = rowindex(obj.parentNode.parentNode);
  var tbl = document.getElementById('tbody-attr');

  tbl.deleteRow(row);
}

</script>
</body>
</html>