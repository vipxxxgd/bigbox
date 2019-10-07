<?php
function https_request($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($ch);
	curl_close ($ch);
	$result = json_decode($result, true);
	return $result;
}
function shareExTime($time){
	if(!empty($time)){
		$extime = (86400 * 30 * 6);
		$time = $time + $extime;
		return date("Y-m-d", $time);
	}
}
function isMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}
function randomKeys($length){  
    $pattern='1234567890'; //字符池  
    $key='';  
    for($i=0;$i<$length;$i++){    
        $key.=$pattern{mt_rand(0,9)};//生成php随机数  
    }  
    return $key;  
}
function get($val){
	$val = trim(I($val));
	return $val;
}
function password($password){
	return md5("xiaoshuo".$password."jianghu");
}