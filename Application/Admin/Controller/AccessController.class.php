<?php
namespace Admin\Controller;
class AccessController extends CommonController{

	/**
	 * 用户列表
	 * @return [type] 
	 */
	public function index(){
		$data = M('users')->field('a.u_id,a.u_nick_name,b.role_id')->join('as a left join sc_role_user as b on a.u_id = b.user_id')->select();
		foreach ($data as $key => &$value) {
			$value['role'] = urlencode(M('role')->where(array('id'=>$value['role_id']))->getField('name'));
		}
// 		$this->assign('data',$data);
//         $this->display();
		$output = array('data' => $data,'info' => urlencode('用户列表'),'code' => 200);
		exit(urldecode(json_encode($output)));                             
	}

	/**
	 * 添加编辑用户
	 */
	public function add_user(){
		$user_id = I('get.user_id');
		$role_id = I('get.role_id');
		if(!empty($user_id)){
		    //当传入user_id
			$data = M('users')->field('u_nick_name')->where(array('u_id'=>$user_id))->find();
// 			$this->assign('data',$data);
			$output = array('data' => $data,'info' => urlencode('添加编辑用户'),'code' => 200);
			exit(urldecode(json_encode($output)));
		}
		$role = M('role')->field('id,name')->select();
// 		$this->assign('role_id',$role_id);
// 		$this->assign('role',$role);
// 		$this->display();
		foreach ($role as $key => &$value) {
		    $value['name'] = urlencode($value['name']);
		}
		$output = array('data' => $role,'info' => urlencode('添加编辑用户'),'code' => 200);
		exit(urldecode(json_encode($output)));		
	}

	/**
	 * 添加动作
	 * @return [type] [description]
	 */
	public function do_user(){
		$user_id = I('post.user_id');
		$role_id = I('post.role_id');
		if(empty($user_id)){
			$data = array(
				'u_nick_name' => I('post.name'),
			    'u_create_time' => date('Y-m-d h:i:s',time())
			);
			$status = M('users')->add($data);
			$data = array(
				'role_id' => $role_id,
				'user_id' => $status
				);
			$status = M('role_user')->add($data);
			if($status){
// 				$this->success('添加成功',U('Admin/Access/index'));
				$output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Access/index'), 'sec' => 2),'info' => urlencode('添加用户成功！'),'code' => 200);
				exit(urldecode(json_encode($output)));				
			}else{
// 				$this->error('添加失败');
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Access/add_user'), 'sec' => 3),'info' => urlencode('添加用户失败！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
		}else{
			$data = array(
				'u_nick_name' => I('post.name'),
				'u_create_time' => date('Y-m-d h:i:s',time())
			);
			$status = M('users')->where(array('u_id'=>$user_id))->setField($data);
			M('role_user')->where(array('user_id'=>$user_id))->delete();
			$data = array(
				'role_id' => $role_id,
				'user_id' => $user_id,
				);
			$status = M('role_user')->add($data);
			if($status){
				$output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Access/index'), 'sec' => 2),'info' => urlencode('修改用户成功！'),'code' => 200);
				exit(urldecode(json_encode($output)));	
			}else{
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Access/add_user'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
		}
		
	}


	/**
	 * 删除用户
	 * @return [type] [description]
	 */
	public function del_user(){
		$id = I('get.u_id');
		$status = M('users')->where(array('u_id'=>$id))->delete();
		if($status){
			$status = M('role_user')->where(array('user_id'=>$id))->delete();
			if($status){
				$this->success('删除成功',U('Admin/Access/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('删除失败');
		}
	}

   /**
    * 节点列表
    * @return [type] [description]
    */
	public function node(){
		$data = M('node')->select();
		$info = category($data);
		$this->assign('data',$info);
		$this->display();
	}

	/**
	 * 添加编辑节点
	 */
	public function add_node(){
		$pid = I('get.pid','0');
		$level = I('get.level','1');
		switch ($level) {
			case '1':
				$view = '模块';
				break;
			case '2':
				$view = '控制器';
				break;
			case '3':
				$view = '方法';
				break;
			default:
				$view = '模块';
				break;
		}
		$this->assign('view',$view);
		$this->assign('pid',$pid);
		$this->assign('level',$level);
		$this->display();
	}

	/**
	 * 添加动作
	 * @return [type] [description]
	 */
	public function do_node(){
		$data = array(
			'name'  => I('post.name',''),
			'title' => I('post.title',''),
			'sort'  => I('post.sort',''),
			'level' => I('post.level',''),
			'pid'   => I('post.pid',''),
			'status'=> '1'
			);
		$status = M('node')->add($data);
		if($status){
			$this->success('添加成功',U('Admin/Access/node'));
		}else{
			$this->error('添加失败');
		}

	}


	/**
	 * 删除节点
	 * @return [type] [description]
	 */
	public function del_node(){
		$id = I('get.id');
		$status = M('node')->where(array('id'=>$id))->delete();
		if($status){
		    $status = M('access')->where(array('node_id'=>$id))->delete();
			$this->success('删除成功',U('Admin/Access/node'));
		}else{
			$this->error('删除失败');
		}
	}

    /**
     * 角色列表
     * @return [type] [description]
     */
	public function role(){
		$data = M('role')->select();
		$this->assign('data',$data);
		$this->display();
	}

	/**
	 * 添加编辑角色
	 */
	public function add_role(){
		if(IS_POST){
			$data = array(
				'name' => I('post.name'),
				'status' => '1',
				'remark' => I('post.remark')
				);
			$status = M('role')->add($data);
			if($status){
				$this->success('添加成功',U('Admin/Access/role'));
			}else{
				$this->error('添加失败');
			}

		}else{
			$this->display();
		}
		
	}

	/**
	 * 删除角色
	 * @return [type] [description]
	 */
	public function del_role(){
		$id = I('get.id');
		$status = M('role')->where(array('id'=>$id))->delete();
		if($status){
		    $data = array(
		        'role_id' => 0 //为分配角色
		    );		    
		    M('role_user')->where(array('role_id'=>$id))->setField($data);	    
			$this->success('删除成功',U('Admin/Access/role'));
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * [access description]
	 * @return [type] [description]
	 */
	public function access(){
		if(IS_POST){
			$node_id = I('post.');
			$role_id = $node_id['id'];
			$status = M('access')->where(array('role_id'=>$role_id))->delete();
			$data = array();
			foreach ($node_id['access'] as $key => $value) {
				$data[] = array(
					'role_id' => $role_id,
					'node_id' => $value,
					);
			}
			$status = M('access')->addAll($data);
			if($status){
				$this->success('添加成功',U('Admin/Access/role'));
			}else{
				$this->error('添加失败');
			} 
		}else{
			$id = I('get.id');
			$data = M('node')->select();
			$ids  = M('access')->where(array('role_id'=>$id))->getField('node_id',true);
			$this->assign('ids',$ids);
			$info = category($data);
			$this->assign('id',$id);
			$this->assign('data',$info);
			$this->display();
		}

	}

}	
