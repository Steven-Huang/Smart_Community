<?php
namespace Admin\Controller;

class UsersController extends CommonController {
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
    //显示用户信息页面
    public function index(){
        $this->display();
    }
    
    //展示业主基本信息(已审批通过的)
	public function approved_users(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    //获取每页展示行数
    	    $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
    	    //实例化模型
    		$users = D('users');
    		//获取总记录数
    		$count = $users->where("if_aprvd='1'")->count();
    		//实例化分类页
    		$Page = new \Think\Page($count,$count);
    		//调用show显示分页链接
    		$show = $Page->show();
    		//实现数据分页
    		$data = $users->field('id,icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num,create_time,last_log_ip,last_log_time')->where("if_aprvd='1'")->limit($Page->firstRow,$Page->listRows)->select();
    		$output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('已审核通过的业主信息！'),'code' => 200);
    		exit(urldecode(json_encode($output)));
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}
	}
	
	//展示业主基本信息(待审批的)
	public function pending_users(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    //获取每页展示行数
    	    $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
    	    //实例化模型
    	    $users = D('users');
    	    //获取总记录数
    	    $count = $users->where("if_aprvd='0'")->count();
    	    //实例化分类页
    	    $Page = new \Think\Page($count,$count);
    	    //调用show显示分页链接
    	    $show = $Page->show();
    	    //实现数据分页
    	    $data = $users->field('id,icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num,create_time,last_log_ip,last_log_time')->where("if_aprvd='0'")->limit($Page->firstRow,$Page->listRows)->select();
    	    $output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('等待审批的业主信息！'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}

	//添加业主信息页面
	public function add(){
	    $this->display();
	}
	
	//处理业主信息
	public function do_add(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
	        $data = array(
	            'nick_name' => strtolower(addslashes(trim(I('post.user_nick_name')))),
	            'true_name' => strtolower(addslashes(trim(I('post.user_true_name')))),
	            'gender' => trim(I('post.user_gender')),
	            'id_card_num' => strtolower(addslashes(trim(I('post.user_id_card_num')))),
	            'h_pocn' => strtolower(addslashes(trim(I('post.user_pocn')))),
	            'email' => strtolower(addslashes(trim(I('post.user_email')))),
	            'password' => strtolower(addslashes(trim(I('post.user_password')))),
	            'mobile' => addslashes(trim(I('post.user_mobile'))),
	        );
	        $pwd_confirm = strtolower(addslashes(trim(I('post.user_password_confirmed'))));
	        //实例化Users对象
 	        $users = D('Users');
// 	        $data = $users->create();
// 	        foreach ($data as $key => $value){
// 	            $data[$key] = strtolower(trim($value));
// 	        }
	        //当用户信息为空时，返回错误信息（需前端配合过滤）
	        if (empty($data['nick_name']) || empty($data['true_name']) || empty($data['password']) || empty($pwd_confirm) || empty($data['h_pocn']) || empty($data['mobile']) || empty($data['email']) || empty($data['id_card_num'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '业主信息不能为空！','code' => '-201A');
	            exit(urldecode(json_encode($output)));
	        }
	        //判断是否有效
	        //禁止注册admin
	        if ($data['nick_name'] == 'admin'){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '非法用户名，请重新再试！','code' => '-201B');
	            exit(urldecode(json_encode($output)));
	        }
// 	        if(!preg_match('/^[\u4E00-\u9FA5A-Za-z0-9_]+$/',$data['nick_name'])){
// 	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '用户名限中文，字母或下划线！','code' => '-201A');
// 	            exit(urldecode(json_encode($output)));
// 	        }
// 	        if(!preg_match('/^[\u4E00-\u9FA5A-Za-z]+$/',$data['true_name'])){
// 	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '真实姓名限中文或字母！','code' => '-201B');
// 	            exit(urldecode(json_encode($output)));
// 	        }
	        if(!preg_match('/(^\d{15}$)|(^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$)/',$data['id_card_num'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '身份证号错误！','code' => '-201C');
	            exit(urldecode(json_encode($output)));
	        }
	        if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',$data['email'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '邮箱格式错误！','code' => '-201D');
	            exit(urldecode(json_encode($output)));
	        }
	        if(!preg_match('/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/',$data['mobile'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => '手机号格式错误！','code' => '-201E');
	            exit(urldecode(json_encode($output)));
	        }
	        //检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
	        if ($users->field('id')->where("nick_name = '{$data['nick_name']}'")->find()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => '-202A');
	            exit(urldecode(json_encode($output)));
	        }
	        if ($users->field('id')->where("id_card_num = '{$data['id_card_num']}'")->find()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('身份证号已存在！'),'code' => '-202D');
	            exit(urldecode(json_encode($output)));
	        }
	        if ($users->field('id')->where("email = '{$data['email']}'")->find()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202C');
	            exit(urldecode(json_encode($output)));
	        }
	        if ($users->field('id')->where("mobile = '{$data['mobile']}'")->find()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202B');
	            exit(urldecode(json_encode($output)));
	        }

	        //当两次密码输入错误时，返回错误（需前端配合过滤）
	        if ($data['password'] != $pwd_confirm){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('两次输入的密码不一致！'),'code' => -203);
	            exit(urldecode(json_encode($output)));
	        }
	        //密码加密
	        $data['password'] = create_hash($data['password'],$data['id_card_num']);
	        $data['create_time'] = date('Y-m-d h:i:s',time());
	        if ($users->add($data)) {
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/index'), 'sec' => 2),'info' => urlencode('添加业主信息成功！'),'code' => 200);
	            exit(urldecode(json_encode($output)));
	        }else{
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('添加业主信息失败！请重新再试！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/add'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更新信息页面
	public function edit(){
	    $this->display();
	}
	
	//更新用户头像
	public function edit_icon(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('users');
    	    //$data = $users->field('icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num')->select();
    	    $data = $users->field('id,icon_url')->where("id = '{$id}'")->find();
    	    $output = array('data' => array('id' => $data['id'],'icon_url' => $data['icon_url']),'info' => urlencode('用户头像'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更改昵称
// 	public function edit_nick_name(){
// 	    $id = I('post.user_id');
// 	    $users = D('users');
// 	    $data = $users->field('id,nick_name')->where("id = '{$id}'")->select();
// 	    $output = array('data' => array($data[0]['id'],$data[0]['nick_name']),'info' => urlencode('用户昵称'),'code' => 200);
// 	    exit(urldecode(json_encode($output)));	     
// 	}	
    
	//更新密码
	public function edit_password(){
	    $this->display();
	}
	
	//更改手机号
	public function edit_mobile(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('users');
    	    $data = $users->field('id,mobile')->where("id = '{$id}'")->find();
    	    $output = array('data' => array('id' => $data['id'],'mobile' => $data['mobile']),'info' => urlencode('用户手机号'),'code' => 200);
    	    exit(urldecode(json_encode($output)));	
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }     
	}	

	//更改邮箱
	public function edit_email(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('users');
    	    $data = $users->field('id,email')->where("id = '{$id}'")->find();
    	    $output = array('data' => array('id' => $data['id'],'email' => $data['email']),'info' => urlencode('用户邮箱'),'code' => 200);
    	    exit(urldecode(json_encode($output)));	
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }     
	}
	
	//更新所有信息(物业/管理员使用)
    public function edit_all(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            $id = I('post.user_id');
            $users = D('users');
            $data = $users->field('id,icon_url,nick_name,true_name,gender,id_card_num,h_pocn,mobile,email')->where("id = '{$id}'")->find();
            //身份证号加*号隐藏部分信息
            $data['id_card_num'] = strlen($data['id_card_num']) == 15 ? substr_replace($data['id_card_num'],"****",8,4) : (strlen($data['id_card_num']) == 18 ? substr_replace($data['id_card_num'],"****",10,4) : "身份证位数不正常！");
            if ($data){
                $output = array('data' => $data,'info' => urlencode('需更新的用户信息'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('获取用户信息失败！'),'code' => -200);
                exit(urldecode(json_encode($output)));                
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }       
    }
	//处理业主更新信息
	public function do_edit(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $edit_type = I('post.edit_type');
    	    $id = I('post.user_id');
    	    
    	    //实例化用户
    	    $Users = D('users');
    	    
    	    if ($edit_type == 'edit_icon'){
    	        $icon_url = strtolower(addslashes(trim(I('post.icon_url'))));
    	        $data = array(
    	            'icon_url' => $icon_url,
    	            'id' => $id
    	        );
    	        $status = $Users->save($data);
//     	    }elseif ($edit_type == 'edit_nick_name'){
//     	        $nick_name = strtolower(trim(I('post.nick_name')));
//     	        if (D('users')->field('id')->where("nick_name = '{$nick_name}'")->select()){
//     	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit_nick_name'), 'sec' => 3),'info' => urlencode('用户名已存在！'),'code' => -200);
//     	            exit(urldecode(json_encode($output)));	            
//     	        }
//     	        $data = array(
//     	            'nick_name' => $nick_name,
//     	            'id' => $id
//     	        );
//     	        D('users')->save($data);	        
    	    }elseif ($edit_type == 'edit_password'){
    	        $old_password = strtolower(addslashes(trim(I('post.old_password'))));
    	        $new_password = strtolower(addslashes(trim(I('post.new_password'))));
    	        $confirm_password = strtolower(addslashes(trim(I('post.new_password2'))));
    	        //获取当前用户密码
    	        $row = $Users->field('password,id_card_num')->where("id = '{$id}'")->select();
    	        //判断错误
    	        if ($new_password != $confirm_password){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('两次输入的新密码不一致！'),'code' => '-202A');
    	            exit(urldecode(json_encode($output)));
    	        }else{
    	            if ($row['password'] != create_hash($old_password, $row['id_card_num'])) {
    	                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('输入的旧密码错误！'),'code' => '-202B');
    	                exit(urldecode(json_encode($output)));
    	            }else{
    	                //执行
    	                $data = array(
    	                    'password' => create_hash($new_password, $row['id_card_num']),
    	                    'id' => $id
    	                );
    	                $status = D('users')->save($data);
    	            }
    	        }
    	    }elseif ($edit_type == 'edit_mobile'){
    	        $mobile = strtolower(addslashes(trim(I('post.mobile'))));
    	        
    	        if ($Users->field('id')->where("mobile = '{$mobile}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202C');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        
    	        $data = array(
    	            'mobile' => $mobile,
    	            'id' => $id
    	        );
    	        $status = $Users->save($data);	        
    	    }elseif ($edit_type == 'edit_email'){
    	        $email = strtolower(addslashes(trim(I('post.email'))));
    	        
    	        if ($Users->field('id')->where("email = '{$email}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202D');
    	            exit(urldecode(json_encode($output)));
    	        }    	        
    	        $data = array(
    	            'email' => $email,
    	            'id' => $id
    	        );
    	        $status = $Users->save($data);	        
    	    }elseif ($edit_type == 'edit_all'){
    	        //$icon_url = strtolower(addslashes(trim(I('post.icon_url'))));
    	        //$nick_name = strtolower(addslashes(trim(I('post.nick_name'))));
    	        $old_password = strtolower(addslashes(trim(I('post.old_password'))));
    	        $new_password = strtolower(addslashes(trim(I('post.new_password'))));
    	        $confirm_password = strtolower(addslashes(trim(I('post.new_password2'))));
    	        $mobile = addslashes(trim(I('post.user_mobile')));
    	        $email = strtolower(addslashes(trim(I('post.user_email'))));
    	        
    	        //当用户信息为空时，返回错误信息（需前端配合过滤）
    	        if (empty($old_password) || empty($new_password) || empty($confirm_password) || empty($mobile) || empty($email)){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('更新信息不能为空！'),'code' => -201);
    	            exit(urldecode(json_encode($output)));
    	        }
    	        //检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
//     	        if (D('users')->field('id')->where("nick_name = '{$nick_name}'")->select()){
//     	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => '-202E');
//     	            exit(urldecode(json_encode($output)));
//     	        }
                
                $row = $Users->field('email,mobile,password,id_card_num')->where("id = '{$id}'")->find();
                
                if ($row['mobile'] != $mobile){
                    if ($Users->field('id')->where("mobile = '{$mobile}'")->find()){
                        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202C');
                        exit(urldecode(json_encode($output)));
                    }
                }

                if ($row['email'] != $email){
                    if ($Users->field('id')->where("email = '{$email}'")->find()){
                        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202D');
                        exit(urldecode(json_encode($output)));
                    }
                }
    	        
    	        //判断错误
    	        if ($row['password'] != create_hash($old_password, $row['id_card_num'])) {
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('输入的旧密码错误！'),'code' => '-202B');
    	            exit(urldecode(json_encode($output)));
    	        }elseif ($new_password != $confirm_password){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('两次输入的新密码不一致！'),'code' => '-202A');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        //执行	        
    	        $data = array(
    	            'id' => $id,
    	            'password' => create_hash($new_password, $row['id_card_num']),
    	            'mobile' => $mobile,
    	            'email' => $email
    	        );
    	        $status = $Users->save($data);
    	    }
    	    //判断修改状态
    	    if ($status){
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 2),'info' => urlencode('更新成功！'),'code' => 200);
    	        exit(urldecode(json_encode($output)));
    	    }else{
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('更新失败！'),'code' => 200);
    	        exit(urldecode(json_encode($output)));
    	    }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Users/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
}