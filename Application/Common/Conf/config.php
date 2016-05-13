<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'smart_community',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '1234',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sc_',    // 数据库表前缀	

	/*设置前后台模块*/
	'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),

	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称

    /*模板替换*/
    'TMPL_PARSE_STRING'     =>	array(
    	//定义路径
    	'__ADMIN__'	=>	'../../../Public/Admin'
    ),
    
     //权限认证

    'ADMIN_AUTH_KEY'    => 'admin',
    'USER_AUTH_ON'      => '1',
    'USER_AUTH_TYPE'    => '1',//2为即时验证模式，别的数字为登陆验证
    'RBAC_ROLE_TABLE'   => 'sc_role',
    'RBAC_USER_TABLE'   => 'sc_role_user',
    'RBAC_ACCESS_TABLE' => 'sc_access',
    'RBAC_NODE_TABLE'   => 'sc_node',    
    
//     'USER_AUTH_ON' => true, // 支持权限检查？
//     'USER_AUTH_TYPE' => 1, // 默认认证类型 1 登录认证 2 实时认证
//     'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
//     'ADMIN_AUTH_KEY' => 'administrator', // session里有这个管理员不需要认证
//     'ADMINISTRATOR' => 'admin',
//     'USER_AUTH_MODEL' => 'User', // 默认验证数据表模型
//     'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式
//     'USER_AUTH_GATEWAY' => '/Public/login', // 默认认证网关
//     'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
//     'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
//     'NOT_AUTH_ACTION' => '', // 默认无需认证操作
//     'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
//     'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
//     'GUEST_AUTH_ID' => 0, // 游客的用户ID

//     'RBAC_ROLE_TABLE'   => 'sc_role',
//     'RBAC_USER_TABLE'   => 'sc_role_user',
//     'RBAC_ACCESS_TABLE' => 'sc_access',
//     'RBAC_NODE_TABLE'   => 'sc_node',    
    
//     //权限认证错误页面
//     'RBAC_ERROR_PAGE' => '/thinkphps/Public/error404.html'

    //每页展示数量
    'PAGE_NUM' => 1,
    
    //开启表单令牌
    'TOKEN_ON'      =>    false,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
);