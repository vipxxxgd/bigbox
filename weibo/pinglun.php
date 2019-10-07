<?php

include('connect.php');

$active_id = isset($_POST['active_id']) ? htmlspecialchars($_POST['active_id']) : '';
$user_name = $_SESSION[username];
$user_id = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : '';
$comment_text =isset($_POST['comment_text']) ? htmlspecialchars($_POST['comment_text']) : '';
$comment_time = date("Y-m-d H:i:s",time());



if ($active_id && $user_id && $comment_text && $comment_time && $user_name ){

    $sql = "INSERT INTO comment (user_id,user_name, active_id, comment_time,comment_text)
    VALUES ($user_id,'$user_name',$active_id,'$comment_time','$comment_text')";

    $result =mysqli_query($conn,$sql);

    //输出数据
    if($result){
        echo '评论成功';
    }else{
        echo '评论失败';
    }



}else{
    echo '表单不完整，请重新输入';
} 

?>