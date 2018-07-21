<ul>
	<li><?php echo CHtml::link('Create New Post',array('//cakeposts/create'))?></li>
	<li><?php echo CHtml::link('Manage Posts',array('//cakeposts/admin'))?></li>
	<li><?php echo CHtml::link('Approve Comments',array('//cakecomments/index')) . ' (' . CakeComments::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Logout',array('//site/logout'))?></li>
</ul>