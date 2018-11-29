<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>乐艾订单系统</title>
    <meta http-equiv="content-Type" content="text/html;charset=UTF-8">
    <meta name="renderer" content="webkit">   
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    
    <!-- <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon"> -->
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <!-- <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all"> -->
    <!-- <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css"> -->
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
    <script type="text/javascript" src="/Public/Admin/js/jquery-2.0.2.min.js"></script>
    
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/addtest.css">
	<style type="text/css">
		#table-top{
			text-align: center;
		}
		.file{
            display: block;
            width: 400px;
            height: 300px;
            opacity:0;
            margin: -300px 0 0 0;            
        }
        .preview{
            display: block;
            width: 400px;
            height: 300px;
        }
	</style>

    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo">乐艾订单</span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <li><a href="">页面1</a></li>
            <li><a href="">页面2</a></li>
            <li><a href="">页面3</a></li>
            <li><a href="">页面4</a></li>
            <li><a href="">页面5</a></li>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                
                <li class="manager">你好，<em title=""><?php echo session('user')['username'] ?></em></li>
                <li><a href="">修改密码</a></li>
                <li><a href="">修改昵称</a></li>
                <li><a href="/index.php/Home/Index/logout">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                
                <h3><i class="icon icon-unfold"></i>产品</h3>
                <ul class="side-sub-menu">
                    <li>
                        <a class="item" href="/index.php/Admin/Product/productlist">产品列表</a>
                    </li>
                </ul>

                <h3><i class="icon icon-unfold"></i>订单</h3>
                <ul class="side-sub-menu">
                    <li>
                        <a class="item" href="/index.php/Admin/Order/orderlist">订单列表</a>
                    </li>
                </ul>

            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <!-- <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div> -->
        <div id="main" class="main">
            
            <div class="breadcrumb">
                <span>您的位置:</span>
                
	<span>添加产品</span>

                
            </div>
            
            
	<div id="row">添加产品</div>
	<form action="/index.php/Admin/Product/addproduct" method="POST">
		<div id="table-top">
			<span>&nbsp;产&nbsp;品&nbsp;名&nbsp;&nbsp;&nbsp;：</span>
			<input type="text" placeholder="例:善活素" name="pname" >
		</div>
		<div id="table-top">
			<span>&nbsp;产&nbsp;品&nbsp;标&nbsp;记：</span>
			<input type="text" placeholder="例:shs01(字母、数字组成)" name="premark" >
		</div>
		<div id="table-top">
			<input type="submit" name="" value="提交">
		</div>
	</form>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">下单系统</div>
                <div class="fr">V1.0.170408</div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
</body>
<script type="text/javascript">
+function(){
    var $window = $(window), $subnav = $("#subnav"), url;
    $window.resize(function(){
        $("#main").css("min-height", $window.height() - 130);
    }).resize();

    /* 左边菜单高亮 */
    url = window.location.pathname + window.location.search;
    url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
    $subnav.find("a[href='" + url + "']").parent().addClass("current");

    /* 左边菜单显示收起 */
    $("#subnav").on("click", "h3", function(){
        var $this = $(this);
        $this.find(".icon").toggleClass("icon-fold");
        $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
              prev("h3").find("i").addClass("icon-fold").end().end().hide();
    });

    $("#subnav h3 a").click(function(e){e.stopPropagation()});

    /* 头部管理员菜单 */
    $(".user-bar").mouseenter(function(){
        var userMenu = $(this).children(".user-menu ");
        userMenu.removeClass("hidden");
        clearTimeout(userMenu.data("timeout"));
    }).mouseleave(function(){
        var userMenu = $(this).children(".user-menu");
        userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
        userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
    });

    /* 表单获取焦点变色 */
    $("form").on("focus", "input", function(){
        $(this).addClass('focus');
    }).on("blur","input",function(){
                $(this).removeClass('focus');
            });
    $("form").on("focus", "textarea", function(){
        $(this).closest('label').addClass('focus');
    }).on("blur","textarea",function(){
        $(this).closest('label').removeClass('focus');
    });

    // 导航栏超出窗口高度后的模拟滚动条
    var sHeight = $(".sidebar").height();
    var subHeight  = $(".subnav").height();
    var diff = subHeight - sHeight; //250
    var sub = $(".subnav");
    if(diff > 0){
        $(window).mousewheel(function(event, delta){
            if(delta>0){
                if(parseInt(sub.css('marginTop'))>-10){
                    sub.css('marginTop','0px');
                }else{
                    sub.css('marginTop','+='+10);
                }
            }else{
                if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                    sub.css('marginTop','-'+(diff-10));
                }else{
                    sub.css('marginTop','-='+10);
                }
            }
        });
    }
}();
</script>

<script type="text/javascript">

</script>

</html>