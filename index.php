<html>
<head>
<title>系统设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" rel="stylesheet" type="text/css">
<script src="prevent.js"></script>
<style>
#showdele{
	width:100%;
}
hr.t{
	border:1px solid #CCC;margin:none;padding:none;
}
#title{
	text-align:center;
}
hr.c{
	border:0.5px solid #CCC;margin:none;padding:none;
}
td{
	text-align:center;
}
div.b{
	position:fixed;width:100%;height:100%;opacity:0.5;background-color:#000;z-index:10;top:0;left:0;
	display:none;
}
div.ch{
	background-color:#FFF;width:500px;height:220px;opacity:1;position:fixed;top:20%;left:30%;z-index:20;
	display:none;
}
#diat{
	width:100%;margin:10px 0px;
}
#powe,#na{
	width:80%;background-color:#F9F9F9;border:1px solid #CCC;height:30px;
}
#diat th,#diat td{
	height:50px;
}
#tit{
	background-color:#F3F3F3;height:39px;text-align:center;line-height:40px
}
.sbu{
	width:95%;background-color:#316CDB;color:#FFF;border:1px solid #00F;border-radius:2px;outline:none;height:30px;
}
input.sbu:hover{
	background-color:#00C;color:#F5F5F5;
}
</style>
<script>
function showDialog(id=0,name="",power="",p_id=0){
	//alert("1"+document.getElementById("bg").style.display);
	document.getElementById("bg").style.display=(document.getElementById("bg").style.display=="block"?"none":"block");
	document.getElementById("dia").style.display=(document.getElementById("dia").style.display=="block"?"none":"block");
	document.getElementById("editid").value=id;
	document.getElementById("na").value=name;
	document.getElementById('p_id').value=p_id;
	document.getElementById('oldpri').value=power;	
	var sele=document.getElementById("powe");
	//alert(sele.options.length);
	for(var i=0;i<sele.options.length;i++)
	   if(sele.options[i].value==power){
	       sele.options[i].selected=true;	
		   break;
	   }
}
function adduser(){
	document.getElementById("dialogd").style.display=(document.getElementById("dialogd").style.display=="block"?"none":"block");
	document.getElementById("dialogc").style.display=(document.getElementById("dialogc").style.display=="block"?"none":"block");		
}
function juge(theForm){
	if(theForm.user.value==""){
		alert("请输入用户名！");
		theForm.user.focus();
		return false;
	}
	if(theForm.pass.value==""){
		alert("请输入密码！");
		theForm.pass.focus();
		return false;
	}
	if(theForm.repass.value==""){
		alert("确认密码与密码不一致！");
		theForm.pass.focus();
		return false;
	}
}
function setpage(num){
	var parameter=location.search.substr(1,3);
	var pms=parameter.split("=");
	if(pms[0]=="k"&&pms[1]!=0)
	    location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+pms[1]+"&nopage="+num;
	else if(pms[0]=="u"&&pms[1]==1){
		var acc=document.getElementById("accuser").value;
		document.cookie="explore="+acc;		
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?u="+pms[1]+"&nopage="+num;
	}
	else
	    location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?nopage="+num;
}
function explore(identify){
	if(identify==1){
		var acc=document.getElementById("acckind").value;
		switch(acc){
			case "医生": location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+1;break;
			case "病人": location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+2;break;
			case "管理员": location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+3;break;
			case "派药员": location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+4;break;
			case "收银员": location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+5;break;			
			default: alert("输入类型不符合规范！");location.href="<?php echo $_SERVER['PHP_SELF'] ?>";		
		}
	}
	else if(identify==2){
		var acc=document.getElementById("accuser").value;
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
<div class="bgd" id="dialogd" onClick="adduser()"></div>
<div class="dc" id="dialogc">
<div class="diatit">添加用户</div>
<table class="diat">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit=" return juge(this) ">
<tr>
<td colspan="2">用户姓名：<input class="diainput" type="text" name="user"></td>
</tr>
<tr>
<td colspan="2">用户密码：<input type="password" class="diainput" name="pass"></td>
</tr>
<tr>
<td colspan="2">确认密码：<input type="password" class="diainput" name="repass"></td>
</tr>
<td colspan="2" style="text-align:left;padding-left:10px;">账户性别：&nbsp;&nbsp;男<input checked type="radio" name="addusersex" value=1>&nbsp;&nbsp;&nbsp;&nbsp;女<input type="radio" name="addusersex" value=2></td>
</tr>
<tr>
<td colspan="2" style="text-align:left;padding-left:10px;">账户类型：
<input type="radio" name="priority" value="patient" checked/>患者
<!-- <input type="radio" name="priority" value="doctor" />医生 -->
<input type="radio" name="priority" value="admin" />系统管理员
<input type="radio" name="priority" value="drug" />药房管理人员
<input type="radio" name="priority" value="cashier" />收银员
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="确定"/ id="f" class="diasave">
</td>
</tr>
</form>
</table>
</div>
<?php
require "head.php";
echo "<div>";
require "sside.php";
require "conf.php";

function getcurpag(){
	require "conf.php";
	$sql="select * from $table_user";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

	//遮罩层
	echo "<div class=\"b\" id=\"bg\"  onClick=\"showDialog()\">";
	echo "</div>";
	//弹出框
	echo "<div class=\"ch\" id=\"dia\">";
	echo "<div id=\"tit\">修改用户权限</div>";
	echo "<table id=\"diat\">";
	echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">";
	echo "<input type=\"hidden\" name=\"p_id\" id=\"p_id\">";
	echo "<input type=\"hidden\" name=\"oldpri\" id=\"oldpri\">";	
	echo "<tr>";
	echo "<td>";
	echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
	echo "用户姓名：<input id=\"na\" name=\"name\" type=\"text\" value=\"none\" readonly=\"readonly\">";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "用户类型：<select name=\"powe\" id=\"powe\">";
	echo "<option value=\"patient\">患者</option>";
	echo "<option value=\"doctor\">医生</option>";
	echo "<option value=\"drug\">药房管理员人员</option>";
	echo "<option value=\"admin\">系统管理员</option>";	
	echo "<option value=\"cashier\">收银员</option>";		
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	echo "<tr><td><input class=\"sbu\" type=\"submit\" value=\"保存\"></td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</div>";



echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">用户列表</span>
	  <input class=\"appdep\" type=\"button\" value=\"添加用户\" onClick=\"adduser()\">
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:仅限医生,病人,管理员,派药员,收银员\" placeholder=\"按用户类型搜索\"><input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>
      <div class=\"search\"><input id=\"accuser\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如张三\" placeholder=\"按用户姓名搜索\"><input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(2)\"></div>
      </div>";
$priority="";
$text="";
$pageamo=9;
$nopage=0;

$maxpage=ceil(getcurpag()/$pageamo);
if($_GET['k']==1){
   $priority="doctor";
   $text="医生";
  }   
else if($_GET['k']==2){
   $priority="patient";  
   $text="病人";
}
else if($_GET['k']==3){
   $priority="admin"; 
   $text="管理员";
}
else if($_GET['k']==4){
   $priority="drug"; 
   $text="派药员";
}
else if($_GET['k']==5){
   $priority="cashier";
   $text="收银员";
}
else
   ;
   
if($priority!=""){ 	
 $sql="select * from $table_user where priority='$priority'";
 $result=mysqli_query($link,$sql);
 $row=mysqli_num_rows($result);
 if($row==0)
    $maxpage=1;
 else
    $maxpage=ceil($row/$pageamo);
 echo "<script>
         document.getElementById(\"acckind\").value=\"".$text."\";
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
 /*echo "<script>alert(\"".$row." ".$maxpage." ".$number." ".$nopage." ".$_GET['nopage']."\")</script>";*/
 $sql="select * from $table_user where priority='$priority' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);
 $rows=mysqli_fetch_array($result);	
}
else if($priority==""&&$_COOKIE['explore']||$_GET['u']==1){
  $maxpage=1;	
  $name=$_COOKIE["explore"];
  echo "<script>
         document.getElementById(\"accuser\").value=\"".$name."\";
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
 $sql="select * from $table_user where name='$name' limit $number,$pageamo";
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
$sql="select * from $table_user limit $number,$pageamo";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);		
}	  
	  
echo "<div class=\"bgt2\">";
echo "<table id=\"showdele\" cellspacing=\"0\">
	 <tr>";
if($rows[0]==""){
	echo "<th>"."序号"."</th>"."<th>"."用户类型"."</th>"."<th>"."用户名"."</th>"."<th>"."创建时间"."</th><th>"."操作"."</th></tr>";
	echo "<tr><td colspan=\"5\"><hr class=\"t\"></td></tr>";	
	echo "<td colspan=\"5\">用户列表为空！</td>";
	echo "</tr>";
}
else{
	echo "<th>序号</th><th>用户类型</th><th>用户名</th><th>性别</th><th>创建时间</th><th>操作</th></tr>";
	echo "<tr><td colspan=\"6\"><hr class=\"t\"></td></tr>";
$i=1;
do{
	echo "<tr><td>".$i."</td>";
	echo "<td>";
	if($rows['priority']=='doctor')
	    echo "医生";
	else if($rows['priority']=='patient')
	    echo "患者";
    else if($rows['priority']=='admin')
	    echo "系统管理员";
    else if($rows['priority']=='cashier')
	    echo "收银员";		
	else
	    echo "药房管理员";
	echo "</td>";
	echo "<td>".$rows['name']."</td>";
	echo "<td>";
	if($rows['sex']=="boy")
	    echo "男";
	else	
	    echo "女";
	echo "</td>";
	echo "<td>".$rows['date']."</td>";
	echo "<td><a class=\"delebut\" href=\"".$_SERVER['PHP_SELF']."?id=".$rows['id']."\">"."删除"."</a>&nbsp;";
	echo "<a class=\"editbut\" href=\"javascript:void(0);\" onClick=\"showDialog($rows[id],'$rows[name]','$rows[priority]','$rows[p_id]')\">"."修改"."</a></td>";	
	echo "</tr>";
	echo "<tr><td colspan=\"6\"><hr class=\"c\"></td></tr>";	
    $i++;
}while($rows=mysqli_fetch_array($result));

	//echo date("Y 年 m 月 d 日");
}
echo "</table>";
echo "<div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div>";
echo "</div>";
echo "</div>";

if($_GET['id']){
	$id=$_GET['id'];
	//var_dump($id);
	$sql="select * from $table_user where id='$id'";	
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	$sql2="delete from $table_user where id='$id'";
	mysqli_query($link,$sql2);
	if($rows['priority']=="doctor"){
	    $sql3="delete from $table_doctor where id='$rows[p_id]'";
	    mysqli_query($link,$sql3);
	}
	if($rows['priority']=="patient"){	
	   $sql4="delete from $table_patient where pp_id='$id'";
	   mysqli_query($link,$sql4);	
	}
	echo "<script>alert(\"用户删除成功！\");</script>";
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">"; 
	}
if($_POST['editid']){
	$p=$_POST['powe'];
	$id=$_POST['editid'];
	$name=$_POST['name'];
	$p_id=$_POST['p_id'];
	$oldpri=$_POST['oldpri'];
    if($p=="doctor"&&$oldpri!="doctor"){
		  $sql="insert into $table_doctor(name) values('$name')";
		  mysqli_query($link,$sql);
		  $sql2="select id from $table_doctor where name='$name'";
		  $result2=mysqli_query($link,$sql2);
		  $rows2=mysqli_fetch_array($result2);
	}
    else if($p!="doctor"&&$oldpri=="doctor"){
		  $sql="delete from $table_doctor where name='$name'";
		  $result=mysqli_query($link,$sql);
		  $rows2[0]=0;
	}
	else
	     $rows2[0]=0;
	/*echo "<script>alert(\"".$p_id."\");</script>";*/
	if($priority=="doctor"&&$oldpri=="doctor")
	    ;
	else{
	    $sql="update $table_user set priority='$p',p_id='$rows2[0]' where id='$id'";
	    mysqli_query($link,$sql);
	}
	echo "<script>alert(\"用户权限修改成功！\");</script>";	
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
}
if($_POST['user']){
$sex=$_POST['addusersex'];
$pass=md5($_POST['pass']);
$name=$_POST['user'];
$priority=$_POST['priority'];
$time=date("Y 年 m 月 d 日");
require "conf.php";
$sql="select * from $table_user where name='$_POST[user]'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
//var_dump($row);
if($row!="0"){
	echo "<script>alert(\"用户名已注册！\");</script>";
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
}
else{
    if($priority=="doctor"){
		$sql="insert into $table_doctor(name) values('$name')";
		mysqli_query($link,$sql);
		$sql2="select id from $table_doctor where name='$name'";
		$result2=mysqli_query($link,$sql2);
		$rows2=mysqli_fetch_array($result2);
	}
	$sql="insert into $table_user(name,password,priority,date,sex) values('$name','$pass','$priority','$time','$sex')";
    mysqli_query($link,$sql);
	echo "<script>alert(\"用户添加成功！\");</script>";
	$sql3="update $table_user set p_id='$rows2[0]' where name='$name'";
	mysqli_query($link,$sql3);	
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";	
   }
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>
