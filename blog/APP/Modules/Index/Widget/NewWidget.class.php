<?php 
	class NewWidget extends Widget{
		public function render($data){
			$limit = $data['limit'];
			$field = array('id','title','click','time');
			$news = M('blog')->field($field)->order('time DESC')->limit($limit)->select();
			$data['news'] = $news;
			//p($data);die;
			return $this->renderfile('',$data);

		}
	}
 ?>