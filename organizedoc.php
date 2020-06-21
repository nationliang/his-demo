<html>
<head>
<title>系统设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" type="text/css" rel="stylesheet">
<script>
function adddoc(){
	document.getElementById("bgd").style.display=(document.getElementById("bgd").style.display=="block"?"none":"block");
	document.getElementById("dc").style.display=(document.getElementById("dc").style.display=="block"?"none":"block");	
}
function editdoc(){
	document.getElementById("bgd2").style.display=(document.getElementById("bgd2").style.display=="block"?"none":"block");
	document.getElementById("dc2").style.display=(document.getElementById("dc2").style.display=="block"?"none":"block");	
}
function refreshdoc(){
	document.location="organizedoc.php";
}
function juge4(theForm){
	if(theForm.dname.value==""){
		alert("用户名不能为空！");
		theForm.dname.focus();
		return false;
	}	
	if(theForm.pass.value==""){
		alert("密码不能为空！");
		theForm.pass.focus();
		return false;
	}	
}
function juge5(theForm){
	if(theForm.pass.value==""){
		alert("密码不能为空！");
		theForm.pass.focus();
		return false;
	}	
}
function setpage(num){
	var parameter=location.search.substr(1,3);
	var pms=parameter.split("=");
	if(pms[0]=="k"&&pms[1]==1){
		var acc=document.getElementById("acckind").value;
		document.cookie="explore="+acc;			
	    location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+pms[1]+"&nopage="+num;
	}
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
		document.cookie="explore="+acc;
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?k="+1;        
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
<?php
require "head.php";
echo "<div>";
require "sside.php";
require "conf.php";
function getcurpag(){
	require "conf.php";
	$sql="select * from $table_doctor";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"adddoc()\"></div>";
echo "<div class=\"dc\" id=\"dc\">";
echo "<div class=\"diatit\">添加医生</div>";
echo "<table class=\"diat\">";
echo "<form method=\"post\" action=\"organizedoc.php\" onsubmit=\"return juge4(this);\">";
echo "<tr>";
echo "<td>";
echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
echo "医生姓名：<input class=\"diainput\" name=\"dname\" type=\"text\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "登录密码：<input class=\"diainput\" name=\"pass\" type=\"password\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
echo "电话号码：<input class=\"diainput\" name=\"dpnumber\" type=\"text\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "医生职称：<select name=\"position\" class=\"diaselect\">";
echo "<option value=\"主治医师\">主治医师</option>";
echo "<option value=\"副主任医师\">副主任医师</option>";
echo "<option value=\"主任医师\">主任医师</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "所属科室：<select name=\"department\" class=\"diaselect\">";
$sql="select * from $table_department";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
   echo "<option value=\"".$rows['name']."\">".$rows['name']."</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "医生性别：<select name=\"sex\" class=\"diaselect\">";
echo "<option value=\"1\">男</option>";
echo "<option value=\"2\">女</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "医生婚否：<select name=\"maritalstatus\" class=\"diaselect\">";
echo "<option value=\"2\">未婚</option>";
echo "<option value=\"1\">已婚</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "入职年份：<select name=\"entrytime\" class=\"diaselect\">";
for($i=2000;$i<=2019;$i++)
echo "<option value=\"".$i."\">".$i."年</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "医生年龄：<select name=\"age\" class=\"diaselect\">";
for($i=0;$i<100;$i++)
echo "<option value=\"".$i."\">".$i."岁</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "医生工龄：<select name=\"workingyear\" class=\"diaselect\">";
for($i=0;$i<100;$i++)
echo "<option value=\"".$i."\">".$i."年</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"submit\" value=\"保存\"></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "<div class=\"container\">";

echo "<div class=\"title\"><span class=\"title2\">医生列表</span>
      <input class=\"appdep\" type=\"button\" value=\"添加医生\" onClick=\"adddoc()\">
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按部门类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>
      <div class=\"search\"><input id=\"accuser\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如张三\" placeholder=\"按医生姓名搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(2)\"></div>	  
	  </div>";
echo "<table class=\"bgt\" id=\"bgt\">";
echo "<tr><th>序号</th><th>姓名</th><th>性别</th><th>所属科室</th><th>职称</th><th>入职年份</th><th>工龄</th><th>婚否</th><th>年龄</th><th>电话</th><th>操作</th></tr>";
echo "<tr><td colspan=\"11\"><hr class=\"line1\"></td></tr>";

$count=2;
$text="";
$pageamo=9;
$nopage=0;
$maxpage=ceil(getcurpag()/$pageamo);

$name=$_COOKIE["explore"];

 echo "<script>
              var date=new Date();
			  date.setTime(date.getTime()-1000);
              document.cookie=\"explore='';expires=\"+date.toGMTString();
	  </script>";

$sql="select * from $table_department where name='$name'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);
if(count($rows)!=0){ 
 $count--;

 $sql="select * from $table_doctor where department='$name'";
 $result=mysqli_query($link,$sql);
 $row=mysqli_num_rows($result);
 if($row==0)
    $maxpage=1;
 else
    $maxpage=ceil($row/$pageamo);
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
 $sql="select * from $table_doctor where department='$name' limit $number,$pageamo";
 $result=mysqli_query($link,$sql) or die(mysqli_error($link));
 $rows=mysqli_fetch_array($result) or die(mysqli_error($link));	
}


$sql2="select id from $table_doctor where name='$name'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
if(count($rows2)!=0){
  $count--;
  $maxpage=1;	
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
 $sql="select * from $table_doctor where name='$name' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);
 $rows=mysqli_fetch_array($result);	
 /*echo "<script>alert(\"".$name."\");</script>";	*/
}

if($count==2&&$name)
   echo "<script>alert(\"您搜索的内容不存在！\");</script>";

if($count==2){	
if($_GET['nopage']){
  if($_GET['nopage']>$maxpage&&$maxpage!=0)
     $nopage=$maxpage;
  else
     $nopage=$_GET['nopage'];
}
else
  $nopage=1;
$number=($nopage-1)*$pageamo;
$sql="select * from $table_doctor limit $number,$pageamo";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);		
}	
 
if(!$rows[0]){
	echo "<tr><td colspan=\"11\" style=\"text-align:center;\">暂无数据</td></tr>";
}
else{
$i=1;	
do{
	echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>";
	if($rows['sex']=="man")
	    echo "男";
	else
	    echo "女";
	echo "</td><td>".$rows['department']."</td><td>".$rows['position']."</td><td>".$rows['entrytime']."</td><td>".$rows['workingyear']."</td><td>".$rows['maritalstatus']."</td><td>".$rows['age']."</td><td>".$rows['phonenumber']."</td><td>"."<a class=\"editbut\" href=\"organizedoc.php?eid=".$rows['id']."\" onClick=\"editdoc()\">"."编辑"."</a>&nbsp;"."<a class=\"delebut\" href=\"organizedoc.php?id=".$rows['id']."\">"."删除"."</a></td></tr>";
	echo "<tr><td colspan=\"11\"><hr class=\"line2\"></td></tr>";	
	$i++;
}while($rows=mysqli_fetch_array($result));
}

echo "<tr><td colspan=\"11\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</table>";
echo "</div>";
if($_POST['dname']){
	$name=$_POST['dname'];
	$dpnumber=$_POST['dpnumber'];
	$sex=$_POST['sex'];
	$age=$_POST['age'];
	$pass=md5($_POST['pass']);
	$workingyear=$_POST['workingyear'];
	$entrytime=$_POST['entrytime'];
	$department=$_POST['department'];
	$position=$_POST['position'];
	$maritalstatus=$_POST['maritalstatus'];
	$sql="select * from $table_doctor where name='$name'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_num_rows($result);
	$time=date("Y 年 m 月 d 日");
	if($row){
	echo "<script>alert(\"该医生已存在！请重新输入\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedoc.php\">";
	}
	else{
		//var_dump($sex);
		//var_dump($sex);
	$sql="insert into $table_doctor(name,sex,department,position,entrytime,workingyear,maritalstatus,age,phonenumber) values('$name','$sex','$department','$position','$entrytime','$workingyear','$maritalstatus','$age','$dpnumber')";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql2="select id from $table_doctor where name='$name'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);
    /*echo "<script>alert(\"".$rows2[0]."\");</script>";*/
	$sql="insert into $table_user(name,p_id,password,priority,date,sex) values('$name','$rows2[0]','$pass','doctor','$time','$sex')";
	mysqli_query($link,$sql);
	echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedoc.php\">";
	echo "<script>alert(\"添加医生成功！\");</script>";
	}
}
if($_GET['id']){
    $id=$_GET['id'];
	$sql="delete from $table_user where p_id='$id'";
	mysqli_query($link,$sql);
	$sql="delete from $table_doctor where id='$id'"; 
    mysqli_query($link,$sql);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedoc.php\">";	 
    echo "<script>alert(\"删除医生成功！\");</script>";
}
if($_GET['eid']){
	$sql="select * from $table_doctor where id='$_GET[eid]'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
    echo "<div class=\"bgd\" id=\"bgd2\" onClick=\"refreshdoc()\"></div>";
    echo "<div class=\"dc\" id=\"dc2\" \">";
    echo "<div class=\"diatit\">编辑医生信息</div>";
    echo "<table class=\"diat\">";
    echo "<form method=\"post\" action=\"organizedoc.php\" onsubmit=\"return juge5(this);\">";
	echo "<input type=\"hidden\" name=\"eid2\" value=\"".$_GET['eid']."\">";	
    echo "<tr>";
    echo "<td>";
    echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
    echo "医生姓名：<input class=\"diainput\" name=\"dname2\" type=\"text\" value=\"".$rows['name']."\">";
    echo "</td>";
    echo "</tr>";	
    echo "<tr>";
    echo "<td>";
    echo "<input type=\"hidden\" name=\"editid\" id=\"editid\">";
    echo "电话号码：<input class=\"diainput\" name=\"dpnumber\" type=\"text\" value=\"".$rows['phonenumber']."\">";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo "医生职称：<select name=\"position\" class=\"diaselect\">";
	if($rows['position']=="主治医师"){
       echo "<option value=\"主治医师\" selected>主治医师</option>";
       echo "<option value=\"副主任医师\">副主任医师</option>";
       echo "<option value=\"主任医师\">主任医师</option>";
	}
	else if($rows['position']=="副主任医师"){
       echo "<option value=\"主治医师\">主治医师</option>";
       echo "<option value=\"副主任医师\" selected>副主任医师</option>";
       echo "<option value=\"主任医师\">主任医师</option>";		
	}
	else{
       echo "<option value=\"主治医师\">主治医师</option>";
       echo "<option value=\"副主任医师\">副主任医师</option>";
       echo "<option value=\"主任医师\" selected>主任医师</option>";		
	}
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   echo "所属科室：<select name=\"department\" class=\"diaselect\">";
   $sql2="select * from $table_department";
   $result2=mysqli_query($link,$sql2) or die(mysqli_error($link));
   while($rows2=mysqli_fetch_array($result2)){ 
      if($rows['department']==$rows2['name'])
          echo "<option value=\"".$rows2['name']."\" selected>".$rows2['name']."</option>";
	  else
	      echo "<option value=\"".$rows2['name']."\">".$rows2['name']."</option>";
   }
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   echo "医生性别：<select name=\"sex\" class=\"diaselect\">";
   if($rows['sex']=='man'){
      echo "<option value=\"1\" selected>男</option>";
	  echo "<option value=\"2\" >女</option>";
   }
   else{
	  echo "<option value=\"1\" >男</option>";
      echo "<option value=\"2\" selected>女</option>";
   }
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   //var_dump($rows['maritalstatus']);
   echo "医生婚否：<select name=\"maritalstatus\" class=\"diaselect\">";
   if($rows['maritalstatus']=='yes'){
      echo "<option value=\"1\" selected>已婚</option>";
	  echo "<option value=\"2\" >未婚</option>";
   }
   else{
	  echo "<option value=\"1\" >已婚</option>";
      echo "<option value=\"2\" selected>未婚</option>";
   }
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   echo "入职年份：<select name=\"entrytime\" class=\"diaselect\">";
   for($i=2000;$i<=2019;$i++)
     if($rows['entrytime']==$i)
         echo "<option value=\"".$i."\" selected>".$i."年</option>";
	 else
		 echo "<option value=\"".$i."\">".$i."年</option>";
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   echo "医生年龄：<select name=\"age\" class=\"diaselect\">";
   for($i=0;$i<100;$i++)
      if($rows['age']==$i)
         echo "<option value=\"".$i."\" selected>".$i."岁</option>";
	  else
		 echo "<option value=\"".$i."\">".$i."岁</option>";
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr>";
   echo "<td>";
   echo "医生工龄：<select name=\"workingyear\" class=\"diaselect\">";
   for($i=0;$i<100;$i++)
      if($rows['workingyear']==$i)
	      echo "<option value=\"".$i."\" selected>".$i."年</option>";
      else
	      echo "<option value=\"".$i."\">".$i."年</option>";
   echo "</select>";
   echo "</td>";
   echo "</tr>";
   echo "<tr><td><input class=\"diasave\" type=\"submit\" value=\"保存\"></td></tr>";
   echo "</form>";
   echo "</table>";
   echo "</div>";	
   echo "<script>editdoc();</script>";
}
if($_POST['dname2']){
	$id=$_POST['eid2'];
	$name=$_POST['dname2'];
	$dpnumber=$_POST['dpnumber'];
	$sex=$_POST['sex'];
	$age=$_POST['age'];
	$workingyear=$_POST['workingyear'];
	$entrytime=$_POST['entrytime'];
	$department=$_POST['department'];
	$position=$_POST['position'];
	$maritalstatus=$_POST['maritalstatus'];

	$sql="update $table_doctor set name='$name',sex='$sex',department='$department',position='$position',entrytime='$entrytime',workingyear='$workingyear',maritalstatus='$maritalstatus',age='$age',phonenumber='$dpnumber' where id=$id";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="update $table_user set name='$name',sex='$sex' where p_id='$id'";
	mysqli_query($link,$sql);
	echo "<meta http-equiv=\"refresh\" content=\"0; url=organizedoc.php\">";
	echo "<script>alert(\"修改医生信息成功！\");</script>";
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>




































