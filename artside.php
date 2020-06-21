<script>
function setkind(signal){
	var kv="";
	document.cookie="signal="+signal;
	if(signal==1)
	    kv="医院要闻";
	else if(signal==2){
	    kv="综合新闻";	
	}
    else if(signal==3){
	    kv="病友飞鸿";		
	}
	else if(signal==4){
	    kv="杏林人物";		
	}
	else if(signal==5){
	    kv="员工文苑";		
	}
	else{
	    kv="领导论坛";	
	}
	document.cookie="kind="+kv;
	location.href="article.php";
}
function getCookie(name){
	var cArray=document.cookie.split(";");
	for(var i=0;i<cArray.length;i++){
		if(cArray[i].split("=")[0].replace(/\s*/g,"")==name){
			return decodeURI(cArray[i].split("=")[1]).replace(/\s*/g,"");
		}
	}
}
function buttonleap(){
	var signal=getCookie("signal");
	if(signal==6){//领导论坛
		document.getElementById("t1").classList.remove("active");
		document.getElementById("t2").classList.remove("active");
		document.getElementById("t3").classList.remove("active");
		document.getElementById("t4").classList.remove("active");
		document.getElementById("t5").classList.remove("active");
		document.getElementById("t6").classList.add("active");	
		
	}
	else if(signal==2){//综合新闻
		document.getElementById("t1").classList.remove("active");
		document.getElementById("t2").classList.add("active");
		document.getElementById("t3").classList.remove("active");
		document.getElementById("t4").classList.remove("active");
		document.getElementById("t5").classList.remove("active");
		document.getElementById("t6").classList.remove("active");		
	}
    else if(signal==3){//病友飞鸿
		document.getElementById("t1").classList.remove("active");
		document.getElementById("t2").classList.remove("active");
		document.getElementById("t3").classList.add("active");
		document.getElementById("t4").classList.remove("active");
		document.getElementById("t5").classList.remove("active");
		document.getElementById("t6").classList.remove("active");		
	}
	else if(signal==4){//杏林人物
		document.getElementById("t1").classList.remove("active");
		document.getElementById("t2").classList.remove("active");
		document.getElementById("t3").classList.remove("active");
		document.getElementById("t4").classList.add("active");
		document.getElementById("t5").classList.remove("active");
		document.getElementById("t6").classList.remove("active");		
	}
	else if(signal==5){//员工文苑
		document.getElementById("t1").classList.remove("active");
		document.getElementById("t2").classList.remove("active");
		document.getElementById("t3").classList.remove("active");
		document.getElementById("t4").classList.remove("active");
		document.getElementById("t5").classList.add("active");
		document.getElementById("t6").classList.remove("active");		
	}
	else{//医院要闻
		document.getElementById("t1").classList.add("active");
		document.getElementById("t2").classList.remove("active");
		document.getElementById("t3").classList.remove("active");
		document.getElementById("t4").classList.remove("active");
		document.getElementById("t5").classList.remove("active");
		document.getElementById("t6").classList.remove("active");			
	}	
}
</script>
<div id="smenu">
<div id="usermana">新闻分类</div>
<div id="uchild">
<a href="javascript:void(0)" class="active" id="t1" onclick="setkind(1);">医院要闻</a>
<a href="javascript:void(0)" id="t2" onclick="setkind(2);">综合新闻</a>
<a href="javascript:void(0)" id="t3" onclick="setkind(3);">病友飞鸿</a>
<a href="javascript:void(0)" id="t4" onclick="setkind(4);">杏林人物</a>
<a href="javascript:void(0)" id="t5" onclick="setkind(5);">员工文苑</a>
<a href="javascript:void(0)" id="t6" onclick="setkind(6);">领导论坛</a>
</div>
</div>
<script>
buttonleap();
</script>
