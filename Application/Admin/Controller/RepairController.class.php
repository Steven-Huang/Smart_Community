<?php
namespace Admin\Controller;

class RepairController extends CommonController
{

    /**
     * 定义_empty空操作
     * 
     * @author Steven.Huang <87144734@qq.com>
     */
    public function _empty()
    {
        $this->show();
    }

    /**
     * 定义_empty空操作跳转
     * 
     * @author Steven.Huang <87144734@qq.com>
     */
    public function show()
    {
        $output = array(
            'data' => array(
                'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
                'sec' => 3
            ),
            'info' => urlencode('您访问的页面不存在！'),
            'code' => - 404
        );
        exit(urldecode(json_encode($output)));
    }
    
    /**
     * 待处理维修信息列表页面
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function toHandle()
    {
        $this->display();
    }
    
    /**
     * 已处理维修信息列表页面
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function handled()
    {
        $this->display();
    }
    
    /**
     * 请求返回维修信息 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function indexPost()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            // 获取反馈类型
            $cid = I('post.cid') ? I('post.cid') : 0;
            // 获取状态（0->待处理, 1->已处理）
            $status = I('post.status');
            // 获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            
            // 实例化模型
            $Repair = M('Repair');
            // 导入分页类
            import('ORG.Util.Page');
    
            if ($cid) {
                //获取指定ID分类的数据
                // 获取总记录数
                $count = $Repair->where(array(
                    'cid' => $cid,
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Repair->field('a.id,a.cid,a.title,a.from_who,a.mobile,a.create_time,a.create_id,a.status,a.operate_id,a.operate_time,b.aname')
                ->join('as a join sc_category as b on a.cid = b.acid')
                ->where(array(
                    'cid' => $cid,
                    'status' => $status
                ))
                ->limit($Page->firstRow, $Page->listRows)
                ->order('id desc')
                ->select();
            } else {
                //全部类型
                // 获取总记录数
                $count = $Repair->where(array(
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Repair->field('a.id,a.cid,a.title,a.from_who,a.mobile,a.create_time,a.create_id,a.status,a.operate_id,a.operate_time,b.aname')
                ->join('as a join sc_category as b on a.cid = b.acid')
                ->where(array(
                    'status' => $status
                ))
                ->limit($Page->firstRow, $Page->listRows)
                ->order('id desc')
                ->select();
            }
            
            // 对内容进行编码
            foreach ($data[0] as $key => $value) {
                $data[0][$key] = stripslashes($value);
            }
            
            $output = array(
                'data' => array(
                    'data' => $data,
                    'count' => $count,
                    'page' => urlencode($show),
                ),
                'info' => urlencode('维修信息列表！'),
                'code' => 200
            );
            exit(urldecode(json_encode($output)));
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 待处理维修信息详情页面
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function detail1()
    {
    if (IS_GET) {
            $id = I('get.id');
            $Repair = M('Repair');
            $item = $Repair->find($id);
            
            // 对内容进行编码
            foreach ($item as $key => $value) {
                $item[$key] = stripslashes($value);
            }
            
            $this->assign('item', $item);
            $this->display();
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 已处理维修信息详情页面
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function detail2()
    {
        $this->display();
    }
    
    /**
     * 指定ID号的维修信息 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function getSingleRepairById()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
    
            $id = I('post.id');
            $Repair = M('Repair');
            $item = $Repair->find($id);
            
            // 对内容进行编码
            foreach ($item as $key => $value) {
                $item[$key] = stripslashes(trim($value));
            }
            
            $output = array(
                'data' => $item,
                'info' => urlencode('指定ID号的维修信息！'),
                'code' => 200
            );
            exit(urldecode(json_encode($output)));
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }
    
    /**
     * 处理维修信息 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function handle()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
    
            // 获取反馈信息的ID
            $id = I('post.id');
            $result = I('post.result');
    
            $data = array(
                'id' => $id,
                'results' => htmlspecialchars($result),
                'status' => 1, //状态变成已处理
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            
            if (empty($data['results'])){
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Repair/toHandle'),
                        'sec' => 3
                    ),
                    'info' => urlencode('处理结果不能为空！'),
                    'code' => -201
                );
                exit(urldecode(json_encode($output)));
            }
            
            $res = M('Repair')->save($data);
    
            if ($res){
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Repair/toHandle'),
                        'sec' => 2
                    ),
                    'info' => urlencode('保存处理结果成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Repair/toHandle'),
                        'sec' => 3
                    ),
                    'info' => urlencode('保存处理结果失败，请重新再试！'),
                    'code' => - 200
                );
                exit(urldecode(json_encode($output)));
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }
}