<div id="smenu">
<div id="usermana">收支统计</div>
<div id="uchild">
<a href="statistics.php" class="active" id="adduser">医院总收支</a>
</div>
<div id="dailymana">人流和物流统计</div>
<div id="dailychild">
<a href="countpill.php" id="organizedep">药物进出库</a>
<a href="countpat.php" id="organizedoc">接诊患者</a>
</div>
</div>
<?php
//echo "url=".php_self();
if(php_self()=="statistics.php"){

}
else if(php_self()=="countpill.php"){
	echo "<script>document.getElementById(\"organizedep\").className=\"active\";</script>";
	echo "<script>document.getElementById(\"organizedoc\").className=\"sleep\";</script>";	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";	
}
else{
	echo "<script>document.getElementById(\"organizedep\").className=\"sleep\";</script>";
	echo "<script>document.getElementById(\"organizedoc\").className=\"active\";</script>";	
	echo "<script>document.getElementById(\"adduser\").className=\"sleep\";</script>";		
}
?>




























