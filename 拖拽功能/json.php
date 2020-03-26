<?php

//$arr =  explode(",",$_GET['js']);
//var_dump($arr);
header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="xing";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');

mysqli_query($conn,'update a set xulie=\''.$_GET['js'].'\' where id=1');


?>