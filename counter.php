<html>
<head>
<title>问诊</title>
<link href="addbut.css" rel="stylesheet" type="text/css"/>
<script>
function counter(id){
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?payid="+id;
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
	else if(pms[0]=="p"&&pms[1]==1){
		var acc=document.getElementById("accpatient").value;
		document.cookie="explore="+acc;		
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?p="+pms[1]+"&nopage="+num;
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
	else if(identify==3){
		var acc=document.getElementById("accpatient").value;
		document.cookie="explore="+acc;
		location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?p="+1;
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
require "coside.php";
require "conf.php";

function getcurpag(){
	require "conf.php";
	$sql="select * from $table_patient where treat='yes' and pill='no' and pay='no'";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">待付订单列表</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按部门类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>
      <div class=\"search\"><input id=\"accuser\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如张三\" placeholder=\"按医生姓名搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(2)\"></div>	
    <div class=\"search\"><input id=\"accpatient\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如张三\" placeholder=\"按病人姓名搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(3)\"></div>     
	 </div>";
echo "<div class=\"bgt2\" align=\"center\" style=\"display:block\" id=\"lookarr\">";
echo "<table width=\"100%\">";
echo "<tr>";
echo "<th>序号</th><th>患者姓名</th><th>科室</th><th>医生姓名</th><th>挂号时间</th><th>挂号类型</th><th>费用</th><th>操作</th>";
echo "</tr>";
echo "<tr><td colspan=\"8\"><hr class=\"lin1\"></td></tr>";
echo "</tr>";

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

 $sql="select * from $table_patient where dep_id='$rows[id]' and treat='yes' and pill='no' and pay='no'";
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
 $sql="select * from $table_patient where dep_id='$rows[id]'  and treat='yes' and pill='no' and pay='no' limit $number,$pageamo";
 $result=mysqli_query($link,$sql) or die(mysqli_error($link));
}


$sql2="select * from $table_doctor where name='$name'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
if(count($rows2)!=0){ 
 $count--;
 $sql="select * from $table_patient where d_id='$rows2[id]'  and treat='yes' and pill='no' and pay='no'";
 $result=mysqli_query($link,$sql);
 $row=mysqli_num_rows($result);
 if($row==0)
    $maxpage=1;
 else
    $maxpage=ceil($row/$pageamo);
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
 $sql="select * from $table_patient where d_id='$rows2[id]'  and treat='yes' and pill='no' and pay='no' limit $number,$pageamo";
 $result=mysqli_query($link,$sql) or die(mysqli_error($link));
}

$sql2="select id from $table_patient where name='$name' and treat='yes' and pill='no' and pay='no'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
if(count($rows2)!=0){
  $count--;
  $maxpage=1;	
  echo "<script>
         document.getElementById(\"accpatient\").value=\"".$name."\";
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
 $sql="select * from $table_patient where name='$name'  and treat='yes' and pill='no' and pay='no' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);	
 /*echo "<script>alert(\"".$name."\");</script>";	*/
 echo "<script>
              var date=new Date();
			  date.setTime(date.getTime()-1000);
              document.cookie=\"explore='';expires=\"+date.toGMTString();
	  </script>";
 /*echo "<script>alert(\"".$_COOKIE['explore']."\");</script>";		*/  
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
$sql="select * from $table_patient  where treat='yes' and pill='no' and pay='no' limit $number,$pageamo";
$result=mysqli_query($link,$sql);	
}


$i=1;
while($rows=mysqli_fetch_array($result)){
	$sql2="select name from $table_doctor where id='$rows[d_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);
	$sql3="select name from $table_department where id='$rows[dep_id]'";
	$result3=mysqli_query($link,$sql3);
	$rows3=mysqli_fetch_array($result3);	
	if($rows['registrationtype']=="1"){
	    echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>".$rows2['name']."</td><td>".$rows3['name']."</td>";
		echo "<td>门诊</td><td>".$rows['date'];
		if($rows['time']=="morning")
		   echo " 上午";
		else if($rows['time']=="afternoon")
		   echo " 下午";
		else
		   echo " 晚上";
		echo "</td><td>".$rows['cost']."</td><td><input type=button class=\"paybut\" value=\"付款\" id=\"cancell\" onclick=\"counter('$rows[id]')\"></td></tr>";
    }
	if($rows['registrationtype']=="2"){
	    echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>".$rows2['name']."</td><td>".$rows3['name']."</td>";
		echo "<td>急诊</td><td>".$rows['date'];
		if($rows['time']=="morning")
		   echo " 上午";
		else if($rows['time']=="afternoon")
		   echo " 下午";
		else
		   echo " 晚上";
		echo "</td><td>".$rows['cost']."</td><td><input type=button class=\"paybut\" value=\"付款\" id=\"cancell\" onclick=\"counter('$rows[id]')\"></td></tr>";
    }
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";
	$i++;
}

echo "<tr><td colspan=\"10\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</table>";
echo "</div>";
echo "</div>";

if($_GET['payid']){
   if($_COOKIE['his_priority']!="cashier"){
	echo "<script>alert(\"您不是收银员,没有这项操作权限！\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
    exit();
    }	
   $id=$_GET['payid'];
   $sql="update $table_patient set pay='1',casid='$_COOKIE[his_id]' where id='$id'";
   mysqli_query($link,$sql);
   echo "<script>alert(\"付款成功！\");</script>";		
   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";   
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>