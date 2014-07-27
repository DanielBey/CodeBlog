<?php 
	class CategoryAction extends CommonAction{
		//分类列表的视图
		public function index(){
			import('Class.Category',APP_PATH);
			$cate = M('cate')->order('sort ASC')->select();
			//$cate = Category::getParents($cate,12);
			//p($cate);die;
			$cate = Category::unlimitedForLevel($cate);
			$this->assign('cate',$cate);
			$this->display();
		}
		//添加分类的视图
		public function addCate(){
			$pid = I('pid',0,'intval');
			$this->assign('pid',$pid);
			$this->display();
		}
		//添加分类的表单处理
		public function runAddCate(){
			if (M('cate')->add($_POST)) {
				$this->success('添加成功',U(GROUP_NAME.'/Category/index'));
			}else{
				$this->error('添加失败，请重新添加',U(GROUP_NAME.'/Category/addCate'));
			}
		}
		public function sortCate(){
			$db = M('cate');
			foreach($_POST as $id=>$sort){
				$db->where(array('id'=>$id))->setfield('sort',$sort);
			}
			$this->redirect(GROUP_NAME.'/Category/index');
		}
		public function deleteCate(){
			$idToDel = (int)$_GET['idToDel'];
			$where1 = array('id'=>$idToDel);
			$where2 = array('cid'=>$idToDel);
			$data['cid'] = $idToDel;
			$data['cid'] = M('cate')->where($where1)->getField('pid');
			$deleteitem = M('cate')->where($where1)->find();
			if(M('blog')->where($where2)->save($data)){
				if(M('cate')->where($where1)->delete()){
					$this->success('类别'.$deleteitem['name'].'已被永久删除',U(GROUP_NAME.'/Category/index'));
				}
			}else{
				if(M('cate')->where($where1)->delete()){
					$this->error('类别'.$deleteitem['name'].'已被永久删除',U(GROUP_NAME.'/Category/index'));
				}
			}
		}
		// public function delete(){
		// 	$id = (int)$_GET['id'];
		// 	$where1 = array('id'=>$id);
		// 	$where2 = array('bid'=>$id);
		// 	$deleteitem = M('blog')->where($where1)->find();
		// 	if (M('blog')->where($where1)->delete()) {
		// 		if(M('blog_attr')->where($where2)->delete()){
					
		// 			$this->success('文章'.$deleteitem['title'].'已被永久删除',U(GROUP_NAME.'/Blog/trash'));
		// 		}
		// 	}else{
		// 		$this->error('文章'.$deleteitem['title'].'删除失败，正跳转到回收站重新删除',U(GROUP_NAME.'/Blog/trash'));
		// 	}
		// }

	}
 ?>