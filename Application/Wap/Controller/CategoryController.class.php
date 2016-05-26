<?php
namespace Wap\Controller;

class CategoryController extends CommonController
{

    /**
     * 定义_empty空操作
     */
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
     * 获取当前分类ID的子分类列表结构 [面向APP的API接口，AJAX post请求]
     *
     * @author Steven.Huang <87144734@qq.com>
     */
    public function CategoryList()
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
            
            // 获取当前分类ID
            $cid = I('get.cid');
            
            import("ORG.Util.Category");
            $cat = new \Think\Category('Category', array(
                'acid',
                'afid',
                'aname',
                'cname'
            ));
            $clist = $cat->getList(NULL, $cid, NULL); // 获取分类结构,只显示当前分类的子分类
            
            $output = array(
                'data' => $clist,
                'info' => urlencode('当前分类ID的子分类列表结构！'),
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