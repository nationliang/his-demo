<?php
require_once ("jpgraph/jpgraph.php");
require_once ("jpgraph/jpgraph_bar.php");
require_once ("conf.php");
$names=array();
$data=array();
$sql="select name,amount,rest from $table_medicine";
$result=mysqli_query($link,$sql);
while($rows=mysqli_fetch_array($result)){	
	//array_push($names,$rows['name']."(入库)");
	//array_push($data,$rows['amount']);	
	array_push($names,$rows['name']."(出库)");	
	array_push($data,$rows['amount']-$rows['rest']);	
}

$graph = new Graph(1000,350);  //创建新的Graph对象
$graph->SetScale("textlin");  //刻度样式
$graph->SetShadow();          //设置阴影
$graph->img->SetMargin(40,30,40,50); //设置边距   

$barplot = new BarPlot($data);  //创建BarPlot对象
$barplot->SetFillColor('#2382EB'); //设置颜色
$barplot->value->Show(); //设置显示数字
$graph->Add($barplot);  //将柱形图添加到图像中
 
$graph->title->Set("药品出库统计"); 

$graph->xaxis->title->Set("药名"); //设置标题和X-Y轴标题
$graph->yaxis->title->Set("数量(个)");                                                                      
$graph->title->SetColor("red");
$graph->title->SetMargin(10);
$graph->img->SetMargin(60,30,30,50);
$graph->yaxis->title->SetMargin(10);
$graph->xaxis->title->SetMargin(5);
$graph->xaxis->SetTickLabels($names);
 
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);  //设置字体
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
$graph->Stroke();
?>