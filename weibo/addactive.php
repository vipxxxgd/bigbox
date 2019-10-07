<?php

include('connect.php');

$user_id =$_SESSION["id"];
$user_name =$_SESSION["username"];
$active_text =$_POST['active_text'];
$datatime = date("Y-m-d H:i:s",time());

//将file数组转换
function buildInfo(){
        $i = i;
        foreach ($_FILES as $v){//三维数组转换成2维数组
            if(is_string($v['name'])){ //单文件上传
                $info[$i] = $v;
                $i++;
            }else{ // 多文件上传

                foreach ($v['name'] as $key=>$val){//2维数组转换成1维数组
                    //取出一维数组的值，然后形成另一个数组
                    //新的数组的结构为：info=>i=>('name','size'.....)
                    $info[$i]['name'] = $v['name'][$key];
                    $info[$i]['size'] = $v['size'][$key];
                    $info[$i]['type'] = $v['type'][$key];
                    $info[$i]['tmp_name'] = $v['tmp_name'][$key];
                    $info[$i]['error'] = $v['error'][$key];
                    $i++;
                }
            }
        }
        return $info;
}

$path="./picture";
$allowExt = array('png','jpg','jpeg','gif');
$maxSize=1048576;
$imgFlag=true;

 //创建文件夹 设立权限
if (! file_exists($path)) {
    mkdir($path,0777,true);
}

$infoArr = buildInfo();
$imggesurlStr='';
$imggesurlStr=array();

foreach ($infoArr as $val){
    
    if($val['error'] === UPLOAD_ERR_OK){
        $tmp_name= $val["tmp_name"];
        $a= explode(".",$val["name"]);
        $name = date('YmdHis').mt_rand(100,999).".".$a[1];
        $destination = $path."/".$name;
        move_uploaded_file($tmp_name, $destination);
        $imggesurlStr[] = $destination;
    }else{
    
    echo '';
}

}

$imggesurlStr = json_encode($imggesurlStr);

if ($user_name && $active_text && $user_id){
    $sql = "INSERT INTO active (user_id,user_name,active_text,  active_img,active_time)
    VALUES ('$user_id','$user_name','$active_text','$imggesurlStr','$datatime')";

    $result =mysqli_query($conn,$sql);

    //输出数据
    if($result){
        echo '提交成功...跳转中';
        echo "<script>setTimeout(function(){window.location.href='index.php';},500);</script>";
    }else{
        echo '提交失败...请重试';
        echo "<script>setTimeout(function(){window.location.href='index.php';},500);</script>";
    }

}else{
    echo '表单不完整，请重新输入';
    echo "<script>setTimeout(function(){window.location.href='index.php';},500);</script>";
} 

?>