
<?php 
	
	/*
	set_time_limit(0);
	for($num=116;$num<200;$num++)
	{
		$nu_new = $num*15;
		$numf=str_pad($nu_new,6,"0",STR_PAD_LEFT); //$num.ts
		$url = "https://x4y8.qq360cn.com/hls/5013603/".$nu_new."/raw.ts";
		$content = file_get_contents($url);
		file_put_contents($numf.'.ts', $content);//写入
	}
	
	*/
	$udsa = 'https://api.syclzg.cn/v1/media/uVd992gIc9oMsVNmdcH92WeZJJCSSuIlaQyKlVKYCNQOPBQkDtl6adbDJ3DlndLCPIdVGwp6HFptRuRC_TIhmlQ7sjUYArPFcuatxRHhSi4ekELVCEWBT4P56vplQEq2.m3u8?'; 
	$contents = file_get_contents($udsa);
	//echo $contents;
	//die();
	preg_match_all("/https:(.*).ts/",$contents,$arr);
	//var_dump($arr[0]);
	//die();

	$count =count($arr[0]);
	set_time_limit(0);
	for($num=0;$num<$count;$num++)
	{
		$url = $arr[0][$num];
		//echo $url.'<br>';
		$content = file_get_contents($url);
		file_put_contents($num.'.ts', $content);//写入
	}	
		//密钥
		preg_match_all("/URI=\"(.*)\",/",$contents,$arr1);
		//$content1 = file_get_contents('https://tez.jyjnsc.com/'.$type.'/'.$sid.'/240/key.php');
		file_put_contents('1.key', file_get_contents($arr1[1][0]));//写入
		//解析
		$txt = '';
		$txt .= "#EXTM3U\n";
		$txt .= "#EXT-X-TARGETDURATION:5200\n";
		$txt .= "#EXT-X-KEY:METHOD=AES-128,URI=\"D:/wamp/www/ts/key/1.key\"\n";
		for($i=0;$i<$count;$i++){
			$txt .= "#EXTINF:0,\n";
			$txt .= "D:\wamp\www\\ts\key\\$i.ts\n";
		}
		$txt .= '#EXT-X-ENDLIST';
		//echo $txt;
		
		//写入m3u8
		file_put_contents('tsmaster.m3u8', $txt);//写入
		sleep(3);
		exec('ffmpeg -allowed_extensions ALL -i tsmaster.m3u8 -c copy '.time().'.mp4')
?>
	