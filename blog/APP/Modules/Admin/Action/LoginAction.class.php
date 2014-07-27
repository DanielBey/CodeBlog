<?php 
/**
 * 后台登录控制器
 */
	Class LoginAction extends Action{
		//后台登录页面视图
		Public function index(){
			$this->display();
		}

		Public function login(){
			if (!IS_POST) {
				halt('页面不存在');
			}
			//判断验证码是否正确
			if (I('code','','strtolower') != session('verify')) {
				$this->error('验证码不正确');
			}
			//验证用户名和密码
			$db = M('user');
			$user = $db->where( array('username'=>I('username')) )->find();
			if (!$user || $user['password']!=I('password','','md5')) {
				$this->error('用户名或密码错误');
			}
			//更新数据库中的最后登录时间和最后登录IP
			$update = array(
				'id' => $user['id'],
				'logintime' => time(),
				'loginip' => get_client_ip(),
				);
			$db->save($update);
			//将信息写入SESSION，以便在其他页面判断是否还是这个用户
			session('uid',$user['id']);
			session('username',$user['username']);
			session('password',$user['password']);
			session('logintime',date('Y-m-d H:i:s',$update['logintime']));
			session('loginip',$update['loginip']);
			//redirect(__GROUP__);
			$this->redirect(GROUP_NAME.'/Index/index');
		}
		//产生验证码
		Public function verify(){
			import('Class.Image',APP_PATH);
			Image::verify();
		}
	}
 ?>