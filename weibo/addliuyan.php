<?php

include('connect.php');

$user_id =$_SESSION["id"];
$user_name =$_SESSION["username"];
$user_text =$_POST['user_text'];
$datatime = date("Y-m-d H:i:s",time());



if ($user_name && $user_text && $user_id ){
    $sql = "INSERT INTO message (user_id, user_name, datatime,user_text)
    VALUES ('$user_id','$user_name','$datatime','$user_text')";

    $result =mysqli_query($conn,$sql);

    //输出数据
    if($result){
        echo '提交成功...跳转中';
        echo "<script>setTimeout(function(){window.location.href='liuyan.php';},500);</script>";
    }else{
        echo '提交失败...请重试';
        echo "<script>setTimeout(function(){window.location.href='liuyan.php';},500);</script>";
    }



}else{
    echo '表单不完整，请重新输入';
    echo "<script>setTimeout(function(){window.location.href='liuyan.php';},500);</script>";
} 

?>