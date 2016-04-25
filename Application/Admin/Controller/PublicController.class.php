<?php
namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller {
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
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
            if ($role == '-1'){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('请选择用户角色！'),'code' => -201);
                exit(urldecode(json_encode($output)));
            }            
            if (empty($username)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('用户名不能为空！'),'code' => -201);
                exit(urldecode(json_encode($output)));
            }
            if (empty($password)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('密码不能为空！'),'code' => -201);
                exit(urldecode(json_encode($output)));
            }
            // if (empty($code)) {
            //     $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('验证码不能为空！'),'code' => -201);
            //     exit(urldecode(json_encode($output)));
            // }            
            //判断验证码是否正确
            // $verify = new \Think\Verify();
            // if (!$verify->check($code)) {
            //     $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('验证码错误！'),'code' => -202);
            //     exit(urldecode(json_encode($output)));
            // }
            $password = md5($password);
            //实例化模型
            $users = M($role);
            //用户输入的可能是用户名，邮箱，手机，分别进行判断
            $where1 = "nick_name='{$username}' and password='{$password}'";
            $where2 = "email='{$username}' and password='{$password}'";
            $where3 = "mobile='{$username}' and password='{$password}'";
            $field = 'id,nick_name,if_aprvd';
            $row = $users->field($field)->where($where1)->find() ? $users->field($field)->where($where1)->find() : ($users->field($field)->where($where2)->find() ? $users->field($field)->where($where2)->find() : $users->field($field)->where($where3)->find());

            //判断登录是否成功
            if ($row['id']) {
                //针对业主账户的状态进行判断
                if ($role == 'users' && $row['if_aprvd'] == 0) {
                    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('您的账户正在审核中，请耐心等待！'),'code' => -203);
                    exit(urldecode(json_encode($output)));
                }elseif ($role == 'users' && $row['if_aprvd'] == -1){
                    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('您的账户审核不通过或被禁止访问，请联系物业人员！'),'code' => -204);
                    exit(urldecode(json_encode($output)));
                }

                //设置session
                session('user_id',$row['id']);
                session('name',$row['nick_name']);
             
                if($role == 'admin' && $username == C('ADMIN_AUTH_KEY')){
                    session(C('ADMIN_AUTH_KEY'),$username);
                }else{
                    \Org\Util\Rbac::saveAccessList($row['id']);
                }                
//                 //判断用户是否记住了用户信息
//                 if($remember == 'on'){
//                     //用户选择了保存用户信息
//                     //设置cookie，记住用户的信息，把用户信息保存到浏览器（保存用户ID）
//                     setcookie('user_id',$row['id'],time()+7*3600*24);
//                 }
                //更新用户IP及登录时间信息
                $data = array(
                    'id' => $row['id'],
                    'last_log_ip' => $_SERVER['REMOTE_ADDR'],
                    'last_log_time' => date('Y-m-d h:i:s',time())
                );
                $users->save($data);      
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 2),'info' => urlencode('登录成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('用户名或密码错误！'),'code' => -200);
                exit(urldecode(json_encode($output)));
            }
        }else{
            
//测试模式， 上线后务必删除
                            session('user_id','1');
                session('name','nn');
VAR_DUMP(session());

            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('请求失败，请重新登录！'),'code' => -205);
            exit(urldecode(json_encode($output)));        
        }
    }
}