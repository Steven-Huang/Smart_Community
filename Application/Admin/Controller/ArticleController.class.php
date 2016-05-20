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
                'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Index/index'),
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
     * 请求返回文章信息 [面向APP的API接口，AJAX post请求]
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
            // 获取分类ID,如果没有则显示所有信息
            $cid = (int) I('post.category_id') ? (int) I('post.category_id') : 'ALL';
            // 获取文章状态（1->发布,0->待审核）
            $status = I('post.article_status');
            // 获取每页展示行数
            $num = I('post.num') ? I('post.num') : C('PAGE_NUM');
            
            // 实例化模型Article
            $Article_cat = M('Article_cat');
            // 获取分类名字
            $Category_name = $Article_cat->field('aname')
                ->where(array(
                'acid' => $cid
            ))
                ->select();
            
            // 实例化模型Article
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
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Article->field('aid,acid,atitle,keyword,source,author,des,valid_time,create_time,sort')
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
                $Page = new \Think\Page($count, $count);
                // 调用show显示分页链接
                $show = $Page->show();
                // 实现数据分页
                $data = $Article->field('aid,acid,atitle,keyword,source,author,des,valid_time,create_time,sort')
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
                    'page' => urlencode($show),
                    'category_name' => $Category_name
                ),
                'info' => urlencode('文章信息列表！'),
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
     * 文章详情页面，API接口，get请求 【用于系统后台】
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function detail()
    {
        if (IS_GET) {
            $id = I('get.id');
            $Article = M('Article');
            $item = $Article->find($id);
            
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
     * 回收站文章详情页面，API接口，get请求 【用于系统后台】
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function detail2()
    {
        if (IS_GET) {
            $id = I('get.id');
            $Article = M('Article');
            $item = $Article->find($id);
    
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
     * 获取文章分类列表 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function articleCategoryList()
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
            
            import("ORG.Util.Category");
            $cat = new \Think\Category('Article_cat', array(
                'acid',
                'afid',
                'aname',
                'cname'
            ));
            $clist = $cat->getList(); // 获取分类结构
            
            $output = array(
                'data' => $clist,
                'info' => urlencode('文章分类列表！'),
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
     * 文章增加页面,获取文章分类列表，非API接口，get请求【用于系统后台】
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function add()
    {
        if (IS_GET) {
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 获取文章信息
            $data = array(
                'acid' => I('post.category_id'),
                'sort' => I('post.article_sort') ? I('post.article_sort') : 0,
                'atitle' => trim(I('post.article_title')),
                'keyword' => trim(I('post.article_keyword')),
                'source' => trim(I('post.article_source')),
                'valid_time' => trim(I('post.article_valid_time')),
                'author' => trim(I('post.article_author')),
                'des' => trim(I('post.article_des')),
                'content' => htmlspecialchars(stripslashes(I('post.article_content'))),
                'status' => 0, // 需审核才可以正式发布
                'create_id' => $_SESSION['user_id']
            );
            
            // 当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['acid']) || empty($data['atitle']) || empty($data['keyword']) || empty($data['source']) || empty($data['valid_time']) || empty($data['author']) || empty($data['des']) || empty($data['content'])) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
                        'sec' => 3
                    ),
                    'info' => urlencode('文章信息不能为空！'),
                    'code' => '-201A'
                );
                exit(urldecode(json_encode($output)));
            }
            // 判断用户是否选择分类
            if ($data['acid'] == '-1') {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
                        'sec' => 3
                    ),
                    'info' => urlencode('请选择文章分类！'),
                    'code' => '-201B'
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
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index'),
                        'sec' => 3
                    ),
                    'info' => $Article->getError(),
                    'code' => '-202'
                );
                exit(urldecode(json_encode($output)));
            } else {
                $result = $Article->add($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
                            'sec' => 2
                        ),
                        'info' => urlencode('添加文章成功！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
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
     * 指定ID号文章的信息（用于文章修改或展示） [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function getSingleArticleById()
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
            $Article = M('Article');
            $item = $Article->find($id);
            
            $output = array(
                'data' => $item,
                'info' => urlencode('指定ID号文章的信息！'),
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
     * 文章修改页面，API接口，get请求 【用于系统后台】
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function edit()
    {
        if (IS_GET) {
            $id = I('get.id');
            $Article = M('Article');
            $item = $Article->find($id);
            
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => '-208'
                );
                exit(urldecode(json_encode($output)));
            }
            
            // 获取文章信息
            $data = array(
                'aid' => I('post.article_id'),
                'acid' => I('post.category_id'),
                'sort' => I('post.article_sort'),
                'atitle' => trim(I('post.article_title')),
                'keyword' => trim(I('post.article_keyword')),
                'source' => trim(I('post.article_source')),
                'valid_time' => trim(I('post.article_valid_time')),
                'author' => trim(I('post.article_author')),
                'des' => trim(I('post.article_des')),
                'content' => htmlspecialchars(stripslashes(I('post.article_content'))),
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            
            // 当信息为空时，返回错误信息（需前端配合过滤）
            if (empty($data['aid']) || empty($data['acid']) || empty($data['atitle']) || empty($data['keyword']) || empty($data['source']) || empty($data['valid_time']) || empty($data['author']) || empty($data['des']) || empty($data['content'])) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
                        'sec' => 3
                    ),
                    'info' => $data,
                    'code' => '-201A'
                );
                exit(urldecode(json_encode($output)));
            }
            // 判断用户是否选择分类
            if ($data['acid'] == '-1') {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/add'),
                        'sec' => 3
                    ),
                    'info' => urlencode('请选择文章分类！'),
                    'code' => '-201B'
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
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index'),
                        'sec' => 3
                    ),
                    'info' => $Article->getError(),
                    'code' => '-202'
                );
                exit(urldecode(json_encode($output)));
            } else {
                $result = $Article->save();
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index/category_id/' . $data['acid']),
                            'sec' => 2
                        ),
                        'info' => urlencode('更新文章成功！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/edit'),
                            'sec' => 3
                        ),
                        'info' => urlencode('内容未更改或更新文章失败！请重新再试！'),
                        'code' => '-200'
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
                'code' => '-205'
            );
            exit(urldecode(json_encode($output)));
        }
    }

    /**
     * 删除文章内容 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index'),
                        'sec' => 2
                    ),
                    'info' => urlencode('没有选择要删除的文章！'),
                    'code' => - 201
                );
                exit(urldecode(json_encode($output)));
            } else {
                $data = array(
                    'aid' => $id,
                    'status' => - 1,
                    'operate_time' => date('Y-m-d h:i:s', time()),
                    'operate_id' => $_SESSION['user_id']
                );
                $result = $Article->save($data);
                if ($result) {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/trash'),
                            'sec' => 2
                        ),
                        'info' => urlencode('文章已移入回收站！'),
                        'code' => 200
                    );
                    exit(urldecode(json_encode($output)));
                } else {
                    $output = array(
                        'data' => array(
                            'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index'),
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
     * 审批文章 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
            
            $Article = D('Article');
            
            // 获取文章ID
            $id = I('post.article_id');
            $data = array(
                'aid' => $id,
                'status' => 1,
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            $status = $Article->save($data);
            if ($status) {
                $acid = $Article->field('acid')->where(array('aid' => $id))->select();
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index/category_id/' . $acid[0]['acid']),
                        'sec' => 2
                    ),
                    'info' => urlencode('文章审批成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/index'),
                        'sec' => 3
                    ),
                    'info' => urlencode('文章审批失败！'),
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

    /**
     * 回收站
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function trash()
    {
        $this->display();
    }

    /**
     * 回收站-彻底删除 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
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
                'status' => - 2,
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            $status = D('Article')->save($data);
            if ($status) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/trash'),
                        'sec' => 2
                    ),
                    'info' => urlencode('删除文章成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/trash'),
                        'sec' => 3
                    ),
                    'info' => urlencode('删除文章失败！'),
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

    /**
     * 回收站-还原，还原为待审核状态 [面向APP的API接口，AJAX post请求]
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
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
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
                'status' => 0, // 还原为待审核状态
                'operate_time' => date('Y-m-d h:i:s', time()),
                'operate_id' => $_SESSION['user_id']
            );
            $status = D('Article')->save($data);
            if ($status) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/trash'),
                        'sec' => 2
                    ),
                    'info' => urlencode('恢复文章成功！'),
                    'code' => 200
                );
                exit(urldecode(json_encode($output)));
            } else {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Article/trash'),
                        'sec' => 3
                    ),
                    'info' => urlencode('恢复文章失败！'),
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