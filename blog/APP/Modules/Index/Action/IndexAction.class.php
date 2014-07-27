<?php 
	//前台首页的控制器
	class IndexAction extends Action {
		public function index(){
			//如果缓存不存在则读取数据库，然后生成动态缓存
			//如果已经有缓存,就不读数据库了.
			if ( !($topcate=S('index_topcate')) ) {
				//只读取顶级分类
				$where = array('pid'=>0);
				$topcate = M('cate')->where($where)->order('sort')->select();
				//p($topcate);//die;
				$cate = M('cate')->order('sort')->select();
				//p($cate);die;
				import('Class.Category',APP_PATH);

				foreach ($topcate as $key => $value) {
					$cids = Category::getChildsID($cate,$value['id']);
					$cids[] = $value['id'];
					$blogwhere = array('cid'=>array('IN',$cids));
					$blogfield = array('id','title','time');
					$topcate[$key]['blog'] = M('blog')->where($blogwhere)->field($blogfield)->order('time DESC')->select();
				}
				S('index_topcate',$topcate,10);//设置缓存为10秒
			}

			
			//p($topcate);die;
			
			$this->assign('topcate',$topcate);
			//p(__ROOT__);
			$this->display();
		}
	}
 ?>