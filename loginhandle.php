<?php
if($_POST['loguser']){
	$user=$_POST['loguser'];
	$pass=md5($_POST['pass']);
	require "conf.php";
	$sql="select * from $table_user where name='$user'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if(!$rows['name']){
		echo "<script>alert(\""."用户".$user."不存在！"."\");</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0; url=login.php\">";		
	}
	else if($rows['password']!=$pass){
		echo "<script>alert(\"输入密码有误，请重新输入！\");</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0; url=login.php\">";
	}
	else{
		setcookie("his_user",$user);
		setcookie("his_priority",$rows['priority']);
		setcookie("his_id",$rows['id']);
		//setcookie("user",time()-1);
		echo "<meta http-equiv=\"refresh\" content=\"0; url=door.php\">";
	}
}
if($_POST['reguser']){
	$sex=$_POST['sex'];
	$user=$_POST['reguser'];
	$pass=md5($_POST['pass']);
	$time=date("Y 年 m 月 d 日");
	require "conf.php";
	$sql="select * from $table_user where name='$user' and priority!='patient'";
	$result=mysqli_query($link,$sql) or die(mysqli_error($link));
	$rows=mysqli_fetch_array($result);
	if($rows['name']){
		echo "<script>alert(\""."用户".$user."已注册！"."\");</script>";
		echo "<meta http-equiv=\"refresh\" content=\"0; url=login.php\">";			
	}
	else{
		$sql="insert into $table_user(priority,name,password,date,sex) values('patient','$user','$pass','$time','$sex')";
		mysqli_query($link,$sql);	
	    echo "<script>alert(\"注册成功！\");</script>";		
		echo "<meta http-equiv=\"refresh\" content=\"0; url=login.php\">";
	}	
}
?>
