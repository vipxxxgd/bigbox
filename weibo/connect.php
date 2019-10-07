<?php
header("content-type:text/html;charset=utf-8;");
session_start();

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "liuyan";
 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
?>
