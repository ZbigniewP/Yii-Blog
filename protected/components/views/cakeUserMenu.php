<ul>
	<li><?= CHtml::link('Create New Post',array('//cakeposts/create'))?></li>
	<li><?= CHtml::link('Manage Posts',array('//cakeposts/admin'))?></li>
	<li><?= CHtml::link('Approve Comments',array('//cakecomments/index')) . ' (' . CakeComments::model()->pendingCommentCount . ')'; ?></li>
	<li><?= CHtml::link('Logout',array('//site/logout'))?></li>
</ul>