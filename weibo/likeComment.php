<?php

include('connect.php');



$active_id = isset($_POST['active_id']) ? htmlspecialchars($_POST['active_id']) : '';
$comment_id = isset($_POST['comment_id']) ? htmlspecialchars($_POST['comment_id']) : '';
$user_id = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : '';


if ($active_id && $user_id && $comment_id){


    $ishavelikesql = "select * from `like` where active_id = ".$active_id." and user_id=".$user_id."  and comment_id=".$comment_id."";
    $ishavelikeresult =mysqli_query($conn,$ishavelikesql);
    $ishavelikerows=mysqli_num_rows($ishavelikeresult); //返回结果行数
    
    if($ishavelikerows){
        echo '你已经点过赞啦'; 
    }else{
        $sql = "INSERT INTO `like` (active_id,user_id,comment_id)
        VALUES ($active_id,$user_id,$comment_id)";
       
        
        $result =mysqli_query($conn,$sql);

        //输出数据
        if($result){

                $addlikesql = "update comment set like_num=like_num+'1' where comment_id = ".$comment_id;
                $addresult =mysqli_query($conn,$addlikesql);
                if($addresult){
                    echo '点赞成功！';
                }else{
                    echo '点赞失败，请重试';
                }
        }else{
            echo '点赞失败';
           
        }

      
    } 
}else{
    echo '缺少参数，请重新输入';
  
} 

?>