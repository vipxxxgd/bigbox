<!DOCTYPE html>
<html>


<head>
<title>在线留言</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->

<script src="js/jquery.js"></script>
<link href="css/style.css" rel='stylesheet' type='text/css' />

</head>



<style>
input,select,option,textarea{outline: none;}
.login-02{width: 80%}
.table{color: #fff;}
a{color:#ffffff;cursor: pointer;}
a:hover{color:#ffffff}
.hide-box{position:fixed;
top: 50%;
margin-left: -40px;
background: #fff;
text-align: center;
	padding: 30px 20px;
	left: 50%;
	margin-left: -155px;
	margin-top: -160px;
}
.hide-box div{color:#4e4e4e;font-size:20px;}
.hide-box textarea{   
    margin-top: 25px;width: 300px;height: 180px;resize: none;border: none;background: #fff;color: #565656;padding: 10px;margin-top: 10px; border-radius: 7px;
	border: 2px solid #e64e67;}
	

	
.close{position: absolute;
    top: 10px;
    right: 10px;
    color: #db2048;
    font-weight: 800;
	opacity: 1!important;}

    
.button{display: inline-block;width: 100px;height: 50px;background: #fbac24;line-height: 50px;text-align: center;border-radius: 7px;margin-top: 20px;cursor: pointer;margin-top: 10px;
    cursor: pointer;
	color: #fff!important;font-size: 18px!important}
.button:hover{background:#ffd181}
.hide-box{display:none;}
</style>
<body>



<?php
include('connect.php');
    $sql = "select * from  message";
    $result =mysqli_query($conn,$sql);
?>





	<h1>留言列表</h1>
	<div class="login-01 login-02">
		
		<div class="bs-example" data-example-id="hoverable-table">
			<table class="table">
			  <thead>
				<tr>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">#</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户id</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户名</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">留言时间</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">留言内容</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">编辑</font></font></th>
				</tr>
			  </thead>
			  <tbody>


<?php   
  	if ($result->num_rows > 0) {
		// 输出数据
		while($row = $result->fetch_assoc()) {
			echo '<tr>
			<th scope="row"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[id].'</font></font></th>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[user_id].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[user_name].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[datatime].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[user_text].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><a onclick="back('.$row[id].',`'.$row[user_name].'`);">  回复</a>  or  <a href="delliuyan.php?id='.$row[id].'">删除</a></font></font></td> </tr>';
		}
	} else {
		echo "";
	}
?>
				
			</tbody>
		</table>


		<div class="hide-box">
			<span class="close">X</span>
			<div>请输入你要回复<span class="username"></span>的内容</div>
			<textarea value="Message" id="message_text" name="user_text"></textarea>
			<div class="clearfix"></div>
			<div class="button"  onclick="huifu()">回复</div>
		</div>
	</div>
</div>

<script>

var id = null;
   
function back(m_id,name){
		console.log(name);
		$(".hide-box").show();
		$(".hide-box .username").text(name);
		id =m_id;
}

$(".close").click(function(){
	$(".hide-box").hide();
})

function huifu(){
	var message = $("#message_text").val();
	if(message == "" || message == null){
		alert("留言不得为空哦！请重新输入鸭~")
	}else{
		console.log(id,message);
		$.post("reply.php",
			{
				id:id,
				message:message
			},
			function(data,status){
				if(status !== 'success'){

				}else{

					alert("回复成功！")
					$(".hide-box").hide();
					$("#message_text").val("");
				}
			});
	}
}

</script>
</body>
</html>