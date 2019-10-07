<?php
include('connect.php');

$user_name =$_POST['name'];
$user_pwd =$_POST['password'];

if ($user_name && $user_pwd){


    $sql1 = "select * from user where user_name = '$user_name'";

    $result1 =mysqli_query($conn,$sql1);
    $rows1=mysqli_num_rows($result1);
    if($rows1){
            echo '昵称已被占用~请换个试试哟';
            echo "<script>setTimeout(function(){window.location.href='zhuce.html';},500);</script>";
    }else{
        $sql = "INSERT INTO user ".
        "(user_name,user_pwd) ".
        "VALUES ".
        "('$user_name','$user_pwd')";

        $result =mysqli_query($conn,$sql);
        if($result){
                echo '注册成功...跳转中';
                echo "<script>setTimeout(function(){window.location.href='login.php';},500);</script>";
        
        
        }else{
            echo '注册失败...跳转中';
            echo "<script>setTimeout(function(){window.location.href='zhuce.html';},500);</script>";
        }
    }



   

}else{
    echo '表单不完整，请重新输入';
    echo "<script>setTimeout(function(){window.location.href='zhuce.html';},500);</script>";
} 
?>