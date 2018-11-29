<?php
namespace Admin\Controller;
use Org\Util\Page;
 
class OrderController extends AdminController {

    public function orderlist(){

        $p=1;
        if(isset($_GET['p'])){
            $p=$_GET['p'];
        }
        $this->assign("p",$p);

        $product = D("Product");
        $productlist = $product->field("pid,pname")->select();
        $this->assign("productlist",$productlist);

        $where="status = 1";
        $pname = "所有";
        if(I('pname')){
            $pname = I('pname');
            if ($pname != "所有") {
                $where = "pname = '".$pname."' and status = 1";
            }
        }

        $this->assign("postpname",$pname);

        
        $order = D("Order");
        $count = $order->where($where)->count();
        $limit = 10;
        $this->assign("limit",$limit);
        $page = new Page($count,$limit);
        $show = $page->show();

        $field = "id,pname,prname,price,realname,telephone,province,city,county,address,crtime,ispay,issend,status,crtime";
        $orderlist = $order->field($field)->where($where)->order('crtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        
        $this->assign("show",$show);
        $this->assign("orderlist",$orderlist);
        $this->display();
    }


    //展示订单详情
    public function showorder($id){
        $where = "id = ".$id;
        $order = D("Order");
        $field = "id,pname,prname,price,realname,realid,telephone,province,city,county,address,remark,remark2,crtime,ispay,issend";
        $result = $order->field($field)->where($where)->find();
        $this->assign("order",$result);
        $this->display();
    }

    //更新订单
    public function updateorder($id){
        $remark2 = trim(I('remark2')) ? trim(I('remark2')) : '0';
        $ispay = I('ispay');
        $issend = I('issend');

        $where = "id = ".$id;
        $order = D("Order");
        $order->remark2 = $remark2;
        $order->ispay = $ispay;
        $order->issend = $issend;
        $re = $order->where($where)->save();
        if ($re) {
            $this->success("更新成功！","showorder?id=$id");
        }
        else{
            $this->error("更新失败！","showorder?id=$id");
        }
    }


    //删除订单
    public function deleteorder($id){
        $where = "id = ".$id;
        $order = D("Order");
        $order->status = 0;
        $re = $order->where($where)->save();
        if ($re) {
            $this->success("删除此条订单","orderlist");
        }
        else{
            $this->error("操作失败","orderlist");
        }
    }
}