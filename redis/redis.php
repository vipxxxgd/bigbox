<?php
// header('Content-type:text/json'); 
header("content-type:text/json;charset=utf-8;");
$config = array(
    'mysql'=>array(
        'host'=>'localhost:3306',
        'user'=>'root',
        'pass'=>'',
        'dbname'=>'cj_data',
    ),
    'redis'=>array(
        'host'=>'127.0.0.1',
        'port'=>6379
    )
);

// echo 'llalal';

//连接数据库
$conn = new mysqli($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['pass'], $config['mysql']['dbname']);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

//实例化redis
$redis = new Redis();
$redis->connect($config['redis']['host'], $config['redis']['port']);

//取参数
$form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
$datatime = isset($_POST['datatime']) ? htmlspecialchars($_POST['datatime']) : '';

$key= $form.$datatime; //键名称

function fanhui($status,$data,$form,$error){
    $json = '{"status":'.$status.', "data":'.$data.',"form":"'.$form.'","error":"'.$error.'"}';
    echo $json;
   
}

if ($form && $datatime){

    $hashData = $redis->hget('info', $key);
    $sqldata = [];
    //是否在redis里面  
    if($hashData){
        fanhui(0,$hashData,'redis','null');
    }else{
        $sql = "select * from `info` where form = '$form' and datatime='$datatime'";
        $result =mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            // 输出数据
            while($row = $result->fetch_assoc()) {
                $sqldata[] =$row;
            }
            $sqldata=json_encode($sqldata);
            $redis->hset('info', $key, $sqldata);
            fanhui(0,$sqldata,'sql','null');
        }else{
            $sqldata=json_encode($sqldata);
            fanhui(0,$sqldata,'sql','null');
        } 
    }
}else{
     $sqldata=json_encode($sqldata);
    fanhui(1,$sqldata,'null','必要参数为空！');
} 


?>