<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>测试</title>
</head>
<body>

	<input type="text" id="number1">
	<br>
	<input type="text" id="number2">
	<br>
<button onclick="rNumber()">点我</button>
<script>

	var i,j,k,l;
	rans=new Array();
function rNumber() {
	j=document.getElementById("number1").value;
	k=document.getElementById("number2").value;
	j*=1;
	k*=1;
    for(var i=0;i<j;i++)
	{
		l=Math.floor(Math.random()*k);
		rans[i]=l;
		//如果产生重复的随机数则重新进行抽取
		if(i>=1){
			for(var m=0;m<i;m++)
			{
				if(rans[m]==rans[i])
				{
					rans[i]=null;
					i--;
				}
			}
		}
	alert(rans[i]);
	}
	for(var i=0;i<rans.length;i++)
		document.writeln(rans[i]+"<br>");
}

</script>
</body>
</html>