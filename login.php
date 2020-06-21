<?php
if($_COOKIE['his_user']||$_COOKIE['his_priority']){
    setcookie("his_user",time()-1);
    setcookie("his_priority",time()-1);
	setcookie("his_id",time()-1);
}
?>
<html>
<head>
<title>登录界面</title>
<style>
body{
    background-image:url(bg2.jpg);background-repeat:no-repeat;
	background-color:#F8F8F8;
}
.struc{
	background-color:#FFF;width:350px;margin-top:30px;box-shadow:0px 0px 5px #C4C4C4;border-radius:5px;
}
.lrtitle{
	border-bottom:1px solid #999;width:100%;
}
.logbut{
	float:left;margin:10px 55px 0px 55px;padding:10px 0px 5px 0px;font-weight:1000;color:#ADADAD;font-size:15px;
	cursor:pointer;	
}
.regbut{
	float:left;margin:10px 55px 0px 55px;padding:10px 0px 5px 0px;font-weight:1000;color:#ADADAD;font-size:15px;
	cursor:pointer;
}
.butactive{
	color:#000;border-bottom:2px solid #666;
}
.clearfloat{
	clear:both;
}
.architecture{
	margin-top:30px;
}
.butsty{
	background-color:#34C8ED;color:#FFF;outline:none;box-shadow:0px 0px 2px #D0CECC;border-radius:5px;border:0px;
	width:200px;padding:8px 0px;
}
.butsty:hover{
	background-color:#0E8ED3;
}
.tsty{
	border-collapse:separate;
	border-spacing:10px;
}
.textsty{
	border-radius:5px;box-shadow:0px 0px 1px #B3B0AE;border:1px solid #D2D2D0;padding:5px 0px;background-color:#F6F6F6;
}
.bigtit{
	color:#06F;font-size:30px;margin:50px;
}
</style>
<script>
function juge(theForm){
  if(theForm.loguser.value==""){
	 alert("请输入登录名！");
	 theForm.loguser.focus();
	 return false;
  }
  if(theForm.pass.value==""){
     alert("请输入密码！");
     theForm.pass.focus();
     return false;
  }
}
function juge2(theForm){
   if(theForm.reguser.value==""){
	  alert("请输入姓名！");
	  theForm.reguser.focus();
	  return false;
	}
   if(theForm.pass.value==""){
      alert("请输入密码！");
	  theForm.pass.focus();
	  return false;
	}
   if(theForm.repass.value!=theForm.pass.value){
	  alert("确认密码与密码不一致!");
	  theForm.repass.focus();
	  return false;
   }
}
function changestatus1(){
	document.getElementById("regbut").classList.remove("butactive");
	document.getElementById("logbut").classList.add("butactive");
	document.getElementById("register").style.display="none";
	document.getElementById("login").style.display="block";	
}
function changestatus2(){
	document.getElementById("logbut").classList.remove("butactive");
	document.getElementById("regbut").classList.add("butactive");
	document.getElementById("register").style.display="block";
	document.getElementById("login").style.display="none";		
}
</script>
</head>
<body>
<center>
<div class="bigtit"><img src="redten.png" width="80px" height="70px" align="absmiddle"/><span>医疗信息管理系统</span></div>
<div class="struc">
<div class="lrtitle">
<div onClick="changestatus1()" class="logbut butactive" id="logbut">用户登录</div>
<div onClick="changestatus2()" class="regbut" id="regbut">用户注册</div>
<div class="clearfloat"></div>
</div>

<div id="login" class="architecture">
<table class="tsty">
<form method=post action="loginhandle.php" onSubmit="return juge(this)">
<tr>
<td>用户姓名：</td>
<td><input type=text name='loguser' class="textsty"></td>
</tr>
<tr>
<td>用户密码：</td>
<td><input type=password name='pass' class="textsty"></td>
</tr>
<tr>
<td align="center" colspan="2"><input type=submit value="登陆" class="butsty">
</td>
</tr>
</form>
</table>
</div>
<div id="register" style="display:none;" class="architecture">
<table class="tsty">
<form method=post action="loginhandle.php" onSubmit="return juge2(this)">
<tr>
<td>用户姓名：</td>
<td><input type=text name="reguser" class="textsty"></td>
</tr>
<tr>
<td>用户密码：</td>
<td><input type=password name="pass" class="textsty"></td>
</tr>
<tr>
<td>确认密码：</td>
<td><input type=password name="repass" class="textsty"></td>
</tr>
<tr>
<td>用户性别：</td>
<td>男性：<input type=radio name="sex" value=1 checked>&nbsp;&nbsp;&nbsp;女性：<input type=radio name="sex" value=2></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type=submit value="注册" class="butsty" />
</td>
</tr>
</form>
</table>
</div>
</div>
</center>
</body>
</html>





































