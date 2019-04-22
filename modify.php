<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title>MKLAB</title>

<link rel="stylesheet" type="text/css" href="default.css"/>
<script src="jquery-3.3.1.js" ></script>

<script>

class Msg{
	constructor(date,txt){
		this.date=date;
		this.txt=txt;
	}
}

class User{
	constructor(userName,msgs){
		this.userName=userName;
		this.msgs=msgs;
	}
}

$(document).ready(function () {

	$("#button-apply").click(function (){
		SetStateProp();
		StartDivideText();
		UserSelect();
		Write();
	});
	
});

function SetStateProp(){
	formKeyword=$("#keyword").val();
	formPaperwork=$("#paperwork").val();
	formFilterWaterman=$("#filter_waterman").prop("checked");
	formFilterTeacher=$("#filter_teacher").prop("checked");
	formFilterAssistant=$("#filter_assistant").prop("checked");
	formFilterInformalName=$("#filter_informal_name").prop("checked");
}

m=new Map();
function StartDivideText(){
	var r=/(\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d) (.+)/g;
	var arrayResultNameTime=$("#text").text().match(r);
	var arrayResultMsg=$("#text").text().split(/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d .+/);
	arrayResultMsg.shift();
	
	let msg;
	let user;
	for(let i=0;i<arrayResultNameTime.length;i++){

		r.lastIndex=0;
		msg=new Msg(new Date(r.exec(arrayResultNameTime[i])[1]),arrayResultMsg[i]);
		r.lastIndex=0;
		user=r.exec(arrayResultNameTime[i])[2];

		if(m.has(user)){
			m.get(user).push(msg);
		}
		else{
			m.set(user, [msg]);
		}
	}
}

function UserSelect(){

	let flag=[];

	deleByRegExp(/^系统消息/) 

	if(formFilterTeacher){ deleByRegExp(/^教师_/) };

	if(formFilterAssistant){ deleByRegExp(/^助教_/) };

	if(formFilterInformalName){ keepByRegExp(/(^教师_|^助教_|^计[0123456789一二三四五六七八九])/) };

	console.log(m);

	function deleByRegExp(r){
		for(let [u,] of m){
			if(u.search(r)>-1){
				flag.push(u);
			}
		}
		for(let i =0;i<flag.length;i++){
			m.delete(flag[i])
		}
	}

	function keepByRegExp(r){
		for(let [u,] of m){
			if(u.search(r)==-1){
				flag.push(u);
			}
		}
		for(let i =0;i<flag.length;i++){
			m.delete(flag[i])
		}
	}
}

function Write(){
	let s="参与者\n";

	for(let [u,v] of m){
		s+=u;
		s+="\n"
	}
		
	
	$("#result").text(s);
}

</script>

</head>
	
<body>
<header>
</header>
	
<div class="page-wrap">
	

<h2>待处理聊天记录</h2>
<textarea id="text" style="height:100px">
<?php include 'doupload.php' ?>
<?php
$newname="./upload.txt";
if(!file_exists($newname)){
	die("ERROR：file not found") ;
}
else{
	$file=fopen("./upload.txt","r");
	echo fread($file,filesize("./upload.txt"));
	fclose($file);
}
?>
</textarea>


<form>
    <h2>筛选</h2>
    <p>过滤教师<input id="filter_teacher" name="filter_teacher" value="1" type="checkbox" /></p>
    <p>过滤助教<input id="filter_assistant" name="filter_assistant" value="1" type="checkbox" /></p>
    <p >过滤不规范的昵称（保留 教师|助教|计X）<input id="filter_informal_name" name="filter_informal_name" value="1" type="checkbox" /></p>
	
	
	
	<h2>未实现功能</h2>
	<div id="input-gift"><!-- 这里控制下面的值 --></div>

	<input type="hidden" name="gift_list" value="" />
	<p class="message-disabled">活动关键字</p><input name="keyword" id="keyword" disabled/>
    <p class="message-disabled">文案</p><textarea name="paperwork" id="paperwork" disabled></textarea>
	<p class="message-disabled">过滤活动7日前低活跃度（无发言）<input id="filter_waterman" name="filter_waterman" value="1" type="checkbox" disabled/></p>
	<p class="message-disabled">立即公布<input name="release_now" value="1" type="checkbox" checked disabled /></p>
	<p class="message-disabled">
		公布时间
		<input name="day" type="text" disabled/>日
		<input name="hour" type="text" disabled/>时
		<input name="min" type="text" disabled/>分
		后
	</p>

	<pre id="result"></pre>

    <div class="button" id="button-apply">提交</div>
</form>

</div>
</body>
</html>