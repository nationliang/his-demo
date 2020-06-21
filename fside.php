<script>
function setkind(signal2,kv,id){
	document.cookie="signal2="+signal2;
	document.cookie="kind2="+kv;
	document.cookie="dep_id="+id;
	wipeCookie("topic_id");
	location.href="forum.php";
	
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
	var depnum=getCookie("depnum");
	var signal2=getCookie("signal2");	
	
	if(typeof signal2!="undefined"){
	   for(var i=1;i<=depnum;i++){
	      var ti = document.getElementById("t" + i);
		  if (ti !==null) {
			if(i!=signal2){
				ti.classList.remove("active");
			}
			else {
				ti.classList.add("active");
			}
		  }
	   }
	}
	else {
		var t1 = document.getElementById("t1");
		if (t1 !==null) {
			t1.classList.add("active");
		}
	}
	/*var date=new Date();
	date.setTime(date.getTime()-1000);
	document.cookie="signal2='';expires="+date.toGMTString();*/
}
</script>
<div id="smenu">
<div id="usermana">社区板块</div>
<div id="uchild">
<?php
require "conf.php";
$sql2="select * from $table_department";
$result2=mysqli_query($link,$sql2);
$i=1;
while($rows2=mysqli_fetch_array($result2)){
   echo "<a href=\"javascript:void(0)\" id=\"t".$i."\" onclick=\"setkind(".$i.",'".$rows2['name']."',".$rows2['id'].");\">".$rows2['name']."</a>";	
   $i++;
}
?>
</div>
</div>
<script>
buttonleap();
</script>



























