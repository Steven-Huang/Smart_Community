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
    
    //展示管理员基本信息（需做分页功能）
	public function index(){
	    //获取每页展示行数
	    $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
	    //实例化模型
		$users = D('admin');
		//获取总记录数
		$count = $users->count();
		//实例化分类页
		$Page = new \Think\Page($count,$num);
		//调用show显示分页链接
		$show = $Page->show();
		//实现数据分页
		$data = $users->field('id,icon_url,nick_name,true_name,gender,mobile,email,id_card_num,create_time,last_log_ip,last_log_time')->limit($Page->firstRow,$Page->listRows)->select();
		$output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('超级管理员信息！'),'code' => 200);
		exit(urldecode(json_encode($output)));
	}
    
	//添加管理员信息页面
	public function add(){
		$this->display();
	}
    
	//处理管理员信息
	public function addOK(){
		if (IS_POST) {
		    $pwd_confirm = strtolower(trim(I('post.user_password_confirmed')));
			$users = D('admin');
			$data = $users->create();
			foreach ($data as $key => $value){
			    $data[$key] = strtolower(trim($value));
			}			
			//当用户信息为空时，返回错误信息（需前端配合过滤）
			if (empty($data['nick_name']) || empty($data['true_name']) || empty($data['password']) || empty($data['mobile']) || empty($data['email']) || empty($data['id_card_num'])){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('超级管理员信息不能为空！'),'code' => -200);
		        exit(urldecode(json_encode($output)));
			}
			//检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
			if ($users->field('id')->where("nick_name = '{$data['nick_name']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));			    
			}
			if ($users->field('id')->where("mobile = '{$data['mobile']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
			if ($users->field('id')->where("email = '{$data['email']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}			
			if ($users->field('id')->where("id_card_num = '{$data['id_card_num']}'")->select()){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('身份证号已存在！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}									
			//当两次密码输入错误时，返回错误（需前端配合过滤）
			if ($data['password'] != $pwd_confirm){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/add'), 'sec' => 3),'info' => urlencode('两次输入的密码不一致！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
			//密码加密
			$data['password'] = md5($data['password']);
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
	    $id = I('post.id');
	    $status = M('admin')->where(array('id'=>$id))->delete();
	    if($status){
	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
	        if($status){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 2),'info' => urlencode('删除超级管理员成功！'),'code' => 200);
	            exit(urldecode(json_encode($output)));
	        }else{
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 3),'info' => urlencode('修改超级管理员失败！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/index'), 'sec' => 3),'info' => urlencode('修改超级管理员失败！'),'code' => -200);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	//更新管理员信息页面
	public function edit(){
	    $this->display();
	}
	
	//更新用户头像
	public function edit_icon(){
	    $id = I('post.user_id');
	    $users = D('admin');
	    //$data = $users->field('icon_url,nick_name,true_name,gender,h_pocn,mobile,email,id_card_num')->select();
	    $data = $users->field('id,icon_url')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['icon_url']),'info' => urlencode('用户头像'),'code' => 200);
	    exit(urldecode(json_encode($output)));
	}
	
	//更改昵称
	public function edit_nick_name(){
	    $id = I('post.user_id');
	    $users = D('admin');
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
	    $users = D('admin');
	    $data = $users->field('id,mobile')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['mobile']),'info' => urlencode('用户手机号'),'code' => 200);
	    exit(urldecode(json_encode($output)));
	}
	
	//更改邮箱
	public function edit_email(){
	    $id = I('post.user_id');
	    $users = D('admin');
	    $data = $users->field('id,email')->where("id = '{$id}'")->select();
	    $output = array('data' => array($data[0]['id'],$data[0]['email']),'info' => urlencode('用户邮箱'),'code' => 200);
	    exit(urldecode(json_encode($output)));
	}
	
	//更新所有信息(物业/管理员使用)
	public function edit_all(){
	    $id = I('post.user_id');
	    $users = D('admin');
	    $data = $users->field('id,icon_url,nick_name,mobile,email')->where("id = '{$id}'")->select();
	    $output = array('data' => $data,'info' => urlencode('需更新的用户信息'),'code' => 200);
	    exit(urldecode(json_encode($output)));	
	}
	//处理业主更新信息
	public function do_edit(){
	    $edit_type = I('post.edit_type');
	    if ($edit_type == 'edit_icon'){
	        $id = I('post.user_id');
	        $icon_url = strtolower(trim(I('post.icon_url')));
	        $data = array(
	            'icon_url' => $icon_url,
	            'id' => $id
	        );
	        D('admin')->save($data);
	    }elseif ($edit_type == 'edit_nick_name'){
	        $id = I('post.user_id');
	        $nick_name = strtolower(trim(I('post.nick_name')));
	        if (D('admin')->field('id')->where("nick_name = '{$nick_name}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_nick_name'), 'sec' => 3),'info' => urlencode('用户名已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        $data = array(
	            'nick_name' => $nick_name,
	            'id' => $id
	        );
	        D('admin')->save($data);
	    }elseif ($edit_type == 'edit_password'){
	        $id = I('post.user_id');
	    	$old_password = strtolower(trim(I('post.old_password')));
	        $new_password = strtolower(trim(I('post.new_password')));
	        $confirm_password = strtolower(trim(I('post.confirm_password')));
	        //获取当前用户密码
	        $row = D('admin')->field('password,id_card_num')->where("id = '{$id}'")->select();
	        //判断错误
	        if ($new_password != $confirm_password){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit_password'), 'sec' => 3),'info' => urlencode('输入的新密码不一致！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }else{
	            if ($row['password'] != create_hash($old_password, $row['id_card_num'])) {
	                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/edit_password'), 'sec' => 3),'info' => urlencode('输入的旧密码错误！'),'code' => -200);
	                exit(urldecode(json_encode($output)));
	            }else{
	                //执行
	                $data = array(
	                    'password' => create_hash($new_password, $row['id_card_num']),
	                    'id' => $id
	                );
	                D('admin')->save($data);
	            }
	        }
	    }elseif ($edit_type == 'edit_mobile'){
	        $id = I('post.user_id');
	        $mobile = strtolower(trim(I('post.mobile')));
	        if (D('admin')->field('id')->where("mobile = '{$mobile}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_mobile'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        $data = array(
	            'mobile' => $mobile,
	            'id' => $id
	        );
	        D('admin')->save($data);
	    }elseif ($edit_type == 'edit_email'){
	        $id = I('post.user_id');
	        $email = strtolower(trim(I('post.email')));
	        if (D('admin')->field('id')->where("email = '{$email}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_email'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }    
	        $data = array(
	            'email' => $email,
	            'id' => $id
	        );
	        D('admin')->save($data);
	    }elseif ($edit_type == 'edit_all'){
	        $id = I('post.user_id');
	        $icon_url = strtolower(trim(I('post.icon_url')));
	        $nick_name = strtolower(trim(I('post.nick_name')));
	        $old_password = MD5(strtolower(trim(I('post.old_password'))));
	        $new_password = MD5(strtolower(trim(I('post.new_password'))));
	        $confirm_password = MD5(strtolower(trim(I('post.confirm_password'))));
	        $mobile = strtolower(trim(I('post.mobile')));
	        $email = strtolower(trim(I('post.email')));
	        
	        //当用户信息为空时，返回错误信息（需前端配合过滤）
	        if (empty($icon_url) || empty($nick_name) || empty($old_password) || empty($new_password) || empty($confirm_password) || empty($mobile) || empty($email)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_all'), 'sec' => 3),'info' => urlencode('业主信息不能为空！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        //检查信息(nick_name,mobile,email,id_card_num)是否重复,需前端配合过滤
	        if (D('admin')->field('id')->where("nick_name = '{$nick_name}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_all'), 'sec' => 3),'info' => urlencode('昵称已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        if (D('admin')->field('id')->where("mobile = '{$mobile}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_all'), 'sec' => 3),'info' => urlencode('手机号已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        if (D('admin')->field('id')->where("email = '{$email}'")->select()){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_all'), 'sec' => 3),'info' => urlencode('邮箱已存在！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }    
	        //获取当前用户密码
	        $current_password = D('admin')->field('password')->where("id = '{$id}'")->select();
	        //判断错误
	        if ($current_password != $old_password) {
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_password'), 'sec' => 3),'info' => urlencode('输入的当前密码错误！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }elseif ($new_password != $confirm_password){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/edit_password'), 'sec' => 3),'info' => urlencode('输入的新密码不一致！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	        //执行
	        $data = array(
	            'id' => $id,
	            'icon_url' => $icon_url,
	            'nick_name' => $nick_name,
	            'password' => $new_password,
	            'mobile' => $mobile,
	            'email' => $email
	        );

	        D('admin')->save($data);	        
	    }
	}	
	
	//管理员对业主信息进行处理
    public function approving_users(){
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
    }
    
	//管理员删除用户信息
	public function delete_users(){
	    $id = I('post.id');
	    $status = M('users')->where(array('id'=>$id))->delete();
	    if($status){
	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
	        if($status){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 2),'info' => urlencode('删除用户成功！'),'code' => 200);
	            exit(urldecode(json_encode($output)));
	        }else{
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/approved_users'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => -200);
	        exit(urldecode(json_encode($output)));
	    }	     
	}
	
	//管理员对物业人员信息进行处理
    public function approving_mgrs(){
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
    }
	
	//管理员删除物业人员信息
	public function delete_mgrs(){
	    $id = I('post.id');
	    $status = M('mgrs')->where(array('id'=>$id))->delete();
	    if($status){
	        $status = M('role_user')->where(array('user_id'=>$id))->delete();
	        if($status){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 2),'info' => urlencode('删除物业成功！'),'code' => 200);
	            exit(urldecode(json_encode($output)));
	        }else{
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 3),'info' => urlencode('修改物业失败！'),'code' => -200);
	            exit(urldecode(json_encode($output)));
	        }
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Admin/approved_mgrs'), 'sec' => 3),'info' => urlencode('修改物业失败！'),'code' => -200);
	        exit(urldecode(json_encode($output)));
	    }	
	}	
}