<?php
namespace Admin\Model;
use Think\Model;

class NoticeModel extends Model {
	//定义主键
	protected $pk = 'id';
	//定义字段信息
	protected $fileds = array('id','n_type','n_source','n_titile','n_pub_date','n_valid_time','n_content','n_keywords','n_author','n_status');
	//定义字段映射
	protected $_map = array(
		//假名	=>	真名
		'admin_icon_url' => 'n_type',
		'admin_nick_name' => 'n_source',
		'admin_true_name' => 'n_titile',
		'admin_password' => 'n_pub_date',
		'admin_gender' => 'n_valid_time',
		'admin_mobile' => 'n_content',
		'admin_email' => 'n_keywords',
		'admin_id_card_num' => 'n_author'
	);
}