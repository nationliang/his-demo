// JavaScript Document
function power(){
	var login=getPower();
	if(login=="patient")
	   document.getElementById("patient").style.display="block";
	else if(login=="doctor"){
		document.getElementById("doctor").style.display="block";
	}
	else if(login=="drug"){
		document.getElementById("medicine").style.display="block";
	}
	else if(login=="admin"){
		document.getElementById("statistics").style.display="block";
		document.getElementById("index").style.display="block";
		document.getElementById("medicine").style.display="block";
		document.getElementById("doctor").style.display="block";
	    document.getElementById("patient").style.display="block";	
		document.getElementById("counter").style.display="block";
	}	
	else if(login=="cashier"){
		document.getElementById("counter").style.display="block";
	}
	else{
		location.href="login.php";
	    alert("非法用户！");
	}
}
function checkstatus(){
	var cookiearray=document.cookie.split(";");
	var flag=false;
	for(var i=0;i<cookiearray.length;i++){
		//alert(cookiearray[i].split("=")[0].replace(/\s*/g,''));
		//alert(cookiearray[i].split("=")[1].replace(/\s*/g,''));
		if(cookiearray[i].split("=")[0].replace(/\s*/g,'')=="his_user"){
			 if(cookiearray[i].split("=")[1].replace(/\s*/g,'').length!=0)
			      flag=true;
		}
	}
	//alert(flag);
    return flag;
}
function showwaiter(){
	document.getElementById("contain").style.display=(document.getElementById("contain").style.display=="block"?"none":"block");	    
}
function showrecommend(){
	document.getElementById("contain2").style.display=(document.getElementById("contain2").style.display=="block"?"none":"block");	    
}
function sendtext(){//发送信息
	var text=document.getElementById("sendmes").value;
	document.getElementById("sendmes").value="";
	
	//获取接收方
	var receiver="";
	var cookies=document.cookie.split(";");
	for(var i=0;i<cookies.length;i++){
		var cookie=cookies[i].split("=");
		if(cookie[0].replace(/\s*/g,"")=="receiver"){
			receiver=cookie[1].replace(/\s*/g,"");
            /*var date=new Date();
			date.setTime(date.getTime()-1000);
            document.cookie="receiver='';expire="+date.toGMTString();*/
			break;
		}
	}
	
	//获取发送方
	var names=document.cookie.split(";");
	var i=0;
	var name=null;
	while(names.length>i){
		name=names[i].split("=")[0].replace(/\s*/g,"");
		//alert(name+":"+" "+names[i].split("=")[1].replace(/\s*/g,"")+" "+name.length);
	    if(name=="his_user")
		    break;
		i++;
	}
	name=decodeURI(names[i].split("=")[1]);
	
	//添加发送信息到信息显示框
	document.getElementById("content").innerHTML+=name+':'+text+timeNormal()+'<br />';
	
	var text2="sender="+name+"&text="+text+"&receiver="+receiver;		
		
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject('Microsoft.XMLHTTP');
	}
	xmlhttp.open("POST",'service.php',true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	xmlhttp.onreadystatechange=function(){
	    if(xmlhttp.readyState==4&&xmlhttp.status==200){
			;
		}
	}
	xmlhttp.send(text2);
}
var timer;//轮询通获取知
var timer2;//维持连接
onload=function (){
	 if(checkstatus()){
         timer=setInterval(inform,1000);//var timer=setInterval(sendtext,1000);
		 power();
	 }
	 else
	    location.href="login.php";
}

function sendtext2(){//发送信息
	var text=document.getElementById("sendmes2").value;
	document.getElementById("sendmes2").value="";
	
	if(text.length==0){
	   alert("您还没有输入信息，请输入信息！");
	   return false;	   
	}
	
	//添加发送信息到信息显示框
	document.getElementById("content2").innerHTML+="患者："+text+timeNormal()+'<br />';	
	
	var text2="helf="+text;		
		
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject('Microsoft.XMLHTTP');
	}
	xmlhttp.open("POST",'service.php',true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	xmlhttp.onreadystatechange=function(){
	    if(xmlhttp.readyState==4&&xmlhttp.status==200){
            var content=(xmlhttp.responseText).replace(/\s*/g,"");
			if(content.length!=0){
				if(content==512)
				   document.getElementById("content2").innerHTML+="导诊机器人:检索信息格式有误，请重新输入！"+timeNormal()+"<br />";
				else
				   document.getElementById("content2").innerHTML+="导诊机器人：以下为推荐建议：<br />"+content+timeNormal()+"<br />";
			}
			else{
				document.getElementById("content2").innerHTML+="导诊机器人：对不起找不到匹配项，请重新检查输入或者到人工窗口咨询"+content+timeNormal()+"<br />";
			}
		}
	}
	xmlhttp.send(text2);
}

function activatesend(receiver){//获取信息
	//alert(getLName());
	clearInterval(timer2);
	var text="rname="+getLName()+"&sname="+receiver;
	document.cookie="receiver="+receiver;
	document.getElementById("sendbut").disabled=false;
	document.getElementById("receiver").innerHTML=receiver;
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("POST","service.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlhttp.onreadystatechange=function (){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=(xmlhttp.responseText).replace(/(\s+$)/g,"");
			if(content.length!=0){	      
				      var infor=content.split("@@");
					  //var mescount=1;
				      for(var k=1;k<infor.length;k++){
				          /*var parent=document.getElementById("doclist");
				          var doclist=document.getElementById("doclist").childNodes;
				          for(var j=1;j<doclist.length;j++)
				              if(infor[0]==doclist[j].innerHTML.split("(")[0]){
						          var a=doclist[j].cloneNode(true);
						          a.childNodes[a.childNodes.length-1].innerHTML=mescount;
								  mescount++;
								  if(parent.childNodes[1].innerHTML.split("(")[0]!=infor[0]){
						              var secondchild=parent.replaceChild(a,parent.childNodes[1]);//parent的第一个节点为文本节点，不是元素a																							
						              parent.replaceChild(secondchild,parent.childNodes[j]);
									  break;
								  }
								  else{
								      var secondchild=parent.replaceChild(a,parent.childNodes[1]);//parent的第一个节点为文本节点，不是元素a
									  break; 
								  }
					          }*/
							  
					          if(typeof(sessionStorage[receiver])!='undefined')
					              document.getElementById("content").innerHTML=sessionStorage[receiver]+infor[0]+":"+infor[k]+'<br />';
						      else{
								  if(k>1)
								    document.getElementById("content").innerHTML+=infor[0]+":"+infor[k]+'<br />';
								  else
								    document.getElementById("content").innerHTML=infor[0]+":"+infor[k]+'<br />';
							  }
			             }
			         }
					 else
					    if(typeof(sessionStorage[receiver])!='undefined')
					        setTimeout(function (){document.getElementById("content").innerHTML=sessionStorage[receiver];},100);
						else
						    setTimeout(function (){document.getElementById("content").innerHTML="";},100);
		    }
	}
	xmlhttp.send(text);
    setTimeout(function (){
	  var doclist=document.getElementById("doclist").childNodes;
	  for(var j=1;j<doclist.length;j++)
	    if(receiver==doclist[j].innerHTML.split("(")[0]){	
			 //alert(j+" "+doclist[j].nodeName+" "+doclist[j].childNodes.length);
			 var child=doclist[j].childNodes[doclist[j].childNodes.length-1];
			 //alert(typeof(child));								  
			 child.innerHTML="";
			 timer2=setInterval(function (){ maintain(receiver);},1000);			 
			 }
			 },50);
}
function maintain(sname){//维持连接
	var text="rname="+getLName()+"&sname="+sname;
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("POST","service.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlhttp.onreadystatechange=function (){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=(xmlhttp.responseText).replace(/\s*/g,"");
			if(content.length!=0){	      
				      var infor=content.split("@@");
				      for(var k=1;k<infor.length;k++){
				          var parent=document.getElementById("doclist");
				          var doclist=document.getElementById("doclist").childNodes;
				          for(var j=1;j<doclist.length;j++){						  
						  if(infor[0]==doclist[j].innerHTML.split("(")[0]){
                                  var target=doclist[j].cloneNode(true);
								  if(parent.childNodes[1].innerHTML.split("(")[0]!=infor[0]){
								    for(var r=j;r>1;r--){
									 var temp=parent.childNodes[r-1].cloneNode(true);
								     parent.replaceChild(temp,parent.childNodes[r]);
									 parent.replaceChild(target,parent.childNodes[r-1]);
								    }//for
							      }//if1
								  document.getElementById("content").innerHTML+=infor[0]+":"+infor[k]+'<br />';
								  break;
							 }//if2
			         }//for2
				}
			}
		}
	}
	xmlhttp.send(text);
	var record=document.getElementById("content").innerHTML;
	sessionStorage.setItem(sname,record);//存储聊天记录
    setTimeout(function (){
	  var doclist=document.getElementById("doclist").childNodes;
	  for(var j=1;j<doclist.length;j++)
	    if(sname==doclist[j].innerHTML.split("(")[0]){	
			 //alert(j+" "+doclist[j].nodeName+" "+doclist[j].childNodes.length);
			 var child=doclist[j].childNodes[doclist[j].childNodes.length-1];
			 //alert(typeof(child));								  
			 child.innerHTML="";			 
			 }
			 },50);
}
function inform(){//轮询获取新消息通知
    var allnum="";
	var text="ownername="+getLName();
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("POST","service.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange=function (){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=(xmlhttp.responseText).replace(/\s*/g,"");
			if(content.length!=0){
			          var allmes= content.split("##");
					  //alert(allmes.length);
					  for(var i=0;i<allmes.length;i++){
				      var infor=allmes[i].split("@@");
					  var mescount=1;
				      for(var k=1;k<infor.length;k++){
				          var parent=document.getElementById("doclist");
				          var doclist=document.getElementById("doclist").childNodes;
				          for(var j=1;j<doclist.length;j++){
				              if(infor[0]==doclist[j].innerHTML.split("(")[0]){
                                  var target=doclist[j].cloneNode(true);
						          target.childNodes[target.childNodes.length-1].innerHTML=mescount;
								  if(parent.childNodes[1].innerHTML.split("(")[0]!=infor[0]){
								  for(var r=j;r>1;r--){
									 var temp=parent.childNodes[r-1].cloneNode(true);
								     parent.replaceChild(temp,parent.childNodes[r]);
									 parent.replaceChild(target,parent.childNodes[r-1]);
								  }
							      }
								  else{
									 parent.replaceChild(target,parent.childNodes[1]); 
								  }
								  mescount++;
								  allnum++;
								  break;
						          /*var a=doclist[j].cloneNode(true);
						          a.childNodes[a.childNodes.length-1].innerHTML=mescount;
								  mescount++;								  
								  if(parent.childNodes[1].innerHTML.split("(")[0]!=infor[0]){
						              var secondchild=parent.replaceChild(a,parent.childNodes[1]);//parent的第一个节点为文本节点，不是元素a																							
						              parent.replaceChild(secondchild,parent.childNodes[j]);
									  break;
								  }
								  else{
								      parent.replaceChild(a,parent.childNodes[1]);
									  break; 
								  }*/
							 }//if1
						  }//for1
					      }
			            }
			         }
						document.getElementById("tip").innerHTML=allnum;					 
		    }
	}
	xmlhttp.send(text);
}
function getLName(){
	var cArray=document.cookie.split(";");
	for(var i=0;i<cArray.length;i++){
		if(cArray[i].split("=")[0].replace(/\s*/g,"")=="his_user"){
			return decodeURI(cArray[i].split("=")[1]).replace(/\s*/g,"");
		}
	}
}
function getPower(){
	var cArray=document.cookie.split(";");
	for(var i=0;i<cArray.length;i++){
		if(cArray[i].split("=")[0].replace(/\s*/g,"")=="his_priority"){
			return decodeURI(cArray[i].split("=")[1]).replace(/\s*/g,"");
		}
	}
}

function drag(ev){//窗口拖拽
	var div=document.getElementById("contain");
	var mx=ev.clientX;//不带单位
	var my=ev.clientY;
	var dy=parseFloat(getComputedStyle(div,null).top.replace("px",""));
	var dx=parseFloat(getComputedStyle(div,null).left.replace("px",""));
	//alert(dy);
	//alert(dx);
	var fx=mx-dx;
	var fy=my-dy;
	//alert(offsetX);
	/*if(div.currentStyle){//兼容ie浏览器
		top=div.currentStyle.top;
		left=div.currentStyle.left;
	}*/
	//alert(getComputedStyle(div,null).top);//edge也可兼容
	
	onmousemove=function (ev2){
		//alert(ev2.clientX+" "+ev2.clientY)
		//div.style.cssText="left:"+ev2.clientX+"px;";
		var ny=ev2.clientY-fy;
		var nx=ev2.clientX-fx;
		//alert(nx+" "+ny)
		div.style.cssText="top:"+ny+"px;"+"left:"+nx+"px;display:block;";
		//div.style.cssText="display:block;";
	}
	
	onmouseup=function(){
		onmousedown=null;
		onmousemove=null;
	}	
}

function drag2(ev){//窗口拖拽
	var div=document.getElementById("contain2");
	var mx=ev.clientX;//不带单位
	var my=ev.clientY;
	var dy=parseFloat(getComputedStyle(div,null).top.replace("px",""));
	var dx=parseFloat(getComputedStyle(div,null).left.replace("px",""));
	var fx=mx-dx;
	var fy=my-dy;
	
	onmousemove=function (ev2){
		var ny=ev2.clientY-fy;
		var nx=ev2.clientX-fx;
		div.style.cssText="top:"+ny+"px;"+"left:"+nx+"px;display:block;";
	}	
	
	onmouseup=function(){
		onmousedown=null;
		onmousemove=null;
	}
	
}

function timeNormal(){
	var time=new Date();
	var Y=time.getFullYear();
	var m=time.getMonth()+1;//0代表1月
	var d=time.getDate();
	var H=time.getHours();
	var minu=time.getMinutes();
	var s=time.getSeconds();
	return "["+Y+"-"+m+"-"+d+" "+H+":"+minu+":"+s+"]";
}
	
function getCookieValue(name){
	var cArray=document.cookie.split(";");
	for(var i=0;i<cArray.length;i++){
		if(cArray[i].split("=")[0].replace(/\s*/g,"")==name){
			return decodeURI(cArray[i].split("=")[1]).replace(/\s*/g,"");
		}
	}
}	





















