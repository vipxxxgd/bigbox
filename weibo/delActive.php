<?php
include('connect.php');


$active_id  = null;
if (isset($_POST['active_id'])){
    $active_id = $_POST['active_id'];
}


if ($active_id){
    $sql = "DELETE FROM active  where a_id = '$active_id'";
    $result =mysqli_query($conn,$sql);
    
    // 输出数据
    if($result){
        echo '删除成功';
    
    }else{
        echo '删除失败';
    }

}else{
    echo '参数为空，请重试';
} 
?>