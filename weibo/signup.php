<?php
include('connect.php');

$user_name =$_POST['name'];
$user_pwd =$_POST['password'];

if ($user_name && $user_pwd){
    $sql = "select * from user where user_name = '$user_name' and user_pwd='$user_pwd'";
    $result =mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result); //返回结果行数
    $info = mysqli_fetch_array($result); //返回结果数据
    $isadmin = $info['is_admin'];
    // 输出数据
    if($rows){
        $_SESSION["username"] = $info["user_name"];
        $_SESSION["id"] = $info["user_id"];
       

        if($isadmin == 1){
            echo '登陆成功...跳转中';
            echo "<script>setTimeout(function(){window.location.href='index.php';},500);</script>";
        }

        if($isadmin == 0){
            echo '登陆成功...跳转中';
            echo "<script>setTimeout(function(){window.location.href='admin.php';},500);</script>";
        }
       
    }else{
        echo '用户名或密码错误';
        echo "<script>setTimeout(function(){window.location.href='login.php';},500);</script>";
    }

}else{
    echo '表单不完整，请重新输入';
    echo "<script>setTimeout(function(){window.location.href='login.php';},500);</script>";
} 
?>