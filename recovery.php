<html>
<head>
<title>坐诊</title>
<link href="addbut.css" rel="stylesheet" type="text/css">
<style>
.dhis{
	border-collapse:separate;border-spacing:10px;
}
</style>
<script>
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
require "dside.php";
require "conf.php";

function getcurpag(){
	require "conf.php";
	$sql="select * from $table_patient where (registrationtype='1' or registrationtype='2') and treat='yes' and pill='yes' and pay='yes' and d_id='$rows0[0]'";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">已接诊患者列表</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按病人搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>      
	  </div>";
echo "<div class=\"bgt2\">";   

$sql0="select p_id from $table_user where name='$_COOKIE[his_user]'";
$result0=mysqli_query($link,$sql0);
$rows0=mysqli_fetch_array($result0);

echo "<table width=\"100%\" class=\"dhis\">";
echo "<tr><th>序号</th><th>患者姓名</th><th>性别</th><th>年龄</th><th>联系方式</th><th>挂号时间</th><th>挂号类型</th></tr>";

$text="";
$pageamo=9;
$nopage=0;
$maxpage=ceil(getcurpag()/$pageamo);
   
if($_COOKIE['explore']||$_GET['u']==1){
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
 $sql="select * from $table_patient where name='$name' and (registrationtype='1' or registrationtype='2') and treat='yes' and pill='yes' and pay='yes' and d_id='$rows0[0]' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);
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
$sql="select * from $table_patient where (registrationtype='1' or registrationtype='2') and treat='yes' and pill='yes' and pay='yes' and d_id='$rows0[0]' limit $number,$pageamo";
$result=mysqli_query($link,$sql);	
}


echo "<tr><td colspan=\"7\"><hr class=\"line1\"></td></tr>";
$i=1;
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>".$rows['sex']."</td><td>".$rows['age']."</td><td>".$rows['phonenumber']."</td><td>".$rows['date'];
	if($rows['time']=="morning")
	    echo " 上午";
	else if($rows['time']=="afternoon")
	    echo " 下午";
	else
	    echo " 晚上";	
	echo "</td><td>";
	if($rows['registrationtype']=="1")
	    echo "门诊";
	else
	    echo "急诊";	
	echo "</td></tr>";
    echo "<tr><td colspan=\"7\"><hr class=\"line2\"></td></tr>";	
    $i++;
}
echo "</table>";

echo "<tr><td colspan=\"7\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>