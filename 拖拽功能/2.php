<?php
header("Content-type: text/html; charset=utf-8");        
$mysql_server="localhost";
$mysql_username="root";
$mysql_password="";
$mysql_database="xing";
$conn = mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database);
mysqli_query($conn,'set names utf8');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI 拖动（Draggable） - 约束运动</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
 <!--  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css"> -->
  <style>
    *{
      margin:0;
      padding: 0;
      box-sizing: border-box;
    }
    .container{
      border: 1px solid black;
      margin-bottom: 10px;
      margin-top: 10px;
    }
    .container:after{
      content: "";
      display: block;
      clear: both;
    }
    .drag{
      width: 200px;
      height: 200px;
      float: left;
    }
    ul li {
      list-style: none;
    }
    .innerdiv{
      padding: 10px;
      height: 100%;
    }
    .innerdiv2{
        background: grey;
        height: 100%;
      }
    #draggable1{
      width: 400px;
      height: 400px;
    }
  .move{
    width: 80px;
    height: 40px;
    background: blanchedalmond;
  }
  </style>
  <script>
  $(function() {
    var arr = '';
    var sort = $( ".sortable" ).sortable({
        handle: ".move",
        opacity: 0.7,
        delay: 150,
        cursor:'move',
        revert: true,
        stop:function(){
 //记录sort后的id顺序数组
        var arr = $( ".sortable" ).sortable('toArray');
            //console.log(arr);
            htmlobj=$.ajax({url:"json.php?js="+arr,async:false});
			//console.log(JSON.stringify(arr));
			
        }
    });
  });
  </script>
</head>
<body>
   <div class="container">
     <div class="sortable">
	 <?php
			$sql_menp = 'select * from a where id=1';
			$row_menp =mysqli_fetch_array(mysqli_query($conn,$sql_menp));
			$arr =  explode(",",$row_menp['xulie']);
			for($i=0;$i<count($arr);$i++)
		{
	 ?>
         <div id="<?php echo $arr[$i];?>" class="drag">
            <div class="innerdiv">
               <div class="innerdiv2">
                 <div class="move">拖拽</div> 
				 <?php
				 $a =$arr[$i];
				 $sql_a= "select * from model where model_id='$a'";
				 $row_1 =mysqli_fetch_array(mysqli_query($conn,$sql_a));
				 echo $row_1['txt'];
				 ?>
                 
               </div>
           </div>
         </div>
      <?php
		 }
	  ?>
     </div>
   </div>
 
</body>
</html>