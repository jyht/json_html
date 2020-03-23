<?php
function aa(){
	static $i = 0;
	
	$i++;
	
	if($i<10)
	{
		echo $i;	
		aa();
	}else{
		$b = 20-$i;
		
		if($b >0)
		{
			echo $b;
			aa();
		}
	}
	
	
	
}

aa();
?>