<?php
include('connect.php');

$user_name=$_SESSION["username"];
$user_id=$_SESSION["id"];
$sql = "select * from  message where user_name = '$user_name'";
$result =mysqli_query($conn,$sql);



$active_sql = "select * from  active";
$active_result =mysqli_query($conn,$active_sql);


?>
<!DOCTYPE html>
<html>
	
<head>
<title>在线留言</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.js"></script>
</head>
<body>
	

<style>
.login-03{background:#fff;}
.w990_auto{width:660px;margin:auto;padding:20px 0;}
.list_title_s{color:#333;font-size:16px;}
.list_title_s span{color:#fa446f;font-size:16px;margin-bottom:20px;}
.w990_auto .big_li{padding:30px;border-top:1px solid #ccc}
.subinfo_box{color:#717171;font-size:14px;margin-top:20px;}
.subinfo_box span{margin-right:15px;}
.subinfo_box .anniu:hover{color:#fa446f;cursor: pointer;}
.info{margin-top:10px;}
.info_img{margin-top:20px}
.info_img li{width:30%;margin-right:3%;height:150px}
.info_img img{width:100%;height:100%}
.active_message{border: 1px solid #f8a72f;}
.up_img:hover{color:#fa446f;cursor: pointer;}
.pinglun_box{background:#f0f0f0;margin-top:10px;height:0px;overflow: hidden;}
.css3{transition: 0.5s;-moz-transition:  0.5s;-webkit-transition:  0.5s;-o-transition:  0.5s;}
.big_li.on .pinglun_box{height:185px;padding:20px;}
.pinglun_box textarea{width:100%;height:100px;resize:none;border:none;}
.pl_btn{display: inline-block;width: 78px;height: 35px;line-height: 35px;background: #f8a72f;border-radius: 8px;margin-top: 5px;float: right;text-align: center;color: #fff;font-size: 15px;cursor: pointer;}
.pl_btn:hover{color:#fff;}

.pinglun_box_2{background:#f0f0f0;margin-top:10px;height:0px;overflow: hidden;}
.public.on .pinglun_box_2{height:150px;}
.pinglun_box_2 textarea{width:100%;height:100px;resize:none;border:none;}

.pinglun_box_3{background:#e7e7e7;margin-top:10px;height:0px;overflow: hidden;}
.public.on .pinglun_box_3{height:150px;}
.pinglun_box_3 textarea{width:100%;height:100px;resize:none;border:none;}

.comment_info{height:0;overflow:hidden}
.big_li.on .comment_info{height:100%;padding:20px;}
.comment_info{background:#f0f0f0}
.comment_info .ul_2{padding:20px;padding-top:0px;padding-right:0px;}
.comment_info ul{padding:20px;padding-top:0px;padding-bottom:0px;}
.comment_info li{border-top:1px solid #bdbdbd;padding:10px;}
.comment_info .name{color:#f93c64;margin-right:5px;font-size:15px;}
.comment_info .info{color:#404040;font-size:14px;}
.comment_info .public{color: #8a8a8a;font-size: 10px;margin-top: 4px;}

.comment_info .right .anniu{margin-right:10px;}
.comment_info .right span:hover{color:#fa446f;cursor: pointer;}
.comment_info .ul_2 li{padding:0;background:#e4e4e4;padding: 5px 10px;border-top:none;}


.inputfile-1 + label {color: #fff;background-color: #F79D29;}
.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover { background-color: #ffb75a;}
.box{margin-left:58px;position: relative;}
.inputfile + label {max-width: 80%;font-size: 15px;font-weight: 700;text-overflow: ellipsis;white-space: nowrap;cursor: pointer;display: inline-block;overflow: hidden;padding: 0.625rem 1.25rem;border-radius: 8px}
.inputfile {width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;position: absolute;z-index: -1;}
.inputfile + label svg {width: 1em;height: 1em;vertical-align: middle;fill: currentColor;margin-top: -0.25em;margin-right: 0.25em;}


.hide-box{width: 220px;position: absolute;background: #ffffff;top:50px;border: 1px solid #e6e6e6}

 #triangle-up {position: absolute;top:40px;width: 0;height: 0;border-left: 50px solid transparent;border-right: 50px solid transparent;border-bottom: 100px solid #e2e2e2;}
 .imgup_box{padding:10px;}
 .imgup_box .p1{font-size:14px;font-weight: 800;color: #333;}
 .imgup_box .p2{font-size:12px;margin:5px 0}
 .imgup_box ul li{width:31%;margin-right:1%;height:60px;}
 .imgup_box ul li:nth-child(3n-0){margin:0;}
 .imgup_box ul li{position: relative;border:1px solid #eee;}
 .imgup_box ul li span{position: absolute;top: 50%;font-size: 12px;margin-top: -10px;left: 50%;margin-left: -24px;}
 .imgup_box ul li img{width:100%;height:100%}

 .list-inline>li{padding:0px;}
 .list-inline{margin-left:0px;}
.jxsc{cursor: pointer;}
.big{display:none}
.big.on{display:block}
.imgup_box label:hover{background:#fff}
.imgup_box label{width: 100%;height: 100%;min-width: 100%;border: none;border-radius: none!important;background: none;color: #999;font-size: 12px;}
.close_imgup{position: absolute;top: 10px;right: 10px;cursor:pointer;}

</style>


<div  style="background:#fff;color:#717171;height:600px;">
<p style="text-align:center;padding:16px;position: fixed;width: 100%;color: #fff;background: #969696;z-index:999999999;">欢迎用户： @  <?php  echo $_SESSION["username"]; ?>  <p>

<h1  style="background:#fff;color:#717171">发表动态 </h1>

	<div class=" login-01">
			<form  action="/addactive.php" method="POST"  enctype="multipart/form-data">
				<ul>
				<li class="second">
				<a href="#" class=" icon msg"></a><textarea  class="active_message" value="Message" name="active_text" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Comments';}">Comments</textarea>
				<div class="clear"></div>
				</li>
			</ul>
			<div class="box">
					<input type="file" name="file-1[]" id="file-1" id="upload" class="inputfile inputfile-1"   multiple accept="image/png,image/jpg,image/gif,image/JPEG"/>
					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>上传图片</span></label>
			
					<div class="big">


					<div id="triangle-up"></div>
					<div class="hide-box  imgup_box">
						<div class="p1">本地上传</div>
						<div class="close_imgup">X</div>
						<div class="p2"></div>
						<ul class="list-inline">
						</ul>
					</div>
					</div>
			
			</div>
			<br>
			<input type="submit" onClick="myFunction()" value="发表" >
			<div class="clear"></div>
		</form>
</div>

</div>




<h1 style="background:#fff;color:#717171">社区动态</h1>
	<div class="login-03">

	<ul class="w990_auto">

	<?php
	if ($active_result->num_rows > 0) {
		// 输出数据
		while($row = $active_result->fetch_assoc()) {
			echo ' <li class="big_li">
			<div class="list_des">
				<h3 class="list_title_s">
					<span>'.$row[user_name].'</span>
					<div class="info">'.$row[active_text].'​</div>
					<div class="info_img">
						<ul class="list-inline">';
						if(!empty($row['active_img'])){
							$imggesurlStr = json_decode($row[active_img]);
							foreach ($imggesurlStr as $value)
							{
								echo '<li><img src="'.$value.'"></li>';
							}
						}else{
							echo  '';
						}
					
						echo  '<ul>
					</div>
				</h3>
				<div class="subinfo_box clearfix">
					<span>'.$row[active_time].'​</span>
					<span class="anniu likeit" onclick="likeIt('.$row[a_id].')"><em >点赞</em><em>';
					$like_sql = "select * from  `like`  where active_id = ".$row[a_id]." and comment_id='0'";
					$like_result =mysqli_query($conn,$like_sql);
					$like_rows=mysqli_num_rows($like_result);

					echo '<em>'.$like_rows.'</em></span>';
					echo '<span class="anniu  pl_showbox"><em>评论</em>';
					
					$comment_sql = "select * from  `comment`  where active_id = ".$row[a_id];
					$comment_result =mysqli_query($conn,$comment_sql);
					$comment_rows=mysqli_num_rows($comment_result);
					echo '<em>'.$comment_rows.'</em></span>';

					if($row[user_id] == $_SESSION[id]){
						echo '<span class="anniu  del" onclick="delActive('.$row[a_id].')" ><em>删除</em>';
					}

					echo '
				</div>
			</div>
			<div class="pinglun_box css3">
					<textarea type="textarea" name="pinglun" class="pinglun_input_'.$row[a_id].'"></textarea>
					<div class="pl_btn  " onclick="pinglun('.$row[a_id].','.$_SESSION["id"].')">评论</div>
					<div class="clearfix"></div>
			</div>
			<div class="comment_info css">
				<ul>';

				//显示所有一级评论
				$comment_sql = "select * from  `comment`  where active_id = ".$row[a_id]." and r_id='0'";
				$comment_result =mysqli_query($conn,$comment_sql);
				$comment_rows=mysqli_num_rows($comment_result);


				if ($comment_result->num_rows > 0) {
					// 输出一级评论
					while($row = $comment_result->fetch_assoc()) {

						echo '<li>
						<span class="name">'.$row[user_name].':</span>
						<span class="info">'.$row[comment_text].'</span>
						<div class="public">
							<span class="left">'.$row[comment_time].'</span>
							<div class="right">
								<span class="anniu"  onclick="likeComment('.$row[active_id].','.$row[comment_id].')"><em class="">点赞</em><em><em>'.$row[like_num].'</em></em></span>
								<span class="btn_pl">回复<span>
							</div>
							<div class="clearfix"></div>
							<div class="pinglun_box_2 css3">
								<textarea type="textarea" name="pinglun2" class="huifu_input_'.$row[comment_id].'"></textarea>
								<div class="pl_btn " onclick="huifu('.$row[active_id].','.$row[comment_id].','.$row[comment_id].','.$_SESSION["id"].')">回复</div>
								<div class="clearfix"></div>
							</div>

						</div>
						<ul class="ul_2">';
							
					$pinglun_sql = "select * from  `comment`  where r_id = ".$row[comment_id];
					
					$pinglun_result =mysqli_query($conn,$pinglun_sql);

					if ($pinglun_result->num_rows > 0) {
						// 输出二级评论
						while($lurow = $pinglun_result->fetch_assoc()) {

							echo  '<li>
								<span class="name">'.$lurow[user_name].':</span>
								<span class="info">'.$lurow[comment_text].'</span>
								<div class="public">
									<span class="left">'.$lurow[comment_time].'</span>
									<div class="right">
										<span class="anniu"  onclick="likeComment('.$lurow[active_id].','.$lurow[comment_id].','.$row[comment_id].')"><em class="">点赞</em><em><em>'.$lurow[like_num].'</em></em></span>
										<span class="btn_pl">回复<span>
									</div>
									<div class="clearfix"></div>
									<div class="pinglun_box_3 css3">
										<textarea type="textarea" name="pinglun3" class="huifu_input_'.$lurow[comment_id].'"></textarea>
										<div class="pl_btn"  onclick="huifu('.$lurow[active_id].','.$lurow[comment_id].','.$lurow[comment_id].','.$_SESSION["id"].')">回复</div>
										<div class="clearfix"></div>
									</div>
									
								</div>';

								$pinglun2_sql = "select * from  `comment`  where r_id = ".$lurow[comment_id];
								$pinglun2_result =mysqli_query($conn,$pinglun2_sql);
								if ($pinglun2_result->num_rows > 0) {
									// 输出三级评论
									while($luurow = $pinglun2_result->fetch_assoc()) {
										echo  '<li>
										<span class="name">'.$luurow[user_name].'回复@'.$lurow[user_name].':</span>
										<span class="info">'.$luurow[comment_text].'</span>
										<div class="public">
											<span class="left">'.$luurow[comment_time].'</span>
											<div class="right">
												<span class="anniu"  onclick="likeComment('.$luurow[active_id].','.$luurow[comment_id].','.$row[r_id].')"><em class="">点赞</em><em><em>'.$luurow[like_num].'</em></em></span>
												<span class="btn_pl">回复<span>
											</div>
											<div class="clearfix"></div>
											<div class="pinglun_box_3 css3">
												<textarea type="textarea" name="pinglun3" class="huifu_input_'.$luurow[comment_id].'"></textarea>
												<div class="pl_btn"  onclick="huifu('.$luurow[active_id].','.$lurow[comment_id].','.$luurow[comment_id].','.$_SESSION["id"].')">回复</div>
												<div class="clearfix"></div>
											</div>
										</div>';
										echo '<li>';

									}
								}
							echo '</li>';   
						}
					}		
					echo '
					</ul></li>';
					}
				}
				echo '</ul></div></li>';
		}
	} else {
		echo "";	
	}
	?>

	</ul>

		
					

			
</div>




<h1>后台留言</h1>
	<div class="login-01">
			<form  action="/addliuyan.php" method="POST">
				<ul>
				<li class="second">
				<a href="#" class=" icon msg"></a><textarea value="Message" name="user_text" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Comments';}">Comments</textarea>
				<div class="clear"></div>
				</li>
			</ul>
			<input type="submit" onClick="myFunction()" value="提交" >
			<div class="clear"></div>
		</form>
</div>

<div class="login-01 login-02">

	<h1>我提交的留言</h1>
	<table class="table" style="margin-top:30px;">
			  <thead>
				<tr>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">留言时间</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">留言内容</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">管理员回复内容</font></font></th>
				</tr>
			  </thead>
			  <tbody>

<?php
	if ($result->num_rows > 0) {
		// 输出数据
		while($row = $result->fetch_assoc()) {
			echo ' <tr>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[datatime].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$row[user_text].'</font></font></td>
			<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$liuyan = $row[reply_text] == '0' ? '暂无回复': $row[reply_text].'</font></font></td>  
		</tr>';
		}
	} else {
		echo "";	
	}
	?>

			 
			</tbody>
	</table>
</div>


<script>


	//图像加载出错时的处理 
	function errorImg(img) { 
		img.src = "./images/errorimg.jpg"; 
		img.onerror = null; 
	} 

	//评论框样式
	$(".pl_showbox").click(function(){
		$(this).parents("li").toggleClass("on");
	});

	$(".public .btn_pl").click(function(){
		$(this).parents(".public").toggleClass("on");
	});

	//点赞动态
	function likeIt(a_id){
		$.post("likeActive.php",
			{
				active_id:a_id,
				user_id:<?php echo $user_id ?>
			},
			function(data,status){
				alert(data);
				window.location.reload();
			});


	}


	//点赞评论
	function likeComment(a_id,c_id){
		console.log(a_id,c_id);
		$.post("likeComment.php",
			{
				active_id:a_id,
				comment_id:c_id,
				user_id:<?php echo $user_id ?>
			},
			function(data,status){
				alert(data);
				window.location.reload();
			});
	}




	//评论
	function pinglun(a_id,id){

		var comment_text = $(".pinglun_input_"+a_id).val();		 
		$.post("pinglun.php",
			{
				active_id:a_id,
				user_id:id,
				comment_text:comment_text
			},
			function(data,status){
				alert(data);
				window.location.reload();
			});
	}	


	//回复
	function huifu(a_id,r_id,c_id,id){
		var comment_text = $(".huifu_input_"+c_id).val();		 
		$.post("huifu.php",
			{
				active_id:a_id,
				comment_id:r_id, //被回复评论的id
				user_id:id, 
				comment_text:comment_text
			},
			function(data,status){
				alert(data);
				window.location.reload();
			});
	}
	//删除动态
	function delActive(a_id){
		console.log(a_id);
		$.post("delActive.php",
			{
				active_id:a_id,
			},
			function(data,status){
				alert(data);
				window.location.reload();
		});
	}

	function getObjectURL(file) {
		var url = null ; 
		if (window.createObjectURL!=undefined) { // basic
			url = window.createObjectURL(file) ;
		} else if (window.URL!=undefined) { // mozilla(firefox)
			url = window.URL.createObjectURL(file) ;
		} else if (window.webkitURL!=undefined) { // webkit or chrome
			url = window.webkitURL.createObjectURL(file) ;
		}
		return url ;
	}

	var imgSrc=[];

	$(".close_imgup").click(function(){
		$(".big").removeClass("on");
		imgSrc=[];
	})

	$('input[type="file"]').change(function(e){
		// 图片上传
		var fileList = this.files;
		for(var i = 0; i < fileList.length; i++) {
			var imgSrcI = getObjectURL(fileList[i]);
			imgSrc.push(imgSrcI);
			if(this.files[0].type != 'image/png' && this.files[0].type != 'image/jpeg'  && this.files[0].type != 'image/jpg' && this.files[0].type != 'image/gif'){
			return alert("图片上传格式必须为 jpg/png/gif/jpeg 格式！");
			}
			//限制图片大小
			// var imgSize = this.files[i].size;  
			// if(imgSize>1024*1024*1){//1M
			// 	// return alert("上传图片不能超过1M");
			// }
		}
		$(".big").addClass("on");

		if(imgSrc.length>9){
			$(".big .p2").text("最多只能上传9张图片");
		}else{
			var num= 9 - imgSrc.length;
			$(".big .p2").text("共"+imgSrc.length+"张，还能上传"+num+"张");
		}
		$(".imgup_box ul").html("");
		imgSrc = imgSrc.slice(0,9)
		for(var a = 0; a < imgSrc.length; a++) {
			var oldBox = $(".imgup_box ul").html();
			$(".imgup_box ul").html(oldBox + '<li><img src="'+imgSrc[a]+'"  onerror="errorImg(this)" ></li>');
			
		}
		if(imgSrc.length<9){//显示上传按钮
			var oldBox = $(".imgup_box ul").html();
			$(".imgup_box ul").html(oldBox + '<li><input type="file"  name="file-1[]" id="file-1"  class="inputfile inputfile-1"  id="upload" multiple accept="image/png,image/jpg,image/gif,image/JPEG"/><label for="file-1"><span>上传图片</span></label></li>');
		}

	})

	



	

	




</script>
</body>
</html>