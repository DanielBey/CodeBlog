<?php 
	 class SystemAction extends CommonAction{
	 	public function verify(){
	 		$this->display();
	 	}
	 	//修改配置文件verify.php中的值
	 	public function updateVerify(){
	 		//将verify.html中表单传来的值缓存到Conf/verify.php文件中
	 		if(F('verify',$_POST,CONF_PATH)){
	 			$this->success('修改成功',U(GROUP_NAME.'/System/verify'));
	 		}else{
	 			$this->error('修改失败，请修改'.CONF_PATH.'.verify.php权限');
	 		}
	 	}

	 	public function water(){
	 		$this->display();
	 	}
	 	//修改配置文件water.php中的值
	 	public function updateWater(){
	 		//water.html中表单传来的值缓存到Conf/water.php文件中
	 		if(F('water',$_POST,CONF_PATH)){
	 			$this->success('修改成功',U(GROUP_NAME.'/System/water'));
	 		}else{
	 			$this->error('修改失败，请重新修改'.CONF_PATH.'.water.php权限');
	 		}
	 	}
	 }
 ?>