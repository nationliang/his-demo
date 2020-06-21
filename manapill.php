<html>
<head>
<title>药库</title>
<link href="addbut.css" rel="stylesheet" type="text/css">
<script>
function addmed(){
	document.getElementById("bgd").style.display=(document.getElementById("bgd").style.display=="block"?"none":"block");
	document.getElementById("dc").style.display=(document.getElementById("dc").style.display=="block"?"none":"block");	
}
function juge(theForm){
if(theForm.medname.value==""){
	alert("请输入药品名称！");
	theForm.medname.focus();
	return false;
}
if(theForm.mednumber.value==""){
	alert("请输入药品数量！");
	theForm.mednumber.focus();
	return false;
}
if(theForm.medprice.value==""){
	alert("请输入药品单价！");
	theForm.medprice.focus();
	return false;
}	
}
function meddel(id){
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?delid="+id;
}
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
<style>
.medtab{
    border-collapse:collapse;width:100%;
}
.trcolor{
	 background-color:#F8F8F8;border-top:1px solid #CACACA;border-bottom:1px solid #CACACA;line-height:40px;
}
</style>
</head>
<body>
<?php
require "head.php";
echo "<div>";
require "mside.php";
require "conf.php";

function getcurpag(){
	require "conf.php";
	$sql="select * from $table_medicine";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"addmed()\"></div>";
echo "<div class=\"dc\" id=\"dc\">";
echo "<div class=\"diatit\">添加药品</div>";
echo "<table class=\"diat\">";
echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\" onsubmit=\"return juge(this);\">";
echo "<tr>";
echo "<td>";
echo "药品名称：<input class=\"diainput\" name=\"medname\" type=\"text\">";
echo "</td>";
echo "</tr>";
echo "<tr><td>";
echo "药品种类：<select name=\"medkind\" class=\"diaselect\">";
echo "<option value=\"0\" selected>非处方药</option>";
echo "<option value=\"1\">处方药</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td>";
echo "药品数量：<input type=text name=\"mednumber\" class=\"diainput\">";
echo "</td></tr>";
echo "<tr><td>";
echo "药品成本：<input type=text name=\"medcost\" class=\"diainput\">";
echo "</td></tr>";
echo "<tr><td>";
echo "药品单价：<input type=text name=\"medprice\" class=\"diainput\">";
echo "</td></tr>";
echo "<tr><td style=\"text-align:left;padding:0px 10px;\">";
echo "<span>药品简介：</span><br>";
echo "<textarea class=\"diatextarea\" name=\"meddes\"></textarea>";
echo "</td></tr>";
echo "<tr><td><input class=\"diasave\" type=\"submit\" value=\"保存\"></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">药品管理</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按药品类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>
	  <input class=\"appdep\" type=\"button\" value=\"添加药品\" onClick=\"addmed()\"></div>";
echo "<div class=\"bgt2\">";
echo "<table class=\"medtab\">";
echo "<form>";
echo "<tr ><th>序号</th><th>药品名称</th><th>类别</th><th>单价</th><th>库存数量</th><th>入库时间</th><th>操作</th></tr>";

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
 $sql="select * from $table_medicine where name='$name' limit $number,$pageamo";
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
$sql="select * from $table_medicine limit $number,$pageamo";
$result=mysqli_query($link,$sql);	
}


$i=1;
while($rows=mysqli_fetch_array($result)){
	if($i%2==1){
	   echo "<tr class=\"trcolor\"><td>".$i."</td><td>".$rows['name']."</td><td>";
	   if($rows['kin']==0)
	      echo "非处方药";
	   else
	      echo "处方药";
	   echo "</td><td>￥".$rows['price']."</td><td>".$rows['amount']."</td><td>".$rows['date']."</td><td><input type=button value=\"删除\" class=\"concellbut\" onClick=\"meddel(".$rows['id'].")\"></td></tr>";
	}
	else{
	   echo "<tr><td>".$i."</td><td>".$rows['name']."</td><td>";
	   if($rows['kin']==0)
	      echo "非处方药";
	   else
	      echo "处方药";
	   echo "</td><td>￥".$rows['price']."</td><td>".$rows['amount']."</td><td>".$rows['date']."</td><td><input type=button value=\"删除\" class=\"concellbut\" onClick=\"meddel(".$rows['id'].")\"></td></tr>";
	}
	$i++;
}
echo "</form>";

echo "<tr><td colspan=\"7\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";
echo "</div>";

echo "</table>";
echo "</div>";
echo "</div>";
if($_POST['medname']){
	$name=$_POST['medname'];
	$price=$_POST['medprice'];
	$kind=$_POST['medkind'];
	$num=$_POST['mednumber'];
	$cost=$_POST['medcost'];
	$description=$_POST['meddes'];
	$time=date("Y 年 m 月 d 日");

	$sql="select * from $table_medicine where name='$name'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if($rows['name']!=""){
	   echo "<script>alert(\"该药品已存在！\");</script>";		
	   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
       exit();		
	}
	else{
	   $sql="insert into $table_medicine(name,description,kind,cost,price,amount,date) values('$name','$description','$kind','$cost','$price','$num','$time')";
	   mysqli_query($link,$sql) or die(mysqli_error($link));
	   echo "<script>alert(\"增加药品成功！\");</script>";		
	   echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
       exit();	   
	}
}
if($_GET['delid']){
	$id=$_GET['delid'];
	$sql="delete from $table_medicine where id='$id'";
	mysqli_query($link,$sql);
	echo "<script>alert(\"删除药品成功！\");</script>";		
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
    exit();	
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>