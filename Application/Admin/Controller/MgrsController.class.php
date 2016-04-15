<?php
namespace Admin\Controller;
//use Admin\Model\UsersModel;

class MgrsController extends CommonController {
    //展示物业人员基本信息（需做分页功能）
	public function index(){
		$users = D('mgrs');
		$data = $users->field('u_id,u_icon_url,u_nick_name,u_true_name,u_gender,h_pocn,u_mobile,u_email,u_id_card_num,u_create_time,u_last_log_ip,u_last_log_time,u_if_aprvd')->select();
        exit(urldecode(json_encode($data)));
	}
    
	//添加物业人员信息页面
	public function add(){
		$this->display();
	}
    
	//处理物业人员信息
	public function addOK(){
		if (IS_POST) {
		    $pwd_confirm = I('post.user_password_confirmed');
			$users = D('Users');
			$data = $users->create();
			//当用户信息为空时，返回错误信息（需前端配合过滤）
			if (empty($data['u_nick_name']) || empty($data['u_true_name']) || empty($data['u_password']) || empty($data['h_pocn']) || empty($data['u_mobile']) || empty($data['u_email']) || empty($data['u_id_card_num'])){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('业主信息不能为空！'),'code' => -200);
		        exit(urldecode(json_encode($output)));
			}
			//当两次密码输入错误时，返回错误（需前端配合过滤）
			if ($data['u_password'] != $pwd_confirm){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('两次输入的密码不一致！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
			//密码加密
			$data['u_password'] = md5($data['u_password']);
			$data['u_create_time'] = date('Y-m-d h:i:s',time());
			if ($users->add($data)) {
				//$this->success('添加业主信息成功！','index',2);
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/index'), 'sec' => 2),'info' => urlencode('添加业主信息成功！'),'code' => 200);
		        exit(urldecode(json_encode($output)));				
			}else{
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('添加业主信息失败！请重新再试！'),'code' => -200);
		        exit(urldecode(json_encode($output)));				
				//$this->error('添加业主信息失败！请重新再试！','add',3);
			}
		}else{
			//$this->error('请求错误！请重新再试！','add',3);
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Users/add'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));	
		}
	}
	
	//更新物业人员信息页面
	public function edit(){
	    $this->display();
	}
	
	//处理物业人员更新信息
	public function editOK(){
	    
	}
	
	//物业对业主信息进行处理
	//物业审核业主申请信息，审核通过（需要考虑权限问题）
	public function approve_users(){
	     
	}	

	//物业审核业主申请信息，审核不通过（需要考虑权限问题）
	public function reject_users(){
	
	}
    
	//物业删除用户信息（需要考虑权限问题，还有相关材料）
	public function delete_users(){
	     
	}
}