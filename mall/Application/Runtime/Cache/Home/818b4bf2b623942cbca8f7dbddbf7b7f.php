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

  
    <div class="header">
        <div class="container">
          <a class="site-logo" href="./"><img src="/mall/Public/assets/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI"></a>
  
          <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
          <!--购物车-->
          <div class="top-cart-block">
            <div class="top-cart-info">
              <a href="javascript:void(0);" class="top-cart-info-count">0样</a>
              <a href="javascript:void(0);" class="top-cart-info-value">$0</a>
            </div>
            <i class="fa fa-shopping-cart"></i>
            <div class="top-cart-content-wrapper">
              <div class="top-cart-content">
                <ul class="scroller" style="height: 250px;">
                  <!--购物车-->
                 
                 
                </ul>
                <div class="text-right">
                  <a href="?a=car" class="btn btn-default">结算</a>
                </div>
              </div>
            </div>            
          </div>
          <!--END CART -->
    <!-- BEGIN NAVIGATION -->
    <div class="header-navigation">
      <ul>
        <li class="dropdown">
          <a class="dropdown-toggle"  href="./?a=order">
            我的订单
          </a>
        </li>
      </ul>
    </div>
   </div>
  </div>

  
   
    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        
        
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1 style="color: #333">购物车</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table class="shopint cart">
                  <tr>
                    <th class="goods-page-image">图片</th>
                    <th class="goods-page-description">商品</th>
                    <th class="goods-page-quantity">数量</th>
                    <th class="goods-page-price">单价</th>
                    <th class="goods-page-total" colspan="2">总价</th>
                  </tr>
                  
                </table>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li class="shopping-total-price">
                      <em>共计</em>
                      <strong class="price"><span>$</span>50.00</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <button class="btn btn-primary checkoutbtn" type="submit">提交 <i class="fa fa-check"></i></button>
            </div>
          </div>
        </div>
        <script src="/mall/Public/assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/mall/Public/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/mall/Public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
<script src="/mall/Public/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/mall/Public/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="/mall/Public/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src='/mall/Public/assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script>
<script src="/mall/Public/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="/mall/Public/assets/corporate/scripts/layout.js" type="text/javascript"></script>
<script src="/mall/Public/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();    
        Layout.initOWL();
        Layout.initImageZoom();
        Layout.initTouchspin();
    });
</script>
<script>
   


function addCar(id){
    $.post("/mall/?a=addCar",{
        id:id,
        num:1
    },function(result){
        getCar();
    });
}


function addnumber(id){
    $.post("/mall/?a=addnumber",{
        id:id,
    },function(result){
        getCar();
    });

}



function delnumber(id){
    $.post("/mall/?a=delnumber",{
        id:id,
    },function(result){
        getCar();
    });
}


function delgroods(id){
    $.post("/mall/?a=delgroods",{
        id:id,
    },function(result){
        getCar();
    });
}

function getCar(){
    var res;

    $.get("http://localhost/mall/?a=Allcar", function(data, status){
         res =JSON.parse(data);
         var table= '<tr><th class="goods-page-image">图片</th><th class="goods-page-description">商品</th><th class="goods-page-quantity">数量</th><th class="goods-page-price">单价</th><th class="goods-page-total" colspan="2">总价</th></tr>'
         $(".top-cart-info-count").html(res.allnumber+"样");
         $(".top-cart-info-value").html(res.alltotal+"元");
         $(".shopping-total-price .price").html("$"+res.alltotal);
        if(res.info == '' || res.info == null || res.info == undefined  ){
            $(".scroller").html()
            $(".slimScrollDiv .scroller").html();
            $(".shopint.cart tbody").html(table);
        }else{
            $(".scroller").html('');
            var html ='';
            var carstr ='';
            for(var i = 0; i<res.info.length;i++){
                var img =  res.info[i].imgs[0].replace(/\"/g, ""); 
                html += '<li>'
                +'<a href="/?a=goods"><img src="/mall/picture/'+img+'" alt="Rolex Classic Watch" width="37" height="34"></a>'
                +'<strong><a href="/mall/?a=goods&id='+res.info[i].id+'">'+res.info[i].name+'</a></strong>'
                +'<span class="cart-content-count">x '+res.info[i].num+'</span>'
                +'<em>$'+res.info[i].total+'</em>'
                +'</li>'

                carstr += '<tr>'
                    +' <td class="goods-page-image">'
                    + ' <a href="javascript:;"><img src="/mall/picture/'+img+'" alt="Berry Lace Dress"></a>'
                    + '</td>'
                    + ' <td class="goods-page-description">'
                    + '<h3><a href="javascript:;">'+res.info[i].name+'</a></h3>'
                    + '</td>'
                    + '<td class="goods-page-quantity">'
                    + ' <div class="product-quantity">'
                    +' <div class="input-group bootstrap-touchspin input-group-sm"> <span class="input-group-btn"><button onclick="delnumber('+res.info[i].id+')" class="btn quantity-down bootstrap-touchspin-down" type="button"><i class="fa fa-angle-down"></i></button></span><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input id="product-quantity" type="text" value="'+res.info[i].num+'" readonly="" class="form-control input-sm" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn"><button onclick="addnumber('+res.info[i].id+')" class="btn quantity-up bootstrap-touchspin-up" type="button"><i class="fa fa-angle-up"></i></button></span></div>'
                    + '</div>'
                    + '</td>'
                    + '<td class="goods-page-price">'
                    + ' <strong><span>$</span>'+res.info[i].price+'</strong>'
                    + '</td>'
                    + '<td class="goods-page-total">'
                    + ' <strong><span>$</span>'+res.info[i].total+'</strong>'
                    + '</td>'
                    + ' <td class="del-goods-col">'
                    + ' <a class="del-goods" href="javascript:;" onclick="delgroods('+res.info[i].id+')">&nbsp;</a>'
                    + '</td>'
                    + '</tr>'
            }

            $(".slimScrollDiv .scroller").html(html);
            $(".shopint.cart tbody").html(table+carstr);
           
        }
    }); 
}

getCar();

</script>

        <script>
            $(".checkoutbtn").click(function(){
                if($(".shopping-total-price .price").text() == '$0'){
                    alert("您的购物车为空哦");
                }else{
                    window.location.href = "/mall/?a=checkout";
                }

                
            })
        </script>
</body>
</html>