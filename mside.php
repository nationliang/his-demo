<div id="smenu">
<div id="usermana">药库管理</div>
<div id="uchild">
<a  href="medicine.php" class="active" id="adduser">派药</a>
<a href="manapill.php" id="edituser">药物管理</a>
</div>
</div>
<?php
//echo "url=".php_self();
if(php_self()=="medicine.php"){

}
else{
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"edituser\").className=\"active\";</script>";	
}
?>




























