<html><head>
	<title>模板- home</title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	

</head>
<style>
.zhuce{   
	 height: 48px;
    background: #fff;
    display: inline-block;
    border-radius: 8px;
    line-height: 48px;
    padding: 0 10px;
    cursor: pointer;
	color: #fa446f;



}
</style>
<body>
		<h1>登录</h1>
		<div class="login-01">
				<form action="/signup.php" method="POST">
					<ul>
					<li class="first">
						<a href="#" class=" icon user"></a><input name="name" type="text" class="text" placeholder="请输入用户名">
						<div class="clear"></div>
					</li>
					<li class="first">
						<a href="#" class=" icon user"></a><input  name="password" type="password" class="text"  placeholder="请输入密码">
						<div class="clear"></div>
					</li>
				</ul>
				<input type="submit"  value="登录">
				<a href="zhuce.html" class="zhuce">没有账号？现在注册</a>
				<div class="clear"></div>
			</form>
	</div>
	

</body>
</html>