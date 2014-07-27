<?php 
	class Category{
		//组合一维数组
		static public function unlimitedForLevel($cate,$html='&nbsp;--',$pid=0,$level=0){
			$arr=array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$v['level'] = $level+1;
					$v['html'] = str_repeat($html,$level);
					$arr[] = $v;
					$arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level + 1));
				}
			}
			return $arr;
		}
		//组合多维数组
		static public function unlimitedForLayer($cate,$pid=0){
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid']==$pid) {
					$v['child'] = self::unlimitedForLayer($cate,$v['id']);
					$arr[] = $v;
				}
			}
			return $arr;//返回所有pid为指定值的元素
		}
		//返回$id分类的所有父级分类
		static public function getParents($cate,$id){
			$arr = array();
			foreach( $cate as $v){
				if ($v['id']==$id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate,$v['pid']) , $arr);
				}
			}
			return $arr;
		}
		//输入一个父级分类IP返回所有子分类ID
		static public function getChildsID($cate,$pid){
			$arr = array();
			foreach($cate as $v){
				if ($v['pid'] == $pid) {
					$arr[] = $v['id'];
					$arr = array_merge($arr,self::getChildsID($cate,$v['id']));
				}
			}
			return $arr;
		}
	}
 ?>