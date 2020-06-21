<div id="smenu">
<div id="usermana">预约</div>
<div id="uchild">
<a href="patient.php" class="active" id="adduser">预约医生</a>
<a href="booklist.php" id="edituser">已预约列表</a>
</div>
<div id="dailymana">账单</div>
<div id="dailychild">
<a href="payment.php" id="organizedep">待付账单</a>
<a href="bill.php" id="organizedoc">历史账单</a>
</div>
</div>
<?php
//echo "url=".php_self();
if(php_self()=="patient.php"){

}
else if(php_self()=="booklist.php"){
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"edituser\").className=\"active\";</script>";	
}
elseif(php_self()=="payment.php"){	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"organizedep\").className=\"active\";</script>";	
}
else{	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"organizedoc\").className=\"active\";</script>";	
}
?>

























































