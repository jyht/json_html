<?php
header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="app";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');
        
		$arr= array('msg'=>'这是系统提示','detailUrl'=>'');
		$data=[
            'status'=>200,
            'msg'=>'ok',
			'body'=>$arr
        ];

echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>