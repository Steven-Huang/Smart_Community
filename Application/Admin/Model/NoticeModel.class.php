<?php
namespace Admin\Model;
use Think\Model;

class NoticeModel extends Model {
	//定义主键
	protected $pk = 'n_id';
	//定义字段信息
	protected $fileds = array('n_id','n_type','n_source','n_titile','n_pub_date','n_valid_time','n_content','n_keywords','n_author','n_status');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'notice_type' => 'n_type',
		'notice_source' => 'n_source',
		'notice_titile' => 'n_titile',
		'notice_valid_time' => 'n_valid_time',
		'notice_content' => 'n_content',
		'notice_keywords' => 'n_keywords',
	    'notice_status' => 'n_status'
	);
}