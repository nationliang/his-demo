<?php
require "conf.php";
//header("Author:Robbin Chen");
//header("WebSite:www.robchen.cn");
//echo "hello world!";
/*$book = array('a'=>'xiyouji','b'=>'sanguo','c'=>'shuihu','d'=>'hongloumeng');
        $json = json_encode($book);
        
        $obj = json_decode($json);
        //var_dump($array);
        //var_dump($obj);
		echo "a的值是：".$obj->a;*/
function searchMessage($rname,$sname){//获取消息
	$filename="storage.text";
	$records=file($filename);
	$num=count($records);
	$senders=array();	
	for($i=0;$i<$num;$i++){
		$record=explode("@@",$records[$i]);
		if($record[2]==$rname&&substr($record[6],0,2)=="no"&&$record[1]==$sname){
             if($senders[$record[1]])
			     $senders[$record[1]].=$record[3]."[".$record[5]."]"."@@";
			 else
			     $senders[$record[1]]=$record[1]."@@".$record[3]."[".$record[5]."]"."@@";
			 $records[$i]=$record[0]."@@".$record[1]."@@".$record[2]."@@".$record[3]."@@".$record[4]."@@".$record[5]."@@"."yes\r\n";
		}
	}
	$records2="";
	for($i=0;$i<$num;$i++)
	   $records2=$records2.$records[$i];
	$myfile=fopen($filename,"w");
	fwrite($myfile,$records2);
	fclose($myfile);
	if(count($senders)!=0){
	  $transition="";
	  foreach($senders as $key=>$value)
	     $transition.=substr($value,0,strlen($value)-2);//去掉尾部的@@
	  echo $transition;
	}
	echo "";
}	
function reflect($owner){//获取通知
	$filename="storage.text";
	$records=file($filename);
	$num=count($records);
	$senders=array();	
	for($i=0;$i<$num;$i++){
		$record=explode("@@",$records[$i]);
		if($record[2]==$owner&&substr($record[6],0,2)=="no"){
             if($senders[$record[1]])
			     $senders[$record[1]].=$record[3]."@@";
			 else
			     $senders[$record[1]]=$record[1]."@@".$record[3]."@@";
		}
	}
	if(count($senders)!=0){
	  $transition="";
	  foreach($senders as $key=>$value)
	     $transition.=substr($value,0,strlen($value)-2)."##";
	  echo substr($transition,0,strlen($transition)-2);
	}
}
if($_REQUEST['sender']&&$_REQUEST['receiver']){
	$text=$_REQUEST['text'];
	$sender=$_REQUEST['sender'];
	$time=date("Y-m-d H:i:s");
	$receiver=$_REQUEST['receiver'];
	//序号@@发送方姓名@@接收方姓名@@内容@@类别（doctor或patient）@@日期@@信息阅读状态（yes or no）
	$record=$sender."@@".$receiver."@@".$text."@@".$_COOKIE['his_priority']."@@".$time."@@no"."\r\n";
	$filename="storage.text";
	if(!file_exists($filename)){
		$myfile=fopen($filename,"w");
		fwrite($myfile,"1@@".$record);
		fclose($myfile);
        searchmes($name,$time);		
	}
	else{
		$myfile=fopen($filename,"a+");
		$i=count(file($filename))+1;
		fwrite($myfile,$i."@@".$record);
		fclose($myfile);
		searchmes($name,$time);
	}
}
if($_REQUEST['rname']&&$_REQUEST['sname']){
	$rname=$_REQUEST['rname'];
	$sname=$_REQUEST["sname"];
	searchMessage($rname,$sname);
}
if($_REQUEST['ownername']){
	$owner=$_REQUEST['ownername'];
	reflect($owner);
}

if($_REQUEST['helf']){
	$describe=$_REQUEST['helf'];
	
	if(!preg_match("/((^([^#]+)$)|(^([^#]+)(##[^#]+)*##([^#]+)$))/",$describe)){
		echo "512";
		exit();
	}
	
	$des=explode("##",$describe);
	$sql="select * from $table_disease where symptom like '%$des[0]%'";
	$j=1;
	while(count($des)>$j){
		$sql.="or symptom like '%$des[$j]%'";
		$j++;
	}  
	$result=mysqli_query($link,$sql);
	$i=1;
	$text="";
	while($rows=mysqli_fetch_array($result)){
	   $text.=$i.".".$rows['name'].": ".$rows['symptom']."->".$rows['department']."<br />";
	   $i++;
	}
	echo $text;
}

if($_REQUEST['id']){
	$id=$_REQUEST['id'];
	$sql="select * from $table_article where id='$id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	echo $rows['title']."@@".$rows['kind']."@@".$rows['author']."@@".$rows['content'];
}
if($_REQUEST['topicid']){
	$id=$_REQUEST['topicid'];
	$sql="select * from $table_topic where id='$id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	echo $rows['topic_name']."@@".$rows['p_id']."@@".$rows['topic_description'];
}
if($_REQUEST['pid']){
	$id=$_REQUEST['pid'];
	$sql="select * from $table_post where id='$id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql2="select * from $table_user where id='$rows[poster_id]'";
	$result2=mysqli_query($link,$sql2);
	$rows2=mysqli_fetch_array($result2);
	
	$text=$rows['id']."@@".$rows['title']."@@".$rows['content']."@@".$rows2['name']."@@".$rows['poster_id']."@@".$rows['post_time']."@@".$rows['re_count']."@@".$rows2['level']."@@".$rows['praise_num']."@@".$rows['f_id'];
	
	$sql3="select * from $table_post where f_id='$id'";
	$result3=mysqli_query($link,$sql3);
	while($rows3=mysqli_fetch_array($result3)){
	    $sql2="select * from $table_user where id='$rows3[poster_id]'";
	    $result2=mysqli_query($link,$sql2);
	    $rows2=mysqli_fetch_array($result2);		
		$text.="##".$rows3['id']."@@".$rows3['title']."@@".$rows3['content']."@@".$rows2['name']."@@".$rows3['poster_id']."@@".$rows3['post_time']."@@".$rows['re_count']."@@".$rows2['level']."@@".$rows3['praise_num']."@@".$rows3['f_id'];
	}
	echo $text;
}
if($_REQUEST['topic_id']){
	$topic_id=$_REQUEST['topic_id'];
	$poster_id=$_REQUEST['poster_id'];
	$content=$_REQUEST['content'];
	$f_id=$_REQUEST['f_id'];
	$date=date("Y 年 m 月 d 日");
	
	$sql="select * from $table_user where id='$poster_id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if(strtotime($rows['ftime'])>strtotime(date("Y-m-d H:i:s"))){
	    echo $rows['ftime'];
		exit();
	}
	$sql="insert into $table_post(topic_id,poster_id,content,f_id,post_time,post_type) values('$topic_id','$poster_id','$content','$f_id','$date','2')";
	if(mysqli_query($link,$sql))
	    echo 2;
	
	$sql="update $table_post set re_count=re_count+1,post_re_time='$date',post_re_id='$poster_id' where id='$f_id'";
	mysqli_query($link,$sql);
}
if($_REQUEST['vc_id']){
	$id=$_REQUEST['vc_id'];
	$sql="update $table_post set view_count=view_count+1 where id='$id'";
	mysqli_query($link,$sql);
}
if($_REQUEST['praiser_id']&&$_REQUEST['post_id']){
	$praiser_id=$_REQUEST['praiser_id'];
	$post_id=$_REQUEST['post_id'];
	$date=date("Y-m-d");
	
	$sql="select count(*) from $table_praise where post_id='$post_id' and agreer_id='$praiser_id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if($rows[0]==0){
	   $sql="insert into $table_praise(post_id,agreer_id,date) values('$post_id','$praiser_id','$date')";
	   mysqli_query($link,$sql);
	   $sql="update $table_post set praise_num=praise_num+1 where id=".$post_id;
	   mysqli_query($link,$sql);
	   echo 1;
	}
	else
	   echo 2;
}
if($_REQUEST['reporter_id']){
	$reporter_id=$_REQUEST['reporter_id'];
	$post_id=$_REQUEST['post_id'];
	$content=$_REQUEST['content'];
	$date=date("Y-m-d");
	
	$sql="select count(*) from $table_peach where post_id='$post_id' and reporter_id='$reporter_id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if($rows[0]==0){
		$sql="insert into $table_peach(post_id,reporter_id,content,date) values('$post_id','$reporter_id','$content','$date')";
		mysqli_query($link,$sql);
		echo 1;
	}
	else
	   echo 2;
}
if($_REQUEST['collecter_id']){
	$collecter_id=$_REQUEST['collecter_id'];
	$post_id=$_REQUEST['post_id'];
	$date=date("Y-m-d");
	
	$sql="select count(*) from $table_collect where post_id='$post_id' and collecter_id='$collecter_id'";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	if($rows[0]==0){
		$sql="insert into $table_collect(post_id,collecter_id,date) values('$post_id','$collecter_id','$date')";
		mysqli_query($link,$sql);
		echo 1;
	}
	else
	   echo 2;
}
if($_REQUEST['deletetopic_id']){
	$id=$_REQUEST['deletetopic_id'];
//----------------------------如果是回复贴,原创帖回复数减一---------------------------------------------------
	$sql="select f_id,poster_id,topic_id from $table_post where id='$id'";                                       
	$result=mysqli_query($link,$sql);
	$rows=mysqli_fetch_array($result);
	
	$sql="update $table_post set re_count=re_count-1 where id='$rows[f_id]'";
	mysqli_query($link,$sql);
//----------------------------如果是回复贴,原创帖回复数减一---------------------------------------------------

    if($rows['f_id']==0){//如果将要删除的是原创帖
	    $sql="update $table_user set post_num=post_num-1 where id='$rows[poster_id]'";
	    mysqli_query($link,$sql);
		
        $sql="update $table_topic set post_count=post_count-1 where id='$rows[topic_id]'";
        mysqli_query($link,$sql);
		
	    $sql="delete from $table_settop where post_id='$id'";
	    mysqli_query($link,$sql);		
	}
	
	$sql="delete from $table_praise where post_id='$id'";
	mysqli_query($link,$sql);

	$sql="delete from $table_post where id='$id' or f_id='$id'";
	mysqli_query($link,$sql);
	

}
if($_REQUEST['reply_id']){
	$id=$_REQUEST['reply_id'];
	$sql="select * from $table_post where id='$id' and f_id!='0'";
	$result=mysqli_query($link,$sql);
	while($rows=mysqli_fetch_array($result)){
	   $sql2="select * from $table_user where id='$rows[poster_id]'";
	   $result2=mysqli_query($link,$sql2);
	   $rows2=mysqli_fetch_array($result2);
	
	   $text=$rows['id']."@@".$rows['title']."@@".$rows['content']."@@".$rows2['name']."@@".$rows['poster_id']."@@".$rows['post_time']."@@".$rows['re_count']."@@".$rows2['level']."@@".$rows['praise_num'];		
	}
	
}

if($_REQUEST['cancelcollect_id']){
	$id=$_REQUEST['cancelcollect_id'];
	$sql="delete from $table_collect where id='$id'";
	mysqli_query($link,$sql);
}
if($_REQUEST['spanid']){
	$id=$_REQUEST['spanid'];
	$rank=$_REQUEST['rank'];
	$time=date("Y-m-d H:i:s",strtotime($rank." hours"));
	
	$sql="update $table_user set ftime='$time' where id='$id'";
	if(mysqli_query($link,$sql))
	   echo 1;
	else
	   echo 2; 
}
if($_REQUEST['wipe_id']){
	$id=$_REQUEST['wipe_id'];
	$sql="delete from $table_peach where id='$id'";
	if(mysqli_query($link,$sql))
	    echo 1;
}
if($_REQUEST['settop_pid']){
	$post_id=$_REQUEST['settop_pid'];
	$topic_id=$_REQUEST['settop_tid'];
	$date=date("Y-m-d");
	$sql="select * from $table_settop where post_id='$post_id' and topic_id='$topic_id'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_num_rows($result);
	
	if($row!=0){
		$sql="delete from $table_settop where post_id='$post_id' and topic_id='$topic_id'";
		mysqli_query($link,$sql);
		
		$sql="insert into $table_settop(post_id,topic_id,is_top,date) values('$post_id','$topic_id',1,'$date')";
		mysqli_query($link,$sql);
	}
	else{
		$sql="insert into $table_settop(post_id,topic_id,is_top,date) values('$post_id','$topic_id',1,'$date')";
		mysqli_query($link,$sql);		
	}
}
if($_REQUEST['canceltop_pid']){
	$post_id=$_REQUEST['canceltop_pid'];
	$topic_id=$_REQUEST['canceltop_tid'];	
	
	//echo $post_id."  ".$topic_id;
	$sql="update $table_settop set is_top=2 where post_id='$post_id' and topic_id='$topic_id'";
    mysqli_query($link,$sql);
}
?>




































