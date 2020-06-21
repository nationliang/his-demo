<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的空间</title>
<style>
.roomframe{
	width:1000px;background-color:white;box-shadow:0px 0px 2px #B2B2B2;margin-top:40px;
}
.menubar{
	background-color:#E0FEF5;border-top:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;height:50px;text-align:left;
	line-height:50px;color:#5A5F81;
}
.moption{
	font-weight:bold;float:left;
}
.moption:hover{
	background-color:#B9FFF1;border-right:1px solid #D2D2D2;cursor:pointer;
}
.mpc{
	border-right:1px solid #D2D2D2;
}
.mpc:hover{
	border:none;
}
.amend{
	position:absolute;border:1px solid #389BF5;color:#389BF5;top:305px;left:200px;background-color:white;border-radius:5px 5px;padding:3px 5px;
	cursor:pointer;
}
.headimage{
	position:absolute;top:260px;left:20px;background-color:white;box-shadow:0px 0px 2px #B2B2B2;
	border-radius:5px 5px;padding:5px;
}
.menuactive{
	background-color:#4EFED7;
}
</style>
<script>
function setOption(number){
	document.cookie="option="+number;
	location.reload();
}
function showdetail(number,post_id,topic_id,reveal=0){
	document.cookie="topic_id="+topic_id;
	document.cookie="post_id="+post_id;
	document.getElementById("post_id").value=post_id;
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?pid="+post_id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var texts=xmlhttp.responseText.replace(/\s*$/g,'');
			//alert(texts);
			var mes=texts.split("##");
		 
			var parent=document.getElementById("item"+number);
			//alert("item"+i+" "+topic_id+" "+post_id);
			for(var i=parent.childNodes.length-1;i>=0;i--)
			    parent.removeChild(parent.childNodes[i]);
				
			var theme=document.createElement("div");
			var neck=document.createElement("div");
			var button=document.createElement("button");
			var btext=document.createTextNode("回复");          
			
			var id=mes[0].split("@@")[0];
			var author_id=mes[0].split("@@")[4]
			
			button.classList.add("replybut");
			button.appendChild(btext);	
			button.onclick=function(){reply(number,id)};
			if(reveal==0)
			    neck.appendChild(button);
			
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
				cbimg.onclick=function(){showpraise(number,this.id,);};
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
				//alert(s[9]);
				if((s[4]==author_id&&mes.length>1)||(s[9]==0&&mes.length==1)){
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

function initiatepage(){
    var option=getCookieValue("option");
	
	if(option==6){
		document.getElementById("item1").style.display="none";
		document.getElementById("item6").style.display="table";
		document.getElementById("menu1").classList.remove("menuactive");
		document.getElementById("menu6").classList.add("menuactive");
	}
	else if(option==2){
		document.getElementById("item1").style.display="none";
		document.getElementById("item2").style.display="table";
		document.getElementById("menu1").classList.remove("menuactive");
		document.getElementById("menu2").classList.add("menuactive");
	}
	else if(option==3){
		document.getElementById("item1").style.display="none";
		document.getElementById("item3").style.display="table";
		document.getElementById("menu1").classList.remove("menuactive");		
		document.getElementById("menu3").classList.add("menuactive");
	}
	else if(option==4){
		document.getElementById("item1").style.display="none";
		document.getElementById("item4").style.display="table";
		document.getElementById("menu1").classList.remove("menuactive");
		document.getElementById("menu4").classList.add("menuactive");
	}
	else if(option==5){
		document.getElementById("item1").style.display="none";
		document.getElementById("item5").style.display="table";
		document.getElementById("menu1").classList.remove("menuactive");
		document.getElementById("menu5").classList.add("menuactive");
	}	
	else{
		document.getElementById("item1").style.display="table";
		document.getElementById("item2").style.display="none";
	}
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

function cancelcollect(id){
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?cancelcollect_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){		
			location.reload();
		}
	}
	xmlhttp.send();		
}

function adddep2(){
	document.getElementById("bgd2").style.display=(document.getElementById("bgd2").style.display=="block"?"none":"block");
	document.getElementById("dc2").style.display=(document.getElementById("dc2").style.display=="block"?"none":"block");	
}

function reply(number,id){
	document.getElementById("option").value=number;
	adddep2();
}
function sub2ser(){
	var number=document.getElementById("option").value;
	var topic_id=getCookieValue("topic_id");
	var poster_id=getCookieValue("his_id");
	var content=document.getElementById("newsbody2").value;
	var fid=document.getElementById("post_id").value;
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
            showdetail(number,fid,topic_id);
		}
	}
	xmlhttp.send();	
	adddep2();
}
function showpraise(number,id){
	var praiser_id=getCookieValue("his_id");
	var post_id=getCookieValue("post_id");
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
		    showdetail(number,post_id,post_id);
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
	alert(text);
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
function adddep3(){
	document.getElementById("bgd3").style.display=(document.getElementById("bgd3").style.display=="block"?"none":"block");
	document.getElementById("dc3").style.display=(document.getElementById("dc3").style.display=="block"?"none":"block");	
}
function adddep4(){
	document.getElementById("bgd4").style.display=(document.getElementById("bgd4").style.display=="block"?"none":"block");
	document.getElementById("dc4").style.display=(document.getElementById("dc4").style.display=="block"?"none":"block");	
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
function forbidden(id,name){
	adddep4();
	var user=document.getElementById("username");
	user.value=name;
	user.readOnly=true;
	document.getElementById("spanid").value=id;
}
function submitspan(){
	var poster_id=document.getElementById("spanid").value;
	var rank=0;
	var spantimes=document.getElementById("spantime");
	for(var i=0;spantimes.length>i;i++){
		if(spantimes.options[i].selected==true){
			rank=spantimes.options[i].value;
			break;
		}
	}
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?spanid="+poster_id+"&rank="+rank,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==1)
			   alert("禁言成功！");
		}
	}
	xmlhttp.send();
	adddep4();
}
function liberate(poster_id){
	var rank=0;
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?spanid="+poster_id+"&rank="+rank,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==1)
			   alert("解除禁言成功！");
		}
	}
	xmlhttp.send();
}
function wipeRecord(id){
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch{
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","service.php?wipe_id="+id,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var flag=xmlhttp.responseText.replace(/\s*/g,"");		
			if(flag==1)
			   alert("删除成功！");
			location.reload();
		}
	}
	xmlhttp.send();
}
</script>
</head>
<body>
<center>
<?php
echo "<div class=\"bgd\" id=\"bgd4\" onClick=\"adddep4()\"></div>";
echo "<div class=\"dc\" id=\"dc4\">";
echo "<div class=\"diatit\">禁言</div>";
echo "<input type=\"hidden\" id=\"spanid\">";
echo "<table class=\"diat\">";
echo "<tr>";
echo "<td>";
echo "用户名称：<input class=\"diainput\" type=\"text\" id=\"username\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "禁言时间：<select class=\"diaselect\" id=\"spantime\">";
echo "<option value=1>1小时</option>";
echo "<option value=2>2小时</option>";
echo "<option value=3>3小时</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr><td><input class=\"diasave\" type=\"button\" value=\"保存\" onclick=\"submitspan()\"></td></tr>";
echo "</table>";
echo "</div>";

echo "<input type=\"hidden\" id=\"option\">";

echo "<div class=\"bgd\" id=\"bgd2\" onClick=\"adddep2()\"></div>";
echo "<div class=\"dc3\" id=\"dc2\">";
echo "<div class=\"diatit\">发表回复帖</div>";
echo "<input type=\"hidden\" id=\"post_id\">";
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

require "head.php";
echo "<div style=\"position:relative;width:1000px;\">";
echo "<div style=\"background-image:url(mrhead.jpg);background-size:100% 100%;height:300px;width:1000px;margin-top:0px;\"></div>";
echo "<div class=\"headimage\">
      <img src=\"cartoon.jpg\" style=\"background-color:#FFD7FE;\" width=\"150px\" height=\"150px\">
	  </div>";
echo "<div class=\"amend\" onClick=\"modpass()\">编辑资料</div>";	
echo "<div style=\"position:absolute;top:350px;left:200px;font-size:20px;font-weight:bold;\">".$_COOKIE['his_user']."的空间</div>";	
echo "<div style=\"position:absolute;top:380px;left:200px;font-size:15px;color:gray;\">";
$id=$_COOKIE['his_id'];
$sql="select * from $table_user where id='$id'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);
/*echo "<script>alert(\"".$rows['sex']."\");</script>";*/
if($rows['sex']=="woman")
   echo "<img src=\"woman.png\" width=\"10px\" height=\"17px\">&nbsp;";
else
   echo "<img src=\"man.png\" width=\"10px\" height=\"17px\">&nbsp;";   
echo "用户名：".$_COOKIE['his_user'];
echo "&nbsp;|&nbsp;发帖：".$rows['post_num'];
echo "&nbsp;|&nbsp;等级：".$rows['level'];
echo "</div>";	
echo "<div class=\"roomframe\">";
echo "<div style=\"width:1000px;height:110px;background-color:#E0FEF5;\"></div>";
echo "<div class=\"menubar\";>
          <div class=\"moption menuactive\" id=\"menu1\" onclick=\"setOption(1)\">
		       <span class=\"mpc\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我的帖子&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   </span>
		  </div>
          <div class=\"moption\" id=\"menu2\" onclick=\"setOption(2)\">
		       <span class=\"mpc\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我的回复&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   </span>
		  </div>	
          <div class=\"moption\" id=\"menu3\" onclick=\"setOption(3)\">
		       <span class=\"mpc\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我赞了谁&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   </span>
		  </div>
          <div class=\"moption\" id=\"menu4\" onclick=\"setOption(4)\">
		       <span class=\"mpc\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;谁赞了我&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   </span>
		  </div>";
	echo "<div class=\"moption\" id=\"menu5\" onclick=\"setOption(5)\">
		       <span class=\"mpc\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我的收藏&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   </span>
		  </div>";
	if($_COOKIE['his_priority']=="admin")	  
	     echo "<div class=\"moption\" id=\"menu6\" onclick=\"setOption(6)\">
		         <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;举报管理&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			     </span>
		       </div>";
    echo "</div>";

$sql="select * from $table_post where poster_id='$id' and f_id='0' order by id desc";		
echo "<table id=\"item1\" style=\"width:100%;\">";
$result=mysqli_query($link,$sql);
echo "<tr><td colspan=4><hr class=\"line3\"></td></tr>";
while($rows=mysqli_fetch_array($result)){	
	echo "<tr>
	      <td style=\"text-align:left;width:50%;font-weight:bold;\">
	      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['id'].");showdetail(1,".$rows['id'].",".$rows['topic_id'].");\">标题：".$rows['title']."</a></td>
		  <td style=\"text-align:right;\">回复/浏览:".$rows['view_count']."/".$rows['re_count']."</td>
		  <td style=\"text-align:right;width:160px;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:100px;\"><a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\" onclick=\"deletetopic(".$rows['id'].")\">"."删除"."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=4><hr class=\"line3\"></td></tr>";
}	  
echo "</table>";	  
	  
$sql="select * from $table_post where poster_id='$id' and f_id!='0' order by id desc";		
echo "<table id=\"item2\" style=\"width:100%;display:none;\">";
$result=mysqli_query($link,$sql);
echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
while($rows=mysqli_fetch_array($result)){	
	echo "<tr>
	      <td style=\"text-align:left;width:50%;font-weight:bold;\">
	      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['f_id'].");showdetail(2,".$rows['f_id'].",".$rows['topic_id'].");\">内容：".$rows['content']."</a></td>
		  <td style=\"text-align:right;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:100px;\"><a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\" onclick=\"deletetopic(".$rows['id'].")\">"."删除"."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
}	  
echo "</table>";	  

echo "<table id=\"item3\" style=\"width:100%;display:none;\">";
echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
$sql0="select * from $table_praise where agreer_id='$id'";
$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
    $sql="select * from $table_post where id='$rows0[post_id]' order by id desc";	
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_array($result);	
	
	$sql2="select name from $table_user where id='$rows[poster_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);	
	
	echo "<tr>
	      <td style=\"text-align:left;width:50%;font-weight:bold;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  if($rows['f_id']==0)
	         echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['id'].");showdetail(3,".$rows['id'].",".$rows['topic_id'].");\">";
		  else
		     echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['f_id'].");showdetail(3,".$rows['f_id'].",".$rows['topic_id'].");\">";
		  echo "内容：".$rows['content'];
		  echo "</a></td>
		  <td style=\"text-align:right;font-weight:bold;\">作者:".$rows2['name']."</td>
		  <td style=\"text-align:right;width:160px;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:100px;display:none;\"><a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\" onclick=\"deletetopic(".$rows['id'].")\">"."删除"."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
}	  
echo "</table>";


echo "<table id=\"item4\" style=\"width:100%;display:none;\">";
echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
$sql0="select * from $table_praise where agreer_id!='$id'";
$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
    $sql="select * from $table_post where id='$rows0[post_id]' order by id desc";	
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_array($result);
	
	$sql2="select name from $table_user where id='$rows0[agreer_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);	
	
	if($rows['poster_id']==$id){
	echo "<tr>
	      <td style=\"text-align:left;width:50%;font-weight:bold;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  if($rows['f_id']==0)
	         echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['id'].");showdetail(4,".$rows['id'].",".$rows['topic_id'].");\">";
		  else
		     echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['f_id'].");showdetail(4,".$rows['f_id'].",".$rows['topic_id'].");\">";
		  echo "内容：".$rows['content'];
		  echo "</a></td>
		  <td style=\"text-align:right;font-weight:bold;\">点赞者:".$rows2['name']."</td>
		  <td style=\"text-align:right;width:160px;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:100px;display:none;\"><a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\" onclick=\"deletetopic(".$rows['id'].")\">"."删除"."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=3><hr class=\"line3\"></td></tr>";
	}
}	  
echo "</table>";


echo "<table id=\"item5\" style=\"width:100%;display:none;\">";
echo "<tr><td colspan=4><hr class=\"line3\"></td></tr>";
$sql0="select * from $table_collect where collecter_id='$id'";
$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
    $sql="select * from $table_post where id='$rows0[post_id]' order by id desc";	
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_array($result);
	
	$sql2="select name from $table_user where id='$rows[poster_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);	
	echo "<tr>
	      <td style=\"text-align:left;width:50%;font-weight:bold;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	      echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['id'].");showdetail(5,".$rows['id'].",".$rows['topic_id'].");\">";
		  echo "标题：".$rows['title'];
		  echo "</a></td>
		  <td style=\"text-align:right;font-weight:bold;\">作者:".$rows2['name']."</td>
		  <td style=\"text-align:right;width:160px;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:100px;\">
		  <a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\"
		  onclick=\"cancelcollect(".$rows0['id'].")\">"."删除"."</a>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=4><hr class=\"line3\"></td></tr>";
}	  
echo "</table>";


echo "<table id=\"item6\" style=\"width:100%;display:none;\">";
echo "<tr><td colspan=5><hr class=\"line3\"></td></tr>";
$sql0="select * from $table_peach";
$result0=mysqli_query($link,$sql0);
while($rows0=mysqli_fetch_array($result0)){
    $sql="select * from $table_post where id='$rows0[post_id]' order by id desc";	
    $result=mysqli_query($link,$sql);
    $rows=mysqli_fetch_array($result);
	
	$sql2="select name from $table_user where id='$rows0[reporter_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);
	
	$sql3="select name from $table_user where id='$rows[poster_id]'";
	$result3=mysqli_query($link,$sql3);
	$rows3=mysqli_fetch_array($result3);	
	
	echo "<tr>
	      <td style=\"text-align:left;font-weight:bold;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	      echo "<a href=\"javascript:void(0)\" class=\"lins\" onclick=\"countview(".$rows['id'].");showdetail(6,".$rows['id'].",".$rows['topic_id'].",1);\">";
		  echo "被举报者：".$rows3['name'];
		  echo "</a></td>
		  <td style=\"text-align:right;font-weight:bold;\">举报理由:".$rows0['content']."</td>
		  <td style=\"text-align:right;width:130px;font-weight:bold;\">举报人:".$rows2['name']."</td>
		  <td style=\"text-align:right;width:160px;\">".$rows['post_time']."</td>
		  <td style=\"text-align:right;width:200px;\">
		  <a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\"
		  onclick=\"forbidden(".$rows['poster_id'].",'".$rows3['name']."')\">"."禁言"."</a>
		  <a class=\"editbut\" name=\"disapear\" href=\"javascript:void(0)\"
		  onclick=\"liberate(".$rows['poster_id'].")\">"."解禁"."</a>
		  <a class=\"delebut\" name=\"disapear\" href=\"javascript:void(0)\"
		  onclick=\"wipeRecord(".$rows0['id'].")\">"."删除"."</a>		  
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  </tr>";
	echo "<tr><td colspan=5><hr class=\"line3\"></td></tr>";
}	  
echo "</table>";

echo  "</div>";
echo "</div>";
?>
</center>
<?php
require "webtail.php";
?>
<script>
initiatepage();
</script>
</body>
</html>
