<?php
require_once ("jpgraph/jpgraph.php");
require_once ("jpgraph/jpgraph_pie.php");
require_once ("jpgraph/jpgraph_pie3d.php");
require_once ("conf.php");
$sql="select * from $table_itemlist";
$data = array();
$item=array("收入","支出");
$result=mysqli_query($link,$sql);
$temp1=0;
while($rows=mysqli_fetch_array($result)){
	$temp1+=$rows['price']*$rows['number'];
}
$sql2="select * from $table_medicine";
$result2=mysqli_query($link,$sql2);
$temp2=0;
while($rows2=mysqli_fetch_array($result2)){
	$temp1+=($rows2['amount']-$rows2['rest'])*$rows2['price'];
	$temp2+=$rows2['amount']*$rows2['cost'];
}
array_push($data,$temp1);
array_push($data,$temp2);
$graph = new PieGraph(600,500);
$graph->SetShadow();
$graph->title->Set("医院收入与支出");
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);

$pieplot = new PiePlot3D($data);  //创建PiePlot3D对象
$pieplot->SetCenter(0.5, 0.4); //设置饼图中心的位置
$pieplot->SetLegends($item); //设置图例
$graph->Add($pieplot);
$graph->Stroke();
?>