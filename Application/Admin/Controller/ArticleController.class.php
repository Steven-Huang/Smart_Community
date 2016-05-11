<?php
namespace Admin\Controller;

class ArticleController extends CommonController{
    //定义_empty空操作
    public function _empty(){
        $this->show();
    }
    
    public function show(){
        $output = array('data' => array('redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Admin/Index/index'), 'sec' => 3),'info' => urlencode('您访问的页面不存在！'),'code' => -404);
        exit(urldecode(json_encode($output)));
    }
    
    public function index()
    {
        $Article = M('Article');
        import('ORG.Util.Page'); // 导入分页类
        $count = $Article->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
                                     // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $plist = $Article->limit($Page->firstRow . ',' . $Page->listRows)
            ->order('aid desc')
            ->select();
        $this->assign('page', $show); // 赋值分页输出
        $this->assign('alist', $plist);
        $this->display();
    }
    // 分类显示
    public function alist()
    {
        $map['acid'] = $this->_get('id');
        $Article = M('Article');
        import('ORG.Util.Page'); // 导入分页类
        $count = $Article->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
                                     // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $plist = $Article->where($map)
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->order('aid desc')
            ->select();
        $this->assign('page', $show); // 赋值分页输出
        $this->assign('alist', $plist);
        $this->display();
    }

    /**
     * 文章　增加页面
     */
    public function add()
    {
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

    public function addsave()
    {
        $Article = D('Article');
        $map['acid'] = I('acid');
        $map['atitle'] = I('atitle');
        
        $map['create_time'] = time();
        
        $map['alink'] = I('alink');
        
        $map['content'] = htmlspecialchars(stripslashes($_POST['content']));
        // *******************自动验证模板/
        $res = $Article->create($map);
        if (! $res) {
            $this->error($Article->getError());
        } else {
            $result = $Article->add($map);
            if ($result) {
                $this->success('新增成功');
            } else {
                $this->error('新增失败');
            }
        }
        // *******************自动验证模板结束/
    }
    
    // *******************修改开始
    public function edit()
    {
        $id = $this->_get('id');
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

    public function editsave()
    {
        $id = I('aid');
        if (! $id) {
            $this->error('文章id不可以为空');
        } // 判定ＩＤ是否为空
        $data["aid"] = $id;
        
        $Article = D('Article');
        $map['acid'] = I('acid');
        $map['atitle'] = I('atitle');
        $map['create_time'] = time();
        $map['sort'] = I('sort');
        $mallid = I('mallid');
        
        $map['content'] = htmlspecialchars(stripslashes($_POST['content']));
        // *******************自动验证模板/
        $res = $Article->create();
        if (! $res) {
            $this->error($Article->getError());
        } else {
            $result = $Article->where($data)->save($map);
            if ($result) {
                $this->success('修改成功', U('Article/index'));
            } else {
                $this->error('新增失败');
            }
        }
        // *******************自动验证模板结束/
    }
    
    // *******************修改结束**************/
    // *******************删除开始**************/
    public function delete()
    {
        $Article = M('Article');
        $id = $this->_get('id');
        if (! $id) { // 判定是否为空
            $this->error('商品不可以为空');
        } else {
            
            $data['aid'] = $id;
            $result = $Article->where($data)->delete();
            if ($result) {
                // 设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                // $this->success('删除成功');
                $this->redirect(U('Article/index'));
            } else {
                // 错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('删除失败');
            }
        }
    }
    
    // *******************修改结束**************/
    // *******************推荐开始**************/
    public function updatetop()
    {
        $Article = M('Article');
        $id = $this->_get('id');
        
        if (! $id) { // 判定是否为空
            $this->error('文章id不可以为空');
        } else {
            
            $map['aid'] = $id;
            $data['top'] = 1;
            $result = $Article->where($map)->save($data);
            
            if ($result) {
                // $this->success('删除成功');
                $this->redirect(U('Article/index'));
            } else {
                // 错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('推荐失败');
            }
        }
    }
    
    // 撤销首页推荐
    public function deletetop()
    {
        $Article = M('Article');
        $id = $this->_get('id');
        
        if (! $id) { // 判定是否为空
            $this->error('文章id不可以为空');
        } else {
            
            $map['aid'] = $id;
            $data['top'] = 0;
            $result = $Article->where($map)->save($data);
            
            if ($result) {
                // $this->success('删除成功');
                $this->redirect(U('Article/index'));
            } else {
                // 错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('推荐失败');
            }
        }
    }
}