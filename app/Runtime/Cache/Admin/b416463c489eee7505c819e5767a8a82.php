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
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 用户评论 </span>
<div style="clear:both"></div>
</h1>
<div class="form-div">
  <form action="javascript:searchComment()" name="searchForm">
    <img src="<?php echo (ADMIN_RES_PATH); ?>/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    输入评论内容 <input type="text" name="keyword" /> <input type="submit" class="Button" value=" 搜索 " />
  </form>
</div>



<!-- start comment list -->
<div class="list-div" id="listDiv">


</div>
<!-- end comment list -->


<script type="text/javascript" src="<?php echo (ADMIN_RES_PATH); ?>/js/utils.js"></script>
<script type="text/javascript">
  /**
   * 搜索评论
   */
  function searchComment()
  {
      var keyword = $.trim(document.forms['searchForm'].elements['keyword'].value);
      if (keyword.length > 0)
      {
          $.post('<?php echo U('comment/comment_list');?>',{content:keyword,page:1},function(data){
              $('#listDiv').html(data);
          })
          
      }
      else
      {
              $.post('<?php echo U('comment/comment_list');?>',{page:1},function(data){
              $('#listDiv').html(data);
          })
      }
  }
  

  function confirm_bath()
  {
    var action = document.forms['listForm'].elements['sel_action'].value;

    return confirm(cfm[action]);
  }
  function selectAll(){
      var btn = $("#btnSubmit").prop('disabled');
        $(".ck").prop("checked",this.checked);
        $("#btnSubmit").prop("disabled",!btn);    
  }

  function selectOne(){
    var id =$("input[name='checkboxes[]']:checked");
          
          if(id.length >=1){
             $("#btnSubmit").prop("disabled",false);
          }else{
             $("#btnSubmit").prop("disabled",true);
          }
  }

  function sub(){
    var select_act =$('#select_act option:selected').val();
      
            
              var checkedList = new Array(); 
            $("input[name='checkboxes[]']:checked").each(function() { 
            checkedList.push($(this).val()); 
            });
      $.post('<?php echo U('comment/batch');?>',{act:select_act,comment_id:checkedList.toString()},function(data){
            if(data.status){
               $.post('<?php echo U('comment/comment_list');?>',{page:1},function(data){
                    $('#listDiv').html(data);
                });
            }
            });
  }

  function showpage(url){
    $.get(url,function(data){
        $('#listDiv').html(data);
        
    });
  }

  function del(id,tmp){
    $.post('<?php echo U('comment/del');?>',{comment_id:id},function(data){
      if(data.status){
        $(tmp).parent().parent().remove();
      }
    })
  }

  $(document).ready(function(){
    $.post('<?php echo U('comment/comment_list');?>',{page:1},function(data){
        $('#listDiv').html(data);
        
    });
    
     
  });

   
   function selectAll(){
        var flag = $('.ck').prop('checked')
        $('.ck').prop('checked',!flag);
       
  }
//-->
</script>
<div id="footer">
共执行 9 个查询，用时 0.012001 秒，Gzip 已禁用，内存占用 2.100 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<!-- 新订单提示信息 -->
<script type="text/javascript">
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
        if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = 'lightblue';
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