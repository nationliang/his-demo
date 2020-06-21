<?php
echo "<html>";
echo "<head>";
echo "<title>创建数据库表</title>";
echo "</head>";
echo "<body>";
echo "<center>";
echo "
      <script language=\"javascript\">
	  function juge(theForm){
		  if(theForm.user.value==\"\"){
		       alert(\"请输入管理员名称！\");
			   theForm.user.focus();
			   return (false);
		  }
		  if(theForm.pass.value==\"\"){
			 alert(\"请输入管理员密码!\");
			 theForm.pass.focus();
			 return (false);
		  }
		  if(theForm.repass.value!=theForm.pass.value){
			 alert(\"重复输入的密码不一致！\");
			 theForm.repass.focus();
			 return (false);
		  }
	  }
	  </script>
     ";
if(!$_POST['user']){
echo "<table>";
echo "<tr>";
echo "<td><h2>创建数据库表</h2></td>";
echo "</tr></table>";
echo "<table width=\"80%\" cellspacing=\"1\" cellpadding=\"1\">";
echo "<form method=post action=\"$_SERVER[PHP_SELF]\" onsubmit=\"return juge(this)\">";
echo "<tr>";
echo "<td>输入管理员名称：</td>";
echo "<td>";
echo "<input type=text name=user>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>输入管理员密码：</td>";
echo "<td>";
echo "<input type=password name=pass>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>输入确认密码：</td>";
echo "<td>";
echo "<input type=password name=repass>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>输入表前缀：</td>";
echo "<td>";
echo "<input type=text name=pre value=\"\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=\"center\" colspan=\"2\"><input type=submit value=\"提交\">&nbsp;";
echo "<input type=reset value=\"重置\"></td>";
echo "</tr>";
echo "</form>";
echo "</table>";
echo "</center>";
echo "</body>";
echo "</html>";
}
else{
	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	$pre=$_POST['pre'];
	$date=date("Y 年 m 月 d 日");
	require "conf.php";
	$table_patient=$pre.$table_patient;
	$table_doctor=$pre.$table_doctor;
	$table_user=$pre.$table_user;
	$table_medicine=$pre.$table_medicine;
	$table_itemlist=$pre.$table_itemlist;
	$table_department=$pre.$table_department;
	$table_arrange=$pre.$table_arrange;	
	$table_pilllist=$pre.$table_pilllist;	
	$table_costlist=$pre.$table_costlist;	
	$table_disease=$pre.$table_disease;	
	$table_article=$pre.$table_article;	
	$table_post=$pre.$table_post;	
	$table_topic=$pre.$table_topic;	
	$table_praise=$pre.$table_praise;
	$table_settop=$pre.$table_settop;
	$table_peach=$pre.$table_peach;
	$table_collect=$pre.$table_collect;		
	$sql="create table $table_patient(
									  id int(5) auto_increment not null primary key comment '病人id',
									  name varchar(20) comment '病人姓名',
									  age varchar(20) comment '年龄',
									  idnum varchar(20) comment '身份证号',
									  borntime varchar(20) comment '出生年月日',
									  address varchar(80) comment '住址',
									  sex enum('man','woman') default 'man',
									  phonenumber varchar(20),
									  allergic_his varchar(80) comment '过敏史',
									  d_id int(5) comment '所挂号的医生id',
									  dep_id int(5) comment '所挂号的科室id,doctor表里的id',
									  cost int(10)  comment '治疗花费',
									  treat enum('yes','no') default 'no' comment '是否已接诊',
									  registrationtype enum('1','2','3','4') default '1' comment '3表示未挂号,4已就诊完毕,1表示普通门诊，2表示急诊',
									  pill enum('yes','no') default 'no' comment '是否已开药',
									  pay enum('yes','no') default 'no' comment '是否已付费',
									  judge varchar(100) comment '诊断详情',
									  treatment varchar(200) comment '治疗方案',
									  symptom varchar(200) comment '症状',
									  date varchar(20) comment '挂号时间',
									  time varchar(20) comment '上:m,下:a,晚:e',
									  pp_id varchar(20) comment '病人表指向用户表的父id',
									  casid int(5) comment '收银员id',
									  medid int(5) comment '派药员id'
									  )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_doctor(
									 id int(5) not null auto_increment primary key,
									 name varchar(20),
									 position varchar(20) default '主治医师' comment '职称',
									 sex enum('man','woman') not null default 'man',
									 maritalstatus enum('是','否') not null default '否' comment '是否已婚',
									 phonenumber varchar(20),
									 department varchar(20) comment '所属科室',
									 description text comment '个人简介',
									 entrytime varchar(20) comment '入职时间',
									 workingyear varchar(20) comment '工龄',
									 age int(5)
									 )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_medicine(
									  id int(5) auto_increment primary key,
									  name varchar(20),
									  description varchar(100),
									  kind enum('0','1') default '0' comment '1为处方药，0非为处方药',
									  price int(20) comment '药品单价',
									  amount int(20) comment '入库数量',
									  rest int(20) comment '剩余库存',
									  date varchar(20) comment '入库时间',
									  cost int(5) comment '成本'
									  )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_user(
									id int(5) auto_increment primary key,
									priority varchar(20) default 'patient' comment '登录用户优先级，分为admin,patient,doctor,drug',
									name varchar(20),
									password varchar(50),
									p_id int(5) default '0' comment '在doctor表里的id',
									date varchar(30),
                                    sex enum('boy','girl') not null default 'boy',
									q_name varchar(200) not null default '' comment '论坛签名',
									post_num int(5) not null default '0' comment '论坛发帖总数',
									level int(5) not null default '0' comment '论坛等级',
									ftime varchar(45) default '0' comment '禁言截止时间'
									)";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_department(
										  id int(5) auto_increment primary key,
										  name varchar(20),
										  members_num int(20) comment '科室人员数量'
										  )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_itemlist(
									   id int(5) auto_increment primary key,
									   name varchar(20),
									   price int(20) default '0',
									   number int(20) default '0' comment '该收费项收费次数'
									   )";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$sql="create table $table_arrange(
									  id int(5) auto_increment primary key not null,
									  week varchar(20) comment '星期一：Monday 星期二：Tuesday 星期三：Wednesday 星期四：Thursday 星期五：Friday 星期六：Saturday 星期日：Sunday',
									  mor varchar(20) comment '上午',
									  aft varchar(20) comment '下午',
									  eve varchar(20) comment '晚上',
									  dep varchar(20) comment '科室',
									  date varchar(20) comment '日期',
									  mornum int(11) default '0' comment '医生最大可接受挂号数',
									  aftnum int(11) default '0' comment '医生最大可接受挂号数',
									  evenum int(11) default '0' comment '医生最大可接受挂号数'
									  )";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$sql="create table $table_pilllist(
									   id int(5) auto_increment primary key not null,
									   name varchar(20),
									   price float,
									   amount int(5),
									   totalprice float,
									   p_id int(5) comment 'Patient表里的的ID',
									   kind enum('0','1') default '0' comment '1为处方药，0非为处方药',
									   date varchar(50),
									   d_id int(5) comment 'user表里的doctor的id',
									   issubmit enum('0','1') default '0' comment '是否已提交'									   
									   )";
	mysqli_query($link,$sql);
	$sql="create table $table_costlist(
									   id int(5) primary key auto_increment not null,
									   name varchar(20),
									   cost float,
									   p_id int(5) comment 'Patient表里的的ID',
									   date varchar(50),
									   d_id int(5) comment 'user表里的doctor的id',
									   issubmit enum('0','1') default '0' comment '是否已提交'
									   )";

	mysqli_query($link,$sql);
	$sql="create table $table_article(
									 id int(5) primary key auto_increment not null,
									 title varchar(45),
									 author varchar(45),
									 content text,
									 kind varchar(45),
									 date varchar(45)
									 )";
    mysqli_query($link,$sql) or die(mysqli_error($link));	
	$sql="create table $table_topic(
									id int(5) not null auto_increment primary key,
									p_id int(5) not null default '0' comment 'department表里的id',
									topic_name varchar(12) not null default '' comment '分主题名称',
									topic_description varchar(80) not null default '' comment '该分类别简介',
									post_count int(5) not null default '0' comment '该分类别的帖子总数',
									setter varchar(45) comment '创建者',
									date varchar(45)									
									)";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_post(
									id int(5) not null auto_increment primary key,
									topic_id int(5) not null default '0' comment 'topic表里的id',
									poster_id int(5) not null default '0' comment '记录发帖者的编号,user表里的id',
									title varchar(40) not null default '' comment '记录帖子标题',
									content text not null comment '记录帖子内容',
									view_count int(5) not null default '0' comment '记录帖子浏览量',
									re_count int(5) not null default '0' comment '记录帖子回复量',
									post_time varchar(40) not null default '' comment '记录发帖时间',
									post_re_time varchar(40) not null default '' comment '记录帖子最后回复时间',
									post_type enum('原创帖','回复贴') default '原创帖',
									f_id int(5) default '0' comment '回复贴的父id,post表里的id',
									post_re_id int(5) default '0' comment '记录最后回复者的id,user表里的id',
									praise_num int(11) default '0' comment '获得的点赞总数'
									)";
    mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_praise(
							   id int(11) not null auto_increment primary key,
							   post_id int(11) comment 'post表里的id',
							   agreer_id int(11) comment '点赞者的user表里的id',
							   date varchar(40)
							   )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_settop(
							   id int(11) not null auto_increment primary key,
							   topic_id int(11) comment 'topic表里的id',
							   post_id int(11) comment 'post表里的id',
							   date varchar(40),
							   is_top enum('yes','no') default 'no' comment '是否设置过置顶'
							   )";
	mysqli_query($link,$sql) or die(mysqli_error($link));	
	$sql="create table $table_peach(
							   id int(11) not null auto_increment primary key,
							   post_id int(11) comment 'post表里的id',
							   reporter_id int(11) comment 'user表里的id,举报者的id',
							   content varchar(45) comment '举报内容',
							   date varchar(40)
							   )";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="create table $table_collect(
							   id int(11) not null auto_increment primary key,
							   post_id int(11) comment 'post表里的id',
							   collecter_id int(11) comment 'user表里的id,收藏者的id',
							   date varchar(40)
							   )";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$sql="create table $table_disease(
							   id int(11) not null auto_increment primary key,
							   name varchar(40) not null ,
							   symptom text not null ,
							   department varchar(40) not null
	                           )";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$date=$time=date("Y 年 m 月 d 日");
	$sql="insert into $table_user(priority,name,password,date) values('admin','$user','$pass','$date')";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	

	$sql="insert into $table_disease(name,symptom,department) values('普通感冒','流鼻涕,鼻塞,打喷嚏,流眼泪,发烧,咳嗽,咽痛,声音嘶哑,全身无力','呼吸内科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$sql="insert into $table_disease(name,symptom,department) values('咽炎，扁桃体炎，喉炎','咽痛，咽干，咽痒，吞咽疼痛，吞咽困难，声音嘶哑，咽部异物感（吞之不下，吐之不出）','耳鼻喉科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	
	$sql="insert into $table_disease(name,symptom,department) values('细菌性结膜炎（红眼病）','有明显的灼热感，异物感，或伴畏光流泪，视力一般不受影响','眼科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));	
	
	$sql="insert into $table_disease(name,symptom,department) values('急性胃肠炎（肠胃炎）','恶心、呕吐、腹痛、腹泻、发热','消化内科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));	
	
	$sql="insert into $table_disease(name,symptom,department) values('痔疮','大便带血，便血为鲜红色，不伴有疼痛，在排便时发生鲜血沾附于粪便之外，不相混合，便血量一般不大，但也可呈喷射状出血，在排便后不久即止','外科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));	
	
	$sql="insert into $table_disease(name,symptom,department) values('尿路结石','腰腹绞痛，血尿或伴有尿频、尿急、尿痛，下腹部疼痛','泌尿外科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));	
	
	$sql="insert into $table_disease(name,symptom,department) values('口腔溃疡','口腔的唇、颊、软腭或齿龈等处的粘膜多见，发生单个或者多个大小不等的圆形或椭圆形溃疡，表面覆盖灰白或黄色假膜，中央凹陷，边界清楚，周围粘膜红而微肿，溃疡局部灼痛明显，具有周期性、复发性、自限性的特征','口腔科')";
	mysqli_query($link,$sql) or die(mysqli_error($link));

	$sql="insert into $table_department(name,members_num) values('内科',8),('外科',8),('妇产科',10),('男科',11),('儿科',15),('五官科',14),('肿瘤科',8),('传染科',9),('中医科',8)";
	mysqli_query($link,$sql) or die(mysql_error($link));
	$sql="insert into $table_medicine(name,description,kind,price,amount,rest,date,cost) values('复方益肝灵','片剂','0',6,200,156,'$date',3),('感冒清','胶囊剂','0',7,300,263,'$date',5),('狗皮膏','胶囊膏剂','0',12,150,98,'$date',8),('骨通贴膏','胶囊膏剂','0',11,269,120,'$date',6),('骨仙','片剂','0',14,253,142,'$date',11),('黄连上清','片剂','0',6,460,110,'$date',3)";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	$sql="insert into $table_itemlist(name,price,number) values('挂号费',10,0),('粪便检查',60,256),('钾测定',36,130),('尿素测定',35,245),('鼓膜穿刺术',98,56),('辅助呼吸',152,96),('麻醉',65,520),('胃手术',162,240)";
	mysqli_query($link,$sql) or die(mysqli_error($link));
	
    $fp=fopen("conf.php","w+");
    fputs($fp,"<?php \n");
    fputs($fp,"\$db_host=\"localhost\"; \n");
    fputs($fp,"\$db_user=\"root\"; \n");
    fputs($fp,"\$db_pass=\"hgl2000\"; \n");
    fputs($fp,"\$db_name=\"his\"; \n");
    fputs($fp,"\$table_patient=\"$table_patient\"; \n");
    fputs($fp,"\$table_doctor=\"$table_doctor\"; \n");
    fputs($fp,"\$table_medicine=\"$table_medicine\"; \n");
    fputs($fp,"\$table_user=\"$table_user\"; \n");
    fputs($fp,"\$table_department=\"$table_department\"; \n");
    fputs($fp,"\$table_itemlist=\"$table_itemlist\"; \n");	
    fputs($fp,"\$table_arrange=\"$table_arrange\"; \n");
    fputs($fp,"\$table_pilllist=\"$table_pilllist\"; \n");	
    fputs($fp,"\$table_costlist=\"$table_costlist\"; \n");
    fputs($fp,"\$table_disease=\"$table_disease\"; \n");	
	fputs($fp,"\$table_article=\"$table_article\"; \n");	
    fputs($fp,"\$table_post=\"$table_post\"; \n");	
	fputs($fp,"\$table_topic=\"$table_topic\"; \n");
	fputs($fp,"\$table_praise=\"$table_praise\"; \n");
	fputs($fp,"\$table_settop=\"$table_settop\"; \n");
	fputs($fp,"\$table_peach=\"$table_peach\"; \n");
	fputs($fp,"\$table_collect=\"$table_collect\"; \n");		
    fputs($fp,"\$link=mysqli_connect(\$db_host,\$db_user,\$db_pass); \n");
    fputs($fp,"mysqli_select_db(\$link,\$db_name); \n");
    fputs($fp,"?>");
    fclose($fp);	
	echo "<html>";
	echo "<head>";
	echo "<title>安装程序</title>";
	echo "</head>";
	echo "<body>";
	echo "</center>";
	echo "<table width=\"80%\" cellpadding=\"1\" cellspacing\"1\" align=\"center\">";
	echo "<tr>";
	echo "<td align=\"center\"><font size=\"5px\">医疗信息管理系统安装程序</font></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=\"center\"><font size\"3px\">成功安装！</font></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=\"center\">点<a href=\"login.php\">这里</a>进入</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
	echo "</body>";
	echo "</html>";	
}

?>



































