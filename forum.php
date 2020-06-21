<?php
require "conf.php";
$sql="select * from $table_department";
$result=mysqli_query($link,$sql);
$num=mysqli_num_rows($result);
setcookie("depnum",$num);

$sql="select * from $table_department limit 0,1";
$result=mysqli_query($link,$sql);
$dep_id=$_COOKIE['dep_id'];
if(!$dep_id){
	$rows=mysqli_fetch_array($result);
	if (!$rows['id']) {
		setcookie("dep_id",-1);
	} else {
		$dep_id=$rows['id'];
		setcookie("dep_id",$rows['id']);
	}
	// echo "<script>location.href=\"forum.php\";</script>";//cookie设置后要刷新页面才会生效
}

?>
<?php
// $depnum=$_COOKIE['depnum'];
// setcookie("jjjj",$depnum);
// $dep_id=$_COOKIE['dep_id'];
// $dep_id=$_COOKIE['departmentid'];
$topic_id=$_COOKIE['topic_id'];
if(!$topic_id){
    $sql="select * from $table_topic where p_id='$dep_id'";
    $result=mysqli_query($link,$sql) or die(mysql_error($link));
	$rows=mysqli_fetch_array($result);
	if (!$rows['id']) {
        setcookie("topic_id",-1);
	} else {
		$topic_id=$rows['id'];
		setcookie("topic_id",$rows['id']);
	}
    // echo "<script>location.href=\"forum.php\";</script>";//cookie设置后要刷新页面才会生效
}

$flag=$_COOKIE['flag'];
if(!$flag){
	$flag=1;
	setcookie("flag",1);
	// echo "<script>location.href=\"forum.php\";</script>";//cookie设置后要刷新页面才会生效
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="addbut.css" rel="stylesheet" type="text/css">
<script src="prevent.js"></script>
<title>医院论坛</title>
<style>
   .mes-tip-wrap{
	display:inline-block;
	color:white;
	position:relative;
	top:-14px;
	left:-10px;
	background:red;
	text-align:center;
	border-radius:50%;
	font-size:10px;
	color:red;
	opacity:0.8;
   }
   .mes-tip{
	position:relative;
	top:0px;
	left:-3px;
	display:inline-block;
	color:white;
   }
</style>
<script>
function wipeCookie(name){
	var date=new Date();
	date.setTime(date.getTime()-1000);
    document.cookie=name+"='';expires="+date.toGMTString();	
}
function adddep(){
	document.getElementById("bgd").style.display=(document.getElementById("bgd").style.display=="block"?"none":"block");
	document.getElementById("dc").style.display=(document.getElementById("dc").style.display=="block"?"none":"block");	
}
function adddep2(){
	document.getElementById("bgd2").style.display=(document.getElementById("bgd2").style.display=="block"?"none":"block");
	document.getElementById("dc2").style.display=(document.getElementById("dc2").style.display=="block"?"none":"block");	
}
function adddep3(){
	document.getElementById("bgd3").style.display=(document.getElementById("bgd3").style.display=="block"?"none":"block");
	document.getElementById("dc3").style.display=(document.getElementById("dc3").style.display=="block"?"none":"block");	
}
function setpage(num){
	location.href="<?php echo $_SERVER['PHP_SELF']; ?>"+"?nopage="+num;
}
function exchange(flag,id){
	document.cookie="flag="+flag;
	document.cookie="topic_id="+id;
	location.href="forum.php";
}
function initButton(){
	var flag=getCookieValue("flag");
	if(flag==2){
		document.getElementById("s1").classList.remove("tactive");
		document.getElementById("s2").classList.add("tactive");
		document.getElementById("s3").classList.remove("tactive");
	}
	else if(flag==3){
		document.getElementById("s1").classList.remove("tactive");
		document.getElementById("s2").classList.remove("tactive");
		document.getElementById("s3").classList.add("tactive");		
	}
	else{
		document.getElementById("s1").classList.add("tactive");
		document.getElementById("s2").classList.remove("tactive");
		document.getElementById("s3").classList.remove("tactive");		
	}	
	var power=getCookieValue("his_priority");
	var delbuts=document.getElementsByName("disapear");
	var settopbuts=document.getElementsByName("settopbuts");
	if(power!="admin"){
	  for(var i=0;i<delbuts.length;i++){
	     delbuts[i].style.display="none";
		 settopbuts[i].style.display="none";
	  }
	}
}
function reply(id){
	adddep2();
}
function sub2ser(){
	var topic_id=getCookieValue("topic_id");
	var poster_id=getCookieValue("his_id");
	var content=document.getElementById("newsbody2").value;
	var fid=location.search.substr(1).split("=")[1];
	var text="topic_id="+topic_id+"&poster_id="+poster_id+"&content="+content+"&f_id="+fid;
	//alert(text);
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?"+text,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*$/g,"");		
			if(flag==2)
			   alert("回复成功！");
			else
			   alert("您被禁言了，在"+flag+"之前暂时不能发帖！");			
            scan();
		}
	}
	xmlhttp.send();	
	adddep2();
}
function hiddensendbut(){
	//alert("hello");
	document.getElementById("speak").style.display="none";
}
function countview(id){
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?vc_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
                 ;
		}
	}
	xmlhttp.send();		
}
function showpraise(id){
	var praiser_id=getCookieValue("his_id");
	//alert(id+" "+post_id);
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?praiser_id="+praiser_id+"&post_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==2)
			   alert("您已经点过赞，每个回复每人只能点赞一次");
		    scan();
		}
	}
	xmlhttp.send();	
}
function submitpeach(){
	var reporter_id=getCookieValue("his_id");
	var post_id=document.getElementById("post_id").value;
	var content=document.getElementById("newsbody3").value;
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	var text="reporter_id="+reporter_id+"&post_id="+post_id+"&content="+content;
	xmlhttp.open("POST","service.php",true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==1)
			   alert("举报成功！");
			else
			   alert("您已经举报过TA！");
		}
	}
	xmlhttp.send(text);	
	adddep3();
}
function showpeach(id){
	adddep3();
	document.getElementById("post_id").value=id;
}
function onlymoster(){
var para=location.search.substr(1).split("=");
//alert(para[0]);
if(para[0]=="id"){
	hiddensendbut();
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?pid="+para[1],true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var texts=xmlhttp.responseText.replace(/\s*$/g,'');
			//alert(texts);
			var mes=texts.split("##");
		 
			var parent=document.getElementById("item");
			for(var i=parent.childNodes.length-1;i>=0;i--)
			    parent.removeChild(parent.childNodes[i]);
				
			var theme=document.createElement("div");
			var neck=document.createElement("div");
			var button=document.createElement("button");
			var btext=document.createTextNode("回复");
			var onlysee=document.createElement("button");
			var ostext=document.createTextNode("只看楼主");
			var allreply=document.createElement("button");
			var artext=document.createTextNode("全部回复");
			var myroom=document.createElement("button");
			var mrtext=document.createTextNode("我的空间");
			var collect=document.createElement("button");
			var ctext=document.createTextNode("收藏");
			
			onlysee.appendChild(ostext);
			myroom.appendChild(mrtext);
			collect.appendChild(ctext);
			allreply.appendChild(artext);            
			
			var id=mes[0].split("@@")[0];
			var author_id=mes[0].split("@@")[4]
			
			button.classList.add("replybut");
			onlysee.classList.add("replybut");
			myroom.classList.add("replybut");
			collect.classList.add("replybut");
			allreply.classList.add("replybut");
			button.appendChild(btext);	
			button.onclick=function(){reply(id)};
			myroom.onclick=function(){ wipeCookie("option");location.href="myroom.php";};
			allreply.onclick=scan;
			onlysee.onclick=onlymoster;
			neck.appendChild(button);	
			neck.appendChild(myroom);
			neck.appendChild(collect);
			neck.appendChild(onlysee);
			neck.appendChild(allreply);
			
			theme.id="theme"	
			theme.classList.add("theme");
			neck.classList.add("neck");	
			
			parent.appendChild(theme);
			parent.appendChild(neck);
				
			for(var i=0;i<mes.length;i++){	
			    var s=mes[i].split("@@");
			   if(i==0||s[4]==mes[0].split("@@")[4]){
				if(i==0){
				   var problem=document.createElement("span");
				   var textnode=document.createTextNode("帖子标题：");
				   problem.appendChild(textnode);
				   problem.classList.add("problem");
				   document.getElementById("theme").appendChild(problem);
				   var textnode=document.createTextNode(s[1]);
                   document.getElementById("theme").appendChild(textnode);
				   
				   collect.id=s[0];
				   collect.onclick=function(){store(this.id);};
				}
				var outframe=document.createElement("div");		    
				var n=document.createTextNode(s[3]);	
				var m=document.createTextNode(s[2]);
				var name=document.createElement("div");
				var message=document.createElement("div");
				var br=document.createElement("br");
				var br2=document.createElement("br");
				var img=document.createElement("img");
				var rank=document.createElement("img");
				var content=document.createElement("div");
				var status=document.createElement("div");
				var stair=document.createElement("span");
				var date=document.createElement("span");
				var stairtext=document.createTextNode(i+1+"楼");
				var datetext=document.createTextNode(s[5]);
				var blank=document.createTextNode(" ");
				var report=document.createElement("span");
				var celebrate=document.createElement("span");
				var cbimg=document.createElement("img");
				var reptext=document.createTextNode("举报");
				var cbtext=document.createTextNode(s[8]);
				
				cbimg.src="praise.png";
				cbimg.width=15;
				cbimg.height=15;
				cbimg.classList.add("finger");
				if(s[8]!=0)
				   cbimg.style.background="red";
				cbimg.id=s[0];
				cbimg.onclick=function(){showpraise(this.id);};
				celebrate.appendChild(cbimg);
				celebrate.appendChild(blank);
				celebrate.appendChild(cbtext);
				celebrate.classList.add("praise");
				status.appendChild(celebrate);
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}				
				stair.appendChild(stairtext);
				date.appendChild(datetext);
				status.appendChild(stair);
				report.appendChild(reptext);
				report.classList.add("peach");
				report.id=s[0];
				report.onclick=function(){showpeach(this.id);};
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}
				status.appendChild(date);
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}
				if(i==0){
				   var replytext=document.createTextNode("回复数 "+s[6]);
				   var response=document.createElement("span");
				   response.appendChild(replytext);
				   status.appendChild(response);
				   for(j=1;j<=6;j++){
				      var blank=document.createTextNode(" ");
				      status.appendChild(blank);
				   }				   
				}
				status.appendChild(report);
				var wipe=document.createElement("span");
				var deletext=document.createTextNode("删除");				
				for(j=1;j<=6;j++){
				      var blank=document.createTextNode(" ");
				      status.appendChild(blank);
				}
				wipe.appendChild(deletext);
				wipe.id=s[0];
				wipe.onclick=function(){deletetopic(this.id);};
				wipe.style.cssText="cursor:pointer;";
				if(i>=1){
					if((s[4]==getCookieValue("his_id")&&author_id==s[4])||getCookieValue("his_priority")=="admin")
				       status.appendChild(wipe);
				}
                content.appendChild(m);
				status.classList.add("statusbar");
				
				img.src="figure.png";
				//alert(s[7]);
				if(s[7]==3)
				   rank.src="r3.png";
				else if(s[7]==2)
				   rank.src="r2.png";
				else
				   rank.src="r1.png";
				img.width="50";
				img.height="50";
				name.appendChild(img);
				name.appendChild(br);
				outframe.classList.add("contentframe");
				name.classList.add("editer");
				if(s[4]==author_id){
				    name.classList.add("ebg");
					//alert("hello");
				}
				message.classList.add("information");				
				message.appendChild(content);
				message.appendChild(status);
				name.appendChild(n);
				name.appendChild(br2);
				name.appendChild(rank);
				outframe.appendChild(name);
				outframe.appendChild(message);
				parent.appendChild(outframe);
			  }
			}

		}
	}
	xmlhttp.send();
}
}

function store(id){
	var collecter_id=getCookieValue("his_id");
	//alert(id+" "+collecter_id);
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?collecter_id="+collecter_id+"&post_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==1)
			   alert("收藏成功！");
			else
			   alert("您已经收藏过TA！");
		}
	}
	xmlhttp.send();		
}
function deletetopic(id){
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?deletetopic_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){		
			location.reload();
		}
	}
	xmlhttp.send();		
}
function settop(pid,tid){
	//alert(id);
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?settop_pid="+pid+"&settop_tid="+tid,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){		
			location.reload();
		}
	}
	xmlhttp.send();		
}
function canceltop(pid,tid){
	//alert(pid+" "+tid);
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?canceltop_pid="+pid+"&canceltop_tid="+tid,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			location.reload();
		}
	}
	xmlhttp.send();		
}
</script>
</head>

<body>
<?php
require "head.php";

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"adddep()\"></div>";
echo "<div class=\"dc3\" id=\"dc\">";
echo "<div class=\"diatit\" id=\"topicname\">发表主题帖</div>";
echo "<table class=\"diat\">";
echo "<form method=\"post\" action=\"forum.php\" onsubmit=\"return juge3(this);\">";
echo "<tr>";
echo "<td>";
echo "<div id=\"topfra\">贴子名称：<input class=\"diainput2\" name=\"diainput\" id=\"newshead\" type=\"text\"></div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "贴子内容：<textarea class=\"diaessay\" name=\"newsbody\" id=\"newsbody\"></textarea>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"submit\" value=\"发表\"></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";

echo "<div class=\"bgd\" id=\"bgd2\" onClick=\"adddep2()\"></div>";
echo "<div class=\"dc3\" id=\"dc2\">";
echo "<div class=\"diatit\">发表回复帖</div>";
echo "<table class=\"diat\">";
echo "<tr>";
echo "<td>";
echo "贴子内容：<textarea class=\"diaessay\" name=\"newsbody2\" id=\"newsbody2\"></textarea>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"button\" value=\"发表\" onclick=\"sub2ser();\"></td></tr>";
echo "</table>";
echo "</div>";

echo "<div class=\"bgd\" id=\"bgd3\" onClick=\"adddep3()\"></div>";
echo "<div class=\"dc3\" id=\"dc3\">";
echo "<div class=\"diatit\">举报</div>";
echo "<table class=\"diat\">";
echo "<tr><td><input type=\"hidden\" id=\"post_id\"></td></tr>";
echo "<tr>";
echo "<td>";
echo "举报内容：<textarea class=\"diaessay\" name=\"newsbody2\" id=\"newsbody3\"></textarea>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"button\" value=\"提交\" onclick=\"submitpeach();\"></td></tr>";
echo "</table>";
echo "</div>";

function getcurpag($topic_id){
	require "conf.php";
	$sql="select * from $table_post where topic_id='$topic_id' and f_id='0' order by id desc";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}
$sql="";
$pageamo=9;
$nopage=0;

// $dep_id=$_COOKIE['dep_id'];

$sql0="select * from $table_topic where p_id='$dep_id'";
$result0=mysqli_query($link,$sql0);
$t1="";$ti1="";$tc1="";
$t2="";$ti2="";$tc2="";
$t3="";$ti3="";$tc3="";
$i=1;
while($rows0=mysqli_fetch_array($result0)){
	$temp="t".$i;
	$temp2="ti".$i;
	$temp3="tc".$i;
	$$temp=$rows0['topic_name'];
	$$temp2=$rows0['id'];
	// $$temp3="(帖数:".$rows0['post_count'].")";
	$$temp3=$rows0['post_count'];
	$i++;
}

// $topic_id=$_COOKIE['topic_id'];
$maxpage=ceil(getcurpag($topic_id)/$pageamo);
if($_GET['nopage']>1){
 $nopage=$_GET['nopage'];
 $number=($nopage-1)*$pageamo;
 //$sql="select * from $table_post where topic_id='$topic_id' and f_id='0' order by id desc limit $number,$pageamo";//order必须在limit之前
 $sql0="select * from $table_settop where topic_id='$topic_id' order by id desc limit $number,$pageamo";
}
else{
 //$sql="select * from $table_post where topic_id='$topic_id' and f_id='0' order by id desc limit 0,$pageamo";	
 $sql0="select * from $table_settop where topic_id='$topic_id' order by id desc limit 0,$pageamo";
}



echo "<div class=\"artframe\">";
require "fside.php";
echo "<div class=\"container\">";
echo "<div class=\"bgt4\">";
echo "<table class=\"ntable\">";
echo "<tr><td colspan=\"4\" style=\"text-align:left;font-size:larger;border-bottom:1px solid #858585;\"><span class=\"tactive spanbut\" onclick=\"exchange(1,".$ti1.");\" id=\"s1\">".$t1."<span class=\"mes-tip-wrap\">".$tc1."<span class=\"mes-tip\">".$tc1."</span></span>"."</span>&nbsp;&nbsp;&nbsp;<span class=\"spanbut\" onclick=\"exchange(2,".$ti2.");\" id=\"s2\">".$t2."<span class=\"mes-tip-wrap\">".$tc2."<span class=\"mes-tip\">".$tc2."</span></span>"."</span>&nbsp;&nbsp;&nbsp;<span onclick=\"exchange(3,".$ti3.");\" id=\"s3\" class=\"spanbut\">".$t3."<span class=\"mes-tip-wrap\">".$tc3."<span class=\"mes-tip\">".$tc3."</span></span>"."</span></td><td style=\"border-bottom:1px solid #858585;\">&nbsp;<button class=\"senbut\" id=\"speak\" onclick=\"adddep();\">发帖</button></td></tr>";
echo "</table>";
echo "<table id=\"item\" class=\"ntable\">";
echo "<tr><th style=\"text-align:left;width:40%;\">标题</th><th>作者</th><th>&nbsp;最后回复者</th><th>&nbsp;&nbsp;回复/查看数</th><th>管理</th></tr>";
echo "<tr><td colspan=5><hr class=\"line4\"></td></tr>";
$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
   if($rows0['is_top']=="yes"){
	$sql="select * from $table_post where id='$rows0[post_id]'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql12="select name from $table_user where id='$rows[poster_id]'";
	$result12=mysqli_query($link,$sql12);
	$rows12=mysqli_fetch_array($result12);
	
	$sql13="select name from $table_user where id='$rows[post_re_id]'";
	$result13=mysqli_query($link,$sql13);
	$rows13=mysqli_fetch_array($result13);
	
	echo "<tr>
	      <td style=\"text-align:left;\">
	      <a href=\"forum.php?id=".$rows['id']."\" class=\"lins\" onclick=\"countview(".$rows['id'].");\">".$rows['title']."</a></td>
		  <td>".$rows12['name']."<br>".$rows['post_time']."</td><td>".$rows13['name']."<br>".$rows['post_re_time']."</td>
		  <td>".$rows['re_count']."/".$rows['view_count']."</td>
		  <td><a class=\"delebut\" name=\"disapear\" href=\"forum.php?delid=".$rows['id']."&topicid=".$rows['topic_id']."\">"."删除"."</a>
		  <a class=\"delebut\" name=\"canceltop\" href=\"javascript:void(0)\" onclick=\"canceltop(".$rows['id'].",".$rows['topic_id'].")\">"."取消"."</a>
		  </td>
		  </tr>";
	echo "<tr><td colspan=5><hr class=\"line4\"></td></tr>";
   }
}

$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
   if($rows0['is_top']=="no"){
	$sql="select * from $table_post where id=".$rows0['post_id'];
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql12="select name from $table_user where id='$rows[poster_id]'";
	$result12=mysqli_query($link,$sql12);
	$rows12=mysqli_fetch_array($result12);
	
	$sql13="select name from $table_user where id='$rows[post_re_id]'";
	$result13=mysqli_query($link,$sql13);
	$rows13=mysqli_fetch_array($result13);	
	
	echo "<tr>
	      <td style=\"text-align:left;\">
	      <a href=\"forum.php?id=".$rows['id']."\" class=\"lins\" onclick=\"countview(".$rows['id'].");\">".$rows['title']."</a></td>
		  <td>".$rows12['name']."<br>".$rows['post_time']."</td><td>".$rows13['name']."<br>".$rows['post_re_time']."</td>
		  <td>".$rows['re_count']."/".$rows['view_count']."</td>
		  <td><a class=\"delebut\" name=\"disapear\" href=\"forum.php?delid=".$rows['id']."&topicid=".$rows['topic_id']."\">"."删除"."</a>
		  <a class=\"editbut\" name=\"settopbuts\" href=\"javascript:void(0)\" onclick=\"settop(".$rows['id'].",".$rows['topic_id'].")\">"."置顶"."</a>
		  </td>
		  </tr>";
	echo "<tr><td colspan=5><hr class=\"line4\"></td></tr>";
  }
}

/*echo "<div class=\"theme\">11551</div>";
echo "<div class=\"neck\"><button class=\"replybut\" onclick=\"reply(".$rows['id'].");\">回复</button></div>";
echo "<div class=\"contentframe\">";
echo "<div class=\"editer\"><img src=\"figure.png\" height=50px; width=50px;><br>小狼（楼主）<br><img src=\"r1.png\"></div><div class=\"information\"><div>炸丸子</div><div class=\"statusbar\"><span class=\"praise\"><img src=\"praise.png\" width=\"15px\" height=\"15px;\" style=\"background-color:red;vertical-align:middle;\">&nbsp;0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2015-09-01</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>回复数</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>只看楼主</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>举报</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>1楼</span></div></div>";
echo "</div>";*/

echo "<tr><td colspan=\"5\"><div class=\"pagestyle\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
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
function scan(){
var para=location.search.substr(1).split("=");
//alert(para[0]);
if(para[0]=="id"){
	hiddensendbut();
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?pid="+para[1],true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var texts=xmlhttp.responseText.replace(/\s*$/g,'');
			//alert(texts);
			var mes=texts.split("##");
		 
			var parent=document.getElementById("item");
			for(var i=parent.childNodes.length-1;i>=0;i--)
			    parent.removeChild(parent.childNodes[i]);
				
			var theme=document.createElement("div");
			var neck=document.createElement("div");
			var button=document.createElement("button");
			var btext=document.createTextNode("回复");
			var onlysee=document.createElement("button");
			var ostext=document.createTextNode("只看楼主");
			var allreply=document.createElement("button");
			var artext=document.createTextNode("全部回复");
			var myroom=document.createElement("button");
			var mrtext=document.createTextNode("个人空间");
			var collect=document.createElement("button");
			var ctext=document.createTextNode("收藏");
			
			onlysee.appendChild(ostext);
			myroom.appendChild(mrtext);
			collect.appendChild(ctext);
			allreply.appendChild(artext);            
			
			var id=mes[0].split("@@")[0];
			var author_id=mes[0].split("@@")[4]
			
			button.classList.add("replybut");
			onlysee.classList.add("replybut");
			myroom.classList.add("replybut");
			collect.classList.add("replybut");
			allreply.classList.add("replybut");
			button.appendChild(btext);	
			button.onclick=function(){reply(id)};
			myroom.onclick=function(){wipeCookie("option");location.href="myroom.php";};
			allreply.onclick=scan;
			onlysee.onclick=onlymoster;
			neck.appendChild(button);	
			neck.appendChild(myroom);
			neck.appendChild(collect);
			neck.appendChild(onlysee);
			neck.appendChild(allreply);
			
			theme.id="theme"	
			theme.classList.add("theme");
			neck.classList.add("neck");	
			
			parent.appendChild(theme);
			parent.appendChild(neck);
				
			for(var i=0;i<mes.length;i++){	
			    var s=mes[i].split("@@");
				if(i==0){
				   var problem=document.createElement("span");
				   var textnode=document.createTextNode("帖子标题：");
				   problem.appendChild(textnode);
				   problem.classList.add("problem");
				   document.getElementById("theme").appendChild(problem);
				   var textnode=document.createTextNode(s[1]);
                   document.getElementById("theme").appendChild(textnode);
				   
				   collect.id=s[0];
				   collect.onclick=function(){store(this.id);};
				}
				var outframe=document.createElement("div");		    
				var n=document.createTextNode(s[3]);	
				var m=document.createTextNode(s[2]);
				var name=document.createElement("div");
				var message=document.createElement("div");
				var br=document.createElement("br");
				var br2=document.createElement("br");
				var img=document.createElement("img");
				var rank=document.createElement("img");
				var content=document.createElement("div");
				var status=document.createElement("div");
				var stair=document.createElement("span");
				var date=document.createElement("span");
				var stairtext=document.createTextNode(i+1+"楼");
				var datetext=document.createTextNode(s[5]);
				var blank=document.createTextNode(" ");
				var report=document.createElement("span");
				var celebrate=document.createElement("span");
				var wipe=document.createElement("span");
				var cbimg=document.createElement("img");
				var reptext=document.createTextNode("举报");
				var deletext=document.createTextNode("删除");
				var cbtext=document.createTextNode(s[8]);
				
				cbimg.src="praise.png";
				cbimg.width=15;
				cbimg.height=15;
				cbimg.classList.add("finger");
				if(s[8]!=0)//s[8]为点赞数
				   cbimg.style.background="red";
				cbimg.id=s[0];
				cbimg.onclick=function(){showpraise(this.id);};
				celebrate.appendChild(cbimg);
				celebrate.appendChild(blank);
				celebrate.appendChild(cbtext);
				celebrate.classList.add("praise");
				status.appendChild(celebrate);
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}				
				stair.appendChild(stairtext);
				date.appendChild(datetext);
				status.appendChild(stair);
				report.appendChild(reptext);
				report.classList.add("peach");
				report.id=s[0];
				report.onclick=function(){showpeach(this.id);};
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}
				status.appendChild(date);
				for(j=1;j<=6;j++){
				   var blank=document.createTextNode(" ");
				   status.appendChild(blank);
				}
				if(i==0){
				   var replytext=document.createTextNode("回复数 "+s[6]);
				   var response=document.createElement("span");
				   response.appendChild(replytext);
				   status.appendChild(response);
				   for(j=1;j<=6;j++){
				      var blank=document.createTextNode(" ");
				      status.appendChild(blank);
				   }				   
				}
				status.appendChild(report);	
				for(j=1;j<=6;j++){
				      var blank=document.createTextNode(" ");
				      status.appendChild(blank);
				}
				wipe.appendChild(deletext);
				wipe.id=s[0];
				wipe.onclick=function(){deletetopic(this.id);};
				wipe.style.cssText="cursor:pointer;";
				if(i>=1){
					if((s[4]==getCookieValue("his_id")&&author_id==s[4])||getCookieValue("his_priority")=="admin")
				         status.appendChild(wipe);
				}
				content.appendChild(m);
				status.classList.add("statusbar");
				
				img.src="figure.png";
				// alert(s[7]);
				if(s[7]==3)//s[7]为等级数
				   rank.src="r3.png";
				else if(s[7]==2)
				   rank.src="r2.png";
				else
				   rank.src="r1.png";
				img.width="50";
				img.height="50";
				name.appendChild(img);
				name.appendChild(br);
				outframe.classList.add("contentframe");
				name.classList.add("editer");
				if(s[4]==author_id){
				    name.classList.add("ebg");
					//alert("hello");
				}
				message.classList.add("information");				
				message.appendChild(content);
				message.appendChild(status);
				name.appendChild(n);
				name.appendChild(br2);
				name.appendChild(rank);
				outframe.appendChild(name);
				outframe.appendChild(message);
				parent.appendChild(outframe);				
			}

		}
	}
	xmlhttp.send();
}
}

scan();
initButton();
</script>

<?php
if($_POST['diainput']){
   $title=$_POST['diainput'];
   $content=$_POST['newsbody'];
   $topic_id=$_COOKIE['topic_id'];
   /*echo "<script>alert(".$topic_id.");</script>";*/
   $poster_id=$_COOKIE['his_id'];
   $date=date("Y 年 m 月 d 日");
   
	$sql="select * from $table_user where id='$poster_id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if(strtotime($rows['ftime'])>strtotime(date("Y-m-d H:i:s"))){
		echo "<script>alert(\"您被禁言了，在".$rows['ftime']."之前暂时不能发帖！\");</script>";
		exit();
	}
   $sql="insert into $table_post(topic_id,poster_id,title,content,post_time) values('$topic_id','$poster_id','$title','$content','$date')";
   mysqli_query($link,$sql);

   $sql="update $table_topic set post_count=post_count+1 where id=".$topic_id;
   mysqli_query($link,$sql) or die(mysqli_error($link));

   if($rows['post_num']>=19)//发帖数大于等于20，升至3级，因为下面把增加发帖总数和修改等级的代码合到了一起，所以是19，而不是20
       $sql2="update $table_user set post_num=post_num+1,level=3 where id='$poster_id'";
   else if($rows['post_num']>=9)//发帖数大于等于10，升至2级，因为下面把增加发帖总数和修改等级的代码合到了一起，所以是9，而不是10
       $sql2="update $table_user set post_num=post_num+1,level=2 where id='$poster_id'";
   else
       $sql2="update $table_user set post_num=post_num+1,level=1 where id='$poster_id'";
   mysqli_query($link,$sql2) or die(mysqli_error($link));
   
   $date2=date("Y-m-d");
   $sql3="select * from $table_post where poster_id='$poster_id' order by id desc limit 0,1";
   $result3=mysqli_query($link,$sql3);
   $rows3=mysqli_fetch_array($result3);
   $sql4="insert into $table_settop(topic_id,post_id,is_top,date) values('$topic_id','$rows3[id]',2,'$date2')";
   mysqli_query($link,$sql4);
   
   echo "<meta http-equiv=\"refresh\" content=\"0; url=forum.php\">";
   echo "<script>alert(\"发贴成功！\");</script>";
   exit();
}
if($_GET['delid']){
	$id=$_GET['delid'];
	$topic_id=$_GET['topicid'];
	$user_id=$_COOKIE['his_id'];
	$sql="delete from $table_post where id='$id'";
	mysqli_query($link,$sql);
	
	$sql="delete from $table_post where f_id='$id'";
	mysqli_query($link,$sql);
	
	$sql="update $table_topic set post_count=post_count-1 where id='$topic_id'";
	mysqli_query($link,$sql);

	$sql="delete from $table_praise where post_id='$id'";
	mysqli_query($link,$sql);
	
	$sql="update $table_user set post_num=post_num-1 where id='$user_id'";
	mysqli_query($link,$sql);	
	
	$sql="delete from $table_settop where post_id='$id' and topic_id='$topic_id'";
	mysqli_query($link,$sql);
   
   echo "<meta http-equiv=\"refresh\" content=\"0; url=forum.php\">";	 
   echo "<script>alert(\"删贴成功！\");</script>";
   exit(); 	
}
?>
</body>
</html>
