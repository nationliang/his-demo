<div id="smenu">
<div id="usermana">用户管理</div>
<div id="uchild">
<a href="index.php" class="active" id="adduser">编辑用户</a>
</div>
<div id="dailymana">日常管理</div>
<div id="dailychild">
<a href="organizedep.php" id="organizedep">科室管理</a>
<a href="organizedoc.php" id="organizedoc">医生管理</a>
<a href="arrangedoc.php" id="arrangedoc">医生排班</a>
<a href="price.php" id="price">收费管理</a>
<a href="news.php" id="news">新闻管理</a>
<a href="topic.php" id="topic">论坛板块主题管理</a>
</div>
<div id="rmana">就诊记录管理</div>
<div id="hischild">
<a href="record.php" id="hrecord">编辑记录</a>
</div>
</div>
<?php
//echo "url=".php_self();
if(php_self()=="index.php"){
    ;
}
elseif(php_self()=="organizedep.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"organizedep\").className=\"active\";</script>";	
}
else if(php_self()=="organizedoc.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"organizedoc\").className=\"active\";</script>";	
}
else if(php_self()=="arrangedoc.php"){
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"arrangedoc\").className=\"active\";</script>";	
}
else if(php_self()=="record.php"){
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"hrecord\").className=\"active\";</script>";	
}
else if(php_self()=="price.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"price\").className=\"active\";</script>";	
}
else if(php_self()=="news.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"news\").className=\"active\";</script>";	
}
else if(php_self()=="topic.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"topic\").className=\"active\";</script>";	
}
else 
   echo "<script>alert(\"发生系统错误！\");</script>";
?>




























