<?php
namespace Admin\Controller;

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
     * 获取分类列表
     */
    public function index()
    {
        $cat = new \Think\Category('Category', array(
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
     * 增加分类页面
     */
    public function add()
    {
        $cat = new \Think\Category('Category', array(
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
     * 处理增加分类
     */
    public function addsave()
    {
        $acat = D('Category');
        $map['afid'] = I('post.afid');
        $map['sort'] = I('post.sort');
        $map['aname'] = trim(I('post.aname'));
        
        $res1 = $acat->is_exist_cat($map['aname'], $map['afid']);
        if ($res1) {
            $this->error('同级分类目录名已存在，请更换个试试');
        }
        
        $res2 = $acat->create();
        if (! $res2) {
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $this->error($acat->getError());
        } else { // 验证通过 可以进行其他数据操作
            $result = $acat->add($map);
            if ($result) {
                $this->success('新增成功');
            } else {
                // 错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('新增失败');
            }
        } // *******************res判定结束
    }

    /**
     * 修改分类页面
     */
    public function edit()
    {
        $id = trim(I('get.id'));
        $cat = new \Think\Category('Category', array(
            'acid',
            'afid',
            'aname',
            'cname'
        ));
        $clist = $cat->getList(); // 获取分类结构
        $this->assign('clist', $clist);
        if (! $id) {
            $this->error('id不可以为空');
        }
        $Acat = M('Category');
        $item = $Acat->find($id);
        $this->assign('item', $item);
        $this->display();
    }

    /**
     * 保存修改分类信息
     */
    public function editsave()
    {
        $id = I('post.acid');
        $data["acid"] = $id;
        
        $acat = D('Category');
        $map['afid'] = I('post.afid');
        $map['sort'] = I('post.sort');
        $map['aname'] = trim(I('post.aname'));
        
        // $res1 = $acat->is_exist_cat($map['aname'],$map['afid']);
        // if ($res1){
        // $this->error('同级分类目录名已存在，请更换个试试',"edit/id/{$id}");
        // }
        $res2 = $acat->create();
        
        if (! $res2) {
            $this->error($acat->getError(), "index");
        } else {
            $result = $acat->where($data)->save($map);
            if ($result) {
                $this->success('修改成功', 'index');
            } else {
                $this->error('修改失败', "edit/id/{$id}");
            }
        }
    }

    /**
     * 删除分类
     */
    public function delete()
    {
        $acat = new \Think\Category('Category', array(
            'acid',
            'afid',
            'aname',
            'cname'
        ));
        $id = trim(I('get.id'));
           
        // 检查此分类是否有子类，如果有则不能删除
        if (M('Category')->where(array(
            'afid' => $id
        ))->select()) {
            $this->error('此分类有子类，删除失败');
        }
        // 检查改分类下是否有文章
        if (M('Article')->where(array(
            'acid' => $id
        ))->select()) {
            $this->error('此分类有文章，删除失败');
        }
        
        $result = $acat->del($id);
        if ($result) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
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