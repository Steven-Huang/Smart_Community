<?php
namespace Admin\Model;
use Think\Model;

class MgrsModel extends Model {
	//定义主键
	protected $pk = 'id';
	//定义字段信息
	protected $fileds = array('id','icon_url','nick_name','true_name','password','gender','mobile','email','id_card_num','create_time','last_log_ip','last_log_time','if_aprvd');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'mgrs_icon_url' => 'icon_url',
		'mgrs_nick_name' => 'nick_name',
		'mgrs_true_name' => 'true_name',
		'mgrs_password' => 'password',
		'mgrs_gender' => 'gender',
		'mgrs_mobile' => 'mobile',
		'mgrs_email' => 'email',
		'mgrs_id_card_num' => 'id_card_num',
		'mgrs_create_time' => 'create_time',
		'mgrs_last_log_ip' => 'last_log_ip',
		'mgrs_last_log_time' => 'last_log_time',
	    'mgrs_if_approved' => 'if_aprvd'
	);
}