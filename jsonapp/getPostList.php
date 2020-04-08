<?php

header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="app";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');





	
$dsa = mysqli_query($conn,'select * from txt LEFT JOIN `user` ON txt.uid=`user`.user_id limit 0,10');
$arr = array();
while($row = mysqli_fetch_array($dsa))
{
	//注释22行,""就可以解析\n 不会转义
	//$string = "as</br>12村已堵，\n路已封，\n为了安全躲家中。[傲慢]\n新肺炎，\n扩散快，\n严防死守这一带。[拳头]\n一人染，\n全家病，\n严重起来真要命！";
	//24行 读取数据库字段的就无法解析 json 会转义变成\\n
	$string =stripcslashes($row['content']);  //  \\n新肺炎，\\n扩散
	$zhyyao =array('title'=>'das','content'=>"$string");
	//$zhyyao = addslashes($zhyyao);
	$asd = json_encode($zhyyao,JSON_UNESCAPED_UNICODE);
	$arr[] = array('pid'=>''.$row['pid'].'','uid'=>''.$row['uid'].'','content'=>array('title'=>"$row[title]",'content'=>"$asd"),'postDate'=>''.$row['postDate'].'','readCnt'=>''.$row['readCnt'].'','praiseCnt'=>''.$row['praiseCnt'].'','images'=>''.$row['images'].'','type'=>''.$row['type'].'','status'=>''.$row['status'].'','imageNum'=>''.$row['imageNum'].'','user'=>array('id'=>''.$row['id'].'','user_id'=>''.$row['user_id'].'','name'=>''.$row['name'].'','nickName'=>''.$row['nickName'].'','sex'=>''.$row['sex'].'','location'=>''.$row['location'].'','age'=>''.$row['age'].'','register_time'=>''.$row['register_time'].'','avatar'=>''.$row['avatar'].'','avatar_thumb'=>''.$row['avatar_thumb'].'','notes'=>''.$row['notes'].'','score'=>''.$row['score'].'','fans'=>''.$row['fans'].'','praise'=>''.$row['praise'].'','last_login_time'=>''.$row['last_login_time'].'','status'=>''.$row['status'].'','bornDate'=>''.$row['bornDate'].'','lastLaunchDate'=>''.$row['lastLaunchDate'].'','zanCnt'=>''.$row['zanCnt'].'','fanCnt'=>''.$row['fanCnt'].''));
}





        $data=[
            'status'=>200,
            'msg'=>'ok',
			'body'=>$arr
        ];
//$str="this is a test \\n";

$a = str_replace('\\\\', '\\', json_encode($data,JSON_UNESCAPED_UNICODE));
echo $a;
?>