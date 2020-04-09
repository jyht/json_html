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

	
$dsa = mysqli_query($conn,'select *,txt.status as status2 from txt LEFT JOIN `user` ON txt.uid=`user`.user_id limit 0,10');
$arr = array();
while($row = mysqli_fetch_array($dsa))
{

	$string =stripcslashes($row['content']);

	if($fenlei=='sy')
	{
		//首页
		$asd = "$string";
	}else{
		$zhyyao =array('title'=>'除了胜利，我们别无选择','content'=>"$string");
		$asd = json_encode($zhyyao,JSON_UNESCAPED_UNICODE);
	}

	$arr[] = array('pid'=>''.$row['pid'].'','uid'=>''.$row['uid'].'','content'=>"$asd",'postDate'=>''.$row['postDate'].'','readCnt'=>''.$row['readCnt'].'','praiseCnt'=>''.$row['praiseCnt'].'','images'=>''.$row['images'].'','type'=>''.$row['type'].'','status'=>''.$row['status2'].'','imageNum'=>''.$row['imageNum'].'','user'=>array('id'=>''.$row['id'].'','user_id'=>''.$row['user_id'].'','name'=>''.$row['name'].'','nickName'=>''.$row['nickName'].'','sex'=>''.$row['sex'].'','location'=>''.$row['location'].'','age'=>''.$row['age'].'','register_time'=>''.$row['register_time'].'','avatar'=>''.$row['avatar'].'','avatar_thumb'=>''.$row['avatar_thumb'].'','notes'=>''.$row['notes'].'','score'=>''.$row['score'].'','fans'=>''.$row['fans'].'','praise'=>''.$row['praise'].'','last_login_time'=>''.$row['last_login_time'].'','status'=>''.$row['status'].'','bornDate'=>''.$row['bornDate'].'','lastLaunchDate'=>''.$row['lastLaunchDate'].'','zanCnt'=>''.$row['zanCnt'].'','fanCnt'=>''.$row['fanCnt'].''));
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