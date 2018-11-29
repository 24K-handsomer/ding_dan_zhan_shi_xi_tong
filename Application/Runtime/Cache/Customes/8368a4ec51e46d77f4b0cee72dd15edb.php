<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单提交</title>

<style>
body{ margin:0 ; padding:0; font-size:12px; font-family:"宋体";}
ul,li,h1,h2,h3,h4,h5,p{ margin:0; padding:0; font-weight:normal; font-size:12px; list-style:none;}
.clear{ clear:both; line-height:0; line-height:0; overflow:hidden;}
img{ border:0px; padding:0px; margin:0px; vertical-align:middle;}
a{text-decoration:none; outline:none;}
a:link{ text-decoration:none; color:#636363;}
a:visited{ text-decoration:none; color:#636363;}
a:hover{ text-decoration:none; color:#636363;}
a:active {star:expression(this.onFocus=this.blur());} 
a img{ border:none}
tr{font-size:12px; color:#000000;}
.m_order{ width:100%; height:auto; overflow:hidden; margin:0px auto;}
.order_table{ width:100%; height:auto; overflow:hidden; margin:0px auto; background-color:#CCC; padding:5px;}
.order_table .fields{ width:150px; text-align:right; padding-right:10px;}
.order_table td{ background-color:#FFF; padding:10px;}
.txt{border: 1px solid; height: 25px; line-height: 25px; padding: 0 5px; width: 220px; color: #999; border-color: #A0A0A0 #E0E0E0 #E0E0E0 #A0A0A0;border-radius:5px;}
.l_25{ width:25px;}
.textarea{border: 1px solid;padding:5px; width:300px;height:80px;border-color: #A0A0A0 #E0E0E0 #E0E0E0 #A0A0A0;border-radius:5px;}
.red{ color:#ff6633}
form{margin:0;padding:0}
.mt10{margin-top:10px}
</style>
</head>
<body>

<div class="m_order">
<form action="/index.php/Customes/Index/addorder" method="post" name="theForm" target="_blank">
<input type="hidden" name="pid" value="<?php echo ($product['pid']); ?>">
<input type="hidden" name="pname" value="<?php echo ($product['pname']); ?>">
<table cellpadding="0" cellspacing="1" class="order_table">
  <tr>
    <td class="fields">产品名称：<?php echo ($product['pname']); ?></td>
    <td>
        <select name="cycle" id="cycle" style="border:1px solid #ccc;">
            <option value="">请选择 </option>
            <?php if(is_array($pricelist)): foreach($pricelist as $key=>$v): ?><option value="<?php echo ($v["prname"]); ?>"><?php echo ($v["prname"]); ?>：￥<?php echo ($v["price"]); ?>元</option><?php endforeach; endif; ?>
        </select>
        <input type="hidden" name="price" value="">
    </td>
  </tr>
  <tr>
    <td class="fields">真实姓名：</td>
    <td>
        <input type="text" name="real_name" id="real_name" value="" class="txt" style="width:80px" /> <span class="red">*</span>
        <div class="red" style="margin-top:8px">请填写收货人真实姓名</div>
    </td>
  </tr>
  <tr>
    <td class="fields">身份证号：</td>
    <td>
        <input type="text" name="id_code" id="id_code" value="" class="txt" style="width:140px" /> <span class="red">*</span>
        <div class="red" style="margin-top:8px">身份验证信息仅用于商品通关检查时使用，我们将确保您的个人隐私不外泄。</div>
    </td>
  </tr>
  <tr>
    <td class="fields">手机号码：</td>
    <td>
        <input type="text" name="mobile" id="mobile" value="" class="txt" style="width:100px" /> <span class="red">*</span>
    </td>
  </tr>
  <tr>
    <td class="fields">配送区域：</td>
    <td>
        <div data-toggle="distpicker" id="ssj">
            <select data-province="---- 选择省 ----" name="province" id="province"></select>
            <select data-city="---- 选择市 ----" name="city" id="city"></select>
            <select data-district="---- 选择区 ----" name="county" id="county"></select>
        </div>
        <div class="red" style="margin-top:8px">海关要求严格标准的配送区域，请认真选择。</div>
    </td>
  </tr>
  <tr>
    <td class="fields">收货地址：</td>
    <td>
        <input type="text" name="address" id="address" value="" class="txt" style="width:300px" /> <span class="red">*</span>
    </td>
  </tr>
  <tr>
    <td class="fields">备注：</td>
    <td colspan="3"><textarea name="intro" id="intro" class="textarea" style="width:300px;height:50px" /></textarea>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding-left:170px">
        <input type="hidden" value="" id="refer_website" name="refer_website" />
        <input type="submit" value=" 提交订单 " id="subbtn" class="btn" />
        <!-- <a href="#" target="_blank" style="margin-left:30px">查看我的订单</a> -->
        <div id="pvars"></div>
    </td>
  </tr>
</table>
</form>
<script type="text/javascript" src="/Public/Customes/js/jquery-2.0.2.min.js"></script>
<script src="http://www.leaiorder.com/Public/jQueryDistpicker/dist/distpicker.data.min.js"></script>
<script src="http://www.leaiorder.com/Public/jQueryDistpicker/dist/distpicker.min.js"></script>
<script src="http://www.leaiorder.com/Public/jQueryDistpicker/js/main.js"></script>
<script type="text/javascript">
$(function(){
    $(document).on('click','#province,#city,#county', function(){
        var str = "";
        str += $('#province').val();
        str += $('#city').val();
        str += $('#county').val();
        $('#address').val(str);
    });

    $(document).on('change','#cycle',function(){
        var prnametext = $("#cycle").find("option:selected").text();
        var a = prnametext.substring(prnametext.indexOf('￥')+1);
        $("input[name='price']").val(a);
        
    });
});
    var isRealName = 1;
    
    $('form').eq(0).submit(function(){
        var btnvalue = this.value;
        
        if($('#cycle').val()=='' || $('#cycle').val()==null){
            alert('请选择产品！');
            return false;
        }
        if($('#real_name').val()==''){
            alert('便于您收货，请填写您的姓名！');
            $('#real_name').focus();
            return false;
        }
        
        if($('#id_code').val()==''){
            alert('请正确填写，身份证号！');
            $('#id_code').focus();
            return false;
        }else if(!valid_id($('#id_code').val())){
            alert('请正确填写，身份证号！');
            $('#id_code').select();
            return false;
        }

        if(!valid_phone($('#mobile').val())){
            alert('便于您收货，请填写正确的手机号！');
            $('#mobile').focus();
            return false;
        }
        
        if($('#selDistricts_1').css('display')=='none'){
            if($('#selCities_1').val()=='0'){
                alert('请选择完整的配送区域！');
                return false;
            }
        }else{
            if($('#selDistricts_1').val()=='0'){
                alert('请选择完整的配送区域！');
                return false;
            }
        }
        
        if($('#address').val()==''){
            alert('便于您收货，请填写收货地址！');
            $('#address').focus();
            return false;
        }
        
        if(!isRealName){
            alert('请输入正确的实名认证信息！');
            return false;
        }
        
        $('#refer_website').val(document.referrer);
        
        $('#subbtn').attr('disabled',true);
        
        //$('#subbtn').val('正在提交订单...');
        //return false
    });
       
    
    
    function valid_phone(str){
        return /^1\d{10}$/.test($.trim(str));
    }
    function valid_id(str){
        return /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/.test($.trim(str));
    }
    
</script>
</body>
</html>