<?php
/*
* 2016年9月29日08:09:13
*/
session_start();
header("Content-Type: text/html;charset=utf-8");
function set_token() {
  $_SESSION['token'] = md5(microtime(true));
}
function valid_token() {
  $return = $_REQUEST['token'] === $_SESSION['token'] ? true : false;
  set_token();
  return $return;
}
//如果token为空则生成一个token
if(!isset($_SESSION['token']) || $_SESSION['token']=='') {
  set_token();
}
if(isset($_POST['web'])){
  if(!valid_token()){
    echo "token error，请不要重复提交！";
  }else{
    echo '成功提交，Value:'.$_POST['web'];
  }
}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>PHP防止重复提交表单</title>
<meta name="keywords" content="PHP" />
<meta name="description" content="PHP防止重复提交表单" />
</head>
<body>
<div id="main">
  <div class="demo">
    <form method="post" action="">
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
      <input type="text" class="input" name="web" value="脚本之家">
      <input type="submit" class="btn" value="提交" />
    </form>
  </div>
</div>
</body>
</html>
<?php }?>