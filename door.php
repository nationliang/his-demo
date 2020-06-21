<title>首页</title>
<script src="prevent.js"></script>
<link href="addbut.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
body {
	margin:0px;background-color:#FAFAFA;text-align:center;background-image:url(bg12.png);background-repeat:repeat;
	position:relative;
}
.hospital{
  margin:10px 0px 10px 100px;
}
.topnav {
  overflow:hidden;width:1200px;height:450px;box-shadow:0px 0px 5px #999;display:inline-block;
  background-image:url(tp1.jpg);background-repeat:no-repeat;background-size:100% 100%;
}

.topnav a {
  float:left;display: block;color: #FFF;text-align: center;padding: 18px 30px;text-decoration: none;

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
	text-align:center;float:right;height:57px;color:#FFF;
}
.useropec1{
	background:none;border:none;font-size:18px;cursor:pointer;outline:none;
	padding:20px 20px;margin-right:0px;
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
	width:160px;line-height:35px;border-left:3px solid #999;display:none;
}
#useritem1,#useritem2{
	display:block;text-decoration:none;padding-left:15px;color:#999;
}
#useritem1:hover,#useritem2:hover{
	color:#666;background-color:#F7F7F7;
}
.navitems{
	background-color:rgba(103,217,237,0.8);width:100%;font-weight:bold;
}
.newsbg{
   width:1200px;;height:200px;background-color:#FFF;box-shadow:0px 0px 5px #999;margin:30px 0px 10px 75px;
}
.nk{
	float:left;padding:10px 20px;color:#58ADF3;font-weight:bold;cursor:pointer;
}
.nkf{
	border-bottom:1px solid #42B0E6;
}
.nactive{
	background-color:#64A7F0;color:#FFF;
}
.line4{
	border:0.5px dashed #AFAFAF;
}
.ntable{
	width:98%;margin:0px 10px;
}
.lins{
	text-decoration:none;color:#333;
}
.lins:hover{
	color:#149AEB;
}
</style>
<script>
function activate(){
	document.cookie="signal=1";
	document.cookie="kind="+"医院要闻";
	document.getElementById("nk").classList.add("nactive");
	document.getElementById("nk2").classList.remove("nactive");
	document.getElementById("nk3").classList.remove("nactive");
	
	document.getElementById("nc").style.display="table";
	document.getElementById("nc2").style.display="none";
	document.getElementById("nc3").style.display="none";
}

function activate2(){
	document.cookie="signal=2";
	document.cookie="kind="+"综合新闻";
	document.getElementById("nk2").classList.add("nactive");
	document.getElementById("nk").classList.remove("nactive");
	document.getElementById("nk3").classList.remove("nactive");
	
	document.getElementById("nc2").style.display="table";
	document.getElementById("nc").style.display="none";
	document.getElementById("nc3").style.display="none";	
}

function activate3(){
	document.cookie="signal=3";
	document.cookie="kind="+"病友飞鸿";
	document.getElementById("nk3").classList.add("nactive");
	document.getElementById("nk2").classList.remove("nactive");
	document.getElementById("nk").classList.remove("nactive");
	
	document.getElementById("nc3").style.display="table";
	document.getElementById("nc2").style.display="none";
	document.getElementById("nc").style.display="none";
}

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
require "conf.php";
/*require "cwindow.php";
if($_COOKIE['his_priority']=="patient"||$_COOKIE['his_priority']=="admin")
  require "recommend.php";*/
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
<div class="topnav" id="topnav">
<div class="navitems">
<a href="door.php" id="door">首页</a>
<a href="article.php" id="article" style="display:block;" onclick="wipe();">新闻中心</a>
<a href="forum.php" id="forum" style="display:block;" onclick="wipe2();">社区</a>
<a href="patient.php" id="patient"  style="display:none;">问诊</a>
<a href="doctor.php" id="doctor"  style="display:none;">坐诊</a>
<a href="statistics.php" id="statistics"  style="display:none;">统计</a>
<a href="medicine.php" id="medicine"  style="display:none;">药库</a>
<a href="counter.php" id="counter"  style="display:none;">收款</a>
<a href="index.php" class="active" id="index"  style="display:none;">系统设置</a>
<div class="userope">
<span>登录用户：</span>
<input type="button" id="useropec1" onClick="showudia();" class="useropec1 useropec3" value="<?php echo $_COOKIE['his_user']; ?> "/>
</div>
<div style="clear:both"></div>
</div>
</div>
<div id="userdia2" class="userdia2">
<a href="javascript:void(0)" id="useritem1" onClick="modpass()">修改个人信息</a>
<a href="javascript:void(0)" id="useritem1" onClick="wipeCookie('option');location.href='myroom.php';">个人空间</a>
<a href="login.php" id="useritem2">退出系统</a>

</div>

<div class="newsbg">
<div class="nkf">
<div class="nk nactive" id="nk" onmouseover="activate()">医院要闻</div>
<div class="nk" id="nk2" onmouseover="activate2()">综合新闻</div>
<div class="nk" id="nk3" onmouseover="activate3()">病友飞鸿</div>
<div style="clear:both;"></div>
</div>

<table class="ntable" id="nc">
<tr><td colspan="2"></td></tr>
<?php
require "conf.php";
$sql="select * from $table_article where kind='医院要闻' order by id desc limit 0,3";//order必须在limit之前
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td style=\"text-align:left;\"><a href=\"article.php?id=".$rows['id']."\" class=\"lins\">".$rows['title']."</a></td><td>".$rows['date']."</td></tr>";
	echo "<tr><td colspan=\"2\"><hr class=\"line4\"></td></tr>";
}

?>
</table>

<table class="ntable" id="nc2" style="display:none;">
<tr><td colspan="2"></td></tr>
<?php
$sql="select * from $table_article where kind='综合新闻' order by id desc limit 0,3";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td style=\"text-align:left;\"><a href=\"article.php?id=".$rows['id']."\" class=\"lins\">".$rows['title']."</a></td><td>".$rows['date']."</td></tr>";
	echo "<tr><td colspan=\"2\"><hr class=\"line4\"></td></tr>";
}

?>
</table>

<table class="ntable" id="nc3" style="display:none;">
<tr><td colspan="2"></td></tr>
<?php
require "conf.php";
$sql="select * from $table_article where kind='病友飞鸿' order by id desc limit 0,3";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td style=\"text-align:left;\"><a href=\"article.php?id=".$rows['id']."\" class=\"lins\">".$rows['title']."</a></td><td>".$rows['date']."</td></tr>";
	echo "<tr><td colspan=\"2\"><hr class=\"line4\"></td></tr>";
}

?>
</table>

</div>

<script>
function changePic(){
	for(var i=1;i<5;i++){
	//alert(i);
    //document.getElementById("topnav").style.background="url(tp"+i+".jpg) no-repeat";
	if(i!=1)
	setTimeout('document.getElementById("topnav").style.background="url(tp'+i+'.jpg)"',3*i*1000);
	}
}
changePic();
var timer=setInterval(changePic,12000);
</script>
<?php

function php_self(){
	return substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
}
if(php_self()=="door.php"){
    echo "<script> document.getElementById(\"index\").className=\"hide\"; </script>";
    echo "<script> document.getElementById(\"door\").className=\"active\"; </script>";		
}
if($_POST['modpuname']){
	$name=$_POST['modpuname'];
	$pass=md5($_POST['modpupass']);
	/*echo "<script>alert(\"".$name."\");</script>";*/
	require "conf.php";
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
	   $sql="update $table_user set password='$pass' where name='$name'";
	   mysqli_query($link,$sql);
	   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
	   exit();	   
	}
	else{
    	$sql="select * from $table_user where name='$_COOKIE[his_user]'";
	    $result=mysqli_query($link,$sql);
	    $rows=mysqli_fetch_array($result);
		$sql="update $table_user set name='$name',password='$pass' where id='$rows[id]'";
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
require "webtail.php";
?>






































