<ul>
	<li><?php echo CHtml::link('Create New Post',array('//demopost/create'))?></li>
	<li><?php echo CHtml::link('Manage Posts',array('//demopost/admin'))?></li>
	<li><?php echo CHtml::link('Approve Comments',array('//democomment/index')) . ' (' . DemoComment::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Logout',array('//site/logout'))?></li>
</ul>