<?php 
	return array(
		//配置数据库信息
		'DB_HOST'=>'localhost',
		'DB_USER'=>'root',
		'DB_PWD'=>'',
		'DB_NAME'=>'blog',
		'DB_PREFIX'=>'tp_',

		//配置独立分组的信息
		'APP_GROUP_LIST'=>'Index,Admin',
		'DEFAULT_GROUP'=>'Index',
		'APP_GROUP_MODE'=>1,
		'APP_GROUP_PATH'=>'Modules',
		//'GROUP_NAME'=>'localhost/blog/List',

		'TMPL_PARSE_STRING'=>array(
			'__ROOT__'=>'localhost/public_html/',
			),


		//加载verify.php和water.php配置文件,注意之间不要加空格
		'LOAD_EXT_CONFIG'=>'verify,water',

		//显示调试模式
		'SHOW_PAGE_TRACE'=>true,

		//设置URL伪静态
		'URL_HTML_SUFFIX'=>'',


		//配置URL模式为重写模式,去掉URL中的index.php
		'URL_MODEL'=>3,
		//配置URL路由
		'URL_ROUTER_ON'=>true,
		'URL_ROUTE_RULES'=>array(
				'/^c_(\d+)$/'=>'Index/List/index?id=:1',
				'/^(\d+)$/'=>'Index/Show/index?id=:1',
				':id\d'=>'Index/Show/index'
			),
		);
 ?>