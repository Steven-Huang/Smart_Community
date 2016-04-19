<?php
namespace Admin\Model;
use Think\Model;

class UsersModel extends Model {
	//定义主键
	protected $pk = 'id';
	//定义字段信息
	protected $fileds = array('id','icon_url','nick_name','true_name','password','gender','h_pocn','mobile','email','id_card_num','create_time','last_log_ip','last_log_time','if_aprvd');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'user_icon_url' => 'icon_url',
		'user_nick_name' => 'nick_name',
		'user_true_name' => 'true_name',
		'user_password' => 'password',
		'user_gender' => 'gender',
		'user_pocn' => 'h_pocn',
		'user_mobile' => 'mobile',
		'user_email' => 'email',
		'user_id_card_num' => 'id_card_num',
		'user_create_time' => 'create_time',
		'user_last_log_ip' => 'last_log_ip',
		'user_last_log_time' => 'last_log_time',
	    'user_if_approved' => 'if_aprvd'
	);
}