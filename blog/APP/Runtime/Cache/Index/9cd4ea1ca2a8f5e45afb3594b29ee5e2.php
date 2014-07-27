<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="__PUBLIC__/Css/common.css" />
	
	<script type="text/JavaScript" src='__PUBLIC__/Js/jquery-1.7.2.min.js'></script>
	<script type="text/JavaScript" src='__PUBLIC__/Js/common.js'></script>
	<link rel="stylesheet" href="__PUBLIC__/Css/show.css" />
	<link rel="stylesheet" href="/blog/Data/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
	<script type="text/javascript" src="/blog/Data/ueditor/third-party/SyntaxHighlighter/shCore.js" ></script>
	<!--语法高亮-->
	<script type="text/javascript">
		SyntaxHighlighter.all();
	</script>
<SCRIPT language=javascript>
	function g(formname) {
	var url = "http://www.baidu.com/baidu";
	if (formname.s[1].checked) {
		formname.ct.value = "2097152";
	}
	else {
		formname.ct.value = "0";
	}
	// formname.action = url;
	// formname.ct.value = "0";
	formname.action = url;
	return true;
	}
</SCRIPT>
</head>
<body>


	<div class='top-search-wrap'>
		<div class='top-search'>
			<a href="http://www.danielbey.com" target='_blank' class='logo'>
				<img src="__PUBLIC__/Images/logo.png"/>
			</a>
			<div class='search-wrap'>
				<!--
				<form action="" method='get'>
					<input type="text" name='keyword' class='search-content'/>
					<input type="submit" name='search' value='搜索'/>
				</form>
				-->
				<form name="f1" onsubmit="return g(this)">
					<input type="text" name='word' class='search-content'/>
					<input type="submit" name='search' value='搜索'/>
					<input name=tn type=hidden value="bds">
					<input name=cl type=hidden value="3">
					<input name=ct type=hidden>
					<input name=si type=hidden value="localhost"><br>
					<input name=s type=radio> <span class='whiteword'>互联网</span>
					<input name=s type=radio checked> <span class='whiteword'>本博客</span>
				</form>
				<!--
				<form name="f1" onsubmit="return g(this)">
					<table bgcolor="#FFFFFF" style="font-size:9pt;">
						<tr height="60"><td valign="top"><img src="http://img.baidu.com/img/logo-137px.gif" border="0" alt="baidu"></td>
						<td>
						<input name=word size="30" maxlength="100">
						<input type="submit" value="百度搜索"><br>
						<input name=tn type=hidden value="bds">
						<input name=cl type=hidden value="3">
						<input name=ct type=hidden>
						<input name=si type=hidden value="localhost">
						<input name=s type=radio> 互联网
						<input name=s type=radio checked> localhost
						</td></tr>
					</table>
				</form>-->
			</div>
		</div>
	</div>
	
<?php  $cate = M('cate')->order('sort')->select(); import('Class.Category',APP_PATH); $cate = Category::unlimitedForLayer($cate); ?>
<!--
	<div class='top-nav-wrap'>
		<ul class='nav-lv1'>
			<li class='nav-lv1-li'>
				<a href="" class='top-cate'>博客首页</a>
			</li>
			<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li class='nav-lv1-li'>
					<a href="" class='top-cate'><?php echo ($v["name"]); ?></a>
					<?php if($v["child"]): ?><ul>
							<?php if(is_array($v["child"])): foreach($v["child"] as $key=>$value): ?><li><a href=""><?php echo ($value["name"]); ?></a></li><?php endforeach; endif; ?>
						</ul><?php endif; ?>
				</li><?php endforeach; endif; ?>
		</ul>
	</div>
-->
	<div class='top-nav-wrap'>
		<ul class='nav-lv1'>
			<li class='nav-lv1-li'>
				<a href="__GROUP__" class='top-cate'>博客首页</a>
			</li>
			<?php
 $_nav_cate = M('cate')->order("sort")->select(); import('Class.Category',APP_PATH); $_nav_cate = Category::unlimitedForLayer($_nav_cate); foreach($_nav_cate as $v): extract($v); $url = U('/c_'.$id); ?><li class='nav-lv1-li'>
					<a href="<?php echo U(GROUP_NAME.'/List/index',array('id'=>$v['id']));?>" class='top-cate'><?php echo ($name); ?></a>
					<ul>
						<?php if(is_array($child)): foreach($child as $key=>$v): ?><li>
								<a href="<?php echo U(GROUP_NAME.'/List/index',array('id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a>
								
							</li><?php endforeach; endif; ?>
					</ul>
				</li><?php endforeach;?>
		</ul>
	</div>



<!--主体-->
	<div class='main'>
		<div class='main-left'>
			<div class='location'>
				<a href="">首页</a>  >
				<?php $last = count($parent)-1; ?>
				<?php if(is_array($parent)): foreach($parent as $k=>$v): ?><a href="<?php echo U('/c_'.$v['id']);?>"><?php echo ($v["name"]); ?></a><?php if($k != $last): ?>><?php endif; endforeach; endif; ?>
			</div>
			<div class="title">
				<p><?php echo ($blog["title"]); ?></p>
				<div>
					<span class='fl'>发布于：<?php echo (date('Y年m月d日',$blog["time"])); ?></span>
					<span class='fr'>已被阅读<script type="text/javascript" src="<?php echo U(GROUP_NAME.'/Show/clickNum',array('id'=>$blog['id']));?>" ></script>次
					</span>
				</div>
			</div>
			<!--强制换行-->
			<div class='content' style='word-break:break-all'>
				<?php echo ($blog["content"]); ?>
			</div>
		</div>
	<!--主体右侧-->
<div class='main-right'>
	<!--利用wiget显示热门博文
	将以前在right.html中的热门博文部分转移到HotWidget.class.php中去
	HotWidget类的render函数接收array('limit'=>5)作为参数-->
	<?php echo W('Hot',array('limit'=>5));?>
	<!--利用wiget显示最新博文
	将以前在right.html中的热门博文部分转移到NewWidget.class.php中去-->
	<?php echo W('New',array('limit'=>5));?>
	<dl>
		<dt>友情连接</dt>
		<dd>
			<a href="http://bbs.byr.cn/#!default">BYR论坛</a>
		</dd>

		<dd>
			<a href="http://blog.csdn.net/">CSDN博客</a>
		</dd>
		
	</dl>
</div>
	</div>

<!--底部-->
	<div class='bottom'>
		<div>
		</div>
	</div>
</body>
</html>