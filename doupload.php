<?php


  if(isset($_FILES["file"])){

    $upfile=$_FILES["file"];
    echo $upfile["name"];
    //处理错误
    if($upfile["error"]>0){
        die("上传文件错误,原因:");
    }

    $newname="./upload.txt";
    if(file_exists($newname)){
      unlink($newname);
    }

    //执行文件上传
    if(is_uploaded_file($upfile["tmp_name"]))
    {
       move_uploaded_file($upfile["tmp_name"],$newname);
    }
    else
    {
       die("不是一个上传文件!");
    }
  }
  else{

  }
   
?>