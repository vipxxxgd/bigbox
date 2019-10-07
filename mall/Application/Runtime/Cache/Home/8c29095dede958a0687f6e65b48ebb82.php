<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Shopping cart | Metronic Shop UI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">        
    <link href="/mall/Public/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/mall/Public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mall/Public/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <link href="/mall/Public/assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="/mall/Public/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
    <link href="/mall/Public/assets/plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
    <link href="/mall/Public/assets/pages/css/components.css" rel="stylesheet">
    <link href="/mall/Public/assets/corporate/css/style.css" rel="stylesheet">
    <link href="/mall/Public/assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
    <link href="/mall/Public/assets/pages/css/style-admin.css" rel="stylesheet" type="text/css">
    <link href="/mall/Public/assets/corporate/css/style-responsive.css" rel="stylesheet">
    <link href="/mall/Public/assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="/mall/Public/assets/corporate/css/custom.css" rel="stylesheet">
  </head>
  
<body class="ecommerce">
        <div  style="background:#fff;color:#717171;height:600px;">
                <h1  style="background:#fff;color:#717171">发布商品 </h1>
                    <div class="login-01">
                            <form action="/mall/?a=addGoods"  method="POST"  enctype="multipart/form-data">
                                <ul>
                                <li class="second">
                                <span>商品名称：</span><input name="g_name"  class="active_message">
                                <div class="clear"></div>
                                </li>
                                <li class="second">
                                <span>商品价格：</span><input  type="number" name="g_price"  class="active_message">
                                <div class="clear"></div>
                                </li>
                                <li class="second">
                                <span>商品简介：</span><textarea   name="g_text"  class="active_message" value="Message" name="active_text" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Comments';}">Comments</textarea>
                                <div class="clear"></div>
                                </li>
                            </ul>
                            <div class="box">
                                    <span>商品图片：</span><input type="file" name="file-1[]" id="file-1" id="upload" class="inputfile inputfile-1"   multiple accept="image/png,image/jpg,image/gif,image/JPEG"/>
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
                            <input type="submit" onClick="myFunction()" value="发布" >
                            <div class="clear"></div>
                        </form>
                </div>
                <a href="/mall">去首页看看</a></div>
</body>
<script src="/mall/Public/assets/plugins/jquery.min.js" type="text/javascript"></script><script>

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
            var fileList = this.files;
            for(var i = 0; i < fileList.length; i++) {
                var imgSrcI = getObjectURL(fileList[i]);
                imgSrc.push(imgSrcI);
                if(this.files[0].type != 'image/png' && this.files[0].type != 'image/jpeg'  && this.files[0].type != 'image/jpg' && this.files[0].type != 'image/gif'){
                return alert("图片上传格式必须为 jpg/png/gif/jpeg 格式！");
                }
            }
            $(".big").addClass("on");
    
            if(imgSrc.length>5){
                $(".big .p2").text("最多只能上传5张图片");
            }else{
                var num= 5 - imgSrc.length;
                $(".big .p2").text("共"+imgSrc.length+"张，还能上传"+num+"张");
            }
            $(".imgup_box ul").html("");
            imgSrc = imgSrc.slice(0,5)
            for(var a = 0; a < imgSrc.length; a++) {
                var oldBox = $(".imgup_box ul").html();
                $(".imgup_box ul").html(oldBox + '<li><img src="'+imgSrc[a]+'"  onerror="errorImg(this)" ></li>');
                
            }
            if(imgSrc.length<5){
                var oldBox = $(".imgup_box ul").html();
                $(".imgup_box ul").html(oldBox + '<li><input type="file"  name="file-1[]" id="file-1"  class="inputfile inputfile-1"  id="upload" multiple accept="image/png,image/jpg,image/gif,image/JPEG"/><label for="file-1"><span>上传图片</span></label></li>');
            }
    
        })
</script>
</html>