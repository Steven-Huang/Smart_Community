<?php
namespace Admin\Model;
use Think\Model;

class ArticleModel extends Model {
	// 自动验证设置
	protected $_validate = array(
            array('atitle','require','标题不可以为空'),
    );	
}
?>