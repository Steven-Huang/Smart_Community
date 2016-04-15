<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    //后台首页
    public function index(){
    	$this->display();
    }
    
    //用户退出
    public function logout(){
    	//清理session
    	session('user_id',null);
    	session(null);
//     	//清除COOKIE
//     	if(isset($_COOKIE['user_id'])){
//     	    //删除cookie
//     	    setcookie('user_id','',1);
//     	}    	
    	//跳转到登陆页面
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 2),'info' => urlencode('退出成功！'),'code' => 200);
        exit(urldecode(json_encode($output)));
    }
}