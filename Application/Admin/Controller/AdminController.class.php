<?php
namespace Admin\Controller;
//use Admin\Model\UsersModel;

class AdminController extends CommonController {
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
    //显示物业信息页面
    public function index(){
        $this->display();
    }
    
    //展示管理员基本信息（需做分页功能）
	public function index_list(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    //获取每页展示行数
    	    $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
    	    //实例化模型
    		$users = D('admin');
    		//获取总记录数
    		$count = $users->count();
    		//实例化分类页
    		$Page = new \Think\Page($count,$count);
    		//调用show显示分页链接
    		$show = $Page->show();
    		//实现数据分页
    		$data = $users->field('id,icon_url,nick_name,true_name,gender,mobile,email,id_card_num,create_time,last_log_ip,last_log_time')->limit($Page->firstRow,$Page->listRows)->select();
    		$output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('超级管理员信息！'),'code' => 200);
    		exit(urldecode(json_encode($output)));
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}		
	}
    
	//添加管理员信息页面
	public function add(){
		$this->display();
	}
    
	//处理管理员信息
	public function do_add(){
		if (IS_POST) {
		    //获取TOKEN
		    $token = I('post.access_token');
		    if (!check_token($token)){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
		        exit(urldecode(json_encode($output)));
		    }
	        $data = array(
	            'nick_name' => strtolower(trim(I('post.admin_nick_name'))),
	            'true_name' => strtolower(trim(I('post.admin_true_name'))),
	            'gender' => trim(I('post.admin_gender')),
	            'id_card_num' => strtolower(trim(I('post.admin_id_card_num'))),
	            'email' => strtolower(trim(I('post.admin_email'))),
	            'password' => strtolower(trim(I('post.admin_password'))),
	            'mobile' => trim(I('post.admin_mobile'))
	        );

	        $pwd_confirm = strtolower(trim(I('post.admin_password_confirmed')));
	        //实例化Users对象
			$users = D('admin');
// 			$data = $users->create();
			foreach ($data as $key => $value){
			    $data[$key] = strtolower(trim($value));
			}			
			//当用户信息为空时，返回错误信息（需前端配合过滤）
			if (empty($data['nick_name']) || empty($data['true_name']) || empty($data['password']) || empty($pwd_confirm) || empty($data['mobile']) || empty($data['email']) || empty($data['id_card_num'])){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('超级管理员信息不能为空！'),'code' => '-201A');
		        exit(urldecode(json_encode($output)));
			}
			//判断是否有效
	        if(!preg_match('/(^\d{15}$)|(^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$)/',$data['id_card_num'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => '身份证号错误！','code' => '-201B');
	            exit(urldecode(json_encode($output)));
	        }
	        if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',$data['email'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => '邮箱格式错误！','code' => '-201C');
	            exit(urldecode(json_encode($output)));
	        }
	        if(!preg_match('/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/',$data['mobile'])){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => '手机号格式错误！','code' => '-201D');
	            exit(urldecode(json_encode($output)));
	        }
			//检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
			if ($users->field('id')->where("nick_name = '{$data['nick_name']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => '-202A');
			    exit(urldecode(json_encode($output)));			    
			}
			if ($users->field('id')->where("mobile = '{$data['mobile']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202B');
			    exit(urldecode(json_encode($output)));
			}
			if ($users->field('id')->where("email = '{$data['email']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202C');
			    exit(urldecode(json_encode($output)));
			}			
			if ($users->field('id')->where("id_card_num = '{$data['id_card_num']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('身份证号已存在！'),'code' => '-202D');
			    exit(urldecode(json_encode($output)));
			}									
			//当两次密码输入错误时，返回错误（需前端配合过滤）
			if ($data['password'] != $pwd_confirm){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('两次输入的密码不一致！'),'code' => -203);
			    exit(urldecode(json_encode($output)));
			}
			//密码加密
			$data['password'] = create_hash($data['password'],$data['id_card_num']);
			$data['create_time'] = date('Y-m-d h:i:s',time());
			if ($users->add($data)) {
			    $id = M('users')->field('id')->order('id desc')->limit(1)->select();
			    
			    //当添加超级管理员成功，需同时给sc_role_user添加角色关系，角色默认为“1 - 超级管理员”
			    $data = array(
			        'role_id' => 1, //默认为无
			        'user_id' => $id,
                    'user_type' => 'A'
			    );
			    M('role_user')->add($data);
			    
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 2),'info' => urlencode('添加超级管理员信息成功！'),'code' => 200);
		        exit(urldecode(json_encode($output)));				
			}else{
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('添加超级管理员信息失败！请重新再试！'),'code' => -200);
		        exit(urldecode(json_encode($output)));				
			}
		}else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));	
		}
	}
	
	/**
	 * 删除超级管理员
	 * @return [type] [description]
	 */
	public function del_admin(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.id');
    	    $status = M('admin')->where(array('id'=>$id))->delete();
    	    if($status){
    	        //同时删除用户角色数据
    	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
    	        if($status){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 2),'info' => urlencode('删除超级管理员及用户角色信息成功！'),'code' => 200);
    	            exit(urldecode(json_encode($output)));
    	        }else{
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 3),'info' => urlencode('修改超级管理员成功，但删除用户角色数据失败！'),'code' => "-200A");
    	            exit(urldecode(json_encode($output)));
    	        }
    	    }else{
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 3),'info' => urlencode('修改超级管理员失败！'),'code' => "-200B");
    	        exit(urldecode(json_encode($output)));
    	    }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }    	    
	}
	
	//更新管理员信息页面
	public function edit(){
	    $this->display();
	}
	
	//更新用户头像
	public function edit_icon(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('admin');
    	    //$data = $users->field('icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num')->select();
    	    $data = $users->field('id,icon_url')->where("id = '{$id}'")->select();
    	    $output = array('data' => array('id' => $data[0]['id'],'icon_url' => $data[0]['icon_url']),'info' => urlencode('用户头像'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更改昵称
// 	public function edit_nick_name(){
// 	    if (IS_POST) {
// 	        //获取TOKEN
// 	        $token = I('post.access_token');
// 	        if (!check_token($token)){
// 	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
// 	            exit(urldecode(json_encode($output)));
// 	        }
//     	    $id = I('post.user_id');
//     	    $users = D('admin');
//     	    $data = $users->field('id,nick_name')->where("id = '{$id}'")->select();
//     	    $output = array('data' => array('id' => $data[0]['id'],'nick_name' => $data[0]['nick_name']),'info' => urlencode('用户昵称'),'code' => 200);
//     	    exit(urldecode(json_encode($output)));
// 	    }else{
// 	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
// 	        exit(urldecode(json_encode($output)));
// 	    }
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
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('admin');
    	    $data = $users->field('id,mobile')->where("id = '{$id}'")->select();
    	    $output = array('data' => array('id' => $data[0]['id'],'mobile' => $data[0]['mobile']),'info' => urlencode('用户手机号'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更改邮箱
	public function edit_email(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('admin');
    	    $data = $users->field('id,email')->where("id = '{$id}'")->select();
    	    $output = array('data' => array('id' => $data[0]['id'],'email' => $data[0]['email']),'info' => urlencode('用户邮箱'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更新所有信息(物业/管理员使用)
	public function edit_all(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.user_id');
    	    $users = D('admin');
	        $data = $users->field('id,icon_url,nick_name,true_name,gender,id_card_num,mobile,email')->where("id = '{$id}'")->select();
            //身份证号加*号隐藏部分信息
            $data[0]['id_card_num'] = strlen($data[0]['id_card_num']) == 15 ? substr_replace($data[0]['id_card_num'],"****",8,4) : (strlen($data[0]['id_card_num']) == 18 ? substr_replace($data[0]['id_card_num'],"****",10,4) : "身份证位数不正常！");
            if ($data){
                $output = array('data' => $data,'info' => urlencode('需更新的用户信息'),'code' => 200);
                exit(urldecode(json_encode($output)));                
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('获取用户信息失败！'),'code' => -200);
                exit(urldecode(json_encode($output)));                
            }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	//处理业主更新信息
	public function do_edit(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $edit_type = I('post.edit_type');
    	    $id = I('post.user_id');
    	    if ($edit_type == 'edit_icon'){
    	        $icon_url = strtolower(trim(I('post.icon_url')));
    	        $data = array(
    	            'icon_url' => $icon_url,
    	            'id' => $id
    	        );
    	        $status = D('admin')->save($data);
//     	    }elseif ($edit_type == 'edit_nick_name'){
//     	        $nick_name = strtolower(trim(I('post.nick_name')));
//     	        if (D('admin')->field('id')->where("nick_name = '{$nick_name}'")->select()){
//     	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_nick_name'), 'sec' => 3),'info' => urlencode('用户名已存在！'),'code' => -200);
//     	            exit(urldecode(json_encode($output)));
//     	        }
//     	        $data = array(
//     	            'nick_name' => $nick_name,
//     	            'id' => $id
//     	        );
//     	        D('admin')->save($data);
    	    }elseif ($edit_type == 'edit_password'){
    	    	$old_password = strtolower(trim(I('post.old_password')));
    	        $new_password = strtolower(trim(I('post.new_password')));
    	        $confirm_password = strtolower(trim(I('post.confirm_password')));
    	        //获取当前用户密码
    	        $row = D('admin')->field('password,id_card_num')->where("id = '{$id}'")->select();
    	        //判断错误
    	        if ($new_password != $confirm_password){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit'), 'sec' => 3),'info' => urlencode('两次输入的新密码不一致！'),'code' => '-202A');
    	            exit(urldecode(json_encode($output)));
    	        }else{
    	            if ($row['password'] != create_hash($old_password, $row['id_card_num'])) {
    	                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit'), 'sec' => 3),'info' => urlencode('输入的旧密码错误！'),'code' => '-202B');
    	                exit(urldecode(json_encode($output)));
    	            }else{
    	                //执行
    	                $data = array(
    	                    'password' => create_hash($new_password, $row['id_card_num']),
    	                    'id' => $id
    	                );
    	                $status = D('admin')->save($data);
    	            }
    	        }
    	    }elseif ($edit_type == 'edit_mobile'){
    	        $mobile = strtolower(trim(I('post.mobile')));
    	        if (D('admin')->field('id')->where("mobile = '{$mobile}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202C');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        $data = array(
    	            'mobile' => $mobile,
    	            'id' => $id
    	        );
    	        $status = D('admin')->save($data);
    	    }elseif ($edit_type == 'edit_email'){
    	        $email = strtolower(trim(I('post.email')));
    	        if (D('admin')->field('id')->where("email = '{$email}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202D');
    	            exit(urldecode(json_encode($output)));
    	        }    
    	        $data = array(
    	            'email' => $email,
    	            'id' => $id
    	        );
    	        $status = D('admin')->save($data);
    	    }elseif ($edit_type == 'edit_all'){
    	        $icon_url = strtolower(trim(I('post.icon_url')));
    	        $nick_name = strtolower(trim(I('post.nick_name')));
    	        $old_password = strtolower(trim(I('post.old_password')));
    	        $new_password = strtolower(trim(I('post.new_password')));
    	        $confirm_password = strtolower(trim(I('post.confirm_password')));
    	        $mobile = trim(I('post.mobile'));
    	        $email = strtolower(trim(I('post.email')));
    	        
    	        //当用户信息为空时，返回错误信息（需前端配合过滤）
    	        if (empty($icon_url) || empty($nick_name) || empty($old_password) || empty($new_password) || empty($confirm_password) || empty($mobile) || empty($email)){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('更新信息不能为空！'),'code' => -201);
    	            exit(urldecode(json_encode($output)));
    	        }
    	        //检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
    	        if (D('admin')->field('id')->where("nick_name = '{$nick_name}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => '-202E');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        if (D('admin')->field('id')->where("mobile = '{$mobile}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => '-202C');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        if (D('admin')->field('id')->where("email = '{$email}'")->select()){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => '-202D');
    	            exit(urldecode(json_encode($output)));
    	        }    
    	        //获取当前用户密码
    	        $row = D('admin')->field('password,id_card_num')->where("id = '{$id}'")->select();
    	        //判断错误
    	        if ($row['password'] != create_hash($old_password, $row['id_card_num'])) {
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('输入的旧密码错误！'),'code' => '-202B');
    	            exit(urldecode(json_encode($output)));
    	        }elseif ($new_password != $confirm_password){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('两次输入的新密码不一致！'),'code' => '-202A');
    	            exit(urldecode(json_encode($output)));
    	        }
    	        //执行
    	        $data = array(
    	            'id' => $id,
    	            'icon_url' => $icon_url,
    	            'nick_name' => $nick_name,
    	            'password' => create_hash($new_password, $row['id_card_num']),
    	            'mobile' => $mobile,
    	            'email' => $email
    	        );
    
    	        $status = D('admin')->save($data);	        
    	    }
    	    //判断修改状态
    	    if ($status){
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 2),'info' => urlencode('更新成功！'),'code' => 200);
    	        exit(urldecode(json_encode($output)));
    	    }else{
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('更新失败！'),'code' => 200);
    	        exit(urldecode(json_encode($output)));
    	    }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}	
	
	//管理员对业主信息进行处理
    public function approving_users(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
                }
            //获取需要审批的业主ID
            $id = I('post.id');
            //获取动作（approve / reject）
            $action = I('post.action');
            
            //判断
            if ($action == 'approve') {
                $data = array(
                  'id' => $id,
                  'if_aprvd' => 1
                );
                D('users')->save($data);
                
                //当业主信息审批通过，需同时给sc_role_user添加角色关系，角色默认为“无”
                $data = array(
                    'role_id' => 0, //默认为无
                    'user_id' => $id,
                    'user_type' => 'U'
                );
                M('role_user')->add($data);
                
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 2),'info' => urlencode('业主审批已通过！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }elseif ($action == 'reject'){
                $data = array(
                    'id' => $id,
                    'if_aprvd' => 1
                );
                D('users')->save($data);
                
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 2),'info' => urlencode('业主审批已拒绝！'),'code' => 200);
                exit(urldecode(json_encode($output)));            
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }            
    }
    
	//管理员删除用户信息
	public function del_users(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.id');
    	    $status = M('users')->where(array('id'=>$id))->delete();
    	    if($status){
    	        //同时删除用户角色信息
    	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
    	        if($status){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 2),'info' => urlencode('删除用户及用户角色数据成功！'),'code' => 200);
    	            exit(urldecode(json_encode($output)));
    	        }else{
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 3),'info' => urlencode('修改用户成功，删除用户角色失败！'),'code' => '-200A');
    	            exit(urldecode(json_encode($output)));
    	        }
    	    }else{
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => '-200B');
    	        exit(urldecode(json_encode($output)));
    	    }	   
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }    	      
	}
	
	//管理员对物业人员信息进行处理
    public function approving_mgrs(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            //获取需要审批的业主ID
            $id = I('post.id');
            //获取动作（approve / reject）
            $action = I('post.action');
            
            //判断
            if ($action == 'approve') {
                $data = array(
                  'id' => $id,
                  'if_aprvd' => 1
                );
                D('mgrs')->save($data);
                
                //当业主信息审批通过，需同时给sc_role_user添加角色关系，角色默认为“无”
                $data = array(
                    'role_id' => 0, //默认为无
                    'user_id' => $id,
                    'user_type' => 'M'
                );
                M('role_user')->add($data);
                
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Mgrs/approved_mgrs'), 'sec' => 2),'info' => urlencode('物业审批已通过！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }elseif ($action == 'reject'){
                $data = array(
                    'id' => $id,
                    'if_aprvd' => 1
                );
                D('mgrs')->save($data);
                
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Mgrs/approved_mgrs'), 'sec' => 2),'info' => urlencode('物业审批已拒绝！'),'code' => 200);
                exit(urldecode(json_encode($output)));            
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
	
	//管理员删除物业人员信息
	public function del_mgrs(){
	    if (IS_POST) {
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    	    $id = I('post.id');
    	    $status = M('mgrs')->where(array('id'=>$id))->delete();
    	    if($status){
    	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
    	        if($status){
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 2),'info' => urlencode('删除物业及物业角色数据成功！'),'code' => 200);
    	            exit(urldecode(json_encode($output)));
    	        }else{
    	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 3),'info' => urlencode('修改物业成功，删除物业角色失败！'),'code' => '-200A');
    	            exit(urldecode(json_encode($output)));
    	        }
    	    }else{
    	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 3),'info' => urlencode('删除物业失败！'),'code' => '-200B');
    	        exit(urldecode(json_encode($output)));
    	    }	
    	}else{
    	    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
    	    exit(urldecode(json_encode($output)));
	    }
	}
}