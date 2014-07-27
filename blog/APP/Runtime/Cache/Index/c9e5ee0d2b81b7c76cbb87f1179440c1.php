<?php if (!defined('THINK_PATH')) exit();?><dl>
	<dt>最新发布</dt>
	<?php if(is_array($news)): foreach($news as $key=>$v): ?><dd>
			<a href="<?php echo U('/'.$v['id']);?>"><?php echo ($v["title"]); ?></a>
			<span>(<?php echo (date("y-m-d h:i:s",$v["time"])); ?>)</span>
		</dd><?php endforeach; endif; ?>
</dl>