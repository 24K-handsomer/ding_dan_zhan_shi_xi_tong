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
		    opacity: 0;
		    position: absolute;
		    top: 1px;
		    left: 1px;
		    width: 100%;
		    height: 100%;     
        }
        table>tbody>tr>td:nth-child(3) {
		    width: 35%;
		    padding: 18px;
		    position: relative;
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
                
	<span>更新产品价格表</span>

                
            </div>
            
            
	<div id="row">更新产品价格表</div>
	<input type="hidden" name="trlen" class="trlen" value="">
	<table border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td>价格名</td>
			<td>价格值</td>
			<td>付款二维码</td>
			<td>操作</td>
		</tr>
	</table>
	<?php $i=-1; ?>
	<?php if(is_array($pricelist)): foreach($pricelist as $key=>$v): ?><form action="/index.php/Admin/Product/updateprice?prid=<?php echo ($v["prid"]); ?>&fpid=<?php echo ($v["fpid"]); ?>" method="POST" enctype="multipart/form-data">
		<table border="1" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<input type='text' name="prname" value="<?php echo ($v["prname"]); ?>">
				</td>
				<td><input type='text' name="price" value="<?php echo ($v["price"]); ?>">元</td>
				<td>
					<img class='preview' src="<?php echo ($v["wximg"]); ?>" alt='点击上传图片'/>
					<input type='hidden' name='imgsrc' value='' />
					<input class='file' type='file' name='wximg' />
				</td>
			
				<td>
					<input type="button" name="" class="update" value="更新" >&nbsp;&nbsp;
					<input type="button" name="" class="delete" value="删除" >
				</td>
			</tr>
		</table>
	</form><?php endforeach; endif; ?>
	<div id="row">
		<a href="/index.php/Customes/Index?pid=<?php echo ($pid); ?>" target="_blank">查看填单页面</a>
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
	var actionval = $(this).parent('td').parent('tr').parent('tbody').parent('table').parent('form').attr('action');
	var prid = actionval.substring(actionval.indexOf('=')+1,actionval.indexOf('&'));
	
	$.ajax({
		url:"/index.php/Admin/Product/deleteprice",
		data:{prid:prid},
		type:"POST",
		dataType:"JSON",
		success:function (data) {
			var z=data['z'];
			switch (z) {
				case 0:
					alert("删除失败");
					break;
				case 1:
					window.location.reload();
					break;
				default:
					alert("抱歉，后台未接收到传出去的值");
					break;
			}
		}
	});
	/*$(this).parent().parent().remove();
	trlength();*/
});

/*检测是否可以提交*/
$(document).on('click','.update', function(){
	var tr = $(this).parent('td').parent('tr');
	var pname = tr.children("td:nth-child(1)").children("input").val();
	var price = tr.children("td:nth-child(2)").children("input").val();
	var imgsrc = tr.children("td:nth-child(3)").children("input[name='imgsrc']").val();

	var pnaval = pname.length;
	var prival = price.length;
	var imgsrcval = imgsrc.length;
	if (pnaval==0 || prival==0 || imgsrcval==0) {
		alert("内容不能为空");
	}
	else{
		tr.parent('tbody').parent('table').parent('form').submit();
	}
});


/*获取tr的长度*/
function trlength(){
	trlen=$("#xianshi .tr").length;
	$(".trlen").val(trlen);
}

/*增加价格段*/
/*function tmadd(){
	var trlen=$("#xianshi .tr").length+1;
	$(".trlen").val(trlen);
	var str = "<tr class='tr'><td><input type='text' name='pname"+trlen+"'></td><td><input type='text' name='price"+trlen+"'>元</td><td><img class='preview' src='' alt='点击上传图片'/><input type='hidden' name='imgsrc"+trlen+"' value='' /><input class='file' type='file' name='wximg"+trlen+"' /></td><td><a class='delete'>删除</a></td></tr>";
	$("#xianshi tbody").children('tr:last-child').after(str);
}*/

/**/
</script>

</html>