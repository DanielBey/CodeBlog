<?php 
	Class BlogAction extends CommonAction{

		//文章列表
		public function index(){
			//$field = array('id','title','content','time','click');
			//$where = array('del'=>0);//只显示没有被放入回收站中的文章
			//p($where);
			//$blog = D('BlogRelation');
			//$blog = D('BlogRelation')->where($where)->relation(true)->select();
			$blog = D('BlogRelation')->getBlogs(0);//读取没有被删除的文章
			//p($blog);die;
			$this->assign('blog',$blog);
			//p($blog);die;
			$this->display();
		}

		//删除文章到回收站
		public function toggleTrash(){
			$type = (int)$_GET['type'];
			$update = array(
				'del'=>$type,
				);
			$where = array(
				'id'=>(int)$_GET['id'],
				);
			if(M('blog')->where($where)->save($update)){
				$toggleitem = M('blog')->where($where)->find();
				//p($titname);die;
				$msg1 = $type ? '删除'.$toggleitem['title'].'成功,可以到回收站中还原' :'文章'.$toggleitem['title'].'已经还原，请到文章列表中查看';
				$this->success($msg1,U(GROUP_NAME.'/Blog/index'));
			}else{
				$msg2 = $type ? '删除'.$toggleitem['title'].'失败，返回文章列表' :'文章'.$toggleitem['title'].'还原失败，将返回到回收站';
				$this->error($msg2,U(GROUP_NAME.'/Blog/index'));
			}
		}

		//显示回收站当中的文章
		public function trash(){
			//$where = array('del'=>1);
			//$blog = D('BlogRelation')->where($where)->relation(true)->select();
			$blog = D('BlogRelation')->getBlogs(1);//读取被放入回收站的文章
			$this->assign('blog',$blog);
			$this->display('index');//直接调用index的模版即可
		}

		public function delete(){
			$id = (int)$_GET['id'];
			$where1 = array('id'=>$id);
			$where2 = array('bid'=>$id);
			$deleteitem = M('blog')->where($where1)->find();
			if (M('blog')->where($where1)->delete()) {
				if(M('blog_attr')->where($where2)->delete()){
					
					$this->success('文章'.$deleteitem['title'].'已被永久删除',U(GROUP_NAME.'/Blog/trash'));
				}
			}else{
				$this->error('文章'.$deleteitem['title'].'删除失败，正跳转到回收站重新删除',U(GROUP_NAME.'/Blog/trash'));
			}
		}


		//添加文章
		public function blog(){
			//所属分类
			import('Class.Category',APP_PATH);
			$cate = M('cate')->order('sort')->select();
			$cate = Category::unlimitedForLevel($cate);
			$this->assign('cate',$cate);

			//分配文章的属性
			$attr = M('attr')->select();
			$this->assign('attr',$attr);
			//显示添加文章的页面
			$this->display();
		}
		//添加文章表单处理函数。由blog.html的form表单提交过来
		public function addBlog(){
			//p($_POST);
			$data = array(
				//要传到主表blog中的值
				'title'=>$_POST['title'],
				'content'=>$_POST['content'],
				'summary'=>$_POST['summary'],
				'time'=>time(),
				'click'=>(int)$_POST['click'],
				'cid'=>(int)$_POST['cid'],
				);
			//如果设置了属性信息将属性信息加进来
			if ($bid = M('blog')->add($data)) {
				if (isset($_POST['aid'])) {
					$sql = 'INSERT INTO '.C('DB_PREFIX').'blog_attr (bid,aid) VALUES';
					foreach($_POST['aid'] as $v){
						$sql .= '('.$bid.','.$v.'),';
					}
					$sql = rtrim($sql,',');
				}
				M('blog_attr')->query($sql);
				$this->success('发布文章成功',U(GROUP_NAME.'/Blog/index'));
			}else{
				$this->error('发布文章失败',U(GROUP_NAME.'/Blog/addBlog'));
			}
		}
		//编辑器图片上传处理
		public function upload(){
			//导入ThinkPHP中的上传类。先完成图片上传，才能图片处理
			import ('ORG.Net.UploadFile');
			//定义UploadFile上传类的配置项，
			//该类中有默认配置项$this->config，如果传入自定义$config配置项之后，将其与默认配置项合并
			//在UploadFile.class.php中的构造函数中有array_merge($this->config,$config);
			$config = array(
				'autoSub'  =>  true,// 启用子目录保存文件
				'subType'  =>  'date',// 子目录创建方式 可以使用hash date custom
				'dateFormat'  =>  'Ym',
				);
			$upload = new UploadFile($config);
			//$a = $upload->upload('./Uploads/');
			//echo $a;die;
			if($upload->upload('./Uploads/')) {
                $info = $upload->getUploadFileInfo();//得到图片上传的信息
	                //载入ThinkPHP中的图片处理类
	                // import('ORG.Util.Image');
	                // Image::water('./Uploads/'.$info[0]['savename'],'./Data/logo.png');
                
                //载入自己写的Image.class.php图片处理类
                import('Class.Image',APP_PATH);
                Image::water('./Uploads/'.$info[0]['savename']);
                Image::text('./Uploads/'.$info[0]['savename']);
                //向浏览器返回数据json数据
                echo json_encode(
                	array(
	                    'url' =>$info[0]['savename'],//保存后的文件路径及文件名
	                    'title' => htmlspecialchars($_POST['pictitle'],ENT_QUOTES),//文件描述
	                    'original' => $info[0]['name'],//原始文件名
	                    'state' => 'SUCCESS'//上传状态
                    )
                );
            }else{
                echo json_encode(
                	array(
                        'state' => $upload->getErrorMsg()
                    )
                );            
            }
		}
	}
 ?>