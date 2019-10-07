<?php

include('connect.php');



$message_id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$message_text = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
echo 'id: ' . $message_id;
echo "\n";
echo '留言内容: ' .$message_text;


if ($message_id && $message_text){

    

    $sql = "UPDATE message SET reply_text='".$message_text."'  WHERE id=".$message_id."";
    print_r($sql);
    $result =mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result);
    //输出数据
    if($rows){
        return 'success';
       
    }else{
        return 'error';
       
    }


}else{
    return 'error';
  
} 

?>