<?php 
//列表页面
//http://www.huizhuangj.com/index.php?m=content&c=index&a=lists&catid=12
include 'conn.php'; 
include 'config.php';  //$row_webconfig
include 'cls_page1.php';
$p=isset($_GET['p']) ? $_GET['p'] : 1;
$_GET['k'] = intval(@$_GET['k']);
$_GET['f'] = intval(@$_GET['f']);
//多级分类
//echo $_SERVER["QUERY_STRING"];p=3&d=2
	

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title><?php echo $row_webconfig['text1']; ?></title>
    <meta name="keywords" content="<?php echo $row_webconfig['text2']; ?>">
    <meta name="description" content="<?php echo $row_webconfig['text3']; ?>">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no, email=no" name="format-detection">
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/idangerous.swiper.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <script src="/js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/idangerous.swiper.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/jquery.SuperSlide.2.1.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/city.js" type="text/javascript" charset="utf-8"></script>
    <script src='/js/main.js'></script>
</head>
<body>
    <div class='header'>
        <div class="container">
            <div class="logo"><img src="<?php echo $row_webconfig['text4']; ?>"/></div>
            <a class="load">
                <img src="/images/load.png"/>
                <p>烟台</p>
                <div class="clear"></div>
            </a>
<?php
//nav
	$sql_nav = 'select name from nav order by sort desc, id desc';
	$request_nav = mysqli_query($conn,$sql_nav);
	while($row_nav = mysqli_fetch_array($request_nav))
	{
		$data_nav[] = $row_nav;
	}
	//echo $data_nav[0]['name'];
$url =URL;
$nav1= $data_nav[0][0];
$nav2= $data_nav[1][0];
$nav3= $data_nav[2][0];
$nav4= $data_nav[3][0];
$nav5= $data_nav[4][0];
echo <<<EOT
            <div class="nav">
                <ul>
                    <li ><a href="$url">$nav1<span></span></a></li>
                                        <li class="m-12  navchoose">
                        <a href="$url/pubu.php" title="$nav2">$nav2<span></span></a>
                    </li>
                                        <li class="m-7  ">
                        <a href="$url/list.php" title="$nav3">$nav3<span></span></a>
                    </li>
                                        <li class="m-8  ">
                        <a href="$url/fangan.php" title="$nav4">$nav4<span></span><img src="/images/headertips.png"/></a>
                    </li>
                                        <li class="m-9  ">
                        <a href="$url" title="$nav5">$nav5<span></span></a>
                    </li>
                </ul>
            </div>
EOT;
?>	
            <div class="clear"></div>
        </div>
    </div>



        <div class="rending-wrap">
            <div class="container">
                <div class="rending-nav">
                    <div class="rending-now">
                        <ul>
                            <li><img src="/images/resultdot.png"/></li>
                            <li><a href="http://www.haolej.cn">首页</a></li>
                            <li>></li>
                            <li><a href="http://www.haolej.cn/meitu/">装修效果图</a></li>
                        </ul>
                    </div>
					<form id="filterForm" action="pubu.php" method="get">
                    <div class="rending-navbar">
                        <p>空间：</p>
                        <div id="qy" class="area-list">
                            <a href="/pubu.php?f=<?php echo $_GET['f']; ?>" <?php if(@$_GET['k']==0){echo 'class="ac"'; }?>>全部</a>
							<?php
								$sql_klist = 'select * from pubu_nav_kongjian order by sort desc';
								$request_klist = mysqli_query($conn,$sql_klist);
								while($klist_row = mysqli_fetch_array($request_klist))
								{
							?>
							<a <?php if($klist_row['id']==$_GET['k']){echo 'class="ac"'; }?> href="/pubu.php?k=<?php echo $klist_row['id'].'&f='.@$_GET['f']; ?>"><?php echo $klist_row['name']; ?></a>
							<?php
								}
							?>
						</div>
                    </div>
                    <div class="rending-navbar">
                        <p>风格：</p>
                        <div id="qy" class="area-list">
                            <a href="/pubu.php?k=<?php echo $_GET['k']; ?>" <?php if(@$_GET['f']==0){echo 'class="ac"'; }?>>全部</a>                                                        
							<?php
								$sql_flist = 'select * from pubu_nav_fengge order by sort desc';
								$request_flist = mysqli_query($conn,$sql_flist);
								while($flist_row = mysqli_fetch_array($request_flist))
								{
							?>
							<a <?php if($flist_row['id']==$_GET['f']){echo 'class="ac"'; }?> href="/pubu.php?k=<?php echo @$_GET['k'].'&f='.$flist_row['id']; ?>"><?php echo $flist_row['name']; ?></a>
							<?php
								}
							?>
						</div>
                    </div>
					</form>
                </div>
                <div class="rending-box">
                    <div class="rending-title">
                        <p>精美装修 效果图</p>
                        <b>风格介绍</b>
                    </div>
                    <div class="rending-list">
        
                        <div class="rending-text">
                            <p id="fgdes"> <?php echo $row_webconfig['text7']; ?></p>
                        </div>

                                                
                        <div class="rending-water">
                            <div class="waterfall">
                                <div id="div1">
								<?php
								//条件语句
								if(@$_GET['k']=='' && @$_GET['f']=='')
								{
									$where ='';
								}else{
									if($_GET['k']!='' && $_GET['f']!='')
									{
										$where = ' where fengge_id='.$_GET['f'].' and  kongjian_id='.$_GET['k'];
									}else{
										if($_GET['k']=='')
										{
											$where = ' where fengge_id='.$_GET['f'];
										}else{
											$where = ' where kongjian_id='.$_GET['k'];
										}
									}
								}
								$sql_listcont = 'select count(1) from pubu_list '.$where;
								$count_fy = mysqli_query($conn,$sql_listcont);
								$count_fy_row = mysqli_fetch_array($count_fy);
								$options = array(
									'total_rows' => $count_fy_row[0], //总行数
									'list_rows'  => '80',  //每页显示量
								);
								$page = new Core_Lib_Page($options);
								
								//list

								$currentPage = $p;
								$sql_list ="select * from pubu_list $where order by sort desc,id desc limit ".($currentPage-1)*$options['list_rows'].",".$options['list_rows'];
								$count_list = mysqli_query($conn,$sql_list);
								while($count_listrow = mysqli_fetch_array($count_list))
								{
								?>
                                     
									<div class="box">
                                        <a class="btn1" href="javascript:;" target="_blank">
                                            <img src="<?php echo $count_listrow['img']; ?>"/>
                                            <div class="watertext">
                                               <p><?php echo $count_listrow['fang_type']; ?></p>
                                                <div class="waterleft">
                                                    <dl>
                                                        <dd><?php echo $count_listrow['fang_one']; ?></dd>
                                                        <dd><?php echo $count_listrow['fang_two']; ?></dd>
                                                    </dl>
                                                </div>
                                                <div class="wateright">
                                                    <span><?php echo $count_listrow['hot']; ?></span>
                                                    <img src=""/>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
								<?php
								}
								?>	
                                      
                                                                      
                                </div>
                            </div>
                        </div>
						
                        <div id="pages" class="pages text-c">
						<a class="a1"><?php echo $count_fy_row[0]; ?>条</a>
						<?php  echo $page->show(2); ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
   


<div class="lookforwrap">
   <form method="post" name="myform" id="myform" action="action.php?a=zx2"  onsubmit="return st();">
        <div class="lookforbox" style="width:400px">
            <div class="lookforight">
                <h3 style="text-align: center;">选择我们,<span>您放心</span></h3>
                <p style="text-align: center;">今天已有 <font>64</font> 位业主获取了免费设计</p>
                <div class="lookfoript">
                    <input type="text" name="info[name]"  id="publisher" value="" placeholder="请输入您的姓名" />
                </div>
                <div class="lookfoript">
                    <input type="text" name="info[mianji]" id="area" value="" placeholder="请输入您的房屋面积" />
                    <label for="">㎡</label>
                </div>
                <div class="lookfoript">
                    <input type="text" name="info[tel]" id="tellphone" value="" placeholder="请输入您的手机号码" />
                </div>
                <input class="tmp12" type="submit" name="dosubmit" id="dosubmit" value=" 立即申请 ">
                <b>*为了您的利益以及我们的口碑，您的隐私将被严格保密</b>
            </div>
            <img class="closebtn" src="/images/closebtn.png"/>
            </div>
    </form>
    <script>
        function st(){
            if($('#publisher')){
                 if($('#publisher').val()==''){
                    alert('请输入您的称呼！');
                    return false;
                 }
            }
            if($('#city')){
                 if($('#city').val()==''){
                    alert('请选择城市！');
                    return false;
                 }
            }
            if($('#area')){
                 if($('#area').val()==''){
                    alert('请输入您的房屋面积！');
                    return false;
                 }
            }
            if($("#tellphone")){
                var tellphone = $("#tellphone").val();
                if(tellphone=='' || tellphone=='您的电话'){
                    alert('请输入您的电话！');
                    $('#tellphone').focus();
                    return false;
                }else{
                    if(!isMobile(tellphone)){
                        alert('您输入的手机号格式不正确！');
                        $('#tellphone').focus();
                        return false;
                    }
                }
            }
            return true;
        }
    </script>
</div>

    
        <script src="/js/waterfall.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
        window.onload = function() {
            $("#div1").waterfall({
                itemCls: 'box',
                colWidth: 283,
                gutterWidth: 23,
                gutterHeight: 23,
                minCol: 4,
                checkImagesLoaded: true,
                bufferPixel: -300,
                maxPage: 2,
                // path: function(page) {
                //     return '/index.php/Home/CaseOne/getMore/?pageno=' + page + "&pagesize=20&type=&crrpage=1&crrpagesize=60&keyword=&od=1";
                // }
            });
        }




//找TA设计
$('.rending-water .btn1').click(function() {
    var cpid = $(this).attr('data_id');
    var cpname = $(this).attr('data_name');
    $('#sid_sj').val(cpid);
    $('#bidtitle_sj').val('找装修公司设计-' + cpname);
    $('.lookforwrap').css('display', 'block');
    //$('body,html').addClass('noscroll')
})

$('.lookforbox .closebtn').click(function() {
    $('.lookforwrap').css('display', 'none');
    //$('body,html').removeClass('noscroll')
})
$(".company-btm").slide({
    mainCell: ".bd ul",
    autoPage: true,
    effect: "left",
    autoPlay: true
});





        </script>












	<div class="footer">
        <div class="container">
            <p><?php echo $row_webconfig['text5']; ?></p>
            <b><?php echo $row_webconfig['text6']; ?></b>
        </div>
    </div>

</body>
</html>

