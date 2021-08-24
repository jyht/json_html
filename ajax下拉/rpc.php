<?php
header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="d";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');

$queryString = $_POST['queryString'];
if(strlen($queryString) >0) {
$sql= "SELECT word FROM dashuju WHERE word LIKE '".$queryString."%' LIMIT 10";
$query = mysqli_query($conn,$sql);
while ($result = mysqli_fetch_array($query)){
$value=$result['word'];
echo '<li onClick="fill(\''.$value.'\');">'.$value.'</li>';
}
}
?>