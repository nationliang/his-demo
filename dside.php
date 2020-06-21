<div id="smenu">
<div id="usermana">接诊</div>
<div id="uchild">
<a href="doctor.php" class="active" id="adduser">待接诊</a>
<a href="recovery.php" id="edituser">已接诊</a>
</div>
</div>
<?php
//echo "url=".php_self();
if(php_self()=="doctor.php"){

}
else{
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"edituser\").className=\"active\";</script>";	
}
?>




























