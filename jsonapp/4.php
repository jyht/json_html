<?php

header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="av2";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');





	
$dsa = mysqli_query($conn,'select name,name_bie from nv_name limit 0,10');
$arr = array();
while($row = mysqli_fetch_array($dsa))
{
	$arr[] = array('name'=>''.$row['name'].'','name_bie'=>''.$row['name_bie'].'');
}

$array = array("Eric",23);
        $data=[
            'status'=>200,
            'msg'=>'ok',
			'body'=>$arr
        ];
echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>