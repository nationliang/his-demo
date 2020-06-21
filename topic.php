<html>
<head>
<title>系统设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" rel="stylesheet" type="text/css">
<script>
function adddep(){
	document.getElementById("bgd").style.display=(document.getElementById("bgd").style.display=="block"?"none":"block");
	document.getElementById("dc").style.display=(document.getElementById("dc").style.display=="block"?"none":"block");	
}
function juge3(theForm){
	if(theForm.diainput.value==""){
		alert("主题名不能为空！");
		theForm.diainput.focus();
		return false;
	}	
	if(theForm.newsbody.value==""){
		alert("主题描述不能为空！");
		theForm.newsbody.focus();
		return false;
	}		
}

function setpage(num){
	var parameter=location.search.substr(1,3);
	var pms=parameter.split("=");
    if(pms[0]=="u"&&pms[1]==1){
		var acc=document.getElementById("acckind").value;
		document.cookie="explore="+acc;		
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?u="+pms[1]+"&nopage="+num;
	}
	else
	    location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?nopage="+num;
}
function explore(identify){
    if(identify==1){
		var acc=document.getElementById("acckind").value;
		document.cookie="explore="+acc;
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?u="+1;
	}
	else{
	   alert("非法操作！");
	   location.href="<?php echo $_SERVER['PHP_SELF']; ?>";
	}
}
function artchange(id){
	adddep();
	document.getElementById("delid").value=id;
	
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?topicid="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var text=xmlhttp.responseText.replace(/\s*$/g,'');
			var messages=text.split("@@");
			//alert(messages[0]+" "+messages[2])
			document.getElementById("newshead").value=messages[0];
			document.getElementById("newsbody").innerHTML=messages[2];
			
			var select=document.getElementById("kind");
			for(var i=0;i<select.options.length;i++){
				if(select.options[i].value==messages[1]){
				   select.options[i].selected=true;
				   break;
				}
			}
		}
	}
	xmlhttp.send();	
}
</script>
</head>
<body>
<?php
require "head.php";
echo "<div>";
require "sside.php";
require "conf.php";
function getcurpag(){
	require "conf.php";
	$sql="select * from $table_topic";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"adddep()\"></div>";
echo "<div class=\"dc3\" id=\"dc\">";
echo "<div class=\"diatit\">添加论坛主题</div>";
echo "<table class=\"diat\">";
echo "<form method=\"post\" action=\"topic.php\" onsubmit=\"return juge3(this);\">";
echo "<tr>";
echo "<td>";
echo "<input type=\"hidden\" value=\"\" name=\"delid\" id=\"delid\">";
echo "主题名称：<input class=\"diainput2\" name=\"diainput\" id=\"newshead\" type=\"text\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
$sql="select * from $table_department";
$result=mysqli_query($link,$sql);

echo "归属板块：<select name=\"kind\" class=\"diainput2\" id=\"kind\">";
     while($rows=mysqli_fetch_array($result)){
	     echo "<option value=".$rows['id'].">".$rows['name']."</option>"; 
	 }
	 echo "</select>";

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "主题描述：<textarea class=\"diaessay\" name=\"newsbody\" id=\"newsbody\"></textarea>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"submit\" value=\"保存\"></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";




/*$sql="select * from $table_department";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);*/
echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">主题列表</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按板块类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>      
	  <input class=\"appdep\" type=\"button\" value=\"添加主题\" onClick=\"adddep()\"></div>";
echo "<table class=\"bgt\">";
echo "<tr><th>序号</th><th>主题名称</th><th>归属板块</th><th>创建者</th><th>时间</th><th>操作</th></tr>";
echo "<tr><td colspan=\"6\"><hr class=\"line1\"></td></tr>";

$priority="";
$text="";
$pageamo=9;
$nopage=0;
$maxpage=ceil(getcurpag()/$pageamo);
   
if($priority==""&&$_COOKIE['explore']||$_GET['u']==1){
  $maxpage=1;	
  $kind=$_COOKIE["explore"]; 
  echo "<script>
         document.getElementById(\"acckind\").value=\"".$kind."\";
	  </script>";
 if($_GET['nopage']){
  if($_GET['nopage']>$maxpage)
     $nopage=$maxpage;
  else
     $nopage=$_GET['nopage'];
 }
 else
   $nopage=1;
 $number=($nopage-1)*$pageamo;
 
 $sql0="select * from $table_department where name='$kind'";
 $result0=mysqli_query($link,$sql0);
 $rows0=mysqli_fetch_array($result0);
 
 $sql="select * from $table_topic where p_id='$rows0[id]' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);
 $rows=mysqli_fetch_array($result);	
 /*echo "<script>alert(\"".$name."\");</script>";	*/
 echo "<script>
              var date=new Date();
			  date.setTime(date.getTime()-1000);
              document.cookie=\"explore='';expires=\"+date.toGMTString();
	  </script>";
 /*echo "<script>alert(\"".$_COOKIE['explore']."\");</script>";		*/  
}
else{	
if($_GET['nopage']){
  if($_GET['nopage']>$maxpage&&$maxpage!=0)
     $nopage=$maxpage;
  else
     $nopage=$_GET['nopage'];
}
else
  $nopage=1;
$number=($nopage-1)*$pageamo;
$sql="select * from $table_topic limit $number,$pageamo";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);		
}

if(!$rows[0]){
	echo "<tr><td colspan=\"6\" style=\"text-align:center;\">暂无数据</td></tr>";
}
else{
	
$i=1;	
do{
	
    $sql0="select name from $table_department where id='$rows[p_id]'";
    $result0=mysqli_query($link,$sql0);
    $rows0=mysqli_fetch_array($result0);	
	
	echo "<tr><td>".$i."</td><td title=\"".$rows['topic_name']."\" style=\"width:200px;\"><center><div style=\"width:200px;white-space: nowrap;text-overflow:ellipsis; overflow:hidden;\">".$rows['topic_name']."</div></center></td><td>".$rows0['name']."</td><td>".$rows['setter']."</td><td>".$rows['date']."</td><td>"."<a class=\"delebut\" href=\"topic.php?id=".$rows['id']."\">"."删除"."</a>&nbsp;<a href=\"javascript:void(0)\" class=\"editbut\" onclick=\"artchange(".$rows['id'].");\">修改</a></td></tr>";
	echo "<tr><td colspan=\"6\"><hr class=\"line2\"></td></tr>";		
	$i++;
}while($rows=mysqli_fetch_array($result));
}
echo "<tr><td colspan=\"6\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</table>";
echo "</div>";
if($_POST['diainput']){
	$id=$_POST['delid'];
	$topic_name=$_POST['diainput'];	
	$content=$_POST['newsbody'];
	$kind=$_POST['kind'];
	$date=date("Y 年 m 月 d 日");
	$setter=$_COOKIE['his_user'];
	
	$sql="select * from $table_topic where topic_name='$topic_name' and p_id='$kind'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_num_rows($result);
	
	if($id){
		if(!$row){			
	        $sql="update $table_topic set topic_name='$topic_name',p_id='$kind',topic_description='$content',date='$date',setter='$setter' where id='$id'";
			mysqli_query($link,$sql);
	        echo "<script>alert(\"修改主题成功！\");</script>";	
	        echo "<meta http-equiv=\"refresh\" content=\"0; url=topic.php\">";
	        exit();			
		}
        else{
	        echo "<script>alert(\"该板块的该主题已经存在！\");</script>";	
	        echo "<meta http-equiv=\"refresh\" content=\"0; url=topic.php\">";
	        exit();		
		}
	}
	else{
		$sql="select count(*) from $table_topic where p_id='$kind'";
		$result=mysqli_query($link,$sql);
		$rows=mysqli_fetch_array($result);
		if($rows[0]>=3){
	        mysqli_query($link,$sql);
	        echo "<meta http-equiv=\"refresh\" content=\"0; url=topic.php\">";
	        echo "<script>alert(\"每个板块的主题数不能超过3个，请选择添加其它版块的主题！\");</script>";
	        exit();			
		}
		
	    $sql="insert into $table_topic(topic_name,topic_description,p_id,setter,date) values('$topic_name','$content','$kind','$setter','$date')";
	    mysqli_query($link,$sql);
	    echo "<meta http-equiv=\"refresh\" content=\"0; url=topic.php\">";
	    echo "<script>alert(\"添加主题成功！\");</script>";
	    exit();
	}
}
if($_GET['id']){
    $id=$_GET['id'];
	$sql="delete from $table_topic where id='$id'"; 
    mysqli_query($link,$sql);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=topic.php\">";	 
    echo "<script>alert(\"删除主题成功！\");</script>";
	exit();
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>




































