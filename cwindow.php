<div class="contain" id="contain" onmousedown="drag(event)">
<div class="dtitle">通讯窗口</div>
<div class="mesframe" id="mesframe">
<div id="receiver" class="receiver">&nbsp;</div>
<div class="content" id="content"></div>
<div class="send">
<textarea name="sendtext" class="sendinput" id="sendmes"></textarea><br />
<input type="button" value="发送" id="sendbut" class="sendbut" onclick="sendtext()" disabled="disabled"/>
</div>
</div>
<div class="staff">
<div class="receiver">联系人列表</div>
<div class="doclist" id="doclist">
<?php
require "conf.php";
$sql="select name,p_id,priority from $table_user where name!='$_COOKIE[his_user]'";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){
	$sql="select department from $table_doctor where id='$rows[p_id]'";
	$result2=mysqli_query($link,$sql);
	$rows2=mysqli_fetch_array($result2);
	echo "<div class=\"docitem\" onClick=\"activatesend('$rows[0]')\">".$rows[0];
	if($rows['priority']=="doctor")
	    echo "(".$rows2[0]."医生)";
	else if($rows['priority']=="patient")
	    echo "(患者)";
	else if($rows['priority']=="admin")
	    echo "(系统管理员)";
	else if($rows['priority']=="cashier")
	    echo "(收银员)";	
	else	
	    echo "(药库管理员)";
	echo "<span id=\"count\" class=\"num\"></span></div>";
}
?>
</div>
</div>
</div>

<span id="tip" class="tip"></span>

<div class="waiter" onclick="showwaiter()">
<img src="conn.png" width="50px" height="50px"/>
</div>