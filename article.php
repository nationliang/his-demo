<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" rel="stylesheet" type="text/css">
<title>新闻中心</title>
<style>
.artframe{
	margin-top:20px;
}
.ntable{
	width:98%;margin:0px 10px;
}
.line4{
	border:0.5px dashed #AFAFAF;
}
.lins{
	text-decoration:none;color:#333;
}
.lins:hover{
	color:#149AEB;
}
.pre{
	white-space: pre-wrap;word-wrap: break-word;font-size:large;
}
</style>
<script>
function setpage(num){
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?nopage="+num;
}
</script>
</head>

<body>
<?php
require "head.php";

function getcurpag($kind){
	require "conf.php";
	$sql="select * from $table_article where kind='$kind' order by id desc";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}
require "conf.php";
$sql="";
$pageamo=9;
$nopage=0;
$kind="医院要闻";
$maxpage=ceil(getcurpag($kind)/$pageamo);
if($_COOKIE['kind']){
   $kind=$_COOKIE['kind'];
   $maxpage=ceil(getcurpag($kind)/$pageamo);
}
if($_GET['nopage']>1&&$_GET['nopage']){
 $nopage=$_GET['nopage'];
 $number=($nopage-1)*$pageamo;
 $sql="select * from $table_article where kind='$kind' order by id desc limit $number,$pageamo";//order必须在limit之前
}
else{	
 $sql="select * from $table_article where kind='$kind' order by id desc limit 0,$pageamo";		
}



echo "<div class=\"artframe\">";
require "artside.php";
echo "<div class=\"container\">";
echo "<div class=\"bgt4\">";
echo "<table class=\"ntable\">";
echo "<tr><td colspan=\"2\" style=\"text-align:left;font-size:larger;\"><span style=\"border-bottom:3px solid #3396DF;\">".$kind."</span></td></tr>";
echo "<tr><td colspan=\"2\" style=\"border-top:1px solid #858585;\"></td></tr>";
echo "</table>";
echo "<table id=\"item\" class=\"ntable\">";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td style=\"text-align:left;\"><a href=\"article.php?id=".$rows['id']."\" class=\"lins\">".$rows['title']."</a></td><td>".$rows['date']."</td></tr>";
	echo "<tr><td colspan=2><hr class=\"line4\"></td></tr>";
}

echo "<tr><td colspan=\"2\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></td></tr>";

echo "</table>";

echo "</div>";
echo "</div>";

echo "<div style=\"clear:both;\"></div>";
echo "</div>";


require "webtail.php";
?>
<script>
var para=location.search.substr(1).split("=");
//alert(para[0]);
if(para[0]=="id"){
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?id="+para[1],true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var texts=xmlhttp.responseText.replace(/\s*$/g,'');
			//alert(text);
			var mes=texts.split("@@");
			var text=mes[3];
			var parent=document.getElementById("item");
			for(var i=parent.childNodes.length-1;i>=0;i--)
			    parent.removeChild(parent.childNodes[i]);
			var textnode=document.createTextNode(text);
				
			var pre=document.createElement("pre");
			pre.classList.add("pre");
			pre.appendChild(textnode);
			
			var div=document.createElement("div");
			div.classList.add("ntable");
			
			div.appendChild(pre);
			parent.appendChild(div);
		}
	}
	xmlhttp.send();
}
</script>
</body>
</html>
