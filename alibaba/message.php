<?php

header("content-type:text/html;charset=utf-8;");
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "alibaba";
 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$datatime = date("Y-m-d H:i:s",time());
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

if ($datatime && $message ){
    $sql = "INSERT INTO msg (msg,m_time)
    VALUES ('$message','$datatime')";
    $result =mysqli_query($conn,$sql);
    //输出数据
    if($result){
        echo '提交成功';
    }else{
        echo '提交失败';
    }
}



?>