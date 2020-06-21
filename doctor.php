<html>
<head>
<title>坐诊</title>
<link href="addbut.css" rel="stylesheet" type="text/css">
<script>
function changeintfac(d_id,id,name,sex,age,idnum="",borntime="",phonenumber="",address=""){
	//alert(address);
	//document.getElementById("patid").value=id;
	// alert(d_id);
	document.cookie="patid="+id;
	document.cookie="docid="+d_id;//不能与上面的合并
	
	
	
	document.getElementById("subcov").style.display="block";
	
	document.getElementById("patid").setAttribute("value",id);
	document.getElementById("subid").setAttribute("value",id);
	document.getElementById("pid").setAttribute("value",id);//patient表里的id	
	
	document.getElementById("pregmes").style.display="none";
	document.getElementById("dregmes").style.display="block";
	
	document.getElementById("pname").setAttribute("value",name);
	if(sex="man")
	   document.getElementById("sex").options[0].selected=true;
	else
	   	document.getElementById("sex").options[1].selected=true;
	for(var i=0;i<100;i++)
	  if(age==i)
	   document.getElementById("age").options[i].selected=true;
	document.getElementById("idnum").setAttribute("value",idnum);
	document.getElementById("conway").setAttribute("value",phonenumber);
	document.getElementById("addr").innerHTML=address;
	//addr.value=address;
	document.getElementById("borntime").setAttribute("value",borntime);	
}
function change1(){
	
	document.getElementById("subcov").style.cssText="display:block;";
	//document.getElementById("dregmesc1").style.display="table";//当表格被隐藏后，再次显现需要将display设为table或inline-table（以表格的形式显现，否则td无法填满table）
	document.getElementById("dregmesc1").style.display="inline-table";
	document.getElementById("dregmesc2").style.display="none";
	document.getElementById("dregmesc3").style.display="none";	
	//document.getElementById("dregmesc2").style.visibility="hidden";
	//document.getElementById("dregmesc1").style.visibility="visible";	
	if(!document.getElementById("pat").classList.contains("pat")){
		document.getElementById("pat").classList.remove("med");
		document.getElementById("pat").classList.add("pat");
		document.getElementById("med").classList.add("med");
		document.getElementById("med").classList.remove("pat");		
		document.getElementById("ano").classList.add("med");
		document.getElementById("ano").classList.remove("pat");			
	}
}
function change2(){
	splist();
	//document.getElementById("dregmesc1").style.visibility="hidden";
	//document.getElementById("dregmesc2").style.visibility="visible";
	if(getComputedStyle(document.getElementById("subcov"),null).display=="block")
	     document.getElementById("subcov").style.cssText="display:none;";
	document.getElementById("dregmesc1").style.display="none";
	document.getElementById("dregmesc3").style.display="none";	
    document.getElementById("dregmesc2").style.display="inline-table";
    //document.getElementById("dregmesc2").style.display="table";	
	if(!document.getElementById("med").classList.contains("pat")){
		document.getElementById("pat").classList.remove("pat");
		document.getElementById("ano").classList.add("med");
		document.getElementById("ano").classList.remove("pat");
		document.getElementById("pat").classList.add("med");		
		document.getElementById("med").classList.add("pat");
		document.getElementById("med").classList.remove("med");			
	}		
}
function change3(){
	sflist();
	//document.getElementById("dregmesc1").style.visibility="hidden";
	//document.getElementById("dregmesc2").style.visibility="visible";
	if(getComputedStyle(document.getElementById("subcov"),null).display=="block")
	     document.getElementById("subcov").style.cssText="display:none;";	
	document.getElementById("dregmesc1").style.display="none";
	document.getElementById("dregmesc2").style.display="none";	
    document.getElementById("dregmesc3").style.display="inline-table";
    //document.getElementById("dregmesc2").style.display="table";	
	if(!document.getElementById("ano").classList.contains("pat")){
		document.getElementById("pat").classList.remove("pat");
		document.getElementById("pat").classList.add("med");
		document.getElementById("med").classList.remove("pat");
		document.getElementById("med").classList.add("med");	
		document.getElementById("ano").classList.add("pat");
		document.getElementById("ano").classList.remove("med");			
	}		
}
function change4(){
     location.href="<?php echo $_SERVER['PHP_SELF']; ?>";	
}
function submes(){
	document.getElementById("curemes").submit();
}
function dispense(){
	samdialog();	
	document.getElementById("bgd").style.display=(document.getElementById("bgd").style.display=="block"?"none":"block");
	document.getElementById("dc").style.display=(document.getElementById("dc").style.display=="block"?"none":"block");	
	var box=document.getElementsByName("cho[]");
	for(var i=0;i<box.length;i++){
	    //alert("hello");
	    box[i].checked=false;
	}
	for(var i=1;i<=box.length;i++){
		document.getElementById("mednum"+i).value=0;
		document.getElementById("talpri"+i).innerHTML=0;
	}

}
function updcost(price,i){
	var num=document.getElementById("mednum"+i).value;
	document.getElementById("talpri"+i).innerHTML=num*price;
}
function delmed(id){
     //location.href="dback.php?delid="+id;
	 try{
		 var xmlhttp=new XMLHttpRequest();
	 }
	 catch(e){
		 var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	 }
	 xmlhttp.open("GET","dback.php?delid="+id,true);
	 xmlhttp.onreadystatechange=function(){
		 if(xmlhttp.readyState==4&&xmlhttp.status==200){
			 splist();
		 }
	 }
	 xmlhttp.send();
}

function splist(){
	  var patid;
	  var docid;
	  var cgroup=document.cookie.split(";");
	  for(var i=0;i<cgroup.length;i++){
	      //alert(cgroup[i].split("=")[0].replace(/\s*/g,""));
	      if(cgroup[i].split("=")[0].replace(/\s*/g,"")=="patid"){
			 patid=cgroup[i].split("=")[1].replace(/\s*/g,"");
		  }
		  else if(cgroup[i].split("=")[0].replace(/\s*/g,"")=="docid"){
			  docid=cgroup[i].split("=")[1].replace(/\s*/g,"");
		  }
		  else
		     ;
	  }
	  //alert(patid+" "+docid);
	  var text="patid="+patid+"&docid="+docid;
	  try{
		var xmlhttp=new XMLHttpRequest();  
	  }
	  catch(e){
		  var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.open("POST","dback.php",true);
	  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  xmlhttp.onreadystatechange=function(){
		  if(xmlhttp.readyState==4&&xmlhttp.status==200){
			  var content=xmlhttp.responseText;
			  var parent=document.getElementById("dregmesc2");
			  var nodes=parent.childNodes;
			  for(var r=nodes.length-1;r>0;r--){//removeChild必须从后往前删
				 //alert(r);
			     parent.removeChild(nodes[r]);
			  }			  
			  if(content.replace(/\s*/g,"").length!=0){
			  var items=content.split("##");
			  for(var j=items.length-1;j>=0;j--){
				  
				 var tr=document.createElement("tr");
			     var td=document.createElement("td");
			     var hr=document.createElement("hr");
			     td.colSpan=7;
			     hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			     td.appendChild(hr);
			     tr.appendChild(td);
				 
				 parent.insertBefore(tr,parent.childNodes[1]);					  
				  
				 var item=items[j].split("@@");
				 var tr=document.createElement("tr");
				 for(var k=0;k<item.length-1;k++){
					 var td=document.createElement("td");
					 var mes=document.createTextNode(item[k]);
					 td.appendChild(mes);
					 tr.appendChild(td);
				 }
				 var td=document.createElement("td");
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("删除");
				 but.appendChild(bvalue);
				 but.id=j;
				 but.onclick=function(){delmed(items[this.id].split("@@")[k]);};//注意：闭包
				 but.classList.add("concellbut");
				 td.appendChild(but);
				 tr.appendChild(td);
				 
				 parent.insertBefore(tr,parent.childNodes[1]);//往前插是因为,k是递减的
				 

			  }
				 var tr=document.createElement("tr");
				 var td=document.createElement("td");
				 td.colSpan="7";
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("添加药品");
				 but.appendChild(bvalue);
				 but.classList.add("pillbut");
				 but.onclick=dispense;
				 td.appendChild(but);
				 tr.appendChild(td);
				 parent.appendChild(tr);
			  }
			  else{
				 var tr=document.createElement("tr");
				 tr.id="abutton";
				 var td=document.createElement("td");
				 td.colSpan="7";
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("添加药品");
				 but.appendChild(bvalue);
				 but.classList.add("pillbut");
				 but.onclick=dispense;
				 td.appendChild(but);
				 tr.appendChild(td);
				 parent.appendChild(tr);				  
			  }
		  }
	  }
	  xmlhttp.send(text);		
}
function sflist(){
	  var patid;
	  var docid;
	  var cgroup=document.cookie.split(";");
	  for(var i=0;i<cgroup.length;i++){
	      //alert(cgroup[i].split("=")[0].replace(/\s*/g,""));
	      if(cgroup[i].split("=")[0].replace(/\s*/g,"")=="patid"){
			 patid=cgroup[i].split("=")[1].replace(/\s*/g,"");
		  }
		  else if(cgroup[i].split("=")[0].replace(/\s*/g,"")=="docid"){
			  docid=cgroup[i].split("=")[1].replace(/\s*/g,"");
		  }
		  else
		     ;
	  }
	  var text="fpatid="+patid+"&fdocid="+docid;
	  try{
		var xmlhttp=new XMLHttpRequest();  
	  }
	  catch(e){
		  var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.open("POST","dback.php",true);
	  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  xmlhttp.onreadystatechange=function(){
		  if(xmlhttp.readyState==4&&xmlhttp.status==200){
			  var content=xmlhttp.responseText;
			  var parent=document.getElementById("dregmesc3");
			  var length=parent.childNodes.length;
			  var nodes=parent.childNodes;
			  for(var r=nodes.length-1;r>0;r--){//removeChild必须从后往前删
				 //alert(r);
			     parent.removeChild(nodes[r]);
			  }			  
			  if(content.replace(/\s*/g,"").length!=0){
			  var items=content.split("##");
			  for(var j=items.length-1;j>=0;j--){
				  
				 var tr=document.createElement("tr");
			     var td=document.createElement("td");
			     var hr=document.createElement("hr");
			     td.colSpan=7;
			     hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			     td.appendChild(hr);
			     tr.appendChild(td);
				 
				 parent.insertBefore(tr,parent.childNodes[1]);					  
				  
				 var item=items[j].split("@@");
				 var tr=document.createElement("tr");
				 for(var k=0;k<item.length-1;k++){
					 var td=document.createElement("td");
					 var mes=document.createTextNode(item[k]);
					 td.appendChild(mes);
					 tr.appendChild(td);
				 }
				 var td=document.createElement("td");
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("删除");
				 but.id=j;
				 but.appendChild(bvalue);
				 but.onclick=function(){delfee(items[this.id].split("@@")[k]);};//注意：闭包
				 but.classList.add("concellbut");
				 td.appendChild(but);
				 tr.appendChild(td);
				 parent.insertBefore(tr,parent.childNodes[1]);//往前插是因为,k是递减的
				 
		 
			  }
				 var tr=document.createElement("tr");
				 var td=document.createElement("td");
				 td.colSpan="4";
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("添加费用");
				 but.appendChild(bvalue);
				 but.classList.add("pillbut");
				 but.onclick=addfee;
				 td.appendChild(but);
				 tr.appendChild(td);
				 parent.appendChild(tr);
			  }
			  else{
				  
				 var tr=document.createElement("tr");
				 var td=document.createElement("td");
				 td.colSpan="4";
				 var but=document.createElement("button");
				 var bvalue=document.createTextNode("添加项目");
				 but.appendChild(bvalue);
				 but.classList.add("pillbut");
				 but.onclick=addfee;
				 td.appendChild(but);
				 tr.appendChild(td);
				 parent.appendChild(tr);				  
			  }
		  }
	  }
	  xmlhttp.send(text);		
}
function addfee(){
	safdialog();
	document.getElementById("bgd2").style.display=(document.getElementById("bgd2").style.display=="block"?"none":"block");
	document.getElementById("dc2").style.display=(document.getElementById("dc2").style.display=="block"?"none":"block");	
	var box=document.getElementsByName("cho2[]");
	for(var i=0;i<box.length;i++){
	    //alert("hello");
	    box[i].checked=false;
	}	
}
function delfee(id){
	 try{
		 var xmlhttp=new XMLHttpRequest();
	 }
	 catch(e){
		 var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	 }
	 xmlhttp.open("GET","dback.php?fdelid="+id,true);
	 xmlhttp.onreadystatechange=function(){
		 if(xmlhttp.readyState==4&&xmlhttp.status==200){
			 sflist();
		 }
	 }
	 xmlhttp.send()	
	
}
function msubmit(){
	var patid=document.getElementById("patid").value;
	var radios=document.getElementsByName("cho[]");
	var amount="";
	var text="";
	var amounts="";
	
	for(var i=0;i<radios.length;i++){
		if(radios[i].checked==true){
			amount=document.getElementsByName(radios[i].value)[0].value;			
			text+=radios[i].value+"@@";
			amounts+=amount+"@@";
		}
	}
	//alert("name:"+text+" num:"+amounts);
	try{
		var xmlhttp=new XMLHttpRequest();	
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","dback.php?apatid="+patid+"&mids="+text+"&mnumber="+amounts,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			//alert(xmlhttp.responseText);
			splist();
		}
	}
	xmlhttp.send();
	dispense();
}
function fsubmit(){
	var pid=document.getElementById("pid").value;
	var radios=document.getElementsByName("cho2[]");
	var text="";
	
	for(var i=0;i<radios.length;i++){
		if(radios[i].checked==true){			
			text+=radios[i].value+"@@";
		}
	}
	try{
		var xmlhttp=new XMLHttpRequest();	
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","dback.php?fpatid="+pid+"&fids="+text,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			//alert(xmlhttp.responseText);
			sflist();
		}
	}
	xmlhttp.send();
	addfee();
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
function explore2(){
	var acc=document.getElementById("acckind2").value;
	try{
	   var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");	
	}
	xmlhttp.open("GET","dback.php?basis="+acc,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=xmlhttp.responseText.replace(/\s*/g,"");
			//alert(content);
			var list=content.split("@@");
			var parent=document.getElementById("mwindow");
			
			for(var j=parent.childNodes.length-1;j>1;j--){
				parent.removeChild(parent.childNodes[j]);
			}
			
			if(content.length!=0){
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var cbox=document.createElement("input");
			cbox.type="checkbox";
			cbox.name="cho[]";
			cbox.value=list[0];
			td.appendChild(cbox);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(1);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[1]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			if(list[2]==0){
			   var textnode=document.createTextNode("非处方药");
			   td.appendChild(textnode);
			}
			else{
			   var textnode=document.createTextNode("处方药");
			   td.appendChild(textnode);
			}
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var input=document.createElement("input");
			input.type="text";
			input.value=1;
			input.name=list[0];
			input.classList.add("medinput");
			input.id="mednum1";
			input.onkeyup=function(){
				updcost(list[3],1);
			};
			td.appendChild(input);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[3]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var span=document.createElement("span");
			span.id="talpri1";
			var textnode=document.createTextNode(list[3]);
			span.appendChild(textnode);
			td.appendChild(span);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var hr=document.createElement("hr");
			td.colSpan=7;
			hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			td.appendChild(hr);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			td.colSpan=7;
			var input=document.createElement("input");
			input.type="button";
			input.value="保存";
			input.classList.add("diasave");
			input.onclick=msubmit;
			td.appendChild(input);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			}
		}
	}
	xmlhttp.send();
}
function samdialog(){
	document.getElementById("acckind2").value="";
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","dback.php?inimedicine=1",true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=xmlhttp.responseText.replace(/\s*/g,"");
			var set=content.split("##");
			
			var parent=document.getElementById("mwindow");	
			
			for(var j=parent.childNodes.length-1;j>1;j--){
				parent.removeChild(parent.childNodes[j]);
			}
			
			if(content.length!=0){
			for(var i=0;i<set.length;i++){
			var list=set[i].split("@@");

			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var cbox=document.createElement("input");
			cbox.type="checkbox";
			cbox.name="cho[]";
			cbox.value=list[0];
			td.appendChild(cbox);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(i+1);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[1]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			if(list[2]==0){
			   var textnode=document.createTextNode("非处方药");
			   td.appendChild(textnode);
			}
			else{
			   var textnode=document.createTextNode("处方药");
			   td.appendChild(textnode);
			}
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var input=document.createElement("input");
			input.type="text";
			input.value=1;
			input.name=list[0];
			input.classList.add("medinput");
			input.id="mednum"+(i+1);
			input.onkeyup=function(){
				//alert(this.id.length-6);
				//alert(this.id.substr(6,this.id.length-6));
				var id=this.id.substr(6,this.id.length-6);
				var price=set[id-1].split("@@")[3];
				updcost(price,id);
				/*
				updcost(list[3],i+1);//这种情况i+1=10,其中i=9，i，list[3]取不到目标值，9代表最大显示9条信息，因为onkeydown函数是闭包函数，在起作用的时候，i就是最大值
				*/
			};
			td.appendChild(input);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[3]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var span=document.createElement("span");
			span.id="talpri"+(i+1);
			var textnode=document.createTextNode(list[3]);
			span.appendChild(textnode);
			td.appendChild(span);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var hr=document.createElement("hr");
			td.colSpan=7;
			hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			td.appendChild(hr);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			

			}
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			td.colSpan=7;
			var input=document.createElement("input");
			input.type="button";
			input.value="保存";
			input.classList.add("diasave");
			input.onclick=msubmit;
			td.appendChild(input);
			tr.appendChild(td);
			
			parent.appendChild(tr);	
			}
		}
	}
	xmlhttp.send();
}
function explore3(){
	var acc=document.getElementById("acckind3").value;
	try{
	   var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");	
	}
	xmlhttp.open("GET","dback.php?basis2="+acc,true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=xmlhttp.responseText.replace(/\s*/g,"");
			//alert(content);
			var list=content.split("@@");
			var parent=document.getElementById("fwindow");
			
			for(var j=parent.childNodes.length-1;j>1;j--){
				parent.removeChild(parent.childNodes[j]);
			}
			
			if(content.length!=0){
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var cbox=document.createElement("input");
			cbox.type="checkbox";
			cbox.name="cho2[]";
			cbox.value=list[0];
			td.appendChild(cbox);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(1);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[1]);
			td.appendChild(textnode);
			tr.appendChild(td);		
			
			var td=document.createElement("td");
			var input=document.createElement("input");
			input.type="text";
			input.value=1;
			input.readOnly=true;
			input.name="itemnum";
			input.classList.add("medinput");
			td.appendChild(input);
			tr.appendChild(td);
			
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[2]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var hr=document.createElement("hr");
			td.colSpan=5;
			hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			td.appendChild(hr);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			td.colSpan=5;
			var input=document.createElement("input");
			input.type="button";
			input.value="保存";
			input.classList.add("diasave");
			input.onclick=fsubmit;
			td.appendChild(input);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			}
		}
	}
	xmlhttp.send();
	addfee();
}
function safdialog(){
	document.getElementById("acckind3").value="";
	try{
		var xmlhttp=new XMLHttpRequest();
	}
	catch(e){
		var xmlhttp=new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","dback.php?inimedicine2=1",true);
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			var content=xmlhttp.responseText.replace(/\s*/g,"");
			var set=content.split("##");
			
			var parent=document.getElementById("fwindow");	
			
			for(var j=parent.childNodes.length-1;j>1;j--){
				parent.removeChild(parent.childNodes[j]);
			}
			
			if(content.length!=0){
			for(var i=0;i<set.length;i++){
			var list=set[i].split("@@");

			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var cbox=document.createElement("input");
			cbox.type="checkbox";
			cbox.name="cho2[]";
			cbox.value=list[0];
			td.appendChild(cbox);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(i+1);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[1]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			
			var td=document.createElement("td");
			var input=document.createElement("input");
			input.type="text";
			input.value=1;
			input.readOnly=true;
			input.name="itemnum";
			input.classList.add("medinput");
			td.appendChild(input);
			tr.appendChild(td);
			
			var td=document.createElement("td");
			var textnode=document.createTextNode(list[2]);
			td.appendChild(textnode);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			var hr=document.createElement("hr");
			td.colSpan=5;
			hr.classList.add("line3");//此处border不能小于等于0.3px,否则不显示(不知道是不是太细显示不出来)
			td.appendChild(hr);
			tr.appendChild(td);
			
			parent.appendChild(tr);
			}
			var tr=document.createElement("tr");
			var td=document.createElement("td");
			td.colSpan=5;
			var input=document.createElement("input");
			input.type="button";
			input.value="保存";
			input.classList.add("diasave");
			input.onclick=fsubmit;
			td.appendChild(input);
			tr.appendChild(td);
			
			parent.appendChild(tr);	
			}
		}
	}
	xmlhttp.send();
}
</script>
<style>
.splist{
	width:100%;
}
</style>
</head>
<body>
<?php
require "head.php";
echo "<div>";
require "dside.php";
require "conf.php";

echo "<div class=\"bgd\" id=\"bgd2\" onClick=\"addfee()\"></div>";
echo "<div class=\"dc2\" id=\"dc2\">";
echo "<div class=\"diatit\">添加附加费用
	  <div>
      <div class=\"search2\"><input id=\"acckind3\" type=text name=\"searchframe\" class=\"searchframe2\" placeholder=\"按收费项名称搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut2\" onclick=\"explore3()\"></div>	  
	  </div>      
	  </div>";
echo "<div class=\"diacont\">";
echo "<table class=\"diat2\" id=\"fwindow\">";
//echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\" onsubmit=\"return juge(this);\">";
echo "<input type=hidden name=\"pid\" id=\"pid\">";
echo "<tr><th>&nbsp;</th>";
echo "<th>序号</th>";
echo "<th>名称</th>";
echo "<th>数量</th>";
echo "<th>费用</th></tr>";
echo "<tr><td colspan=\"5\"><hr class=\"line1\"></td></tr>";



/*$sql="select * from $table_itemlist where name!='挂号费'";
$result=mysqli_query($link,$sql);
$i=1;
while($rows=mysqli_fetch_array($result)){
echo "<tr><td><input type=\"checkbox\" name=\"cho2[]\" value=\"".$rows['id']."\"></td>";
echo "<td>".$i."</td>";
echo "<td>".$rows['name']."</td>";
echo "<td><input type=text name=\"itemnum\" class=\"medinput\" value=\"1\" readonly=\"readonly\"></td>";
echo "<td>".$rows['price']."</td></tr>";
echo "<tr><td colspan=\"5\"><hr class=\"line3\"></td></tr>";
$i++;
}
echo "<tr><td colspan=\"5\"><input class=\"diasave\" type=\"button\" value=\"保存\" onclick=\"fsubmit()\"></td></tr>";
//echo "</form>";*/
echo "</table>";
echo "</div>";
echo "</div>";

echo "<div class=\"bgd\" id=\"bgd\" onClick=\"dispense()\"></div>";
echo "<div class=\"dc2\" id=\"dc\">";
echo "<div class=\"diatit\">添加药品
	  <div>
      <div class=\"search2\"><input id=\"acckind2\" type=text name=\"searchframe\" class=\"searchframe2\" placeholder=\"按药品类型搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut2\" onclick=\"explore2()\"></div>	  
	  </div>
	 </div>";
echo "<div class=\"diacont\">";
echo "<table class=\"diat2\" id=\"mwindow\">";
//echo "<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\" onsubmit=\"return juge(this);\">";
echo "<input type=hidden name=\"patid\" id=\"patid\">";
echo "<tr><th>&nbsp;</th>";
echo "<th>序号</th>";
echo "<th>药品名称</th>";
echo "<th>药品种类</th>";
echo "<th>药品数量</th>";
echo "<th>药品单价</th>";
echo "<th>药品总价</th></tr>";
echo "<tr><td colspan=\"7\"><hr class=\"line1\"></td></tr>";

/*$i=1;
while($rows=mysqli_fetch_array($result)){
echo "<tr><td><input type=\"checkbox\" name=\"cho[]\" value=\"".$rows['id']."\"></td>";
echo "<td>".$i."</td>";
echo "<td>".$rows['name']."</td>";
echo "<td>";
if($rows['kind']==0)
   echo "非处方药";
else
   echo "处方药";
echo "</td>";
echo "<td><input type=text name=\"".$rows['id']."\" class=\"medinput\" value=\"0\" id=\"mednum".$i."\" onkeyup=\"updcost('$rows[price]','$i')\"></td>";
echo "<td>".$rows['price']."</td>";
echo "<td><span id=\"talpri".$i."\">0</span></td></tr>";
echo "<tr><td colspan=\"7\"><hr class=\"line2\"></td></tr>";
$i++;
}
echo "<tr><td colspan=\"7\"><input class=\"diasave\" type=\"button\" value=\"保存\" onclick=\"msubmit()\"></td></tr>";
//echo "</form>";*/
echo "</table>";

echo "</div>";
echo "</div>";


echo "<div class=\"container\">";
echo "<div class=\"title\"><span class=\"title2\">当前状态：接诊</span>
      <div class=\"search\"><input id=\"acckind\" type=text name=\"searchframe\" class=\"searchframe\" placeholder=\"按病人搜索\">
	  <input type=\"button\" value=\"搜索\" class=\"seabut\" onclick=\"explore(1)\"></div>        
	  <input style=\"display:none;\" id=\"subcov\" class=\"appdep\" type=\"button\" value=\"提交治疗方案\" onClick=\"submes()\"></div>";
echo "<div class=\"bgt3\">";
echo "<div class=\"patmes\">";
echo "<table class=\"pattab\">";
echo "<tr><td>";
echo "<span style=\"color:blue;\">患者信息</span>";
echo "</td></tr>";
echo "<tr><td>";
echo "姓名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"pname\" id=\"pname\" value=\"\" readonly=\"readonly\">";
echo "</td></tr>";
echo "<tr><td>";
echo "性别：<select name=\"sex\" id=\"sex\" disabled=\"disabled\">";
echo "<option value=\"man\">男性</option>";
echo "<option value=\"woman\">女性</option>";
echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "年龄：<select name=\"age\" id=\"age\" disabled=\"disabled\">";
for($i=0;$i<100;$i++)
echo "<option value=\"".$i."\" readonly=\"readonly\">".$i."岁</option>";
echo "</select>";
echo "</td></tr>";
echo "<tr><td>";
echo "身份证号：<input type=\"text\" name=\"idnum\" id=\"idnum\" readonly=\"readonly\">";
echo "</td></tr>";
echo "<tr><td>";
echo "生日：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"borntime\" id=\"borntime\" type=text placeholder=\"格式：yyyy-mm-dd\" readonly=\"readonly\">";
echo "</td></tr>";
echo "<tr><td>";
echo "联系方式：<input name=\"conway\" id=\"conway\" type=text placeholder=\"电话或手机号\" readonly=\"readonly\">";
echo "</td></tr>";
echo "<tr><td>";
echo "住址：<br><textarea name=\"addr\" id=\"addr\" rows=\"6\" cols=\"33\" readonly=\"readonly\"></textarea>";
echo "</td></tr>";
echo "</table>";
echo "</div>";
echo "<div class=\"showreg\">";
echo "<table class=\"regmes2\" id=\"pregmes\">";
echo "<tr><th>&nbsp;</th><th>序号</th><th>日期</th><th>时间段</th><th>科室</th><th>医生</th><th>挂号类型</th><th>患者姓名</th></tr>";
echo "<tr><td colspan=\"8\"><hr class=\"line1\"></td></tr>";

$date=date("Y 年 m 月 d 日");
if(date("H")<12)
   $time="morning";
else if(date("H")<18)
   $time="afternoon";
else
   $time="evening";

$sql0="select p_id from $table_user where name='$_COOKIE[his_user]'";
$result0=mysqli_query($link,$sql0);
$rows0=mysqli_fetch_array($result0);
function getcurpag($d_id){
	require "conf.php";
	$sql="select * from $table_patient where (registrationtype='1' or registrationtype='2') and treat='no' and d_id='$d_id' and date='$date' and time='$time'";
	$result=mysqli_query($link,$sql);
	$num=mysqli_num_rows($result);
	return $num;
}

$text="";
$pageamo=9;
$nopage=0;
$maxpage=ceil(getcurpag($rows0[0])/$pageamo);
   
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
 $sql="select * from $table_patient where name='$name' and 
 (registrationtype='1' or registrationtype='2') and treat='no' and d_id='$rows0[0]' and date='$date' and time='$time' limit $number,$pageamo";
 $result=mysqli_query($link,$sql);
 	
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
/*echo "<script>alert(\"".$maxpage." ".$number." ".$nopage." ".$_GET['nopage']."\")</script>";*/
$sql="select * from $table_patient where (registrationtype='1' or registrationtype='2') and treat='no' and d_id='$rows0[0]' and date='$date' and time='$time' limit $number,$pageamo";
$result=mysqli_query($link,$sql);	
}
$i=1;
while($rows=mysqli_fetch_array($result)){
   if($rows['registrationtype']=="2"){
    $sql2="select name from $table_doctor where id='$rows[d_id]'";
    $result2=mysqli_query($link,$sql2);
    $rows2=mysqli_fetch_array($result2);	
	$sql3="select name from $table_department where id='$rows[dep_id]'";
	$result3=mysqli_query($link,$sql3);
	$rows3=mysqli_fetch_array($result3);		
	echo "<tr><td>";
	if($_COOKIE['his_priority']=="doctor")//防止doctor表里的id与user表里的管理员id重合
	   echo "<input type=\"radio\" name=\"regope\" onchange=\"changeintfac('$rows[d_id]','$rows[id]','$rows[name]','$rows[sex]','$rows[age]','$rows[idnum]','$rows[borntime]','$rows[phonenumber]','$rows[address]')\">";
	else
	    echo "&nbsp;";
	echo "</td><td>".$i."</td><td>".$rows['date']."</td><td>";
	if($rows['time']=="morning")
	    echo "上午";
	else if($rows['time']=="afternoon")
	    echo "下午";
	else
	    echo "晚上";
	echo "</td><td>".$rows3[0]."</td><td>".$rows2[0]."</td><td>";
	if($rows['registrationtype']=="1")
	    echo "门诊";
	else
	    echo "急诊";
	echo "</td><td>".$rows['name']."</td></tr>";
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";   
	$i++;
  }
}

mysqli_data_seek($result,0);//重置结果集
while($rows=mysqli_fetch_array($result)){
   if($rows['registrationtype']=="1"){
    $sql2="select name from $table_doctor where id='$rows[d_id]'";
    $result2=mysqli_query($link,$sql2);
    $rows2=mysqli_fetch_array($result2);	
	$sql3="select name from $table_department where id='$rows[dep_id]'";
	$result3=mysqli_query($link,$sql3);
	$rows3=mysqli_fetch_array($result3);		
	echo "<tr><td>";
	if($_COOKIE['his_priority']=="doctor")//防止doctor表里的id与user表里的管理员id重合
	   echo "<input type=\"radio\" name=\"regope\" onchange=\"changeintfac('$rows[d_id]','$rows[id]','$rows[name]','$rows[sex]','$rows[age]','$rows[idnum]','$rows[borntime]','$rows[phonenumber]','$rows[address]')\">";
	else
	    echo "&nbsp;";
	echo "</td><td>".$i."</td><td>".$rows['date']."</td><td>";
	if($rows['time']=="morning")
	    echo "上午";
	else if($rows['time']=="afternoon")
	    echo "下午";
	else
	    echo "晚上";
	echo "</td><td>".$rows3[0]."</td><td>".$rows2[0]."</td><td>";
	if($rows['registrationtype']=="1")
	    echo "门诊";
	else
	    echo "急诊";
	echo "</td><td>".$rows['name']."</td></tr>";
	echo "<tr><td colspan=\"8\"><hr class=\"line2\"></td></tr>";   
	$i++;
  }
}

echo "</table>";

echo "<div id=\"dregmes\" class=\"dregmes\">";
echo "<div class=\"dtit\" style=\"border-bottom:1px solid #B2B2B2;\"><input type=\"button\" class=\"pat\" id=\"pat\" value=\"病历\" onClick=\"change1()\"><input onClick=\"change2()\" class=\"med\" type=\"button\" id=\"med\" value=\"药方\"><input type=\"button\" class=\"med\" id=\"ano\" value=\"检查项目\" onClick=\"change3()\"><input type=\"button\" class=\"gob\" id=\"gob\" value=\"返回\" onClick=\"change4()\"></div>";

echo "<table id=\"dregmesc1\">";
echo "<form id=\"curemes\" action=\"".$_SERVER['PHP_SELF']."\" method=post>";
echo "<input type=hidden name=\"subid\" id=\"subid\">";
echo "<tr><td class=\"dcon\">主诉：<br>
      <hr class=\"hrcon\">
      <textarea name=\"symptom\"></textarea>
	  </td></tr>";
echo "<tr><td class=\"dcon\">诊断详情：<br>
      <hr class=\"hrcon\">
      <textarea name=\"judge\"></textarea>
	  </td></tr>";
echo "<tr><td class=\"dcon\">治疗方案：<br>
      <hr class=\"hrcon\">
      <textarea name=\"treatment\"></textarea>
	  </td></tr>";
echo "</form></table>";	


echo "<table id=\"dregmesc2\">";
echo "<tr><td colspan=\"7\">&nbsp;</td></tr>";
echo "<tr><th>序号</th><th>药品名称</th><th>类别</th><th>单价</th><th>数量</th><th>总额</th><th>操作</th></tr>";
echo "<tr><td colspan=\"7\"><hr class=\"line1\"></td></tr>";
echo "</table>";

echo "<table id=\"dregmesc3\">";
echo "<tr><td colspan=\"7\">&nbsp;</td></tr>";
echo "<tr><th>序号</th><th>名称</th><th>金额</th><th>操作</th></tr>";
echo "<tr><td colspan=\"4\"><hr class=\"line1\"></td></tr>";
echo "</table>";
echo "</form>";
echo "</div>";

echo "<div class=\"pagestyle addps\"><div class=\"pagcon\"><a href=\"javascript:void(0)\" onclick=\"setpage(1)\">首页</a>&nbsp;|&nbsp;
      <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage-1)>0)?($nopage-1):1).")\">上一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".((($nopage+1)<$maxpage)?($nopage+1):$maxpage).")\">下一页</a>&nbsp;|&nbsp;
	  <a href=\"javascript:void(0)\" onclick=\"setpage(".$maxpage.")\">尾页</a></div></div>";

echo "</div>";
echo "</div>";	  
if($_POST['symptom']){

	$symptom=$_POST['symptom'];
	$judge=$_POST['judge'];
	$treatment=$_POST['treatment'];
	$id=$_POST['subid'];
	
	$sum=0;
	$sql="select * from $table_pilllist where p_id=".$id;
	$result=mysqli_query($link,$sql);
    while($rows=mysqli_fetch_array($result)){
        $sum+=$rows['price']*$rows['amount'];
	}

	$sql="select * from $table_costlist where p_id=".$id;
	$result=mysqli_query($link,$sql);
    while($rows=mysqli_fetch_array($result)){
        $sum+=$rows['cost'];
	}

	$sql="select price from $table_itemlist where name='挂号费'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	$sum+=$rows['price'];
	
	$sql="update $table_patient set cost=".$sum.",symptom='$symptom',judge='$judge',treatment='$treatment',treat='1' where id='$id'";
	mysqli_query($link,$sql);
	
	$sql="update $table_pilllist set issubmit='2' where p_id='$id'";
	mysqli_query($link,$sql);
	
	$sql="update $table_costlist set issubmit='2' where p_id='$id'";
	mysqli_query($link,$sql);
	
    echo "<script>alert(\"提交诊断记录成功！\");</script>";		
    echo "<meta http-equiv=\"refresh\" content=\"0; url=".$_SERVER['PHP_SELF']."\">";
}
echo "<div style=\"clear:both;\"></div>";
echo "</div>";
require "webtail.php";
?>
</body>
</html>