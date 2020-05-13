<?php

header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="app";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');


//category=sy&subType=0&pageNumber=1
$fenlei = @$_POST['category'];

	
$dsa = mysqli_query($conn,'select * from a');
$arr = array();

while($row = mysqli_fetch_array($dsa))
{
	$arr[] = array('title'=>$row['title'],'txt'=>$row['txt']);

}
	$data=[
		'data'=>$arr
	];	
$a = str_replace('\\\\', '\\', json_encode($data,JSON_UNESCAPED_UNICODE));
echo $a;
?>