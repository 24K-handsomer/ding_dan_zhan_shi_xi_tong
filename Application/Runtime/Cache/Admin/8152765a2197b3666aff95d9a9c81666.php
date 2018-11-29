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
                
	<span>订单列表</span>

                
            </div>
            
            
	<div id="row">
		<form name='MyForm' id='MyForm' method='GET' action="/index.php/Admin/Order/orderlist" >
	        <span>订单产品名：</span>
	        <select name="pname">
	        	<option value="所有">所有</option>
				<?php if(is_array($productlist)): foreach($productlist as $key=>$vv): if($vv['pname'] == $postpname): ?><option value="<?php echo ($vv['pname']); ?>" selected="selected"><?php echo ($vv['pname']); ?></option>
					<?php else: ?>
						<option value="<?php echo ($vv['pname']); ?>"><?php echo ($vv['pname']); ?></option><?php endif; endforeach; endif; ?>
	        </select>
	        <input type="submit" name="" value="搜索">
	    </form>
    </div>
	<table border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>收货信息</td>
			<td>订单详情</td>
			<td>
				订单状态<br>
				付款--发货
			</td>
			<td>操作</td>
			<td>创建时间</td>
		</tr>

		<?php $i=($p-1)*$limit+1; ?>
		<?php if(is_array($orderlist)): foreach($orderlist as $key=>$v): ?><tr>
			<td><?php echo $i++; ?></td>
			<td>
				<?php echo ($v["realname"]); ?>[手机:<?php echo ($v["telephone"]); ?>]&nbsp;[<?php echo ($v["province"]); ?>-<?php echo ($v["city"]); ?>-<?php echo ($v["county"]); ?>]<br>
				<?php echo ($v["address"]); ?>
			</td>
			<td>
				<?php echo ($v["pname"]); ?>[<?php echo ($v["prname"]); ?>：￥<?php echo ($v["price"]); ?>]
			</td>
			<td>
				<?php if($v["ispay"] == 0): ?><span>未确认</span>
				<?php elseif($v["ispay"] == 1): ?>
					<span style="color: green">已付款</span>
				<?php else: ?> 
					<span style="color: red">未付款</span><?php endif; ?>
				<span>--</span>
				<?php if($v["issend"] == 0): ?><span>未确认</span>
				<?php elseif($v["issend"] == 1): ?>
					<span style="color: green">已发货</span>
				<?php else: ?> 
					<span style="color: red">未发货</span><?php endif; ?>
			</td>
			<td>
				<a href="/index.php/Admin/Order/showorder?id=<?php echo ($v["id"]); ?>">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/index.php/Admin/Order/deleteorder?id=<?php echo ($v["id"]); ?>">删除</a>
			</td>
			<td><?php echo ($v["crtime"]); ?></td>
		</tr><?php endforeach; endif; ?>

	</table>
	<div id="page"><?php echo ($show); ?></div>

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