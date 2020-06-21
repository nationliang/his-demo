<?php
require "conf.php";
function showpill($patid,$docid){
	require "conf.php";//必须放置在函数内
	$i=1;
	$text="";
	//echo $patid." ".$docid;
	$sql="select * from $table_pilllist where p_id='$patid' and d_id='$docid' and issubmit!='1'";
	$result=mysqli_query($link,$sql) or die(mysqli_error($link));
	$kind="非处方药";
	while($rows=mysqli_fetch_array($result)){
		if($rows['kind']==0){
			$kind="非处方药";
		} else {
			$kind="非处方药";
		}
		$text.=$i."@@".$rows['name']."@@".$kind."@@".$rows['price']."@@".$rows['amount']."@@".$rows['totalprice']."@@".$rows['id']."##";
		$i++;
	}
	$text=substr($text,0,strlen($text)-2);
	echo $text;	
}
function showfee($fpatid,$fdocid){
	require "conf.php";//必须放置在函数内
	$i=1;
	$text="";
	//echo $patid." ".$docid;
	$sql="select * from $table_costlist where p_id='$fpatid' and d_id='$fdocid' and issubmit!='1'";
	$result=mysqli_query($link,$sql) or die(mysqli_error($link));
	while($rows=mysqli_fetch_array($result)){
		$text.=$i."@@".$rows['name']."@@".$rows['cost']."@@".$rows['id']."##";
		$i++;
	}
	$text=substr($text,0,strlen($text)-2);
	echo $text;	
}
if($_REQUEST['patid']&&$_REQUEST['docid']){
	$patid=$_REQUEST['patid'];
	$docid=$_REQUEST['docid'];
	showpill($patid,$docid);

}
if($_REQUEST['fpatid']&&$_REQUEST['fdocid']){
	$fpatid=$_REQUEST['fpatid'];
	$fdocid=$_REQUEST['fdocid'];
	showfee($fpatid,$fdocid);

}
if($_REQUEST['delid']){
	$id=$_REQUEST['delid'];
	echo "id=".$id;
	$sql="select p_id,d_id from $table_pilllist where id='$id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql2="delete from $table_pilllist where id='$id' and issubmit!='1'";
	mysqli_query($link,$sql2);
	
	showpill($rows['p_id'],$rows['d_id']);
	
}
if($_REQUEST['fdelid']){
	$fid=$_REQUEST['fdelid'];
	$sql="select p_id,d_id from $table_costlist where id='$fid' and issubmit!='1'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql2="delete from $table_costlist where id='$fid'";
	mysqli_query($link,$sql2);
	
	showpill($rows['p_id'],$rows['d_id']);
	
}
if($_REQUEST['apatid']&&$_REQUEST['mids']&&$_REQUEST['mnumber']){
$id=$_REQUEST['mids'];
$mnumber=$_REQUEST['mnumber'];
$mnumber=substr($mnumber,0,strlen($mnumber)-2);
$nums=explode("@@",$mnumber);
$id=substr($id,0,strlen($id)-2);
$cond=str_replace("@@",",",$id);
$patid=$_REQUEST['apatid'];
$time=date("Y 年 m 月 d 日");


$sql="select p_id from $table_user where name='$_COOKIE[his_user]'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result);
$docid=$rows[0];

$sql="select * from $table_medicine where id in ($cond)";
$result=mysqli_query($link,$sql);
$i=1;
while($rows=mysqli_fetch_array($result)){	
   echo $i.",";
   $mednum=$nums[$i-1];
   $price=$mednum*$rows['price'];
   $sql2="insert into $table_pilllist(name,price,amount,totalprice,p_id,kind,date,d_id)                                           
   values('$rows[name]','$rows[price]','$mednum','$price','$patid','$rows[kind]','$time','$docid')";
   mysqli_query($link,$sql2);
   $sql2="update $table_medicine set rest=amount-'$mednum' where name='$rows[name]'";
   mysqli_query($link,$sql2);
   $i++;
}	
}

if($_REQUEST['fpatid']&&$_REQUEST['fids']){
	$id=$_REQUEST['fids'];
	$p_id=$_REQUEST['fpatid'];
	$id=substr($id,0,strlen($id)-2);
	$cond=str_replace("@@",",",$id);
	$time=date("Y 年 m 月 d 日");
	
     $sql="select p_id from $table_user where name='$_COOKIE[his_user]'";
     $result=mysqli_query($link,$sql);
     $rows=mysqli_fetch_array($result);
     $docid=$rows[0];	
	
	$sql="select * from $table_itemlist where id in ($cond)";
	$result=mysqli_query($link,$sql) or die(mysqli_error($link));
	while($rows=mysqli_fetch_array($result)){
		$sql2="insert into $table_costlist(name,cost,p_id,date,d_id) values('$rows[name]','$rows[price]','$p_id','$time','$docid')";
		mysqli_query($link,$sql2);	
		$sql3="update $table_itemlist set number=number+1 where name='$rows[name]' and id!=0";
		mysqli_query($link,$sql3) or die(mysqli_error($link));
	}	
}
if($_REQUEST['basis']){//查询药品
	 $name=$_REQUEST['basis'];
	 $sql="select * from $table_medicine where name='$name'";
     $result=mysqli_query($link,$sql);
	 $rows=mysqli_fetch_array($result);
	 if($rows['id'])
	    $text=$rows['id']."@@".$rows['name']."@@".$rows['kind']."@@".$rows['price'];
	 echo $text;
}
if($_REQUEST['inimedicine']==1){
	 $sql="select * from $table_medicine";
     $result=mysqli_query($link,$sql);
	 $text="";
	 while($rows=mysqli_fetch_array($result)){
	    $text.=$rows['id']."@@".$rows['name']."@@".$rows['kind']."@@".$rows['price']."##";
	 }
	 $text=substr($text,0,strlen($text)-2);
	 echo $text;	
}
if($_REQUEST['basis2']){//查询附加费用
	 $name=$_REQUEST['basis2'];
	 $sql="select * from $table_itemlist where name='$name'";
     $result=mysqli_query($link,$sql);
	 $rows=mysqli_fetch_array($result);
	 if($rows['id'])
	    $text=$rows['id']."@@".$rows['name']."@@".$rows['price'];
	 echo $text;
}
if($_REQUEST['inimedicine2']==1){
	 $sql="select * from $table_itemlist where name!='挂号费'";
     $result=mysqli_query($link,$sql);
	 $text="";
	 while($rows=mysqli_fetch_array($result)){
	    $text.=$rows['id']."@@".$rows['name']."@@".$rows['price']."##";
	 }
	 $text=substr($text,0,strlen($text)-2);
	 echo $text;	
}
?>








