<meta charset="utf-8" />
<?php
define("JAVA_HOSTS", "127.0.0.1:8080");
require_once("java/Java.inc"); //php调用java的接口，路径问题需要注意
java_set_file_encoding("UTF-8"); //设置JAVA编码。

$test=new Java("com.meimeixia.lucene.jyht");

$ass = json_decode($test->select("古墓"));
var_dump($ass);

//$str=json_decode($arr);

 
?>