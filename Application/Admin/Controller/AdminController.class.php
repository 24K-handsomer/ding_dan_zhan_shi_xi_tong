<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    function _initialize(){

		//parent::_construct();

		//$nowac=CONTROLLER_NAME."-".ACTION_NAME;

		//$u_name=session("u_name");
		//$auth_ac=session("auth_ac");

		//$allowac="Showproject-index,Addproject-index,Shownews-index,Add-index,Messzct-index,Messzct-messpro,Showuser-index,Auth-index";
		
		// && strpos($allowac,$nowac)===false && $u_name!=="admin%"
		/*if(strpos($auth_ac,$nowac)===false){
			exit("没有访问权限！！！");
		}*/
		if (!session('user')) {
			$this->error("你还没有登录！",R('Home/Index'));
		}

	}
}