<?php
	function get($url,$functions){
		
		$a = call_user_func($functions);
		var_dump($a);
	}
	
	
	
	get('1',function(){
		return '232';
	});
?>