<?php
namespace Admin\Controller;
use Think\Model;

use Think\Think;
use Think\Page;
class AccessController extends CommonController{
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }

    //引入角色列表页面
    public function index_list(){
        $this->display();
    }    
    
	/**
	 * 用户角色列表
	 * @return [type] 
	 */
	public function index(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (empty($token) || !check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
	        //获取每页展示行数
	        $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
	        //接收角色数据
	        $role = I('post.role');
	        if ($role == 'users') {
	            //获取总记录数
	            $count = M('role_user')->where("user_type = 'U'")->count();
	            //实例化分类页
	            $Page = new \Think\Page($count,$count);

	            //调用show显示分页链接
	            $show = $Page->show();
	        
	            $data = M('users')->field('a.id,a.nick_name,b.role_id')->join('as a join sc_role_user as b on a.id = b.user_id')->where("user_type = 'U'")->limit($Page->firstRow.','.$Page->listRows)->select();
	        }elseif ($role == 'mgrs'){
	            //获取总记录数
	            $count = D('role_user')->where("user_type = 'M'")->count();
	            //实例化分类页
	            $Page = new \Think\Page($count,$count);
	            //调用show显示分页链接
	            $show = $Page->show();
	        
	            $data = M('mgrs')->field('a.id,a.nick_name,b.role_id')->join('as a join sc_role_user as b on a.id = b.user_id')->where("user_type = 'M'")->limit($Page->firstRow.','.$Page->listRows)->select();
	        }elseif ($role == 'admin'){
	            //获取总记录数
	            $count = D('role_user')->where("user_type = 'A'")->count();
	            //实例化分类页
	            $Page = new \Think\Page($count,$count);
	            //调用show显示分页链接
	            $show = $Page->show();
	        
	            $data = M('admin')->field('a.id,a.nick_name,b.role_id')->join('as a join sc_role_user as b on a.id = b.user_id')->where("user_type = 'A'")->limit($Page->firstRow.','.$Page->listRows)->select();
	        }
	         
	        foreach ($data as $key => &$value) {
	            $value['role'] = urlencode(M('role')->where(array('id'=>$value['role_id']))->getField('name'));
	        }
	        $output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('用户角色列表'),'code' => 200);
	        exit(urldecode(json_encode($output)));	        
	    }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));        
        }
	}
	
	//显示edit页面
	public function edit_user_role(){
	    $this->display();
	}
	
	/**
	 * 编辑用户角色
	 */
// 	public function role_list(){
// 	    //接收角色数据
// 	    $role = I('role');	    
// // 		$user_id = I('user_id');
// 		$role_id = I('role_id');
// // 		//获取用户名
// // 		$data = M($role)->field('nick_name')->where(array('id'=>$user_id))->find();
// 		//获取角色列表
// 		$role = M('role')->field('id,name')->select();
		
// 		foreach ($role as $key => &$value) {
// 		    $value['name'] = urlencode($value['name']);
// 		}
// 		$output = array('data' => array('role_list' => $role),'info' => urlencode('添加编辑用户'),'code' => 200);
// 		exit(urldecode(json_encode($output)));		
// 	}

	/**
	 * 修改用户角色
	 * @return [type] [description]
	 */
	public function do_user_role(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    		$user_id = (int)(I('post.user_id'));
    		$new_role_id = (int)(I('post.new_role_id'));
    		$role = I('post.role');
    		$role = $role == 'users' ? 'U' : ($role == 'mgrs' ? 'M' :($role == 'admin' ? 'A' : '0'));
    		if(!empty($user_id)){
    			$data = array(
    				'role_id' => $new_role_id,
    				);
    			$status = M('role_user')->where(array('user_id'=>$user_id,'user_type'=>$role))->save($data);
    			if($status){
    				$output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/index_list'), 'sec' => 2),'info' => urlencode('修改用户角色成功！'),'code' => 200);
    				exit(urldecode(json_encode($output)));
    			}else{
    			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/edit_user_role'), 'sec' => 3),'info' => urlencode('修改用户角色失败！'),'code' => -200);
    			    exit(urldecode(json_encode($output)));
    			}
    		}
	    }else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}
	}


	/**
	 * 删除用户
	 * @return [type] [description]
	 */
// 	public function del_user(){
// 		$id = I('get.id');
// 		$status = M('users')->where(array('id'=>$id))->delete();
// 		if($status){
// 			$status = M('role_user')->where(array('user_id'=>$id))->delete();
// 			if($status){
// 				//$this->success('删除成功',U('Admin/Access/index'));
// 			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/index'), 'sec' => 2),'info' => urlencode('删除用户成功！'),'code' => 200);
// 			    exit(urldecode(json_encode($output)));
// 			}else{
// 			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/index'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => -200);
// 			    exit(urldecode(json_encode($output)));
// 			}
// 		}else{
// 		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/index'), 'sec' => 3),'info' => urlencode('修改用户失败！'),'code' => -200);
// 		    exit(urldecode(json_encode($output)));
// 		}
// 	}

	//引入角色列表页面
	public function node_list(){
	    $this->display();
	}
	
   /**
    * 节点列表
    * @return [type] [description]
    */
	public function node(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }    
    		$data = M('node')->select();
    		foreach ($data as $key => &$value){
    		    $value['title'] = urlencode($value['title']);
    		}		
    		//$info = category($data);
     		$data = category($data);
    		$str = '';
            foreach ($data as $v){
                $str .= <<<Eof
                        	<div style="margin:5px;border-bottom:1px dotted #ccc">
                        		<button type="button" class="btn-primary">{$v['title']}</button>
                        		<a href="add_node/pid/{$v['id']}/level/2"><i class="fa fa-plus"></i></a>
                        		<a href="javascript:;" name="del" id="{$v['id']}"><i class="fa fa-trash-o"></i></a>
                        	</div>
Eof;
                foreach ($v['child'] as $con){
                    $str .= <<<Eof
                    		<div style="margin:5px;border-top:1px solid #555">
                    			<button type="button" class="btn-success">{$con['title']}</button>
                    			<a href="add_node/pid/{$con['id']}/level/3"><i class="fa fa-plus"></i></a>
                    			<a href="javascript:;" name="del" id="{$con['id']}"><i class="fa fa-trash-o"></i></a>
                    		</div>
                    		<div style="margin:5px;">
Eof;
                    foreach ($con['child'] as $act){
                        $str .= <<<Eof
            				<button type="button" class="btn-info" >{$act['title']}</button>
            				<a style="margin-right:10px" href="javascript:;" name="del" id="{$act['id']}"><i class="fa fa-trash-o"></i></a>
Eof;
                    }
                    $str .= "</div>";
                }
            }
    		$output = array('data' => $str,'info' => urlencode('节点列表'),'code' => 200);
    		exit(urldecode(json_encode($output)));		
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}
	}

	/**
	 * 添加编辑节点页面
	 */
	public function add_node(){
	    $this->display();
	}
	/**
	 * 添加编辑节点列表
	 */
	public function add_node_list(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    		$pid = I('post.pid','0');
    		$level = I('post.level','1');
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
    		$output = array('data' => array('view' => urlencode($view), 'pid' => $pid, 'level' => $level),'info' => urlencode('添加/编辑节点'),'code' => 200);
    		exit(urldecode(json_encode($output)));
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}
	}

	/**
	 * 添加节点动作
	 * @return [type] [description]
	 */
	public function do_node(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    		$data = array(
    			'name'  => strtolower(trim(I('post.name',''))),
    			'title' => strtolower(trim(I('post.title',''))),
    			'sort'  => strtolower(trim(I('post.sort',''))),
    			'level' => strtolower(trim(I('post.level',''))),
    			'pid'   => strtolower(trim(I('post.pid',''))),
    			'status'=> '1'
    			);
    		$node = M('node');
    		if (empty($data['name']) || empty($data['title']) || empty($data['sort'])){
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('节点信息不能为空！'),'code' => -201);
    		    exit(urldecode(json_encode($output)));
    		}
    		if ($node->where(array('name'=>$data['name'],'level'=>$data['level'],'pid'=>$data['pid']))->select()){
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('节点已存在,请重新再试！'),'code' => -202);
    		    exit(urldecode(json_encode($output)));
    		}
    		$status = $node->add($data);
    		if($status){
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 2),'info' => urlencode('添加节点成功！'),'code' => 200);
    		    exit(urldecode(json_encode($output)));			
    		}else{
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('添加节点失败！'),'code' => -200);
    		    exit(urldecode(json_encode($output)));
    		}
    	}else{
    	    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . 'Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
    	    exit(urldecode(json_encode($output)));
    	}
	}


	/**
	 * 删除节点
	 * @return [type] [description]
	 */
	public function del_node(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }
    		$id = I('post.id');
    		$model = new Model();
    		//开启事务
    		$model->startTrans();
    		
    		$status1 = $model->table(C('DB_PREFIX').'node')->where(array('pid'=>$id))->find();
    	     
    		if ($status1){
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('此节点存在子节点，请先删除子节点！'),'code' => -201);
    		    exit(urldecode(json_encode($output)));
    		} else {
    		    $status2 = $model->table(C('DB_PREFIX').'node')->where(array('id'=>$id))->delete();
    		    if($status2){
    		        $status3 = $model->table(C('DB_PREFIX').'access')->where(array('node_id'=>$id))->delete();
    		        if ($status3){
    		            //成功提交
    		            $model->commit();
    		            
    		            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 2),'info' => urlencode('删除节点成功！'),'code' => 200);
    		            exit(urldecode(json_encode($output)));
    		        } else {
    		            //失败回滚
    		            $model->rollback();
    		            
    		            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('删除节点失败！'),'code' => -200);
    		            exit(urldecode(json_encode($output)));
    		        }  
    		    }else{
    		        //失败回滚
    		        $node->rollback();
    		        
    		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/node_list'), 'sec' => 3),'info' => urlencode('删除节点失败！'),'code' => -200);
    		        exit(urldecode(json_encode($output)));
    		    } 
    		}

		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}    		
	}
    
	//引入角色列表页面
	public function role_list(){
	    $this->display();
	}
	
    /**
     * 角色列表
     * @return [type] [description]
     */
	public function role(){
	    if (IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }	    
    		$data = M('role')->select();
    		foreach ($data as $key => &$value){
    		    $value['name'] = urlencode($value['name']);
    		    $value['remark'] = urlencode($value['remark']);
    		}
    		$output = array('data' => $data,'info' => urlencode('角色列表'),'code' => 200);
    		exit(urldecode(json_encode($output)));		
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求失败，请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}        		
	}
    
	//编辑角色页面
	public function add_role(){
	    $this->display();
	}
	
	/**
	 * 处理添加编辑角色
	 */
	public function do_add_role(){
		if(IS_POST){
		    //获取TOKEN
		    $token = I('post.access_token');
		    if (!check_token($token)){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
		        exit(urldecode(json_encode($output)));
		    }
		    $name = I('post.name');
		    $remark = I('post.remark');
		    
		    $role = M('role');
		    //判断角色名是否存在
		    $check_name = $role->where(array('name'=>$name))->select();
		    if ($check_name){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/add_role'), 'sec' => 3),'info' => urlencode('角色名已存在！'),'code' => -201);
		        exit(urldecode(json_encode($output)));		        
		    }
		    //角色名不存在时添加
			$data = array(
				'name' => $name,
				'status' => '1',
				'remark' => $remark
				);
			$status = $role->add($data);
			if($status){
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 2),'info' => urlencode('添加角色成功！'),'code' => 200);
			    exit(urldecode(json_encode($output)));				
			}else{
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/add_role'), 'sec' => 3),'info' => urlencode('添加角色失败！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}

		}else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));	
		}
	}

	/**
	 * 删除角色
	 * @return [type] [description]
	 */
	public function del_role(){
	    if(IS_POST){
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }	    
    		$id = I('post.id');
    		
    		$model = new Model();
    		//开启事务
    		$model->startTrans();
    		
    		$status1 = $model->table(C('DB_PREFIX').'role')->where(array('id'=>$id))->delete();
    		if($status1){
    		    $data = array(
    		        'role_id' => 0 //为待分配角色
    		    );		    
    		    $status2 = $model->table(C('DB_PREFIX').'role_user')->where(array('role_id'=>$id))->setField($data);	    
    			if ($status2){
    			    //成功提交
    			    $model->commit();
    			    
    			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 2),'info' => urlencode('删除角色成功！'),'code' => 200);
    			    exit(urldecode(json_encode($output)));
    			}else {
    			    //失败回滚
    			    $model->rollback();
    			    
    			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 3),'info' => urlencode('删除角色失败！'),'code' => -200);
    			    exit(urldecode(json_encode($output)));
    			}
    		}else{
    		    //失败回滚
    		    $model->rollback();
    		    
    		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 3),'info' => urlencode('删除角色失败！'),'code' => -200);
    			exit(urldecode(json_encode($output)));
    		}
		}else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . 'Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}	
	}
	
	public function access_list(){
	    //用户点击角色的权限配置跳转到此，GET请求
	    $id = I('get.id');
	    $data = M('node')->select();
	    	
	    //$ids  = M('access')->field('node_id')->where(array('role_id'=>$id))->select();
	    $ids  = M('access')->where(array('role_id'=>$id))->getField('node_id',true);
	    
	    $data = category($data);
	    
	    $this->assign('data',$data);
	    $this->assign('ids',$ids);
	    $this->assign('id',$id);
	    $this->display();
	}

	/**
	 * 获取当前角色的权限列表
	 * @return [type] [description]
	 */
	public function access_role_list(){
	    if(IS_POST){
	        //用户提交更新的权限配置
	        //获取TOKEN
	        $token = I('post.access_token');
	        if (!check_token($token)){
	            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
	            exit(urldecode(json_encode($output)));
	        }	    
    	    //用户点击角色的权限配置跳转到此，GET请求
    	    $id = I('post.id');
    	    $data = M('node')->select();
    	    
    	    //$ids  = M('access')->field('node_id')->where(array('role_id'=>$id))->select();
    	    $ids  = M('access')->where(array('role_id'=>$id))->getField('node_id',true);

    	    foreach ($data as $key => &$value){
    	        $value['title'] = urlencode($value['title']);
    	    }
    	    $data = category($data);
    	    $str = '';
    	    
    	    foreach ($data as $v){
    	        $str .= <<<Eof
    	                <div>
                        <div style="border-bottom:1px dotted #ccc">
                        <button type="button" class="btn-primary">{$v['title']}</button>
                        <input type="checkbox" id="node" name="access[]" class="level1" value="{$v['id']}">
                        </div>
Eof;
    	        foreach ($v['child'] as $con){
    	            $str .= <<<Eof
                            <div style="border-top:1px solid #555">
                                <button type="button" class="btn-success">{$con['title']}</button>
                                <input type="checkbox" id="node" name="access[]" class="level2" value="{$con['id']}">
                            </div>
Eof;
    	            // "<?php if(in_array({$con['id']}, {$ids})){echo 'checked'}
    	            foreach ($con['child'] as $act){
    	                $str .= <<<Eof
    	                       <div style="">
                                <button type="button" class="btn-info" >{$act['title']}</button>
                                <input type="checkbox" id="node" name="access[]" class="level3" value="{$act['id']}">
                                </div>
Eof;
    	            }
    	            $str .= "</div>";
    	        }
    	    }
    	    
    	    $output = array('data' => array(
    	        'ids' => $ids,
    	        'id' => $id,
    	        'data' => $str
    	    ),'info' => urlencode('权限列表'),'code' => 200);
    	    exit(urldecode(json_encode($output)));
	    }else{
	        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . 'Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
	        exit(urldecode(json_encode($output)));
	    }
	}
	
	/**
	 * 权限添加修改
	 * [access description]
	 * @return [type] [description]
	 */
	public function access(){
		if(IS_POST){
		    //用户提交更新的权限配置
		    //获取TOKEN
		    $token = I('post.access_token');
		    if (!check_token($token)){
		        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
		        exit(urldecode(json_encode($output)));
		    }
			$node_id = explode(',', I('post.access'));
			$role_id = I('post.id');
			$status = M('access')->where(array('role_id'=>$role_id))->delete();
			$data = array();
			foreach ($node_id as $key => $value) {
				$data[] = array(
					'role_id' => $role_id,
					'node_id' => $value,
					);
			}
// 			$output = array('info' => $node_id,'code' => -200);
// 			exit(urldecode(json_encode($output)));
			$status = M('access')->addAll($data);
			if($status){
				$output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 2),'info' => urlencode('更新权限成功！'),'code' => 200);
			    exit(urldecode(json_encode($output)));				
			}else{
			    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Access/role_list'), 'sec' => 3),'info' => urlencode('更新权限失败！'),'code' => -200);
			    exit(urldecode(json_encode($output)));
			}
        }else{
		    $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . 'Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
		    exit(urldecode(json_encode($output)));
		}
	}
}
