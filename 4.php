<?php
    
function demos(){
        $data=[
            'status'=>200,
            'msg'=>'ok'
			'body'
        ];
        return json_encode($data);
    }

echo demos();
?>