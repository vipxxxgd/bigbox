
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="./laydate/laydate.js"></script> 
<script src="./js/jquery.js"></script> 
</head>

<style>
input,select,option,textarea{outline: none;margin-right:30px;border-radius: 7px;border:none;border:1px solid rgb(166, 166, 166);background-color: rgb(248, 248, 248);padding-left:8px;}
.login-02{width: 1200px;margin:auto;}
thead{background:#efefef;}
.serach{background:#5d5d5d;padding:4px 20px;display:inline-block;color:#Fff;cursor: pointer;border-radius:7px;}
.serach:hover{background:#7b7b7b}
select{width:152px;height:26px;}
.table{width:1200px;max-width:1200px;}
.ljcj{float:right;background:#1c9eea;padding:4px 20px;display:inline-block;color:#Fff;cursor: pointer;border-radius:7px;}
.ljcj:hover{background:#55b1e6}
.message{margin: auto;margin-top: 30px;margin-bottom: 40px;padding: 20px;display: inline-block;position: relative;}
.background { display: block; width: 100%; height: 100%; opacity: 0.4; filter: alpha(opacity=40); background:while; position: absolute; top: 0; left: 0; z-index: 2000; } 
.progressBar { border: solid 2px #f1f1f1; background: #f1f1f1 url(./img/loading.gif) no-repeat 10px 10px; } 
.progressBar { display: block;width: 212px;height: 50px;position: fixed;top: 50%;left: 50%;margin-left: -74px;margin-top: -14px;padding: 10px 10px 10px 50px;text-align: left;line-height: 27px;font-weight: bold;position: absolute;z-index: 2001;padding-top: 10px;} 
.message .close{position: absolute;right:20px;top:20px;}
tr th{word-wrap:break-word;word-break:break-all;table-layout：fixed}
.null{text-align:center;}
</style>
<body>
   <div  style="margin-top:140px;width:1200px;margin:auto;margin-top:140px;">
            日期:  <input type="text" id="dadatime" > 
            平台:   <select id="form">
                        <option value ="360">360</option>
                        <option value ="baidu">baidu</option>
                        <option value="weibo">weibo</option>
                        <option value="sogo">sogo</option>
                    </select>
            <span class="serach">搜索</span>
            <span class="ljcj" >立即去采集今日数据</span>
            <div class="clearfix"></div>
   </div> 
	<h1 style="text-align:center;margin-bottom:80px;margin-top:80px;">采集列表</h1>
	<div class="login-01 login-02">
        <div style="margin:10px 5px;">共查询到数据: <span class="num">0</span>条</div>

		<div class="bs-example" data-example-id="hoverable-table">
			<table class="table">
			  <thead>
				<tr>
				  <th width="10%">采集平台</th>
				  <th width="10%">采集时间</th>
				  <th width="20%">标题</th>
				  <th width="40%">连接</th>
				  <th width="10%">热度</th>
				</tr>
			  </thead>
			  <tbody id="info_tbody">	
              </tbody>	
		</table>
        <div class="null"></div>
	</div>
    <div class="loading-box">
        <div id="background" class="background" style="display:none"></div> 
        <div id="progressBar" class="progressBar"  style="display:none">数据采集中，请稍等...</div> 
    </div>
    <div class="loading-box loading-box1 ">
        <div id="background1" class="background" style="display:none"></div> 
        <div id="progressBar1" class="progressBar"  style="display:none">数据查询中，请稍等...</div> 
    </div>
</div>
</body>

<script>
    var datatime;//日期
    var form;//平台

    //日历插件
    laydate.render({
    elem: '#dadatime',
    format: 'yyyy-MM-dd',
    trigger: 'click',
    theme: '#5d5d5d',
    done: function(value, date){
        datatime = value;
    },
    change: function(value, date){
        datatime = value;
    }
    });

    //非空验证
    $(".serach").click(function(){
        form = $("#form option:selected").val()
        if(form == '' || form == null ||  datatime == undefined ){
            alert("日期或平台不得为空！")
        }else{
            get(form,datatime);
        }
    })

    //查询采集数据
    function get(form,datatime){
        var ajaxbg = $("#background1,#progressBar1");
        ajaxbg.show(); 
        $.post("redis.php",
        {
            form:form,
            datatime:datatime
        },
        function(data,status){
            $(".null").html('');
            var tableData = data.data;
            $("#info_tbody").html('')
            for(var i = 0; i < tableData.length;i++){
                var str = '<tr><th scope="row" style="width:10%">'+tableData[i].form+'</th> <th scope="row" style="width:10%">'+tableData[i].datatime+'</th><th scope="row" style="width:20%">'+tableData[i].text+'</th><th scope="row" style="width:40%;font-size: 7px;">'+tableData[i].link+'</th><th scope="row" style="width:10%">'+tableData[i].hot_num+'</th></tr>';
                $("#info_tbody").append(str);
            }
            if(tableData == ''){
                $(".null").html("未搜索到相关数据哦~");
            }
            $(".num").html(tableData.length);
            ajaxbg.hide(); 
        });
    }
    //今日采集
    $(".ljcj").click(function(){
        $(this).hide();
        var ajaxbg = $("#background,#progressBar");
        ajaxbg.show(); 
        $.get("./../../cj/pacong.php", function(result){
            alert(result);
            ajaxbg.hide(); 
        });
        $(this).show();
    })
</script>

</html>