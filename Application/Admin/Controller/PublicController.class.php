<?php
namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller {
    public function login(){
        $this->display();
    }
    //定义verify方法
    public function verify(){
        //实例化验证码类
        $verify = new \Think\verify();
        //设置相关属性
        //$verify->codeSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $verify->useCurve = false;
        $verify->useNoise = true;
        $verify->length = 4;
        //清空ob缓存
        ob_clean();
        //调用entry方法生成验证码
        $verify->entry();
    }
    
    //登录
    public function checkLogin(){
        if (IS_POST) {
            //接收数据
            $username = I('post.username');
            $password = I('post.password');
            $code = I('post.code');
            //不同的角色：users(业主) / mgrs(物业) / admin(管理员)
            $role = I('post.role');
            //$remember = I('post.remember');
            //判断数据合法性
//             if (empty($code)) {
//                 $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('验证码不能为空！'),'code' => -201);
//                 exit(urldecode(json_encode($output)));
//             }
            if (empty($username)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('用户名不能为空！'),'code' => -202);
                exit(urldecode(json_encode($output)));
            }
            if (empty($password)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('密码不能为空！'),'code' => -203);
                exit(urldecode(json_encode($output)));
            }
            //判断验证码是否正确
//             $verify = new \Think\Verify();
//             if (!$verify->check($code)) {
//                 $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('验证码错误！'),'code' => -204);
//                 exit(urldecode(json_encode($output)));
//             }
            $password = md5($password);
            //实例化模型
            $users = M($role);
            //用户输入的可能是用户名，邮箱，手机，分别进行判断
            $where1 = "nick_name='{$username}' and password='{$password}'";
            $where2 = "email='{$username}' and password='{$password}'";
            $where3 = "mobile='{$username}' and password='{$password}'";
            $row1 = $users->where($where1)->find();
            $row2 = $users->where($where2)->find();
            $row3 = $users->where($where3)->find();
            var_dump($row1);
            var_dump($row2);
            var_dump($row3);

            //针对业主账户的状态进行判断
            if ($row1['if_aprvd'] == 0) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('您的账户正在审核中，请耐心等待！'),'code' => -200);
                exit(urldecode(json_encode($output)));  
            }elseif ($row1['if_aprvd'] == -1){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('您的账户审核不通过或被禁止访问，请联系物业人员！'),'code' => -200);
                exit(urldecode(json_encode($output)));                
            }
            //判断登录是否成功
            if ($row1['id']) {
                //设置session
                session('user_id',$row1['id']);
                session('name',$row1['nick_name']);
                if($username == C('ADMIN_AUTH_KEY')){
                    session(C('ADMIN_AUTH_KEY'),$username);
                }else{
                    \Org\Util\Rbac::saveAccessList($row1['id']);
                }                
//                 //判断用户是否记住了用户信息
//                 if($remember == 'on'){
//                     //用户选择了保存用户信息
//                     //设置cookie，记住用户的信息，把用户信息保存到浏览器（保存用户ID）
//                     setcookie('user_id',$row['id'],time()+7*3600*24);
//                 }
                //更新用户IP及登录时间信息
                $data = array(
                    'id' => $row1['id'],
                    'last_log_ip' => $_SERVER['REMOTE_ADDR'],
                    'last_log_time' => date('Y-m-d h:i:s',time())
                );
                $users->save($data);      
                //$this->success('登陆成功！',U('Admin/Index/index'),3);
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 2),'info' => urlencode('登录成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }elseif($row2['id']) {
                //设置session
                session('user_id',$row2['id']);
                session('name',$row2['nick_name']);
                if($username == C('ADMIN_AUTH_KEY')){
                    session(C('ADMIN_AUTH_KEY'),$username);
                }else{
                    \Org\Util\Rbac::saveAccessList($row2['id']);
                }                
                $data = array(
                    'id' => $row2['id'],
                    'last_log_ip' => $_SERVER['REMOTE_ADDR'],
                    'last_log_time' => date('Y-m-d h:i:s',time())
                );
                $users->save($data);      
                //$this->success('登陆成功！',U('Admin/Index/index'),3);
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 2),'info' => urlencode('登录成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }elseif($row3['id']) {
                //设置session
                session('user_id',$row3['id']);
                session('name',$row3['nick_name']);
                if($username == C('ADMIN_AUTH_KEY')){
                    session(C('ADMIN_AUTH_KEY'),$username);
                }else{
                    \Org\Util\Rbac::saveAccessList($row3['id']);
                }
                $data = array(
                    'id' => $row3['id'],
                    'last_log_ip' => $_SERVER['REMOTE_ADDR'],
                    'last_log_time' => date('Y-m-d h:i:s',time())
                );
                $users->save($data);      
                //$this->success('登陆成功！',U('Admin/Index/index'),3);
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 2),'info' => urlencode('登录成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }else{
                //$this->error('登陆失败！','login',3);
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('登录失败！'),'code' => -200);
                exit(urldecode(json_encode($output)));                 
            }
        }else{
            
//测试模式， 上线后务必删除
                VAR_DUMP(session());
                echo get_client_ip();

            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('请求失败，请重新登录！'),'code' => -205);
            exit(urldecode(json_encode($output)));        
        }
    }
}