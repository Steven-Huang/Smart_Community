<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model {
	//定义主键
	protected $pk = 'fb_id';
	//定义字段信息
	protected $fileds = array('fb_id','fb_to','fb_type','fb_content','fb_materials','fb_create_time','fb_create_id','fb_status','fb_results','fb_operate_id','fb_operate_time');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'feedback_to' => 'fb_to',
		'feedback_type' => 'fb_type',
		'feedback_content' => 'fb_content',
		'feedback_materials' => 'fb_materials',
		'feedback_create_time' => 'fb_create_time',
		'feedback_status' => 'fb_status',
		'feedback_results' => 'fb_results'
	);
}