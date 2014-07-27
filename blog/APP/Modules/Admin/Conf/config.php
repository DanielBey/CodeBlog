<?php 

	return array(
		//后台应用中增加此config.php配置项。
		//那么在后台应用中的__PUBLIC__都在此配置项中定义的位置
		//前台应用中没有增加此配置项，则前台应用中的__PUBLIC__还是__ROOT__/Public
			'TMPL_PARSE_STRING'=>array(
					'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public'
				),
			'URL_HTML_SUFFIX'=>'',//取消后台的伪静态后缀
		);
 ?>