<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model {
	//定义主键
	protected $pk = 'id';
	//定义字段信息
	protected $fileds = array('id','icon_url','nick_name','true_name','password','gender','mobile','email','id_card_num','create_time','last_log_ip','last_log_time');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'admin_icon_url' => 'icon_url',
		'admin_nick_name' => 'nick_name',
		'admin_true_name' => 'true_name',
		'admin_password' => 'password',
		'admin_gender' => 'gender',
		'admin_mobile' => 'mobile',
		'admin_email' => 'email',
		'admin_id_card_num' => 'id_card_num',
		'admin_create_time' => 'create_time',
		'admin_last_log_ip' => 'last_log_ip',
		'admin_last_log_time' => 'last_log_time',
	);
}