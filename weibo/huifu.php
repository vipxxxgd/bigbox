<?php

include('connect.php');

$comment_id = isset($_POST['comment_id']) ? htmlspecialchars($_POST['comment_id']) : '';
$user_name = $_SESSION[username];
$user_id = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : '';
$comment_text =isset($_POST['comment_text']) ? htmlspecialchars($_POST['comment_text']) : '';
$comment_time = date("Y-m-d H:i:s",time());
$active_id= isset($_POST['active_id']) ? htmlspecialchars($_POST['active_id']) : '';


if ($comment_id && $user_id && $comment_text && $comment_time && $user_name &&  $active_id ){

    $sql = "INSERT INTO comment (r_id,user_id,user_name, active_id, comment_time,comment_text)
    VALUES ($comment_id,$user_id,'$user_name',$active_id,'$comment_time','$comment_text')";

    $result =mysqli_query($conn,$sql);

    //输出数据
    if($result){
        echo '回复成功';
    }else{
        echo '回复失败';
    }



}else{
    echo '表单不完整，请重新输入';
} 

?>