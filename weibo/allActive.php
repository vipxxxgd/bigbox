<?php
include('connect.php');


$active_sql = "select * from  active";
$active_result =mysqli_query($conn,$active_sql);
// $info = mysqli_fetch_array($active_result);
// $rows=mysqli_num_rows($active_result);
// json_encode

$arr = array();
$arrlike = array();

if ($active_result->num_rows > 0) {
    // 输出数据
    while ($rows= mysqli_fetch_array($active_result)){

        $arr[] =$rows; 

        $like_sql = "select * from  `like`  where active_id = ".$rows[a_id];
		$like_result =mysqli_query($conn,$like_sql);
        $like_rows=mysqli_num_rows($like_result);

        $arrlike[] =$like_rows;        

    }
    echo json_encode($arr);
} else {
    echo "null";
}


?>