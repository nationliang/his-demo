<?php
setcookie("his_user",$_GET['name']);
/*echo "<script>alert(\"111".$_COOKIE['his_user']."\");</script>";*/
?>
<script>
location.href=window.history.go(-1);
</script>