<html>
<head>
<title>系统设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" rel="stylesheet" type="text/css">
<script>
function selectpara(){
	var obj=document.getElementById("selectdep");
	var index=obj.selectedIndex;
	//alert(index);
	var depid=obj.options[index].value;
	//alert(depid);
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?depid="+depid;
}
function arrbut(){
	//alert(document.getElementById("lookarr").style.display);
	//alert(document.getElementById("editarr").style.display);
	document.getElementById("lookarr").style.display=(document.getElementById("lookarr").style.display=="none"?"block":"none");
	document.getElementById("editarr").style.display=(document.getElementById("editarr").style.display=="block"?"none":"block");	
}
function retreat(){
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>";
}
</script>
</head>
<body>
<?php
function showTimeRange(){
	if(date("l")=="Sunday")
		return date("Y-m-d",strtotime("-6 days"))."——".date("Y-m-d");
	else if(date("l")=="Monday")
	    return date("Y-m-d")."——".date("Y-m-d",strtotime("+6 days"));
	else if(date("l")=="Tuesday")
	    return date("Y-m-d",strtotime("-1 days"))."——".date("Y-m-d",strtotime("+5 days"));
	else if(date("l")=="Wednesday")
	    return date("Y-m-d",strtotime("-2 days"))."——".date("Y-m-d",strtotime("+4 days"));	
	else if(date("l")=="Thursday")
	    return date("Y-m-d",strtotime("-3 days"))."——".date("Y-m-d",strtotime("+3 days"));
	else if(date("l")=="Friday")
	    return date("Y-m-d",strtotime("-4 days"))."——".date("Y-m-d",strtotime("+2 days"));
	else
	    return date("Y-m-d",strtotime("-5 days"))."——".date("Y-m-d",strtotime("+1 days"));
}
function setWeeToTim($week){
	if($week=="Sunday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+6 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+5 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("+4 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("+3 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("+2 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));	
	}
	else if($week=="Monday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-6 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("-2 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("-3 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("-4 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("-5 days"));	
	}
	else if($week=="Tuesday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-5 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("-2 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("-3 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("-4 days"));	
	}
	else if($week=="Wednesday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-4 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+2 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("-2 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("-3 days"));	
	}	
	else if($week=="Thursday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-3 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+3 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+2 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("-2 days"));	
	}
	else if($week=="Friday"){
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-2 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+4 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+3 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("+2 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));	
	}
	else{
		if(date("l")=="Sunday")
		     return date("Y 年 m 月 d 日",strtotime("-1 days"));		
	    else if(date("l")=="Monday")
		     return date("Y 年 m 月 d 日",strtotime("+5 days"));	
	    else if(date("l")=="Tuesday")
		     return date("Y 年 m 月 d 日",strtotime("+4 days"));	
    	else if(date("l")=="Wednesday")
		     return date("Y 年 m 月 d 日",strtotime("+3 days"));		
	    else if(date("l")=="Thursday")
		     return date("Y 年 m 月 d 日",strtotime("+2 days"));	
	    else if(date("l")=="Friday")
		     return date("Y 年 m 月 d 日",strtotime("+1 days"));	
	    else
		     return date("Y 年 m 月 d 日",strtotime("+0 days"));	
	}
}
?>
<?php
require "head.php";
echo "<div>";
require "sside.php";
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


$sql="select * from $table_arrange";//删除过期的排班信息
$result=mysqli_query($link,$sql);
$date=date("Y 年 m 月 d 日");
while($rows=mysqli_fetch_array($result)){
   if(compareTime($rows['date'],$date)==-1){
	 $sql2="delete from $table_arrange where date='$rows[date]'";
	 mysqli_query($link,$sql2);
   }
}

$sql="select * from $table_department";
$result=mysqli_query($link,$sql);
echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">医生排班列表</span><span class=\"title3\">".showTimeRange()."</span>";
echo "<span class=\"selectcon\">选择科室：<select name=\"selectdep\" id=\"selectdep\" class=\"selectdep\" onchange=\"selectpara();\">";
$rows=mysqli_fetch_array($result);
$defaultdep="";
if($_GET['depid']){
   $sql2="select * from $table_department where id='$_GET[depid]'";
   $result2=mysqli_query($link,$sql2);
   $rows2=mysqli_fetch_array($result2);
   $defaultdep=$rows2['name'];
   do{
	   if($rows['id']==$_GET['depid'])
	       echo "<option value=".$rows['id']." selected>".$rows['name']."</option>";
	   else
	       echo "<option value=".$rows['id'].">".$rows['name']."</option>";
   }while($rows=mysqli_fetch_array($result));
}
else{
   if(!$rows['name'])
       echo "<option value=\"\">暂无科室数据</option>";
   else{
	   $defaultdep=$rows['name'];
       do{
          echo "<option value=\"".$rows['id']."\">".$rows['name']."</option>";	
       }while($rows=mysqli_fetch_array($result));
   }
}
echo "</select></span></div>";
echo "<div class=\"bgt2\" align=\"center\" style=\"display:block\" id=\"lookarr\">";
echo "<span style=\"\">查看医生排班列表</span>";
$sql="select * from $table_arrange where dep='$defaultdep'";
$result=mysqli_query($link,$sql);
$t11="";$t12="";$t13="";
$t21="";$t22="";$t23="";
$t31="";$t32="";$t33="";
$t41="";$t42="";$t43="";
$t51="";$t52="";$t53="";
$t61="";$t62="";$t63="";
$t71="";$t72="";$t73="";
while($rows=mysqli_fetch_array($result)){
	$time=$rows['date'];
	$year=substr($time,0,4);
	$month=substr($time,9,2);
	$day=substr($time,16,2);
	$time=$year."-".$month."-".$day;
	
	$time2=setWeeToTim("Monday");
	$year2=substr($time2,0,4);
	$month2=substr($time2,9,2);
	$day2=substr($time2,16,2);
	$time2=$year2."-".$month2."-".$day2;
	/*echo "<script>alert(\"".$time2."#".$time."\");</script>";*/
	if(strtotime($time)>=strtotime($time2)){	
	if($rows['week']=="Monday"){
		$t11=$rows['mor'];$t12=$rows['aft'];$t13=$rows['eve'];
	}
	else if($rows['week']=="Tuesday"){
		$t21=$rows['mor'];$t22=$rows['aft'];$t23=$rows['eve'];
	}
	else if($rows['week']=="Wednesday"){
		$t31=$rows['mor'];$t32=$rows['aft'];$t33=$rows['eve'];
	}
	else if($rows['week']=="Thursday"){
		$t41=$rows['mor'];$t42=$rows['aft'];$t43=$rows['eve'];
	}	
	else if($rows['week']=="Friday"){
		$t51=$rows['mor'];$t52=$rows['aft'];$t53=$rows['eve'];
	}	
	else if($rows['week']=="Saturday"){
		$t61=$rows['mor'];$t62=$rows['aft'];$t63=$rows['eve'];
	}
	else{
		$t71=$rows['mor'];$t72=$rows['aft'];$t73=$rows['eve'];
	}
	}
}
echo "<table class=\"showtable\" >";
echo "<tr><th style=\"padding:15px 0px;width:60px;vertical-align:top;\">科室</th><th>时间段</th><th>周一</th><th>周二</th><th>周三</th><th>周四</th><th>周五</th><th>周六</th><th>周日</th><th style=\"padding:15px 0px;width:60px;\">操作</th></tr>";
echo "<tr><td rowspan=\"3\" style=\"padding:15px 0px;width:60px;vertical-align:top;\">".$defaultdep."</td><td>上午</td><td>".$t11."</td><td>".$t21."</td><td>".$t31."</td><td>".$t41."</td><td>".$t51."</td><td>".$t61."</td><td>".$t71."</td><td rowspan=\"3\" style=\"padding:15px 0px;width:60px;vertical-align:top;\"><input type=\"button\" value=\"编辑\" onclick=\"arrbut()\" class=\"arrabut\"></td></tr>";
echo "<td>下午</td><td>".$t12."</td><td>".$t22."</td><td>".$t32."</td><td>".$t42."</td><td>".$t52."</td><td>".$t62."</td><td>".$t72."</td></tr>";
echo "<td>晚上</td><td>".$t13."</td><td>".$t23."</td><td>".$t33."</td><td>".$t43."</td><td>".$t53."</td><td>".$t63."</td><td>".$t73."</td></tr>";
echo "</table>";
echo "</div>";
echo "<div id=\"editarr\" style=\"display:none\" class=\"bgt2\" align=\"center\">";
echo "<span style=\"\">编辑医生排班列表</span>";
echo "<table class=\"showtable\">";
echo "<form method=post action=\"".$_SERVER['PHP_SELF']."\">";
echo "<input type=\"hidden\" name=\"flag\" value=\"".$defaultdep."\">";
echo "<tr><th style=\"padding:15px 0px;width:60px;vertical-align:top;\">科室</th><th>时间段</th><th>周一</th><th>周二</th><th>周三</th><th>周四</th><th>周五</th><th>周六</th><th>周日</th><th style=\"padding:15px 0px;width:60px;\">操作</th></tr>";
echo "<tr><td rowspan=\"3\" style=\"padding:15px 0px;width:60px;vertical-align:top;\">".$defaultdep."</td><td>上午</td><td>";
echo "<select name=\"t11\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t11)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t21\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t21)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t31\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t31)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t41\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t41)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t51\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t51)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t61\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t61)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t71\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t71)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td rowspan=\"3\" style=\"padding:15px 0px;width:60px;vertical-align:center;\"><input type=\"submit\" value=\"保存\" class=\"arrabut\"><input type=\"button\" value=\"返回\" class=\"arrabut\" onclick=\"retreat()\"></td></tr>";
echo "<td>下午</td><td>";
echo "<select name=\"t12\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t12)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";	
echo "</td><td>";
echo "<select name=\"t22\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t22)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t32\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t32)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t42\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t42)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t52\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t52)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t62\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t62)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t72\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t72)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td></tr>";
echo "<td>晚上</td><td>";
echo "<select name=\"t13\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t13)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t23\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t23)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t33\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t33)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t43\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t43)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t53\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t53)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t63\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t63)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td><td>";
echo "<select name=\"t73\">";
echo "<option value=\"\">&nbsp;</option>";
$sql="select * from $table_doctor where department='$defaultdep'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result))
    if($rows['name']==$t73)
	     echo "<option value=".$rows['name']." selected>".$rows['name']."</option>";
	else
         echo "<option value=".$rows['name'].">".$rows['name']."</option>";
echo "</select>";
echo "</td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "</div>";

if($_POST['flag']!=""){
$dep=$_POST['flag'];
/*echo "<script>alert(\"".$dep."\");</script>";*/
/*echo "<script>alert(\"hello!\");</script>";	*/
$t11=$_POST['t11'];$t12=$_POST['t12'];$t13=$_POST['t13'];
$t21=$_POST['t21'];$t22=$_POST['t22'];$t23=$_POST['t23'];
$t31=$_POST['t31'];$t32=$_POST['t32'];$t33=$_POST['t33'];
$t41=$_POST['t41'];$t42=$_POST['t42'];$t43=$_POST['t43'];
$t51=$_POST['t51'];$t52=$_POST['t52'];$t53=$_POST['t53'];
$t61=$_POST['t61'];$t62=$_POST['t62'];$t63=$_POST['t63'];
$t71=$_POST['t71'];$t72=$_POST['t72'];$t73=$_POST['t73'];
$sql="select * from $table_arrange where dep='$dep' and week='Monday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Monday','$t11','$t12','$t13','$dep','".setWeeToTim('Monday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t11',aft='$t12',eve='$t13',date='".setWeeToTim('Monday')."' where dep='$dep' and week='Monday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Tuesday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Tuesday','$t21','$t22','$t23','$dep','".setWeeToTim('Tuesday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t21',aft='$t22',eve='$t23',date='".setWeeToTim('Tuesday')."' where dep='$dep' and week='Tuesday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Wednesday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Wednesday','$t31','$t32','$t33','$dep','".setWeeToTim('Wednesday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t31',aft='$t32',eve='$t33',date='".setWeeToTim('Wednesday')."' where dep='$dep' and week='Wednesday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Thursday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Thursday','$t41','$t42','$t43','$dep','".setWeeToTim('Thursday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t41',aft='$t42',eve='$t43',date='".setWeeToTim('Thursday')."' where dep='$dep' and week='Thursday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Friday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Friday','$t51','$t52','$t53','$dep','".setWeeToTim('Friday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t51',aft='$t52',eve='$t53',date='".setWeeToTim('Friday')."' where dep='$dep' and week='Friday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Saturday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Saturday','$t61','$t62','$t63','$dep','".setWeeToTim('Saturday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t61',aft='$t62',eve='$t63',date='".setWeeToTim('Saturday')."' where dep='$dep' and week='Saturday'";
	mysqli_query($link,$sql);
}
$sql="select * from $table_arrange where dep='$dep' and week='Sunday'";
$result=mysqli_query($link,$sql);
$row=mysqli_num_rows($result);
if($row==""){
	$sql="insert into $table_arrange(week,mor,aft,eve,dep,date) values('Sunday','$t71','$t72','$t73','$dep','".setWeeToTim('Sunday')."')";
	mysqli_query($link,$sql);
}
else{
	$sql="update $table_arrange set mor='$t71',aft='$t72',eve='$t73',date='".setWeeToTim('Sunday')."' where dep='$dep' and week='Sunday'";
	mysqli_query($link,$sql);
}
/*echo "<script>alert(\"编辑医生排班列表操作成功！\");</script>";*/
echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>




































