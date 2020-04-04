<meta charset="UTF-8">
<?php
header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="xing";
//建立数据库链接
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');
set_time_limit(0);
error_reporting(0);


//HTTP请求（支持HTTP/HTTPS，支持GET/POST）
function http_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
	$sql="select * from name where ccf='' and dyf='' limit 0,500";
	$arrsad = mysqli_query($conn,$sql);
	while( $row =mysqli_fetch_array($arrsad))
	{	
		sleep(12);
		//echo $row['name'].'<br>';
		$res = http_request('http://www.starsdy.com/plus/search.php', 'keyword='.urlencode(iconv('UTF-8', 'GB2312',$row['name'])));
		$string_url = iconv('GB2312', 'UTF-8', $res);
		
		$pattern = '/ss-one">\<a href="(.*)" target="_blank"\>/';
		preg_match($pattern, $string_url, $match); 

		$url2 = 'http://www.starsdy.com'.$match[1];
		//echo $url2.'<br>';
		$arr2 = file_get_contents($url2);
		$string_url2 = iconv('GB2312', 'UTF-8',$arr2);
		
	//-----------------------
		$pattern1 = '/代言费：(.*)万+/';
		preg_match($pattern1, $string_url2, $match1); 
		$j1 = strtok($match1[1], '万');//万前面所有字符串
		
		
		$pattern2 = '/出场费：(.*)万/';
		preg_match($pattern2, $string_url2, $match2); 
		$j2 =$match2[1];
		
		//echo $j1.'---'.$j2.'<br>';
		if($j1=='')
		{
			$j1= 'no';
		}
		if($j2=='')
		{
			$j2= 'no';
		}
		echo "update name set ccf='$j2',dyf='$j1' where name='".$row['name']."';<br>";
	}

?>