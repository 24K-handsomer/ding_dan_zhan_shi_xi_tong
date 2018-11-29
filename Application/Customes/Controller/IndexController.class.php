<?php
namespace Customes\Controller;

class IndexController extends CustomesController {
	//www.****.com/index.php/Customes/index?pid=3
    public function index(){
    	$pid = I('pid');
    	if (empty($pid)) {
    		$this->show("参数错误1");
    		exit;
    	}
    	//$this->show($pid);
    	$product = D('Product');
    	$where = "pid = ".$pid;
    	$field = "pid,pname";
    	$productlist = $product->where($where)->find();  //一维
    	$this->assign("product",$productlist);

    	$price = D('Price');
    	$where = "fpid = ".$pid;
    	$field = "prid,fpid,prname,price";
        $pricelist = $price->field($field)->where($where)->order('price')->select(); //二维
        $this->assign("pricelist",$pricelist);

        $this->display();
    }


    public function addorder(){
        $pid = I('pid');

        $data['pname'] = trim(I('pname'));
        if (empty($data['pname'])) {
            $this->error("产品名不能为空！","index?pid=$pid");
        }

        $data['prname'] = trim(I('cycle'));  //价格名  例如：2瓶
        if (empty($data['prname'])) {
            $this->error("请选择正确的数量！","index?pid=$pid");
        }

        $data['price'] = trim(I('price'));
        if (empty($data['price'])) {
            $this->error("请选择正确的价格！","index?pid=$pid");
        }

        $data['realname'] = trim(I('real_name'));
        if (empty($data['realname'])) {
            $this->error("请填写您的姓名！","index?pid=$pid");
        }

        $data['realid'] = trim(I('id_code')) ? trim(I('id_code')) : '0';
        if (empty($data['realid'])) {
            $this->error("请正确填写，身份证号！","index?pid=$pid");
        }

        $data['telephone'] = trim(I('mobile'));
        if (empty($data['telephone'])) {
            $this->error("请填写正确的手机号！","index?pid=$pid");
        }

        $data['province'] = I('province');
        $data['city'] = I('city');
        $data['county'] = I('county') ? I('county') : '0';
        $data['address'] = trim(I('address'));
        if (empty($data['address'])) {
            $this->error("便于您收货，请填写收货地址！","index?pid=$pid");
        }

        $data['remark'] = trim(I('intro')) ? trim(I('intro')) : '0';

        $order = D('Order');
        $re = $order->add($data);
        if ($re) {

            $price = D('Price');
            $where = "fpid = ".$pid." and prname = '".$data['prname']."'";
            $priceimg = $price->field('wximg')->where($where)->find();
            $wximg = $priceimg['wximg'];
            $price = $data['price'];
            $this->success("订单提交成功，请付款","showpay?wximg=$wximg&price=$price");
        }
        else{
            $this->error("数据填写错误");
        }
    }


    function showpay(){
        $wximg = I('wximg');
        $price = I('price');
        $this->assign("wximg",$wximg);
        $this->assign("price",$price);
        $this->display();
    }
}