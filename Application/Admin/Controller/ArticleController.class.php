<?php
namespace Admin\Controller;

class ArticleController extends CommonController
{
    // 定义_empty空操作
    public function _empty()
    {
        $this->show();
    }

    public function show()
    {
        $output = array(
            'data' => array(
                'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                'sec' => 3
            ),
            'info' => urlencode('您访问的页面不存在！'),
            'code' => - 404
        );
        exit(urldecode(json_encode($output)));
    }

    /**
     * 获取所有文章
     */
    public function index()
    {
        $this->display();
        // $Article = M('Article');
        // import('ORG.Util.Page'); // 导入分页类
        // $count = $Article->count(); // 查询满足要求的总记录数
        // $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        // $show = $Page->show(); // 分页显示输出
        // // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        // $plist = $Article->limit($Page->firstRow . ',' . $Page->listRows)
        // ->order('aid desc')
        // ->select();
        // $this->assign('page', $show); // 赋值分页输出
        // $this->assign('alist', $plist);
        // $this->display();
    }

    /**
     * 请求返回通知信息 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            // 获取分类ID,如果没有则显示所有信息
            $cid = (int) I('post.category_id') ? (int) I('post.category_id') : 'ALL';
            // 获取通知状态（1->发布,0->待审核）
            $status = (int) I('post.article_status');
            // 获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            // 实例化模型
            $Article = D('Article');
            import('ORG.Util.Page'); // 导入分页类
            
            if ($cid != 'ALL') {
                // 当指定分类时
                // 获取总记录数
                $count = $Article->where(array(
                    'acid' => $cid,
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $num);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Article->field('acid,atitle,keyword,source,author,des,valid_time,create_time')
                    ->where(array(
                    'acid' => $cid,
                    'status' => $status
                ))
                    ->limit($Page->firstRow, $Page->listRows)
                    ->order('sort desc')
                    ->select();
            } else {
                // 当获取全部数据时
                // 获取总记录数
                $count = $Article->where(array(
                    'status' => $status
                ))->count();
                // 实例化分类页
                $Page = new \Think\Page($count, $num);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Article->field('acid,atitle,keyword,source,author,des,valid_time,create_time')
                    ->where(array(
                    'status' => $status
                ))
                    ->limit($Page->firstRow, $Page->listRows)
                    ->select();
            }
            
            $output = array(
                'data' => array(
                    'data' => $data,
                    'count' => $count,
                    'page' => urlencode($show)
                ),
                'info' => urlencode('通知信息列表！'),
                'code' => 200
            );
            exit(urldecode(json_encode($output)));
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 文章增加页面，非API接口，get请求
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function add()
    {
        // 获取TOKEN
        $token = I('post.access_token');
        if (! check_token($token)) {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                    'sec' => 3
                ),
                'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                'code' => '-208'
            );
            exit(urldecode(json_encode($output)));
        }
        import("ORG.Util.Category");
        $cat = new \Think\Category('Article_cat', array(
            'acid',
            'afid',
            'aname',
            'cname'
        ));
        $clist = $cat->getList(); // 获取分类结构
        $this->assign('clist', $clist);
        $this->display();
    }

    /**
     * 保存文章内容 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 获取文章信息
            $data = array(
                'acid' => (int) I('post.category_id'),
                'sort' => (int) I('post.sort'),
                'atitle' => trim(I('post.article_title')),
                'keyword' => trim(I('post.article_keyword')),
                'source' => trim(I('post.article_source')),
                'author' => trim(I('post.article_author')),
                'des' => trim(I('post.article_des')),
                'content' => htmlspecialchars(stripslashes(I('post.article_content'))),
                'status' => 0, // 需审核才可以正式发布
                'create_id' => $_SESSION['user_id']
            );
            
            // 当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['acid']) || empty($data['sort']) || empty($data['atitle']) || empty($data['keyword']) || empty($data['source']) || empty($data['author']) || empty($data['des']) || empty($data['content'])) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/add'),
                        'sec' => 3
                    ),
                    'info' => '文章信息不能为空！',
                    'code' => '-201'
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 对内容进行编码
            foreach ($data as $key => $value) {
                $data[$key] = urlencode(trim($value));
            }
            
            $Article = D('Article');
            
            $res = $Article->create($data);
            if (! $res) {
                $this->error($Article->getError());
            } else {
                $result = $Article->add($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/add'),
                            'sec' => 2
                        ),
                        'info' => urlencode('添加文章成功！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/add'),
                            'sec' => 3
                        ),
                        'info' => urlencode('添加文章失败！请重新再试！'),
                        'code' => - 200
                    );
                    exit(urldecode(json_encode($output)));
                }
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 文章修改页面，非API接口，get请求
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function edit()
    {
        // 获取TOKEN
        $token = I('post.access_token');
        if (! check_token($token)) {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                    'sec' => 3
                ),
                'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                'code' => '-208'
            );
            exit(urldecode(json_encode($output)));
        }
        $id = I('get.id');
        $Article = M('Article');
        $item = $Article->find($id);
        // dump($item);
        
        import("ORG.Util.Category");
        $cat = new \Think\Category('Article_cat', array(
            'acid',
            'afid',
            'aname',
            'cname'
        ));
        $clist = $cat->getList(); // 获取分类结构
        $this->assign('clist', $clist);
        
        $this->assign('item', $item);
        
        $this->display();
    }

    /**
     * 修改文章内容 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function editSave()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => '-208'
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 获取文章信息
            $data = array(
                'aid' => (int) I('post.article_id'),
                'acid' => (int) I('post.category_id'),
                'sort' => (int) I('post.sort'),
                'atitle' => trim(I('post.article_title')),
                'keyword' => trim(I('post.article_keyword')),
                'source' => trim(I('post.article_source')),
                'author' => trim(I('post.article_author')),
                'des' => trim(I('post.article_des')),
                'content' => htmlspecialchars(stripslashes(I('post.article_content'))),
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            
            // 当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['aid']) || empty($data['acid']) || empty($data['sort']) || empty($data['atitle']) || empty($data['keyword']) || empty($data['source']) || empty($data['author']) || empty($data['des']) || empty($data['content'])) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/add'),
                        'sec' => 3
                    ),
                    'info' => '更新的文章信息不能为空！',
                    'code' => '-201'
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 对内容进行编码
            foreach ($data as $key => $value) {
                $data[$key] = urlencode(trim($value));
            }
            
            $Article = D('Article');
            
            $res = $Article->create();
            if (! $res) {
                $this->error($Article->getError());
            } else {
                $result = $Article->where($data['aid'])->save($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/index'),
                            'sec' => 2
                        ),
                        'info' => urlencode('更新文章成功！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/edit'),
                            'sec' => 3
                        ),
                        'info' => urlencode('更新文章失败！请重新再试！'),
                        'code' => '-200'
                    );
                    exit(urldecode(json_encode($output)));
                }
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => '-205'
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 删除文章内容  [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function moveToTrash()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            
            $Article = M('Article');
            
            $id = I('post.article_id');
            if (! $id) { // 判定是否为空
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('没有选择要删除的文章！'),
                    'code' => - 201
                );
                exit(urldecode(json_encode($output)));
            } else {
                $data = array(
                    'aid' => $id,
                    'status' => -1,
                    'operate_id' => $_SESSION['user_id']
                );
                $result = $Article->save($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/index'),
                            'sec' => 2
                        ),
                        'info' => urlencode('文章已移入回收站！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Article/index'),
                            'sec' => 3
                        ),
                        'info' => urlencode('文章移入回收站失败！请重新再试！'),
                        'code' => - 200
                    );
                    exit(urldecode(json_encode($output)));
                }
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 审批文章  [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function approving()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 获取文章ID
            $id = I('post.article_id');
            $data = array(
                'aid' => $id,
                'status' => 1,
                'operate_id' => $_SESSION['user_id']
            );
            $status = D('notice')->save($data);
            if ($status) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('通知审批成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 3
                    ),
                    'info' => urlencode('通知审批失败！'),
                    'code' => - 200
                );
                exit(urldecode(json_encode($output)));
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 回收站
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function trash()
    {}

    /**
     * 回收站-彻底删除  [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function delete()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
        
            // 获取文章ID
            $id = I('post.article_id');
            $data = array(
                'aid' => $id,
                'status' => -2,
                'operate_id' => $_SESSION['user_id']
            );
            $status = D('notice')->save($data);
            if ($status) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('通知审批成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 3
                    ),
                    'info' => urlencode('通知审批失败！'),
                    'code' => - 200
                );
                exit(urldecode(json_encode($output)));
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 回收站-还原，还原为待审核状态  [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function undo()
    {
        if (IS_POST) {
            // 获取TOKEN
            $token = I('post.access_token');
            if (! check_token($token)) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
        
            // 获取文章ID
            $id = I('post.article_id');
            $data = array(
                'aid' => $id,
                'status' => 0, //还原为待审核状态
                'operate_id' => $_SESSION['user_id']
            );
            $status = D('notice')->save($data);
            if ($status) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('通知审批成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Notice/index'),
                        'sec' => 3
                    ),
                    'info' => urlencode('通知审批失败！'),
                    'code' => - 200
                );
                exit(urldecode(json_encode($output)));
            }
        } else {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'),
                    'sec' => 3
                ),
                'info' => urlencode('请求错误！请重新再试！'),
                'code' => - 205
            );
            exit(urldecode(json_encode($output)));
        }
    }
}