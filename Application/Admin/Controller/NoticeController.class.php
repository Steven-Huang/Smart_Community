<?php
namespace Admin\Controller;

class NoticeController extends CommonController {
    
    /**
     * 定义_empty空操作
     * @author Steven.Huang <87144734@qq.com>
     */
    public function _empty(){
        $this->show();
    }
    
    /**
     * 定义_empty空操作跳转
     * @author Steven.Huang <87144734@qq.com>
     */
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
    /**
     * 通知列表页面
     * @author Steven.Huang <87144734@qq.com>
     */
    public function index(){
        $this->display();
    }
    
    /**
     * 请求返回通知信息
     * @author Steven.Huang <87144734@qq.com>
     */
    public function index_post(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            //获取通知类型（1->小区通知,2->政府公告,3->办事指南）
            $type = (int)I('post.notice_type');
            //获取通知状态（1->发布,0->待审核）
            $status = (int)I('post.notice_status');
            //获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            //实例化模型
            $notice = D('notice');
            //获取总记录数
            $count = $notice->where(array('n_type'=>$type,'n_status'=>$status))->count();
            //实例化分类页
            $Page = new \Think\Page($count,$count);
            //调用show显示分页链接
            $show = $Page->show();
            //实现数据分页
            $data = $notice->field('id,n_author,n_source,n_titile,n_valid_time,n_content,n_keywords,n_abstracts,n_create_date,n_apprv_time')->where(array('n_type'=>$type,'n_status'=>$status))->limit($Page->firstRow,$Page->listRows)->select();
            $output = array('data' => array('data' => $data, 'count' => $count, 'page' => urlencode($show)),'info' => urlencode('通知信息列表！'),'code' => 200);
            exit(urldecode(json_encode($output)));
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 添加通知页面
     * @author Steven.Huang <87144734@qq.com>
     */
    public function add(){
        $this->display();
    }
    
    /**
     * 处理通知添加操作
     * @author Steven.Huang <87144734@qq.com>
     */
    public function do_add(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            
            //获取通知信息
            $data = array(
                'n_type' => (int)I('post.notice_type'),
                'n_author' => trim(I('post.notice_author')),
                'n_source' => trim(I('post.notice_source')),
                'n_titile' => trim(I('post.notice_titile')),
                'n_content' => trim(I('post.notice_content')),
                'n_keywords' => trim(I('post.notice_keywords')),
                'n_abstracts' => trim(I('post.notice_abstracts')),
                'n_valid_time' => I('post.notice_valid_time')
            );
            
            //当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['n_type']) || empty($data['n_author']) || empty($data['n_source']) || empty($data['n_titile']) || empty($data['n_content']) || empty($data['n_keywords']) || empty($data['n_abstracts']) || empty($data['n_valid_time'])){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/add'), 'sec' => 3),'info' => '通知信息不能为空！','code' => '-201');
                exit(urldecode(json_encode($output)));
            }
            
            //对内容进行编码
            foreach ($data as $key => $value){
                $data[$key] = urlencode(trim($value));
            }
            
            //实例化模型
            $notice = D('notice');
            if ($notice->add($data)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 2),'info' => urlencode('添加通知成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/add'), 'sec' => 3),'info' => urlencode('添加通知失败！请重新再试！'),'code' => -200);
                exit(urldecode(json_encode($output)));
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 更新通知页面
     * @author Steven.Huang <87144734@qq.com>
     */
    public function update(){
        $this->display();
    }
    
    /**
     * 列出需要更新通知内容
     * @author Steven.Huang <87144734@qq.com>
     */
    public function update_notice_list(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            
            //获取需要更新的通知ID
            $id = I('post.notice_id');
            //实例化模型
            $notice = D('notice');
            //获取数据
            $data = $notice->field('id,n_author,n_source,n_titile,n_valid_time,n_content,n_keywords,n_abstracts,n_create_date,n_apprv_time')->where(array('n_id'=>$id))->select();
            $output = array('data' => $data,'info' => urlencode('需要更新的通知信息！'),'code' => 200);
            exit(urldecode(json_encode($output)));
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 处理更新通知动作
     * @author Steven.Huang <87144734@qq.com>
     */
    public function do_update(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
    
            //获取通知信息
            $data = array(
                'n_id' => (int)I('post.notice_id'),
                'n_type' => (int)I('post.notice_type'),
                'n_author' => trim(I('post.notice_author')),
                'n_source' => trim(I('post.notice_source')),
                'n_titile' => trim(I('post.notice_titile')),
                'n_content' => trim(I('post.notice_content')),
                'n_keywords' => trim(I('post.notice_keywords')),
                'n_abstracts' => trim(I('post.notice_abstracts')),
                'n_valid_time' => I('post.notice_valid_time')
            );
    
            //当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['n_type']) || empty($data['n_author']) || empty($data['n_source']) || empty($data['n_titile']) || empty($data['n_content']) || empty($data['n_keywords']) || empty($data['n_abstracts']) || empty($data['n_valid_time'])){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/add'), 'sec' => 3),'info' => '通知信息不能为空！','code' => '-201');
                exit(urldecode(json_encode($output)));
            }
    
            //对内容进行编码
            foreach ($data as $key => $value){
                $data[$key] = urlencode(trim($value));
            }
    
            //实例化模型
            $notice = D('notice');
            if ($notice->save($data)) {
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 2),'info' => urlencode('更新通知成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/update'), 'sec' => 3),'info' => urlencode('更新通知失败！请重新再试！'),'code' => -200);
                exit(urldecode(json_encode($output)));
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 审批通知
     * @author Steven.Huang <87144734@qq.com>
     */
    public function approving_notice(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
    
            //获取需要审批通知ID
            $id = I('post.notice_id');
            $data = array(
                'n_id' => $id,
                'n_status' => 1,
                'n_operate_time' => date('Y-m-d h:i:s',time()),
                'n_operate_id' => $_SESSION['user_id']
            );
            $status = D('notice')->save($data);
            if ($status){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 2),'info' => urlencode('通知审批成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 3),'info' => urlencode('通知审批失败！'),'code' => -200);
                exit(urldecode(json_encode($output)));
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 删除通知，放进回收站
     * @author Steven.Huang <87144734@qq.com>
     */
    public function delete_notice(){
        if (IS_POST) {
            //获取TOKEN
            $token = I('post.access_token');
            if (!check_token($token)){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'), 'sec' => 3),'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),'code' => -208);
                exit(urldecode(json_encode($output)));
            }
            
            //获取需要审批通知ID
            $id = I('post.notice_id');
            $data = array(
                'n_id' => $id,
                'n_status' => '-1',
                'n_operate_time' => date('Y-m-d h:i:s',time()),
                'n_operate_id' => $_SESSION['user_id']
            );
            $status = D('notice')->save($data);
            if ($status){
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 2),'info' => urlencode('删除通知成功！'),'code' => 200);
                exit(urldecode(json_encode($output)));
            }else{
                $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'), 'sec' => 3),'info' => urlencode('删除通知失败！'),'code' => -200);
                exit(urldecode(json_encode($output)));
            }
        }else{
            $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('请求错误！请重新再试！'),'code' => -205);
            exit(urldecode(json_encode($output)));
        }
    }
    
}