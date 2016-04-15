<?php
namespace Admin\Model;
use Think\Model;

class UsersModel extends Model {
	//定义主键
	protected $pk = 'u_id';
	//定义字段信息
	protected $fileds = array('u_id','u_icon_url','u_nick_name','u_true_name','u_password','u_gender','h_pocn','u_mobile','u_email','u_id_card_num','u_create_time','u_last_log_ip','u_last_log_time','u_if_aprvd');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'user_icon_url' => 'u_icon_url',
		'user_nick_name' => 'u_nick_name',
		'user_true_name' => 'u_true_name',
		'user_password' => 'u_password',
		'user_gender' => 'u_gender',
		'user_pocn' => 'h_pocn',
		'user_mobile' => 'u_mobile',
		'user_email' => 'u_email',
		'user_id_card_num' => 'u_id_card_num',
		'user_create_time' => 'u_create_time',
		'user_last_log_ip' => 'u_last_log_ip',
		'user_last_log_time' => 'u_last_log_time',
	    'user_if_approved' => 'u_if_aprvd'
	);
}