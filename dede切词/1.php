<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once 'splitword.class.php';    //加载提取关键字文件
   $sp = new SplitWord();#中文分词类
  $sp->SetSource("同样的合法CSS居中设置在不同浏览器中的表现行为却各有千秋，下面让我们先来看一下CSS中常见的几种让元素水平居中显示的方法。");
   $sp->StartAnalysis();
  print_r($sp->GetFinallyIndex());
   $sp = null;