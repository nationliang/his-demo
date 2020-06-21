<script src="prevent.js"></script>
<link href="addbut.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
body {
	margin:0px;background-color:#FAFAFA;background-image:url(bg12.png);background-repeat:repeat;
	position:relative;
}
.hospital{
  margin:10px 0px 10px 100px;
}
.topnav {
  overflow: hidden;	background-color:rgba(103,217,237,0.8);width:100%;font-weight:bold;box-shadow:0px 0px 5px #999;color:#FFF;
}

.topnav a {
  float:left;
  color:#FFF;
  display: block;
  text-align: center;
  padding: 18px 30px;
  text-decoration: none;
}
#door{
	margin-left:200px;
}
.topnav a:hover {
     background-color:#3AF86A;color:#FFF;
}

.topnav a.active {
     background-color:#3AF86A;color:#FFF;
}
img.medal{
	float:left;width:80px;height:70px;
	
}
div.navigation{
	float:left;text-align:center;margin:12px 0px 12px 0px;color:#03F;font-size:35px;font-weight:bold;
}
div.userope{
	text-align:center;float:right;height:57px;
}
.useropec1{
	background:none;border:none;color:#0CF;font-size:18px;cursor:pointer;outline:none;
	padding:20px 20px;margin-right:20px;
}
.useropec2{
	color:#858585;
}
.useropec3{
	color:#FFF;
}
.useropec3:hover{
	color:#000;
}
.userdia2{
	background-color:#FFF;z-index:30;position:absolute;top:135px;right:0px;box-shadow:0px 0px 5px #CCC;
	width:160px;line-height:35px;border-top:3px solid #999;display:none;
}
#useritem1,#useritem2{
	display:block;text-decoration:none;padding-left:15px;color:#999;
}
#useritem1:hover,#useritem2:hover{
	color:#666;background-color:#F7F7F7;
}
</style>
<script>
function showudia(){
	//alert(document.getElementById("useropec1").classList.contains("useropec2"));
    if(document.getElementById("useropec1").classList.contains("useropec2")){
		document.getElementById("useropec1").classList.remove("useropec2");
		document.getElementById("useropec1").classList.add("useropec3")
	}
	else{
		document.getElementById("useropec1").classList.remove("useropec3");
		document.getElementById("useropec1").classList.add("useropec2")		
	}
	//alert(document.getElementById("useropec1").classList.contains("useropec2"));	
	//alert("1"+Object.prototype.toString.call(document.getElementById("userdia").style.display));
	//document.getElementById("userdia").style.display="none";
	//alert("1"+document.getElementById("userdia2").style.display);
	document.getElementById("userdia2").style.display=(document.getElementById("userdia2").style.display=="block"?"none":"block");
    //alert("2"+document.getElementById("userdia2").style.display);
}
function modpass(){
	showudia();
	document.getElementById("modpbg").style.display=(document.getElementById("modpbg").style.display=="block"?"none":"block");
	document.getElementById("modpc").style.display=(document.getElementById("modpc").style.display=="block"?"none":"block");		
}
function juge2(theForm){
	if(theForm.modpupass.value==""){
		alert("密码不能为空！");
		theForm.modpupass.focus();
		return false;
	}
	if(theForm.modpupass.value!=theForm.modpurepass.value){
		alert("确认密码与密码不一致！");
		theForm.modpurepass.focus();
		return false;
	}
}
function wipeCookie(name){
    var date=new Date();
	date.setTime(date.getTime()-1000);
    document.cookie=name+"='';expires="+date.toGMTString();	
}

function wipe(){
	wipeCookie('kind');
	wipeCookie('signal');
}
function wipe2(){
    wipeCookie('flag');
	wipeCookie('topic_id');
	wipeCookie('dep_id');
	wipeCookie('signal2');
}
</script>
<?php
require "cwindow.php";
if($_COOKIE['his_priority']=="patient"||$_COOKIE['his_priority']=="admin")
  require "recommend.php";
require "conf.php";
?>
<div class="bgd" id="modpbg" onClick="modpass();">
</div>
<div class="dc" id="modpc">
<div class="diatit">修改个人信息</div>
<table class="diat">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return juge2(this);">
<tr>
<td>
用户名称：<input class="diainput" name="modpuname" value="<?php echo $_COOKIE['his_user']; ?>"  type="text">
</td>
</tr>
<tr>
<td>
用户密码：<input class="diainput" name="modpupass" type="password">
</td>
</tr>
<tr>
<td>
确认密码：<input class="diainput" name="modpurepass" type="password">
</td>
</tr>
<tr>
<td>用户性别：
<select name="sex" class="diaselect">
<option value=1 selected="selected">男性</option>
<option value=2>女性</option>
</select>
</td>
</tr>
<tr><td><input class="diasave" type="submit" value="保存"></td></tr>
</form>
</table>
</div>
<div class="hospital">
<img src="redten.png" class="medal" />
<div class="navigation">医院信息管理系统</div>
<div style="clear:both"></div>
</div>
<div class="topnav">
<!--<img src="redten.png" class="medal" />
<div class="navigation">医院信息管理系统</div>-->
<a href="door.php" id="door">首页</a>
<a href="article.php" id="article" onclick="wipe();">新闻中心</a>
<a href="forum.php" id="forum" onclick="wipe2();">社区</a>
<a href="patient.php" id="patient" style="display:none;">问诊</a>
<a href="doctor.php" id="doctor"  style="display:none;">坐诊</a>
<a href="statistics.php" id="statistics"  style="display:none;">统计</a>
<a href="medicine.php" id="medicine"  style="display:none;">药库</a>
<a href="counter.php" id="counter"  style="display:none;">收款</a>
<a href="index.php" class="active" id="index"  style="display:none;">系统设置</a>
<div class="userope">
<span>登录用户：</span>
<input type="button" id="useropec1" onClick="showudia();" class="useropec1 useropec3" value="<?php echo $_COOKIE['his_user']; ?> "/>
</div>
</div>
<div id="userdia2" class="userdia2">
<a href="javascript:void(0)" id="useritem1" onClick="modpass()">修改个人信息</a>
<a href="javascript:void(0)" id="useritem1" onClick="wipeCookie('option');location.href='myroom.php';">个人空间</a>
<a href="login.php" id="useritem2">退出系统</a>
</div>

<?php

function php_self(){
	return substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
}
if(php_self()=="index.php"||php_self()=="organizedep.php"||php_self()=="organizedoc.php"||php_self()=="arrangedoc.php"||php_self()=="price.php"||php_self()=="record.php"||php_self()=="news.php"||php_self()=="topic.php"){
	;
}
else if(php_self()=="door.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"door\").className=\"active\"; </script>";		
}
else if(php_self()=="medicine.php"||php_self()=="manapill.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"medicine\").className=\"active\"; </script>";		
}
else if(php_self()=="doctor.php"||php_self()=="recovery.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"doctor\").className=\"active\"; </script>";	
}
else if(php_self()=="patient.php"||php_self()=="booklist.php"||php_self()=="payment.php"||php_self()=="bill.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"patient\").className=\"active\"; </script>";	
}
else if(php_self()=="counter.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"counter\").className=\"active\"; </script>";	
}
else if(php_self()=="statistics.php"||php_self()=="countpill.php"||php_self()=="countpat.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"statistics\").className=\"active\"; </script>";	
}
else if(php_self()=="article.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"article\").className=\"active\"; </script>";	
}
else if(php_self()=="forum.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"forum\").className=\"active\"; </script>";	
}
else if(php_self()=="myroom.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
}
else{
    echo "<script>alert(\"系统错误！\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=login.php\">";	
}
    
if($_POST['modpuname']){
	$sex=$_POST['sex'];
	$name=$_POST['modpuname'];
	$pass=md5($_POST['modpupass']);
	$id=$_COOKIE['his_id'];
	/*echo "<script>alert(\"".$name."\");</script>";*/
	$sql="select * from $table_user where name='$name'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	/*echo "<script>alert(\"".$rows['name']."\");</script>";*/
	if($rows['name']&&$_COOKIE['his_user']!=$rows['name']){
	   echo "<script>alert(\"该用户名已存在！请重新输入\");</script>";		
	   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
	   exit();
	}
	else if($rows['name']&&$rows['name']==$_COOKIE['his_user']){
	   $sql="update $table_user set password='$pass',sex='$sex' where id='$id'";
	   mysqli_query($link,$sql);
	   echo "<script>alert(\"更改用户信息成功！\");</script>";
	   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
	   exit();	   
	}
	else{
    	$sql="select * from $table_user where name='$_COOKIE[his_user]'";
	    $result=mysqli_query($link,$sql);
	    $rows=mysqli_fetch_array($result);
		$sql="update $table_user set name='$name',password='$pass',sex='$sex' where id='$rows[id]'";
		mysqli_query($link,$sql);
		//setcookie("his_user",$name);
		echo "<meta http-equiv=\"refresh\" content=\"0; url=dealmod.php?name=".$name."\">";
		if($rows['priority']=="doctor"){
		   $sql2="update $table_doctor set name='$name' where id='$rows[p_id]'";
		   mysqli_query($link,$sql2);
		}
		echo "<script>alert(\"更改用户信息成功！\");</script>";
		/*echo "<script>alert(\"".$_COOKIE['his_user']."\");</script>";
		echo "<script>alert(\"".$name."\");</script>";*/
		echo "<meta http-equiv=\"refresh\" content=\"0; url=dealmod.php?name=".$name."\">";
	    /*echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";*/
	    exit();	  		
	}
	
}
?>






































