<meta charset="UTF-8">
<?php
$dsa = '[{"id":1,"title":"内容"}]';
$str=json_decode($dsa);
var_dump($str[0]->title);
?>