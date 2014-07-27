<?php 
	class HotWidget extends Widget{
		public function render ($data){
			//热门文章
			$limit = $data['limit'];
			$field = array('id','title','click');
			$blog = M('blog')->field($filed)->order('click DESC')->limit($limit)->select();
			$data['blog'] = $blog;
			//p($data);die;
			return $this->renderFile('',$data);
		}
	}
 ?>