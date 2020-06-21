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
		alert("科室名不能为空！");
		theForm.diainput.focus();
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
	$sql="select * from $table_department";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"adddep()\"></div>";
echo "<div class=\"dc\" id=\"dc\">";
echo "<div class=\"diatit\">添加科室</div>";
echo "<table class=\"diat\">";
echo "<form method=\"post\" action=\"organizedep.php\" onsubmit=\"return juge3(this);\">";
echo "<tr>";
echo "<td>";
echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
echo "科室名称：<input class=\"diainput\" name=\"diainput\" type=\"text\">";
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
echo "<div class=\"title\"><span class=\"title2\">科室列表</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按科室类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>      
	  <input class=\"appdep\" type=\"button\" value=\"添加科室\" onClick=\"adddep()\"></div>";
echo "<table class=\"bgt\">";
echo "<tr><th>序号</th><th>科室名称</th><th>操作</th></tr>";
echo "<tr><td colspan=\"3\"><hr class=\"line1\"></td></tr>";

$priority="";
$text="";
$pageamo=9;
$nopage=0;
$maxpage=ceil(getcurpag()/$pageamo);
   
if($priority==""&&$_COOKIE['explore']||$_GET['u']==1){
  $maxpage=1;	
  $name=$_COOKIE["explore"]; 
  echo "<script>
         document.getElementById(\"acckind\").value=\"".$name."\";
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
 $sql="select * from $table_department where name='$name' limit $number,$pageamo";
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
$sql="select * from $table_department limit $number,$pageamo";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);		
}


if(!$rows[0]){
	echo "<tr><td colspan=\"3\" style=\"text-align:center;\">暂无数据</td></tr>";
}
else{
$i=1;	
do{
	echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>"."<a class=\"delebut\" href=\"organizedep.php?id=".$rows['id']."\">"."删除"."</a></td></tr>";
	echo "<tr><td colspan=\"3\"><hr class=\"line2\"></td></tr>";		
	$i++;
}while($rows=mysqli_fetch_array($result));
}
echo "<tr><td colspan=\"3\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</table>";
echo "</div>";
if($_POST['diainput']){
	$name=$_POST['diainput'];	
	$sql="select * from $table_department where name='$name'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_num_rows(result);
	if($row){
	echo "<script>alert(\"该科室已存在！请重新输入\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedep.php\">";
	}
	else{
	$sql="insert into $table_department(name) values('$name')";
	mysqli_query($link,$sql);
	echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedep.php\">";
	echo "<script>alert(\"添加科室成功！\");</script>";
	}
}
if($_GET['id']){
    $id=$_GET['id'];
	$sql="delete from $table_department where id='$id'"; 
    mysqli_query($link,$sql);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedep.php\">";	 
    echo "<script>alert(\"删除科室成功！\");</script>";
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>




































