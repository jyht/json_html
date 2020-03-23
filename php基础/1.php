<meta charset="UTF-8">
<?php
$conn=@mysql_connect('127.0.0.1','root','');
mysql_select_db('av',$conn) or die('数据库不存在');
mysql_query('set names utf8');

$result = mysql_query('select * from article limit 2,13');


function mysql_fetch_full_result_array($result)

{

   $table_result=array();

   $r=0;

   while($row = mysql_fetch_assoc($result)){

       $arr_row=array();

       $c=0;

       while ($c < mysql_num_fields($result)) {        

           $col = mysql_fetch_field($result, $c);    

           $arr_row[$col -> name] = $row[$col -> name];            

           $c++;

       }    

       $table_result[$r] = $arr_row;

       $r++;

   }    

   return $table_result;
}   
$dsa = mysql_fetch_full_result_array(mysql_query('select id,title from article limit 2,13'));

echo $str=json_encode(array($dsa));
?>