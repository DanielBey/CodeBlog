<?php 
	import('TagLib');
	//自定义的标签库
	class TagLibMytag extends TagLib{
		protected $tags = array(
				'nav'=>array(
					'attr'=>'limit,order',
					'close'=>1
				),
			);
		public function _nav($attr,$content){
			$attr = $this->parseXmlAttr($attr);//调用父类的方法使字符串变为数组
			$str = <<<str
<?php
	\$_nav_cate = M('cate')->order("{$attr['order']}")->select();
	import('Class.Category',APP_PATH);
	\$_nav_cate = Category::unlimitedForLayer(\$_nav_cate);
	foreach(\$_nav_cate as \$v):
		extract(\$v);
	\$url = U('/c_'.\$id);

?>
str;
		$str.= $content;
		$str.= '<?php endforeach;?>';
		return $str;
		//注意上面的$cate前面必须转义，不然就直接认为是变量企图解析了
		//extract函数用来将变量从数组中导入到当前的符号表中
		}
	}
 ?>