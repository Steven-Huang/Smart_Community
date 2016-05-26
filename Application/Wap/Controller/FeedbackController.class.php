<?php
namespace Wap\Controller;

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
     * 请求返回指定用户ID的投诉/表扬信息 [面向APP的API接口，AJAX post请求]
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
            // 获取用户ID
            $create_id = $_SESSION['user_id'];
            // 获取状态（0，待处理；1，已处理）
            $status = I('post.status');
            // 获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            
            // 实例化模型
            $Feedback = M('Feedback');
            // 导入分页类
            import('ORG.Util.Page');
            
            // 当指定分类时
            // 获取总记录数
            $count = $Feedback->where(array(
                'create_id' => $create_id,
                'status' => $status
            ))->count();
            // 实例化分类页
            $Page = new \Think\Page($count, $count);
            // 调用show显示分页链接
            $show = $Page->show();
            // 实现数据分页
            $data = $Feedback->field('id,to_who,cid,title,from_who,mobile,create_time,create_id,status,operate_id,operate_time')
                ->where(array(
                'create_id' => $create_id,
                'status' => $status
            ))
                ->limit($Page->firstRow, $Page->listRows)
                ->order('id desc')
                ->select();
            
            // 对内容进行编码
            foreach ($data[0] as $key => $value) {
                $data[0][$key] = stripslashes($value);
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
            
            // 对内容进行编码
            foreach ($item as $key => $value) {
                $item[$key] = stripslashes($value);
            }
            
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
     * 反馈添加页面，非API接口，get请求【用于wap前台】
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function add()
    {
        if (IS_GET) {
            import("ORG.Util.Category");
            $cat = new \Think\Category('Category', array(
                'acid',
                'afid',
                'aname',
                'cname'
            ));
            
            // 获取当前分类ID
            $cid = I('get.cid');
            $clist = $cat->getList(NULL, $cid, NULL); // 获取分类结构,只显示当前分类的子分类
            $this->assign('clist', $clist);
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
     * 保存反馈信息 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function addSave()
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
            
            $from_who = addslashes(I('post.from_who'));
            $mobile = addslashes(trim(I('post.mobile')));
            
            if (empty($mobile)) {
                // 如果用户没有填写手机，则默认当前用户手机
                $mobile2 = M('Users')->field('mobile')->find();
            }
            
            // 获取文章信息
            $data = array(
                'to_who' => addslashes(I('post.to_who')),
                'cid' => I('post.cid'),
                'title' => addslashes(I('post.title')),
                'content' => htmlspecialchars(stripslashes(I('post.article_content'))),
                'materials' => addslashes(trim(I('post.materials'))),
                // 如果用户没有填写名字，则默认当前用户名
                'from_who' => isset($from_who) ? $from_who : $_SESSION['nick_name'],
                'mobile' => isset($mobile) ? $mobile : $mobile2['mobile'],
                'create_time' => date('Y-m-d h:i:s', time()),
                'create_id' => $_SESSION['user_id'],
                'status' => 0
            );
            
            // 当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['to_who']) || empty($data['title']) || empty($data['content'])) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/add'),
                        'sec' => 3
                    ),
                    'info' => urlencode('必填信息不能为空！'),
                    'code' => '-201A'
                );
                exit(urldecode(json_encode($output)));
            }
            // 判断用户是否选择分类
            if ($data['cid'] == '-1') {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/add'),
                        'sec' => 3
                    ),
                    'info' => urlencode('请选择类型！'),
                    'code' => '-201B'
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 对内容进行编码
            foreach ($data as $key => $value) {
                $data[$key] = urlencode(trim($value));
            }
            
            $Feedback = D('Feedback');
            
            $res = $Feedback->create($data);
            if (! $res) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/index'),
                        'sec' => 3
                    ),
                    'info' => $Feedback->getError(),
                    'code' => '-202'
                );
                exit(urldecode(json_encode($output)));
            } else {
                $result = $Feedback->add($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/add'),
                            'sec' => 2
                        ),
                        'info' => urlencode('添加反馈成功！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Feedback/add'),
                            'sec' => 3
                        ),
                        'info' => urlencode('添加反馈失败！请重新再试！'),
                        'code' => - 200
                    );
                    exit(urldecode(json_encode($output)));
                }
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