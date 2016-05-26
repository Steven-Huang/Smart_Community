<?php
namespace Wap\Controller;

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
            
            // 对内容进行编码
            foreach ($data[0] as $key => $value) {
                $data[0][$key] = stripslashes($value);
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
            
            // 对内容进行编码
            foreach ($item as $key => $value) {
                $item[$key] = stripslashes(trim($value));
            }
            
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
}