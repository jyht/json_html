<?php
//define("JAVA_DEBUG", true); //调试设置
//define("JAVA_HOSTS", "127.0.0.1:8080"); //设置javabridge监听端口，如果开启javabridge.jar设置的端口不是8080，可通过此语句更改
require_once("java/Java.inc"); //php调用java的接口，路径问题需要注意
$here=realpath(dirname($_SERVER["SCRIPT_FILENAME"]));
//java_set_library_path($here.PATH_SEPARATOR .'.'); 
//java_set_library_path($here.PATH_SEPARATOR .'.'); //设置java开发包（class或jar文件）路径，多个路径就用PATH_SEPARATOR分隔，保证跨平的支持。
//java_set_file_encoding("GBK");      //设置JAVA编码。没试过其它的编码，也没深入研究如何能用其它的编码。
 
echo '<meta charset="UTF-8">';
//前面是配置环境，下面开始真正的调用：
$system = new Java("java.lang.System");//初始化JAVA下的类，主要操作就是创建Java类的实例，Java类的第一个参数是JAVA开发的类的名字包含包路径，路径表示按JAVA里导入包的格式。如果JAVA下的类需要使用构造函数，可以在使用第二个参数。
print "Java version=".$system->getProperty("java.version")." /n";
print "Java vendor=".$system->getProperty("java.vendor")." <hr />";
print "Java vendor=".$system->getProperty("java.home")." <br />";
print "Java class=".$system->getProperty("java.class.path")." <br />";
 
 
 
print "OS=".$system->getProperty("os.name")." ".  $system->getProperty("os.version")." on ".$system->getProperty("os.arch")." /n";
 
$formatter = new Java('java.text.SimpleDateFormat',"EEEE, MMMM dd, yyyy 'at' h:mm:ss a zzzz");
 
print $formatter->format(new Java('java.util.Date')).' <br>'.' <br>';
 
 
 
?>