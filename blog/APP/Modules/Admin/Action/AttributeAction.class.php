<?php 
	class AttributeAction extends CommonAction{
		//属性列表
		public function index(){
			$attr = M('attr')->select();
			$this->assign('attr',$attr);
			$this->display();
		}
		//添加属性视图
		public function addAttr(){
			$this->display();
		}
		//添加属性的表单处理
		public function runAddAttr(){
			if (M('attr')->add($_POST)) {
				$this->success('添加成功',U(GROUP_NAME.'/Attribute/index'));
			}else{
				$this->error('添加失败',U(GROUP_NAME.'/Attribute/addAttr'));
			}
		}
		public function deleteAttr(){
			$id = (int)$_GET['id'];
			$where1 = array('id'=>$id);
			$where2 = array('aid'=>$id);
			$deleteitem = M('attr')->where($where1)->find();
			if (M('attr')->where($where1)->delete()){
				if(M('blog_attr')->where($where2)->delete()){
					$this->success('属性'.$deleteitem['name'].'已被永久删除',U(GROUP_NAME.'/Attribute/index'));
				}
			}else{
				$this->error('属性'.$deleteitem['name'].'删除失败',U(GROUP_NAME.'/Attribute/index'));
			}
		}
	}
 ?>