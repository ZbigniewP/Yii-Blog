<ul>
	<li><?= CHtml::link('Create New Post',array('//post/create'))?></li>
	<li><?= CHtml::link('Manage Posts',array('//post/admin'))?></li>
	<li><?= CHtml::link('Approve Comments',array('//comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
	<li><?= CHtml::link('Logout',array('//site/logout'))?></li>
</ul>