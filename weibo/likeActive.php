<?php

include('connect.php');



$active_id = isset($_POST['active_id']) ? htmlspecialchars($_POST['active_id']) : '';
$user_id = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : '';


if ($active_id && $user_id){


    $ishavelikesql = "select * from `like` where active_id = '$active_id' and user_id='$user_id'  and comment_id='0'";
    $ishavelikeresult =mysqli_query($conn,$ishavelikesql);
    $ishavelikerows=mysqli_num_rows($ishavelikeresult); //返回结果行数
    
    if($ishavelikerows){
        echo '你已经点过赞啦'; 
    }else{
        $sql = "INSERT INTO `like` (active_id,user_id)
        VALUES ($active_id,$user_id)";
        
        $result =mysqli_query($conn,$sql);
        //输出数据
        if($result){
            
            echo '点赞成功！';
           
        }else{
            echo 'error';
           
        }

      
    } 
}else{
    echo 'error';
  
} 

?>