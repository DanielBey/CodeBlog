<?php 
	//只在前台使用的视图模型调用List页
	class BlogViewModel extends ViewModel{
		protected $viewFields = array(
			'blog' => array('id','title','time','click','summary','_type'=>'LEFT'),
			'cate' => array('name','_on'=>'blog.cid = cate.id'),
			);
	}
 ?>