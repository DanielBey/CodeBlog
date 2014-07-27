<?php 
	class ListAction extends Action{
		public function index(){
			import('Class.Category',APP_PATH);
			import('ORG.Util.Page');
			$id = (int)$_GET['id'];//类别id
			$cate = M('cate')->order('sort')->select();//所有的分类
			
			$cids = Category::getChildsId($cate,$id);//在所有分类中找出该类的子类
			$cids[] = $id;//此时cids中存储的是该类及其所有的子类
			$where = array('cid'=>array('IN',$cids));
			$count = M('blog')->where($where)->count();
			$page = new Page($count,2);
			$limit = $page->firstRow.','.$page->listRows;
			$blog = D('BlogView')->where($where)->limit($limit)->order('time DESC')->select();
			//$blog = M('blog')->where(array('cid'=>array('IN',$cids)))->select();
			//p($blog);die;
			$showpage = $page->show();
			$this->assign('showpage',$showpage);
			$this->assign('blog',$blog);
			$this->display();
		}
	}
 ?>