<?php
namespace Admin\Controller;

class FeedbackController extends CommonController
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
     * 通知反馈信息列表页面
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 请求返回用户投诉/表扬信息 [面向APP的API接口，AJAX post请求]
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
            $type = (int) I('post.type') ? (int) I('post.type') : 0;
            // 获取状态（0，待处理；1，已处理）
            $status = I('post.status');
            // 获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            
            // 实例化模型
            $Feedback = M('Feedback');
            // 导入分页类
            import('ORG.Util.Page');
            
            if (! $type) {
                // 当指定分类时
                // 获取总记录数
                $count = $Feedback->where(array(
                    'type' => $type,
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Feedback->field('id,to_who,type,content,materials,from_who,mobile,create_time,create_id,status,results,operate_id,operate_time')
                    ->where(array(
                    'type' => $type,
                    'status' => $status
                ))
                    ->limit($Page->firstRow, $Page->listRows)
                    ->order('id desc')
                    ->select();
            } else {
                // 当获取全部数据时
                // 获取总记录数
                $count = $Feedback->where(array(
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Feedback->field('id,to_who,type,content,materials,from_who,mobile,create_time,create_id,status,results,operate_id,operate_time')
                    ->where(array(
                    'status' => $status
                ))
                    ->limit($Page->firstRow, $Page->listRows)
                    ->order('id desc')
                    ->select();
            }
            
            $output = array(
                'data' => array(
                    'data' => $data,
                    'count' => $count,
                    'page' => urlencode($show)
                ),
                'info' => urlencode('反馈信息列表！'),
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
     * 指定ID号反馈的信息 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function getSingleFeedbackById()
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
            $Feedback = M('Feedback');
            $item = $Feedback->find($id);
            
            $output = array(
                'data' => $item,
                'info' => urlencode('指定ID号反馈的信息！'),
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
     * 处理反馈 [面向APP的API接口，AJAX post请求]
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
                'result' => $result,
                'status' => 1, //状态变成已处理
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            
            $res = M('Feedback')->save($data);
            
            if ($res){
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('处理成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/index'),
                        'sec' => 3
                    ),
                    'info' => urlencode('处理失败，请重新再试！'),
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