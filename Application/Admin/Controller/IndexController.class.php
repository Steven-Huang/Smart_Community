<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
    //后台首页
    public function index(){
    	$this->display();
    }   
    
    //用户退出
    public function logout(){
        //清理session
        session(null);
    
        //清除COOKIE
        if(isset($_COOKIE['access_token'])){
            //删除cookie
            setcookie('access_token','',0,'/');
        }
         
        //跳转到登陆页面
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 2),'info' => urlencode('退出成功！'),'code' => 200);
        exit(urldecode(json_encode($output)));
    }
}