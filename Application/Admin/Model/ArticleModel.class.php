<?php
namespace Admin\Model;
use Think\Model;

class ArticleModel extends Model {
    //定义主键
    protected $pk = 'aid';
    //定义字段信息
    protected $fileds = array('aid','acid','atitle','keyword','source','author','des','content','valid_time','create_time','create_id','status','operate_time','operate_id','sort');
    //定义字段映射
    protected $_map = array(
        //假名	=>	真名
        'article_id' => 'aid',
        'category_id' => 'acid',
        'article_title' => 'atitle',
        'article_keyword' => 'keyword',
        'article_source' => 'source',
        'article_author' => 'author',
        'article_des' => 'des',
        'article_content' => 'content',
        'article_valid_time' => 'valid_time',
        'article_status' => 'status',
        'article_sort' => 'sort',
    );
	// 自动验证设置
	protected $_validate = array(
	    array('aid','require','文章ID不可以为空'),
	    array('acid','require','分类ID不可以为空'),
        array('atitle','require','标题不可以为空'),
	    array('keyword','require','关键词不可以为空'),
	    array('source','require','来源不可以为空'),
	    array('author','require','作者不可以为空'),
	    array('des','require','摘要不可以为空'),
	    array('content','require','内容不可以为空'),
	    array('valid_time','require','有效时间不可以为空'),
    );	
}
?>