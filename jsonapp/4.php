<?php
    
function demos(){
	
	
$array = array("Eric",23);
        $data=[
            'status'=>200,
            'msg'=>'ok',
			'body'=>$array
        ];
        return json_encode($data);
    }

echo demos();
?>