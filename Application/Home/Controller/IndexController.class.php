<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->redirect('login');
    }

    public function login($username = null, $password = null, $verify = null){

    	if (IS_POST) {
    		/* 检测验证码 TODO: */
    		$yzm = new \Think\Verify();
        	$z=$yzm->check($verify,2); //检测验证码
            if(!$z){
                $this->error('验证码输入错误！');
            }

            $user = D('User');
            $uid = $user->checklogin($username,$password,$type=1);
            if ($uid > 0) {
            	$result = $user->field()->find($uid);
            	session("user",$result);
            	$this->success('登录成功！', U('Admin/Product/productlist'));
            }
            else{
            	switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }

    	}
    	else{
            session(null);
    		$this->display();
    	}
    	
    }

    public function verify(){
    	$config=array(
        'length'      =>    4     // 验证码位数
        );
        $verify = new \Think\Verify($config);
        $verify->entry(2);
    }


    public function logout(){
    	if(session("user")){  
            session("user",null);  
            session(null);  
            $this->success("正在退出","index"); 
        }
        else{
            $this->redirect("Index/index");
        }
    }
}