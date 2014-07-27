<?php 
	return array(
		'APP_AUTOLOAD_PATH' => '@.TagLib',//当前应用即前台应用下的Taglib文件夹下的类都可以实现自动加载
		'TAGLIB_BUILD_IN'=>'Cx,Mytag',//把Mytag标签库作为内置标签库引入

		//开启静态缓存
		//静态缓存：生成静态页面——缓存的是整个页面;
		// 'HTML_CACHE_ON'=>true,
		// 'HTML_CACHE_RULES'=>array(
		// 	'Show:index'=>array('{:module}_{:action}_{id}',5),
		// 	),
		//'DATA_CACHE_TIME'       => '0',      // 数据缓存有效期 0表示永久缓存
		'TMPL_PARSE_STRING'=>array(
			'__ROOT__'=>'localhost/public_html/',
			),
		//配置动态缓存的方式
		//仅对数据库中的数据进行了缓存，
		//即“通过动态缓存，不需要再读取数据库了，直接通过缓存文件来调取相应数据”;
		'DATA_CACHE_TYPE'=>'File',//可以是Redis,memcache这三种情况都是指S函数缓存到哪里
		
		// 'MEMCACHE_HOST'=>'127.0.0.1',
		// 'MEMCACHE_PORT'=>11211,

		// 'REDIS_HOST'=>'127.0.0.1',
		// 'REDIS_PORT'=>6379,

		);
 ?>