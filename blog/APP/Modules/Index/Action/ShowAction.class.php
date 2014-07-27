<?php 
	class ShowAction extends Action{
		public function index(){
			$id = (int)$_GET['id'];
			
			$where = array('id'=>$id);
			$field = array('id','title','time','content','cid');
			$blog = M('blog')->field($field)->where($where)->find();
			$this->assign('blog',$blog);

			import('Class.Category',APP_PATH);
			$cate = M('cate')->order('sort')->select();//p($cate);die;
			$cid = $blog['cid'];//p($cid);
			$parent = Category::getParents($cate,$cid);//p($parent);die;
			$this->assign('parent',$parent);//p($parent);die;

			$this->display();
		}

		public function clickNum(){
			$clickid = (int)$_GET['id'];//这个$_GET['id']是由index.html中的U方法传过来的
			$where = array('id'=>$clickid);
			$click = M('blog')->where($where)->getField('click');
			M('blog')->where($where)->setInc('click');//每次刷新页面click字段+1
			
			echo 'document.write('.$click.')';
		}
	}
 ?>