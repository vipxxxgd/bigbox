<?php

require 'phpQuery.php';
require 'QueryList.php';

use QL\QueryList;

header("content-type:text/html;charset=utf-8;");

//模拟访问360api
function geturl($url){
	    $cookie_file = "__guid=15484592.427465008006475200.1567499929307.865; soid=zVXSBC0SRyy-n5ESW9a3(CFJ7R4TIwllh1!Qs*WO2; __md=oi34abab88ce31567499929338bc499a5f6f1281105c6d7.11; __huid=11lQakB1TP1rptEiqNpZAxUHgu%2F3Iq3JYfgpMN9TxCxeU%3D; __DC_gid=9114931.485235772.1567677746664.1568192546336.5; __gid=9114931.485235772.1567677746664.1569207213858.11; entity_brief_vote_cookie=5; entity_brief_search_time_cookie=0; test_cookie_enable=null; _S=4dd1adf0f0eaf44e4ea10ebcfe500e65; __bn=OBOSB%7BxOnwO%24%2FxV%2FKwQF%3C%7B%3EBtKR3qL3%2C%24%2BUnpQ.dt%28o%3EX%2B%294T%3C1DxzDg%7D%29YGY%403J%3FtMFf%5E40U%7C3slde%2F%23lAe8%2BZsWd2%23EK9u%3E%25%40H%40r1k_Wckyc%2AUN2; count=4";
        $curl = curl_init($url); 
    	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_COOKIEFILE => $cookie_file, 
		CURLOPT_COOKIEJAR => $cookie_file,
		CURLOPT_HTTPHEADER => array(
			"accept: application/json, text/plain, */*",
			"accept-encoding: gzip, deflate, br",
			"accept-language: zh-CN,zh;q=0.9,en;q=0.8",
			"cache-control: no-cache",
			"connection: keep-alive",
			"content-type: application/json; charset=utf-8",
			"cookie: $cookie_file",
			"Host: trends.so.com",
			"pragma: no-cache",
			"referer: https://trends.so.com/hot",
			"user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36 QIHU 360EE",
			"x-requested-with: XMLHttpRequest"
		),
	));
	    curl_setopt($curl, CURLOPT_URL, $url);
        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output,true);
        return $output;
    }


// 通用抓取数据
function get($url,$rules,$range,$form){
    
    $sql = '';
    $info_data;
    $datatime = date("Y-m-d",time());
    //连接数据库
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "cj_data";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 

    if($form=="baidu"){

        $infoo_data = QueryList::Query($url,$rules,$range)->data;
        array_shift($infoo_data);
        $info_data = array_filter($infoo_data, function($item){
          return $item['title'] !== ''; 
        });
        if($info_data){
            foreach ($info_data as $value) {
                $sql .= "INSERT INTO info (`text`, link, datatime,hot_num,form)
                VALUES ('$value[title]','$value[link]','$datatime','$value[hot_num]','$form');";
            }
            $sql = iconv('GBK', 'UTF-8', $sql);     
        }else{
            echo '未抓取到'.$form.'数据\n';
        } 

    }else if($form=="weibo"){
        $info_data = QueryList::Query($url,$rules,$range)->data;
        array_shift($info_data);
        unset($info_data[0]);
        if($info_data){
            foreach ($info_data as $value) {
                $sql .= "INSERT INTO info (`text`, link, datatime,hot_num,form)
                VALUES ('$value[title]','$value[link]','$datatime','$value[hot_num]','$form');";
            }
        }else{
             echo '未抓取到'.$form.'数据\n';

        } 

    }else if($form=="sogo"){
        $info_data = QueryList::Query($url,$rules,$range)->data;
        if($info_data){
            foreach ($info_data as $value) {
                $sql .= "INSERT INTO info (`text`, link, datatime,hot_num,form)
                VALUES ('$value[title]','$value[link]','$datatime','$value[hot_num]','$form');";
            }
        }else{
            echo '未抓取到'.$form.'数据\n';
        } 

    }else if($form=="360"){
        $info_data = geturl("https://trends.so.com/top/realtime");
        $info_data =$info_data[data][result];
        if($info_data){
        foreach ($info_data as $value) {
                $sql .= "INSERT INTO info (`text`, link, datatime,hot_num,form)
                VALUES ('$value[query]','','$datatime','$value[heat]','$form');";
            }
        }else{
            echo '未抓取到'.$form.'热搜数据\n';
    
        } 
    }

    //插入数据
    // echo $sql;
    if ($conn->multi_query($sql) === TRUE) {
        echo "".$form."记录插入成功\n";
    } else {
        echo "".$form."记录插入失败:  " . $conn->error ."\n";
    }
    mysqli_close($conn);

}


$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "cj_data";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 



$datatime = date("Y-m-d",time());
$sql = "select * from `info` where datatime = '$datatime'";
$result =mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    echo '今日数据已采集，请勿重复采集';
}else{
    // baidu
    $url = 'http://top.baidu.com/buzz?b=341&c=513&fr=topbuzz_b1_c513';
    $rules = [
        'title' => ['.keyword a:eq(0)','text'],
        'link' => ['.keyword a:eq(0)','href'],
        'hot_num' => ['.last span','text'],
    ];
    $range = 'tr';
    get($url,$rules,$range,'baidu');

    //weibo
    $url = 'https://s.weibo.com/top/summary?cate=realtimehot&sudaref=www.google.com.hk';
    $rules = [
        'title' => ['.td-02 a:eq(0)','text'],
        'link' => ['.td-02 a:eq(0)','href'],
        'hot_num' => ['.td-02 span','text'],
    ];
    $range = 'tr';
    get($url,$rules,$range,'weibo');

    //sogu
    $url = 'http://top.sogou.com/hot/shishi_'.$i.'.html';
    $rules = [
        'title' => ['.s2 p:eq(0) a:eq(0)','text'],
        'link' => ['.s2 p:eq(0) a:eq(0)','href'],
        'hot_num' => ['.s3','text'],
    ];
    $range = '.pub-list li';
    for($i=1;$i<=3;$i++){
        $url = 'http://top.sogou.com/hot/shishi_'.$i.'.html';
        get($url,$rules,$range,'sogo');
    }

    //360
    $url = 'https://trends.so.com/top/realtime';
    get($url,'','','360');

}




?>
