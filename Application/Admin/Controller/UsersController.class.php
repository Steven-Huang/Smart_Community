<?php
namespace Admin\Controller;
//use Admin\Model\UsersModel;

class UsersController extends CommonController {
    //展示业主基本信息（需做分页功能）
	public function index(){
		$users = D('users');
		$data = $users->field('id,icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num,create_time,last_log_ip,last_log_time,if_aprvd')->select();
        exit(urldecode(json_encode($data)));
	}
    
	//添加业主信息页面
	public function add(){
		$this->display();
	}
    
	//处理业主信息
	public function do_add(){
		if (IS_POST) {
		    $pwd_confirm = I('post.user_password_confirmed');
			$users = D('Users');
			$data = $users->create();
			//当用户信息为空时，返回错误信息（需前端配合过滤）
			if (empty($data['nick_name']) || empty($data['true_name']) || empty($data['password']) || empty($data['h_pocn']) || empty($data['mobile']) || empty($data['email']) || empty($data['id_card_num'])){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('业主信息不能为空！'),'code' => -200);
		        exit(urldecode(json_encode($output)));
			}
			//检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
			if ($users->field('id')->where("nick_name = '{$data['nick_name']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));			    
			}
			if ($users->field('id')->where("mobile = '{$data['mobile']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
			if ($users->field('id')->where("email = '{$data['email']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}			
			if ($users->field('id')->where("id_card_num = '{$data['id_card_num']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('身份证号已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}									
			//当两次密码输入错误时，返回错误（需前端配合过滤）
			if ($data['password'] != $pwd_confirm){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('两次输入的密码不一致！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
			//密码加密
			$data['password'] = md5($data['password']);
			$data['create_time'] = date('Y-m-d h:i:s',time());
			if ($users->add($data)) {
			    $id = M('users')->field('id')->order('id desc')->limit(1)->select();
			    //当添加业主成功，需同时给sc_role_user添加角色关系，角色默认为“无”
			    $data = array(
			        'role_id' => 0, //默认为无
			        'user_id' => 'U'.$id
			    );
			    $status = M('role_user')->add($data);
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/index'), 'sec' => 2),'info' => urlencode('添加业主信息成功！'),'code' => 200);
		        exit(urldecode(json_encode($output)));				
			}else{
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('添加业主信息失败！请重新再试！'),'code' => -200);
		        exit(urldecode(json_encode($output)));				
			}
		}else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));	
		}
	}
	
	//更新业主信息
	//更新用户头像
	public function edit_icon(){
	    $id = I('post.user_id');
	    $users = D('users');
	    //$data = $users->field('icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num')->select();
	    $data = $users->field('id,icon_url')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['icon_url']),'info' => urlencode('用户头像'),'code' => 200);
	    exit(urldecode(json_encode($output)));
	}
	
	//更改昵称
	public function edit_nick_name(){
	    $id = I('post.user_id');
	    $users = D('users');
	    $data = $users->field('id,nick_name')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['nick_name']),'info' => urlencode('用户昵称'),'code' => 200);
	    exit(urldecode(json_encode($output)));	     
	}	
    
	//更新密码
	public function edit_password(){
	    $this->display();
	}
	
	//更改手机号
	public function edit_mobile(){
	    $id = I('post.user_id');
	    $users = D('users');
	    $data = $users->field('id,mobile')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['mobile']),'info' => urlencode('用户手机号'),'code' => 200);
	    exit(urldecode(json_encode($output)));	     
	}	

	//更改邮箱
	public function edit_email(){
	    $id = I('post.user_id');
	    $users = D('users');
	    $data = $users->field('id,email')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['email']),'info' => urlencode('用户邮箱'),'code' => 200);
	    exit(urldecode(json_encode($output)));	     
	}
	
	//更新所有信息(物业/管理员使用)
    public function edit_all(){
        
    }
	//处理业主更新信息
	public function do_edit(){
	    $edit_type = I('post.edit_type');
	    if ($edit_type == 'edit_icon'){
	        $id = I('post.user_id');
	        $icon_url = I('icon_url');
	        $data = array(
	            'icon_url' => $icon_url,
	            'id' => $id
	        );
	        D('users')->save($data);
	    }elseif ($edit_type == 'edit_nick_name'){
	        $id = I('post.user_id');
	        $nick_name = I('nick_name');
	        $data = array(
	            'nick_name' => $nick_name,
	            'id' => $id
	        );
	        D('users')->save($data);	        
	    }elseif ($edit_type == 'edit_password'){
	        $id = I('post.user_id');
	        $old_password = MD5(I('post.old_password'));
	        $new_password = MD5(I('post.new_password'));
	        $confirm_password = MD5(I('post.confirm_password'));
	        //获取当前用户密码
	        $current_password = D('users')->field('password')->where("id = '{$id}'")->select();
	        //判断错误
	        if ($current_password != $old_password) {
				$output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit_password'), 'sec' => 3),'info' => urlencode('输入的当前密码错误！'),'code' => -200);
				exit(urldecode(json_encode($output)));		            
	        }elseif ($new_password != $confirm_password){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit_password'), 'sec' => 3),'info' => urlencode('输入的新密码不一致！'),'code' => -200);
	            exit(urldecode(json_encode($output)));	             
	        }
	        //执行
	        $data = array(
	            'password' => $new_password,
	            'id' => $id
	        );
	        D('users')->save($data);
	    }elseif ($edit_type == 'edit_mobile'){
	        $id = I('post.user_id');
	        $mobile = I('mobile');
	        $data = array(
	            'mobile' => $mobile,
	            'id' => $id
	        );
	        D('users')->save($data);	        
	    }elseif ($edit_type == 'edit_email'){
	        $id = I('post.user_id');
	        $email = I('email');
	        $data = array(
	            'email' => $email,
	            'id' => $id
	        );
	        D('users')->save($data);	        
	    }
	}
	
}