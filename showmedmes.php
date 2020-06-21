<link href="addbut.css" rel="stylesheet" type="text/css">
<style>
.stab{
	text-align:center;margin-top:10px;
}
.stabtd{
	line-height:32px;
}
</style>

<?php
require "conf.php";
/*echo "<script>alert(\"".$_COOKIE['listid']."\");</script>";*/
$listid=$_COOKIE['listid'];
$sql="select * from $table_pilllist where p_id='$listid' and issubmit='1'";
$result=mysqli_query($link,$sql) or die(mysqli_error($link));
echo "<table class=\"stab regmes2\">";
echo "<tr><td>药品名称</td><td>数量</td></tr>";
echo "<tr><td colspan=\"2\"><hr class=\"line1\"></td></tr>";
while($rows=mysqli_fetch_array($result)){
	echo "<tr><td class=\"stabtd\">".$rows['name']."</td><td>".$rows['amount']."</td></tr>";
    echo "<tr><td colspan=\"2\"><hr class=\"line2\"></td></tr>";	
}
echo "<script>
              var date=new Date();
			  date.setTime(date.getTime()-1000);
              document.cookie=\"listid='';expires=\"+date.toGMTString();
	  </script>";
echo "</table>";
?>




































