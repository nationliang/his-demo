<html>
<head>
<title>问诊</title>
<link href="addbut.css" rel="stylesheet" type="text/css">
<style>
</style>
<script>
function submes(){
	var bookbill = document.getElementById("bookbill");
	if(juge3(bookbill)){
		bookbill.submit();
	}
}
function addmes(total,id,date,time,depid,docid,cost){
	// alert(id+" "+total);
	// alert(cost);
	document.getElementById("sublis").style.display="block";
	for(i=1;i<=total;i++)
	   if(document.getElementById("regkin"+i))
	       document.getElementById("regkin"+i).disabled=true;
	document.getElementById("regkin"+id).disabled=false;
	document.getElementById("docid").setAttribute("value",docid);
	document.getElementById("depid").setAttribute("value",depid);	
	document.getElementById("bookdate").setAttribute("value",date);	
	document.getElementById("booktime").setAttribute("value",time);	
	document.getElementById("regcost").setAttribute("value",cost);	
	document.getElementById("regtype").setAttribute("value",1);	
}
function addmes2(id){
	//
	var obj=document.getElementById("regkin"+id);
	var index=obj.selectedIndex;
	var kin=obj.options[index].value;
	//alert(kin);
	document.getElementById("regtype").setAttribute("value",kin);
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

function juge3(theForm){
   if(theForm.sex.value==""){
	  alert("请选择性别！");
	  theForm.sex.focus();
	  return false;
	}
   if(theForm.age.value==""){
      alert("请选择年龄！");
	  theForm.age.focus();
	  return false;
	}
   if(theForm.idnum.value==""){
	  alert("请填写身份证号!");
	  theForm.idnum.focus();
	  return false;
   }
   if(theForm.borntime.value==""){
	  alert("请出生年月日!");
	  theForm.borntime.focus();
	  return false;
   }
   if(theForm.conway.value==""){
	  alert("请填联系方式!");
	  theForm.conway.focus();
	  return false;
   }
   if(theForm.addr.value==""){
	  alert("请填家庭住址!");
	  theForm.addr.focus();
	  return false;
   }
   return true;
}
</script>
</head>
<body>
<?php
require "head.php";
echo "<div>";
require "pside.php";
require "conf.php";

function compareTime($time,$time2){//比较'xxxx 年 xx 月 xx 日'与比较'yyyy 年 yy 月 yy 日的大小，前者大返回1，后者大返回-1，相等返回0
	$year=substr($time,0,4);//substr(string,start,length)
	$month=substr($time,9,2);//一个汉字占三字符
	$day=substr($time,16,2);
	$time=$year."-".$month."-".$day;
	
	$year2=substr($time2,0,4);//substr(string,start,length)
	$month2=substr($time2,9,2);//一个汉字占三字符
	$day2=substr($time2,16,2);
	$time2=$year2."-".$month2."-".$day2;	
	
	if(strtotime($time)>strtotime($time2)){
		return 1;
	}
	else if(strtotime($time)<strtotime($time2)){
		return -1;
	}
	else
	    return 0;
}

function getcurpag(){
	require "conf.php";
	$sql="select * from $table_arrange";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">当前状态：挂号</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按部门类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>
      <div class=\"search\"><input id=\"accuser\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如张三\" placeholder=\"按医生姓名搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(2)\"></div>	
      <div class=\"search\"><input id=\"accpatient\" type=text name=\"searchframe\" class=\"searchframe\" title=\"输入提示:如2019-04-30\" placeholder=\"按时间搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(3)\"></div>      
	  </div>";
echo "<div class=\"bgt3\">";
echo "<div class=\"patmes\">";
echo "<table class=\"pattab\">";
echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\" id=\"bookbill\">";
echo "<input type=hidden id=\"docid\" name=\"docid\">";
echo "<input type=hidden id=\"bookdate\" name=\"bookdate\">";
echo "<input type=hidden id=\"booktime\" name=\"booktime\">";
echo "<input type=hidden id=\"depid\" name=\"depid\">";
echo "<input type=hidden id=\"regtype\" name=\"regtype\">";
echo "<input type=hidden id=\"regcost\" name=\"regcost\">";
echo "<tr><td>";
echo "<span style=\"color:blue;\">患者信息</span>";
echo "</td></tr>";
echo "<tr><td>";
echo "姓名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"pname\" value=\"".$_COOKIE['his_user']."\" readonly=\"readonly\">";
echo "</td></tr>";
echo "<tr><td>";
echo "性别：<select name=\"sex\">";
echo "<option value=\"man\">男性</option>";
echo "<option value=\"woman\">女性</option>";
echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "年龄：<select name=\"age\">";
for($i=0;$i<100;$i++)
echo "<option value=\"".$i."\">".$i."岁</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td>";
echo "身份证号：<input type=\"text\" name=\"idnum\">";
echo "</td></tr>";
echo "<tr><td>";
echo "生日：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"borntime\" type=text placeholder=\"格式：yyyy-mm-dd\">";
echo "</td></tr>";
echo "<tr><td>";
echo "联系方式：<input name=\"conway\" type=text placeholder=\"电话或手机号\">";
echo "</td></tr>";
echo "<tr><td>";
echo "住址：<br><textarea name=\"addr\" rows=\"6\" cols=\"33\"></textarea>";
echo "</td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "<div class=\"showreg\">";
echo "<table class=\"regmes\">";
echo "<tr><th>&nbsp;</th><th>序号</th><th>日期</th><th>时间段</th><th>科室</th><th>医生</th><th>挂号类型</th><th>挂号费</th></tr>";
echo "<tr><td colspan=\"8\"><hr class=\"line1\"></td></tr>";

$sql="select * from $table_arrange";
$result=mysqli_query($link,$sql);
$date=date("Y 年 m 月 d 日");
while($rows=mysqli_fetch_array($result)){
   if(compareTime($rows['date'],$date)==-1){
	 $sql2="delete from $table_arrange where date='$rows[date]'";
	 mysqli_query($link,$sql2);
   }
}
mysqli_data_seek($result,0);
while($rows=mysqli_fetch_array($result)){
	$sql2="delete from $table_arrange where mor='' and aft='' and eve=''";
	mysqli_query($link,$sql2);
}

$count=2;
$text="";
$pageamo=3;
$nopage=1;
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

 $sql="select * from $table_arrange where dep='$name'";
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
 $sql="select * from $table_arrange where dep='$name' limit $number,$pageamo";
 $result=mysqli_query($link,$sql) or die(mysqli_error($link));
}

$sql2="select * from $table_doctor where name='$name'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
if(count($rows2)!=0){ 
 $count--;
 $sql="select * from $table_arrange where mor='$name' or aft='$name' or eve='$name'";
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
 $sql="select * from $table_arrange where mor='$name' or aft='$name' or eve='$name' limit $number,$pageamo";
 $result=mysqli_query($link,$sql) or die(mysqli_error($link));
}

$time=$name;
$time=explode("-",$time);
$stime=$time[0]." 年 ".$time[1]." 月 ".$time[2]." 日";
$sql2="select id from $table_arrange where date='$stime'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
if(count($rows2)!=0){
  $count--;
  $maxpage=1;	
  $time=$name;
  echo "<script>
         document.getElementById(\"accpatient\").value=\"".$time."\";
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
 $sql="select * from $table_arrange where date='$stime' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);	
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
/*echo "<script>alert(\"".$maxpage." ".$number." ".$nopage." ".$pageamo."\")</script>";*/
$sql="select * from $table_arrange limit $number,$pageamo";
$result=mysqli_query($link,$sql);
//$n=mysqli_num_rows($result);
}	

/*echo "<script>alert(\"".$n."\")</script>";*/
$i=1;
$sql2="select price from $table_itemlist where name='挂号费'";
$result2=mysqli_query($link,$sql2);
$rows2=mysqli_fetch_array($result2);
$sql_count="select * from $table_arrange";
$result_count=mysqli_query($link,$sql_count);
$num=mysqli_num_rows($result_count) or die(mysqli_error($link));
while($rows=mysqli_fetch_array($result)){
	$time=$rows['date'];
	$year=substr($time,0,4);//substr(string,start,length)
	$month=substr($time,9,2);//一个汉字占三字符
	$day=substr($time,16,2);
	$time=$year."-".$month."-".$day;
	/*echo "<script>alert(\"".$time."#".date("Y-m-d")."\");</script>";
	if(strtotime($time)>strtotime(date("H-m-d")))
	    echo "<script>alert(\"pk\");</script>";*/
    /*echo "<script>alert(\"".strlen("年")." &"."\");</script>";
	echo "<script>alert(\"".strlen($time)."#".",".$year."#".strlen($year).",".$month."#".strlen($month).",".$day."#".strlen($day)." ".date("d")."\");</script>";	*/
	if(strtotime($time)>=strtotime(date("Y-m-d"))){	
	$sql3="select id from $table_department where name='$rows[dep]'";
	$result3=mysqli_query($link,$sql3);
	$rows3=mysqli_fetch_array($result3);
	if(($rows['mor']!=""&&date("H")<12&&date("d")==$day)||($rows['mor']!=""&&date("d")!=$day)){
	$sql4="select id from $table_doctor where name='$rows[mor]'";
	$result4=mysqli_query($link,$sql4);
	$rows4=mysqli_fetch_array($result4);		
	echo "<tr><td><input type=\"radio\" name=\"regope\" onChange=\"addmes(".($num*3).",".$i.",'$rows[date]','morning','$rows3[0]','$rows4[0]',".$rows2['price'].")\"></td><td>".$i."</td><td>".$rows['date']."</td><td>上午</td><td>".$rows['dep']."</td><td>".$rows['mor']."</td>
	<td><select id=\"regkin".$i."\" name=\"regkin\" onChange=\"addmes2(".$i.")\" disabled=\"disabled\"><option value=\"1\">门诊</option><option value=\"2\">急诊</option></select></td><td>".$rows2['price']."</td></tr>";
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";
	}
	if(($rows['mor']!=""&&date("H")<12&&date("d")==$day)||($rows['mor']!=""&&date("d")!=$day))
	    $i++;
	/*echo "<script>alert(\"".$rows['aft']." ".$month." ".$day."\");</script>";*/
	
	if(($rows['aft']!=""&&date("H")<18&&date("d")==$day)||($rows['aft']!=""&&date("d")!=$day)){	
	$sql4="select id from $table_doctor where name='$rows[aft]'";
	$result4=mysqli_query($link,$sql4);
	$rows4=mysqli_fetch_array($result4);		
	echo "<tr><td><input type=\"radio\" name=\"regope\" onChange=\"addmes(".($num*3).",".$i.",'$rows[date]','afternoon','$rows3[0]','$rows4[0]',".$rows2['price'].")\"></td><td>".$i."</td><td>".$rows['date']."</td><td>下午</td><td>".$rows['dep']."</td><td>".$rows['aft']."</td><td><select id=\"regkin".$i."\" name=\"regkin\" onChange=\"addmes2(".$i.")\" disabled=\"disabled\"><option value=\"1\">门诊</option><option value=\"2\">急诊</option></select></td><td>".$rows2['price']."</td></tr>";
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";	
	}
	if(($rows['aft']!=""&&date("H")<18&&date("d")==$day)||($rows['aft']!=""&&date("d")!=$day))
	     $i++;
	if(($rows['eve']!=""&&date("H")<=24&&date("d")==$day)||($rows['eve']!=""&&date("d")!=$day)){
	$sql4="select id from $table_doctor where name='$rows[eve]'";
	$result4=mysqli_query($link,$sql4);
	$rows4=mysqli_fetch_array($result4);		
	echo "<tr><td><input type=\"radio\" name=\"regope\" onChange=\"addmes(".($num*3).",".$i.",'$rows[date]','evening','$rows3[0]','$rows4[0]',".$rows2['price'].")\"></td><td>".$i."</td><td>".$rows['date']."</td><td>晚上</td><td>".$rows['dep']."</td><td>".$rows['eve']."</td><td><select id=\"regkin".$i."\" name=\"regkin\" onChange=\"addmes2(".$i.")\" disabled=\"disabled\"><option value=\"1\">门诊</option><option value=\"2\">急诊</option></select></td><td>".$rows2['price']."</td></tr>";	
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";
	}  
	if(($rows['eve']!=""&&date("H")<=24&&date("d")==$day)||($rows['eve']!=""&&date("d")!=$day))
	   $i++;
	}
}
echo "<tr><td colspan=\"8\"><input style=\"display:none;\" id=\"sublis\" class=\"appdep2\" type=\"button\" value=\"提交挂号信息\" onClick=\"submes()\"></td></tr>";
echo "</table>";
echo "<div class=\"pagestyle addps\"><div class=\"pagcon\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a>&nbsp;|&nbsp;<a href=\"javascript:void(0)\">共".$maxpage."页</a>&nbsp;|&nbsp;<a href=\"javascript:void(0)\">当前第".$nopage."页</a></div></div>";
echo "</div>";




echo "</div>";
echo "</div>";
if($_POST['pname']){
$name=$_POST['pname'];
/*echo "<script>alert(\"".$name."\");</script>";*/
$sex=$_POST['sex'];
$age=$_POST['age'];
$idnum=$_POST['idnum'];
$borntime=$_POST['borntime'];
$conway=$_POST['conway'];
$addr=$_POST['addr'];
$depid=$_POST['depid'];
$docid=$_POST['docid'];
$booktime=$_POST['booktime'];
$bookdate=$_POST['bookdate'];
$regcost=$_POST['regcost'];
$regtype=$_POST['regtype'];



$sql="select * from $table_user where name='$name'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);
/*echo "<script>alert(\"".$regtype."\");</script>";	
echo "<script>alert(\"".$rows['priority']."\");</script>";*/	
if($rows['priority']!="patient"){
	echo "<script>alert(\"您不是患者，没有这项操作权限！\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
    exit();
}
else{
$sql="select count(*) as tnum from $table_patient where name='$name' and date='$bookdate' and time='$booktime' and dep_id='$depid'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);
/*echo "<script>alert(\"".$rows['tnum']."\");</script>";	*/
if($rows['tnum']!=0){
echo "<script>alert(\"同一个科室上午/下午/晚上只能挂一个号！\");</script>";		
echo "<meta http-equiv=\"refresh\" content=\"0; url=patient.php\">";
exit();
}	

$sql0="select name from $table_department where id='$depid'";
$result0=mysqli_query($link,$sql0);
$rows0=mysqli_fetch_array($result0);
	
if($booktime=="morning"){	
   $sql="select mornum from $table_arrange where date='$bookdate' and dep='$rows0[0]'";
   $result=mysqli_query($link,$sql);
   $rows=mysqli_fetch_array($result);
}
else if($booktime=="afternoon"){
   $sql="select aftnum from $table_arrange where date='$bookdate' and dep='$rows0[0]'";
   $result=mysqli_query($link,$sql);
   $rows=mysqli_fetch_array($result);	
}
else{ //$booktime=="evening"
   $sql="select evenum from $table_arrange where date='$bookdate' and dep='$rows0[0]'";
   $result=mysqli_query($link,$sql);
   $rows=mysqli_fetch_array($result);	
}
if($rows[0]>=20){
   echo "<script>alert(\"您所挂的号人数已满，请另外选择！\");</script>";		
   echo "<meta http-equiv=\"refresh\" content=\"0; url=patient.php\">";
   exit();
}
else{
	if($booktime=="morning"){
	  $sql="update $table_arrange set mornum=mornum+1 where dep='$rows0[0]' and date='$bookdate'";
	  $result=mysqli_query($link,$sql);
	  $rows=mysqli_fetch_array($result);
	}
	else if($booktime=="afternoon"){
	  $sql="update $table_arrange set aftnum=aftnum+1 where dep='$rows0[0]' and date='$bookdate'";
	  $result=mysqli_query($link,$sql);
	  $rows=mysqli_fetch_array($result);
	}
	else{ //$booktime=="evening"
	  $sql="update $table_arrange set evenum=evenum+1 where dep='$rows0[0]' and date='$bookdate'";
	  $result=mysqli_query($link,$sql);
	  $rows=mysqli_fetch_array($result);
	}	
}



$sql="select id from $table_user where name='$name'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);

$sql="insert into $table_patient(name,age,idnum,borntime,sex,address,phonenumber,registrationtype,d_id,dep_id,date,time,cost,pp_id) values('$name','$age','$idnum','$borntime','$sex','$addr','$conway','$regtype','$docid','$depid','$bookdate','$booktime','$regcost','$rows[id]')";
mysqli_query($link,$sql) or die(mysqli_error($link));
$sql2="update $table_itemlist set number=number+1 where name='挂号费' and id!=0";
mysqli_query($link,$sql2) or die(mysqli_error($link));
echo "<script>alert(\"挂号成功！\");</script>";
echo "<meta http-equiv=\"refresh\" content=\"0; url=booklist.php\">";
}
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>