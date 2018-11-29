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
    
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/filelist.css">
	<style type="text/css">
		#table-top{
			text-align: center;
		}
		.file{
            display: block;
            /* width: 300px;
             height: 300px; */ 
            opacity:0;
            margin: -25px 0 0 20%;            
        }
        table>tbody>tr>td:nth-child(3) {
		    width: 35%;
		    padding: 18px;
		}
		table>tbody>tr>td:nth-child(4) {
		    width: 25%;
		}
		table>tbody>tr>td:nth-child(3)>img {
		    max-width: 100%;
		    max-height: 300px;
		    /* width: 300px;
		    height: 300px; */
		    margin: auto;
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
                
	<span>编辑产品价格表</span>

                
            </div>
            
            
	<div id="row">编辑产品价格表</div>
	<form action="/index.php/Admin/Product/addprice?pid=<?php echo ($pid); ?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="trlen" class="trlen" value="">
		<table border="1" cellpadding="0" cellspacing="0" id="xianshi">
			<tr>
				<td>价格名</td>
				<td>价格值</td>
				<td>付款二维码</td>
				<td>操作</td>
			</tr>
			<?php $i=-1; ?>
			<?php if(is_array($pricelist)): foreach($pricelist as $key=>$v): ?><tr>
					<td><input type='text' name="" value="<?php echo ($v["prname"]); ?>"></td>
					<td><input type='text' name="" value="<?php echo ($v["price"]); ?>">元</td>
					<td>
						<img class='preview' src="<?php echo ($v["wximg"]); ?>" alt='点击上传图片'/>
					</td>
				
					<td>
						<!-- <a href="/index.php/Admin/Product/deleteprice?id=<?php echo ($v["prid"]); ?>">删除</a> -->
					</td>
				</tr><?php endforeach; endif; ?>

		</table>
		<div id="table-top">
			<input type="button" name="" value="增加价格组" onclick="tmadd()">
			<input type="button" name="" value="提交" onclick="checksubmit()">
		</div>
	</form>
	</div>

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
$(function(){

	
});



//二维码图片
$(document).on('change','.file', function(){
    //获取文件列表对象
    var fileList = $(this)[0].files;
    //创建文件流获取文件地址
    var src = URL.createObjectURL(fileList[0]);
    //设置图片路径
    $(this).prevAll(".preview").attr("src", src);
    $(this).prevAll("input[type='hidden']").val(src);
    //$(".preview").attr("src", src);
    
});

//删除
$(document).on('click','.delete', function(){
	$(this).parent().parent().remove();
	trlength();

	var tr = $("#xianshi .tr");
	for (var i = 1; i <= tr.length; i++) {
		var pname = 'pname'+i;
		var price = 'price'+i;
		var imgsrc = 'imgsrc'+i;
		var wximg = 'wximg'+i;
		tr.eq(i-1).children("td:nth-child(1)").children("input").attr("name",pname);
		tr.eq(i-1).children("td:nth-child(2)").children("input").attr("name",price);
		tr.eq(i-1).children("td:nth-child(3)").children("input[type='hidden']").attr("name",imgsrc);
		tr.eq(i-1).children("td:nth-child(3)").children("input[type='file']").attr("name",wximg);
	}

});

/*增加价格段*/
function tmadd(){
	var trlen=$("#xianshi .tr").length+1;
	$(".trlen").val(trlen);
	var str = "<tr class='tr'><td><input type='text' name='pname"+trlen+"'></td><td><input type='text' name='price"+trlen+"'>元</td><td><img class='preview' src='' alt='点击上传图片'/><input type='hidden' name='imgsrc"+trlen+"' value='' /><input class='file' type='file' name='wximg"+trlen+"' /></td><td><a class='delete'>删除</a></td></tr>";
	$("#xianshi tbody").children('tr:last-child').after(str);
}

/*检测是否可以提交*/
function checksubmit(){
	var trlen = $(".trlen").val();
	var a = false;
	for (var i = 1; i <= trlen; i++) {
		var pname = "input[name='pname"+i+"']";
		var price = "input[name='price"+i+"']";
		var imgsrc = "input[name='imgsrc"+i+"']";
		var pnaval = $(pname).val().length;
		var prival = $(price).val().length;
		var imgsrcval = $(imgsrc).val().length;
		console.log(imgsrcval);
		if (pnaval==0 || prival==0 || imgsrcval==0) {
			alert("内容不能为空");
			a = false;
			break;
		}
		else{
			a =  true;
		}
	}
	if (a) {
		$("form").submit();
	}
}

/*获取tr的长度*/
function trlength(){
	trlen=$("#xianshi .tr").length;
	$(".trlen").val(trlen);
}

/**/
</script>

</html>