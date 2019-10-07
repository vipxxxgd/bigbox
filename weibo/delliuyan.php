<?php
include('connect.php');


$id  = null;
if (isset($_GET['id'])){
    $id = $_GET['id'];
}


if ($id){
    $sql = "DELETE FROM  message where id = '$id'";
    $result =mysqli_query($conn,$sql);
    
    // 输出数据
    if($result){
        echo '删除成功...跳转中';
        echo "<script>setTimeout(function(){window.location.href='admin.php';},500);</script>";
    
    }else{
        echo '删除失败...请重试';
        echo "<script>setTimeout(function(){window.location.href='admin.php';},500);</script>";
    }

}else{
    echo '删除失败，请重新执行';
    echo "<script>setTimeout(function(){window.location.href='admin.php';},500);</script>";
} 
?>