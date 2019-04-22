<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title>MKLAB</title>

<link rel="stylesheet" type="text/css" href="default.css"/>
</head>
	
<body>
<header>
</header>	
	
<div class="page-wrap">
<?php
date_default_timezone_set('PRC');//默认时区
$release_now=$_POST['release_now'];
if($release_now)
{
    $days=0;
    $hours=0;
    $minutes=0;
}
else{
    if($_POST['day']!=NULL) $days=$_POST['day'];
    else $days=$_POST['day']=0;
    if($_POST['hour']!=NULL) $hours=$_POST['hour'];
    else $days=$_POST['hour']=0;
    if($_POST['min']!=NULL) $minutes=$_POST['min'];
    else $days=$_POST['min']=0;
}
$now=date("Y-m-d h:i:s");
$enddate=date("Y-m-d h:i:s",strtotime("+$days days $hours hours $minutes minutes "));//计算开奖时间
if(strtotime($now)<strtotime($enddate)){//判断是否到了开奖时间
    echo "抽奖结果将在" .$enddate. "公布";
}
else
{
    echo "抽奖结果为……";
}
?>


</div>
</body>
</html>
