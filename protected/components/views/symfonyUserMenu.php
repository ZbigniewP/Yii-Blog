<ul>
	<li><?= CHtml::link('Create New Post',array('//demopost/create'))?></li>
	<li><?= CHtml::link('Manage Posts',array('//demopost/admin'))?></li>
	<li><?= CHtml::link('Approve Comments',array('//democomment/index')) . ' (' . DemoComment::model()->pendingCommentCount . ')'; ?></li>
	<li><?= CHtml::link('Logout',array('//site/logout'))?></li>
</ul>