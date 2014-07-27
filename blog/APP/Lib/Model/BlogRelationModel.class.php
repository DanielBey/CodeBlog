<?php
	class BlogRelationModel extends RelationModel{
		//主表blog
		protected $tableName = 'blog';
		//要关联的表attr
		protected $_link = array(
			'attr'=>array(
				'mapping_type'=>MANY_TO_MANY,//注意这里没有''
				'mapping_name'=>'attr',//要关联的表名
				'foreign_key'=>'bid',//中间表和主表相关的字段名。这个bid字段对应blog表中的id字段
				'relation_foreign_key'=>'aid',//中间表和关联表相关的字段名。这个aid字段对应attr表中的id字段
				'relation_table'=>'tp_blog_attr',//多对多关系中的中间表的表名
				),
			'cate'=>array(
				//一对多用BELONGS_TO,多对一用HAS_MANY
				'mapping_type'=>BELONGS_TO,//BELONGS_TO的主语是主表blog,即每一篇blog,BELONGS_TO 某个cate
				'mapping_name'=>'cate',
				'foreign_key'=>'cid',//blog中的cid字段
				'mapping_fields'=>'name',//只去找到cate表中的name字段映射到blog表中
				'as_fields'=>'name:cate_name',//将关联表中的name字段映射到主表中作为一个字段,新命名为cate_name
				),
			);
		//读取文章的函数，默认读取没有被删除的文章，$type=1时读取回收站当中的文章
		public function getBlogs($type = 0){
			$where = array('del'=>$type);
			return $this->where($where)->relation(true)->select();

		}
	}
 ?>