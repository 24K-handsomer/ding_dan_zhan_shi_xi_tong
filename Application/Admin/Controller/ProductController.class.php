<?php
/*
*产品
* 
 */
namespace Admin\Controller;
use Org\Util\Page;

class ProductController extends AdminController {

	/*产品列表*/
    public function productlist(){
    	$p=1;
        if(isset($_GET['p'])){
            $p=$_GET['p'];
        }
        $this->assign("p",$p);

        $where = '';
        $pname = '';
        if(trim(I('pname'))){
            $pname = trim(I('pname'));
            //$this->show($pname);
            $where = "pname='".$pname."'";
        }
        $this->assign("pname",$pname);

        $product = D("Product");
        $count = $product->where($where)->count();
        $limit = 10;
        $this->assign("limit",$limit);
        $page = new Page($count,$limit);
        $show = $page->show();

        $field = "pid,premark,pname,crtime";
        $productlist = $product->field($field)->where($where)->order('crtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        
        $this->assign("show",$show);
        $this->assign("productlist",$productlist);
        $this->display();
    }


    /*添加产品---页面展示和添加*/
    public function addproduct(){
    	if (trim(I('pname'))  && trim(I('premark'))) {
    		$premark = trim(I('premark'));
    		$pname = trim(I('pname'));

    		$product = D('Product');
    		$where = "premark = '".$premark."'";
    		$pid = $product->field('pid')->where($where)->find();
    		if ($pid) {
    			$this->error("产品标记重复，请重新填写！");
    		}
    		
    		$product->premark = $premark;
    		$product->pname = $pname;
    		$re = $product->add();
    		if ($re) {
    			$this->error('产品添加完成','productlist',4);
    		}
    		else{
    			$this->error("产品添加失败，请检查！");
    		}
    	}
    	$this->display();
    }


    //删除产品---删除产品前，要将相应的价格也删除
    public function deleteproduct($id){
        $price = D('price');
        $where = "fpid = ".$id;
        $re = $price->where($where)->delete();

        $product = D("Product");
        $wherep = "pid = ".$id;
        $ze = $product->where($wherep)->delete();
        if ($ze) {
            $this->success("该产品删除成功","productlist");
        }
        else{
            $this->error("该产品删除失败","productlist");
        }

    }


    /*产品的各种价格编辑*/
    function updateproduct(){
    	$pid = I('id');
    	$this->assign("pid",$pid);

    	$price = D('price');
    	$where = "fpid = ".$pid;
    	$priceattr = $price->where($where)->select();
    	$this->assign("pricelist",$priceattr);
    	//$this->show(var_dump($priceattr));
    	$this->display();
    }

    /*产品价格增加*/
    function addprice($pid){

    	$trlen = I("trlen");
    	//$this->show("<pre>".var_dump($trlen));
    	$a = true;
    	for ($i=1; $i <= $trlen; $i++) {
    		$pname = "pname".$i; 
    		$price = "price".$i;
    		$file = "wximg".$i;

    		$pnaval = trim(I($pname));
    		$prival = trim(I($price));

    		$pricedata = D('Price');
    		$pricedata->fpid = $pid;
    		$pricedata->prname = $pnaval;
    		$pricedata->price = $prival;

    		$upload = new \Think\Upload();// 实例化上传类 
	        $upload->maxSize = 3145728 ;// 设置附件上传大小 
	        $upload->subName = '';
	        //$upload->rootPath = './';
	        $upload->savePath = 'erweima/'.date("Y").'/'.date("m").'/'.date("d").'/'; // 设置附件上传目录 
	        // 上传文件 
	        $info = $upload->uploadOne($_FILES[$file]);
	        if(!$info) {// 上传错误提示错误信息 
	            $this->error($upload->getError()); 
	        }
	        else{// 上传成功 
	        	$pricedata->wximg = "/Uploads/".$info['savepath'].$info['savename'];
	        	//$this->show(var_dump($info));

	        	$re = $pricedata->add();
	        	if (!$re) {
	        		$a = false;
	        		break;
	        	}
	        }
    	}
    	if ($a) {
    		$this->success("价格添加成功！","updateproduct?id=$pid");
    	}
    	else{
    		$this->error("价格添加失败！","updateproduct?id=$pid");
    	}
    }


    //展示产品价格，并更新、删除
    public function showproduct(){
        $pid = I('id');
        $this->assign("pid",$pid);

        $price = D('price');
        $where = "fpid = ".$pid;
        $priceattr = $price->where($where)->select();
        $this->assign("pricelist",$priceattr);
        //$this->show(var_dump($priceattr));
        $this->display();
    }

    //更新价格
    public function updateprice($prid,$fpid){

        $pnaval = trim(I("prname"));
        $prival = trim(I("price"));

        $pricedata = D('Price');
        $where = "prid = ".$prid;
        $pricedata->prname = $pnaval;
        $pricedata->price = $prival;

        $upload = new \Think\Upload();// 实例化上传类 
        $upload->maxSize = 3145728 ;// 设置附件上传大小 
        $upload->subName = '';
        //$upload->rootPath = './';
        $upload->savePath = 'erweima/'.date("Y").'/'.date("m").'/'.date("d").'/'; // 设置附件上传目录 
        // 上传文件 
        $info = $upload->uploadOne($_FILES["wximg"]);
        if(!$info) {// 上传错误提示错误信息 
            $this->error($upload->getError());
        }
        else{// 上传成功 
            $pricedata->wximg = "/Uploads/".$info['savepath'].$info['savename'];
            //$this->show(var_dump($info));

            $re = $pricedata->where($where)->save();
            if ($re) {  //更新成功
                $this->success("价格更新成功！","showproduct?id=$fpid");
            }
            else{
                $this->error("价格更新失败！","showproduct?id=$fpid");
            }
        }

    }


    public function deleteprice(){
        if (isset($_POST['prid'])) {
            $where = "prid = ".$_POST['prid'];
            $price = D('Price');
            $re = $price->where($where)->delete();
            if ($re) {
                $data['z'] = 1;
                $this->ajaxReturn($data);
            }
            else{
                $data['z'] = 0;
                $this->ajaxReturn($data);
            }
        }
        else{
            $data['z'] = 2;
            $this->ajaxReturn($data);
        }
    }


}